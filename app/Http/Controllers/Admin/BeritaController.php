<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest('tanggal')->latest('id')->paginate(12);

        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:beritas,slug',
            'konten' => 'required|string',
            'status' => 'required|in:draft,published',
            'tanggal' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,avif|max:2048',
        ]);

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['judul']);
            $slug = $baseSlug;
            $counter = 1;
            while (Berita::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }
            $validated['slug'] = $slug;
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('berita_images', 'public');
        }

        Berita::create($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:beritas,slug,' . $berita->id,
            'konten' => 'required|string',
            'status' => 'required|in:draft,published',
            'tanggal' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:2048',
        ]);

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['judul']);
            $slug = $baseSlug;
            $counter = 1;
            while (Berita::where('slug', $slug)->where('id', '!=', $berita->id)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }
            $validated['slug'] = $slug;
        }

        if ($request->hasFile('image')) {
            if ($berita->image && !Str::startsWith($berita->image, 'assets/')) {
                Storage::disk('public')->delete($berita->image);
            }
            $validated['image'] = $request->file('image')->store('berita_images', 'public');
        } else {
            unset($validated['image']);
        }

        $berita->update($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->image && !Str::startsWith($berita->image, 'assets/')) {
            Storage::disk('public')->delete($berita->image);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }
}
