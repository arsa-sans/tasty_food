<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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

        $paymentMethods = PaymentMethod::aktif()->get();
        $user = Auth::user();

        return view('checkout', compact('cart', 'total', 'paymentMethods', 'user'));
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

        // Fetch selected payment method
        $paymentMethod = null;
        if ($request->filled('payment_method_id')) {
            $paymentMethod = PaymentMethod::where('is_aktif', true)->find($request->payment_method_id);
        }

        $rules = [
            'nama_pelanggan' => 'required|string|max:255',
            'telepon' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'alamat_lengkap' => 'required|string|max:1000',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'catatan' => 'nullable|string|max:1000',
            'payment_method_id' => 'required|exists:payment_methods,id',
        ];

        // Conditional validation: if e_wallet or bank, proof upload is required
        if ($paymentMethod && $paymentMethod->tipe !== 'cash') {
            $rules['bukti_pembayaran'] = 'required|image|mimes:jpeg,png,jpg,webp|max:5120';
        } else {
            $rules['bukti_pembayaran'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120';
        }

        $messages = [
            'nama_pelanggan.required' => 'Nama lengkap wajib diisi.',
            'telepon.required' => 'Nomor WhatsApp / telepon wajib diisi untuk konfirmasi kurir.',
            'alamat_lengkap.required' => 'Alamat pengantaran lengkap wajib diisi.',
            'payment_method_id.required' => 'Silakan pilih metode pembayaran yang Anda inginkan.',
            'payment_method_id.exists' => 'Metode pembayaran yang dipilih tidak valid atau sudah nonaktif.',
            'bukti_pembayaran.required' => 'Foto / screenshot bukti pembayaran wajib diunggah untuk metode transfer bank atau e-wallet/QRIS.',
            'bukti_pembayaran.image' => 'Bukti pembayaran harus berupa gambar/foto.',
            'bukti_pembayaran.mimes' => 'Format file bukti pembayaran harus JPG, JPEG, PNG, atau WEBP.',
            'bukti_pembayaran.max' => 'Ukuran foto bukti pembayaran maksimal 5MB.',
        ];

        $validated = $request->validate($rules, $messages);

        $totalHarga = 0;
        foreach ($cart as $item) {
            $totalHarga += $item['harga'] * $item['quantity'];
        }

        // Handle screenshot / proof upload
        $buktiPath = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = 'bukti_' . time() . '_' . Str::random(20) . '.' . $file->getClientOriginalExtension();

            $storageDir = storage_path('app/public/bukti_pembayaran');
            $publicDir = public_path('storage/bukti_pembayaran');

            if (!File::isDirectory($storageDir)) {
                File::makeDirectory($storageDir, 0755, true, true);
            }
            if (!File::isDirectory($publicDir)) {
                File::makeDirectory($publicDir, 0755, true, true);
            }

            $file->move($storageDir, $filename);
            File::copy($storageDir . '/' . $filename, $publicDir . '/' . $filename);

            $buktiPath = 'bukti_pembayaran/' . $filename;
        }

        // Generate unique order code: TF-YYYYMMDD-XXXX
        $orderCode = 'TF-' . date('Ymd') . '-' . strtoupper(Str::random(5));
        while (Order::where('order_code', $orderCode)->exists()) {
            $orderCode = 'TF-' . date('Ymd') . '-' . strtoupper(Str::random(5));
        }

        $isNonCash = $paymentMethod && $paymentMethod->tipe !== 'cash';

        $order = Order::create([
            'user_id' => Auth::id(), // Tautkan ke user jika sedang login
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
            'payment_method_id' => $paymentMethod?->id,
            'metode_pembayaran' => $paymentMethod?->nama ?? 'Cash On Delivery',
            'tipe_pembayaran' => $paymentMethod?->tipe ?? 'cash',
            'bukti_pembayaran' => $buktiPath,
            'status_pembayaran' => $isNonCash ? 'menunggu_verifikasi' : 'belum_bayar',
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
        $order = Order::with(['items', 'paymentMethod'])->where('order_code', $order_code)->firstOrFail();

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
        $search = trim($request->input('search', ''));
        $sessionCodes = session()->get('order_history', []);
        $isLoggedIn = Auth::check();

        $query = Order::with('items')->latest();

        if ($isLoggedIn) {
            // Pengguna yang sudah login: tampilkan seluruh riwayat pesanan milik user ini
            $query->where('user_id', Auth::id());

            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('order_code', 'like', "%{$search}%")
                      ->orWhere('telepon', 'like', "%{$search}%")
                      ->orWhere('nama_pelanggan', 'like', "%{$search}%");
                });
            }

            $orders = $query->paginate(8)->withQueryString();
        } else {
            // Pengunjung tamu (belum login): gunakan pencarian kode atau sesi lokal
            if (!empty($search)) {
                $orders = $query->where(function ($q) use ($search) {
                    $q->where('order_code', 'like', "%{$search}%")
                      ->orWhere('telepon', 'like', "%{$search}%")
                      ->orWhere('nama_pelanggan', 'like', "%{$search}%");
                })->paginate(8)->withQueryString();
            } elseif (!empty($sessionCodes)) {
                $orders = $query->whereIn('order_code', $sessionCodes)->paginate(8);
            } else {
                $orders = $query->whereRaw('1 = 0')->paginate(8);
            }
        }

        return view('order-history', compact('orders', 'search', 'sessionCodes', 'isLoggedIn'));
    }
}
