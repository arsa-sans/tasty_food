<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Message;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();
        $unreadMessagesCount = Message::unread()->count();
        $totalMenu = Menu::count();
        $totalOrders = Order::count();
        $unconfirmedOrdersCount = Order::where('status', 'menunggu_konfirmasi')->count();

        // Data Terbaru
        $latestOrders = Order::with('items')->latest()->take(5)->get();
        $latestGaleri = Galeri::latest()->take(8)->get();
        $latestMessages = Message::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalBerita',
            'totalGaleri',
            'unreadMessagesCount',
            'totalMenu',
            'totalOrders',
            'unconfirmedOrdersCount',
            'latestOrders',
            'latestGaleri',
            'latestMessages'
        ));
    }
}
