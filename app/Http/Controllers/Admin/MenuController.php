<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('kategori', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $menus = $query->latest()->paginate(10)->withQueryString();
        $categories = Menu::distinct()->pluck('kategori');

        return view('admin.menu.index', compact('menus', 'categories'));
    }

    public function create()
    {
        $existingCategories = Menu::distinct()->pluck('kategori');
        return view('admin.menu.create', compact('existingCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'is_tersedia' => 'boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

            $storageDir = storage_path('app/public/menu_images');
            $publicDir = public_path('storage/menu_images');

            if (!File::isDirectory($storageDir)) {
                File::makeDirectory($storageDir, 0755, true, true);
            }
            if (!File::isDirectory($publicDir)) {
                File::makeDirectory($publicDir, 0755, true, true);
            }

            $file->move($storageDir, $filename);
            File::copy($storageDir . '/' . $filename, $publicDir . '/' . $filename);

            $imagePath = 'menu_images/' . $filename;
        }

        Menu::create([
            'nama' => $validated['nama'],
            'kategori' => $validated['kategori'],
            'harga' => $validated['harga'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'image' => $imagePath,
            'is_tersedia' => $request->has('is_tersedia'),
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Menu makanan berhasil ditambahkan!');
    }

    public function edit(Menu $menu)
    {
        $existingCategories = Menu::distinct()->pluck('kategori');
        return view('admin.menu.edit', compact('menu', 'existingCategories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'is_tersedia' => 'boolean',
        ]);

        $data = [
            'nama' => $validated['nama'],
            'kategori' => $validated['kategori'],
            'harga' => $validated['harga'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'is_tersedia' => $request->has('is_tersedia'),
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

            $storageDir = storage_path('app/public/menu_images');
            $publicDir = public_path('storage/menu_images');

            if (!File::isDirectory($storageDir)) {
                File::makeDirectory($storageDir, 0755, true, true);
            }
            if (!File::isDirectory($publicDir)) {
                File::makeDirectory($publicDir, 0755, true, true);
            }

            $file->move($storageDir, $filename);
            File::copy($storageDir . '/' . $filename, $publicDir . '/' . $filename);

            $data['image'] = 'menu_images/' . $filename;
        }

        $menu->update($data);

        return redirect()->route('admin.menu.index')->with('success', 'Menu makanan berhasil diperbarui!');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu makanan berhasil dihapus!');
    }
}
