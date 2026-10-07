<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();

        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,avif|max:3072',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('galeri_images', 'public');
        }

        Galeri::create($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan!');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:3072',
        ]);

        if ($request->hasFile('image')) {
            if ($galeri->image && !Str::startsWith($galeri->image, 'assets/')) {
                Storage::disk('public')->delete($galeri->image);
            }
            $validated['image'] = $request->file('image')->store('galeri_images', 'public');
        } else {
            unset($validated['image']);
        }

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil diperbarui!');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->image && !Str::startsWith($galeri->image, 'assets/')) {
            Storage::disk('public')->delete($galeri->image);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil dihapus!');
    }
}
