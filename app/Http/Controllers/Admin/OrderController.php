<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('items')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_code', 'like', "%{$search}%")
                  ->orWhere('nama_pelanggan', 'like', "%{$search}%")
                  ->orWhere('telepon', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(12)->withQueryString();

        $unreadCount = Order::where('status', 'menunggu_konfirmasi')->count();
        $totalOrders = Order::count();

        return view('admin.orders.index', compact('orders', 'unreadCount', 'totalOrders'));
    }

    public function show(Order $order)
    {
        $order->load('items.menu');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu_konfirmasi,dikonfirmasi,sedang_dimasak,dalam_pengiriman,selesai,dibatalkan',
            'keterangan_admin' => 'nullable|string|max:1000',
        ]);

        $defaultKeterangan = match ($validated['status']) {
            'dikonfirmasi' => 'Pesanan telah dikonfirmasi oleh restoran dan masuk dalam antrean dapur.',
            'sedang_dimasak' => 'Makanan sedang disiapkan dan dimasak oleh koki kami.',
            'dalam_pengiriman' => 'Makanan selesai dimasak dan sedang dalam perjalanan diantar oleh kurir ke lokasi Anda.',
            'selesai' => 'Pesanan telah sampai dan diterima dengan baik oleh pelanggan. Selamat menikmati hidangan!',
            'dibatalkan' => 'Pesanan dibatalkan.',
            default => 'Menunggu konfirmasi restoran.',
        };

        $order->update([
            'status' => $validated['status'],
            'keterangan_admin' => $validated['keterangan_admin'] ?: $defaultKeterangan,
        ]);

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', "Status pesanan {$order->order_code} berhasil diperbarui menjadi: " . $order->status_label);
    }

    public function destroy(Order $order)
    {
        $code = $order->order_code;
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', "Pesanan {$code} berhasil dihapus.");
    }
}
