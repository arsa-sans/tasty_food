<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the shopping cart.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['quantity'];
        }

        return view('cart', compact('cart', 'total'));
    }

    /**
     * Add a menu item to the cart.
     */
    public function add(Request $request, $menu)
    {
        if (!($menu instanceof Menu)) {
            $menu = Menu::where('id', $menu)->orWhere('slug', $menu)->first();
        }

        if (!$menu) {
            return redirect()->route('menu')->with('error', 'Menu makanan tidak ditemukan.');
        }

        if (!$menu->is_tersedia) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Maaf, menu ini sedang habis.'], 400);
            }
            return redirect()->back()->with('error', 'Maaf, menu ini sedang habis.');
        }

        $cart = session()->get('cart', []);
        $id = $menu->id;
        $qty = max(1, (int) $request->input('quantity', 1));

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
        } else {
            $cart[$id] = [
                'id' => $menu->id,
                'nama' => $menu->nama,
                'slug' => $menu->slug,
                'kategori' => $menu->kategori,
                'harga' => (float) $menu->harga,
                'image_url' => $menu->image_url,
                'quantity' => $qty,
            ];
        }

        session()->put('cart', $cart);

        $totalCount = array_sum(array_column($cart, 'quantity'));

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "{$qty}x {$menu->nama} berhasil ditambahkan ke keranjang!",
                'cart_count' => $totalCount,
            ]);
        }

        return redirect()->route('cart.index')->with('success', "{$qty} porsi {$menu->nama} berhasil ditambahkan ke keranjang!");
    }

    /**
     * Update quantity of a cart item.
     */
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $action = $request->input('action');
            if ($action === 'increase') {
                $cart[$id]['quantity']++;
            } elseif ($action === 'decrease') {
                $cart[$id]['quantity']--;
                if ($cart[$id]['quantity'] <= 0) {
                    unset($cart[$id]);
                }
            } elseif ($request->filled('quantity')) {
                $qty = (int) $request->input('quantity');
                if ($qty <= 0) {
                    unset($cart[$id]);
                } else {
                    $cart[$id]['quantity'] = $qty;
                }
            }
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui.');
    }

    /**
     * Remove an item from the cart.
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $nama = $cart[$id]['nama'];
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', "{$nama} dihapus dari keranjang.");
        }

        return redirect()->route('cart.index');
    }

    /**
     * Empty the entire cart.
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang telah dikosongkan.');
    }
}
