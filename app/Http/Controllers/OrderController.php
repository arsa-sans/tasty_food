<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display the public menu page for ordering food.
     */
    public function menu(Request $request)
    {
        $query = Menu::query()->tersedia();

        if ($request->filled('kategori') && $request->kategori !== 'Semua') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        $menus = $query->latest()->get();
        $categories = Menu::distinct()->pluck('kategori');

        return view('menu', compact('menus', 'categories'));
    }

    /**
     * Display the checkout page.
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('menu')->with('error', 'Keranjang belanja Anda masih kosong. Silakan pilih menu terlebih dahulu.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    /**
     * Store the customer order.
     */
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('menu')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'telepon' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'alamat_lengkap' => 'required|string|max:1000',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'catatan' => 'nullable|string|max:1000',
        ], [
            'nama_pelanggan.required' => 'Nama lengkap wajib diisi.',
            'telepon.required' => 'Nomor WhatsApp / telepon wajib diisi untuk konfirmasi kurir.',
            'alamat_lengkap.required' => 'Alamat pengantaran lengkap wajib diisi.',
        ]);

        $totalHarga = 0;
        foreach ($cart as $item) {
            $totalHarga += $item['harga'] * $item['quantity'];
        }

        // Generate unique order code: TF-YYYYMMDD-XXXX
        $orderCode = 'TF-' . date('Ymd') . '-' . strtoupper(Str::random(5));
        while (Order::where('order_code', $orderCode)->exists()) {
            $orderCode = 'TF-' . date('Ymd') . '-' . strtoupper(Str::random(5));
        }

        $order = Order::create([
            'order_code' => $orderCode,
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'telepon' => $validated['telepon'],
            'email' => $validated['email'] ?? null,
            'alamat_lengkap' => $validated['alamat_lengkap'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'catatan' => $validated['catatan'] ?? null,
            'total_harga' => $totalHarga,
            'status' => 'menunggu_konfirmasi',
            'keterangan_admin' => 'Pesanan baru diterima. Menunggu konfirmasi dari pihak restoran.',
        ]);

        // Save order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $item['id'] ?? null,
                'nama_menu' => $item['nama'],
                'harga' => $item['harga'],
                'jumlah' => $item['quantity'],
                'subtotal' => $item['harga'] * $item['quantity'],
            ]);
        }

        // Clear cart session and record to customer's order history
        session()->forget('cart');
        session()->push('order_history', $order->order_code);

        return redirect()->route('order.track', $order->order_code)
            ->with('success', "Pesanan Anda berhasil dibuat! Kode Pesanan Anda: {$order->order_code}. Mohon simpan kode ini.");
    }

    /**
     * Track order status by order code.
     */
    public function track($order_code)
    {
        $order = Order::with('items')->where('order_code', $order_code)->firstOrFail();

        return view('order-track', compact('order'));
    }

    /**
     * Search order code form submission.
     */
    public function trackSearch(Request $request)
    {
        $request->validate([
            'order_code' => 'required|string',
        ]);

        $orderCode = trim($request->order_code);
        $order = Order::where('order_code', $orderCode)->first();

        if (!$order) {
            return redirect()->back()->with('error', "Pesanan dengan kode '{$orderCode}' tidak ditemukan. Pastikan kode sudah benar.");
        }

        return redirect()->route('order.track', $order->order_code);
    }

    /**
     * Customer confirms receiving the order and leaves rating & review.
     */
    public function confirmReceived(Request $request, $order_code)
    {
        $order = Order::where('order_code', $order_code)->firstOrFail();

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string|max:1000',
        ], [
            'rating.required' => 'Silakan pilih bintang rating (1 - 5) untuk hidangan dan pelayanan kami.',
        ]);

        $order->update([
            'rating' => $validated['rating'],
            'ulasan' => $validated['ulasan'] ?? null,
            'is_diterima' => true,
            'diterima_at' => now(),
            'status' => 'selesai',
            'keterangan_admin' => 'Pelanggan telah mengonfirmasi bahwa pesanan diterima dengan baik dan memberikan rating ' . $validated['rating'] . '/5 bintang. Terima kasih!',
        ]);

        return redirect()->route('order.track', $order->order_code)
            ->with('success', 'Terima kasih banyak! Konfirmasi penerimaan pesanan dan ulasan rating Anda telah berhasil kami terima.');
    }

    /**
     * Customer Order History page with search and status detail link.
     */
    public function history(Request $request)
    {
        $sessionCodes = session()->get('order_history', []);
        $search = trim($request->input('search', ''));

        if (!empty($search)) {
            $orders = Order::with('items')
                ->where(function ($q) use ($search) {
                    $q->where('order_code', 'like', "%{$search}%")
                      ->orWhere('telepon', 'like', "%{$search}%")
                      ->orWhere('nama_pelanggan', 'like', "%{$search}%");
                })
                ->latest()
                ->paginate(8)
                ->withQueryString();
        } elseif (!empty($sessionCodes)) {
            $orders = Order::with('items')
                ->whereIn('order_code', $sessionCodes)
                ->latest()
                ->paginate(8);
        } else {
            $orders = Order::with('items')->latest()->take(0)->paginate(8);
        }

        return view('order-history', compact('orders', 'search', 'sessionCodes'));
    }
}
