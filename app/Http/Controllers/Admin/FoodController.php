<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    public function index(Request $request)
    {
        $query = Food::query();

        if ($request->filled('section')) {
            $query->where('section', $request->section);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $foods = $query->latest()->paginate(10);

        return view('admin.foods.index', compact('foods'));
    }

    public function create()
    {
        return view('admin.foods.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'section' => 'required|in:tentang,berita,galeri,semua',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('foods', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        Food::create($validated);

        return redirect()->route('admin.foods.index')
            ->with('success', 'Makanan berhasil ditambahkan!');
    }

    public function edit(Food $food)
    {
        return view('admin.foods.edit', compact('food'));
    }

    public function update(Request $request, Food $food)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'section' => 'required|in:tentang,berita,galeri,semua',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it's in storage (not a default asset)
            if (!str_starts_with($food->image, 'assets/')) {
                Storage::disk('public')->delete($food->image);
            }
            $validated['image'] = $request->file('image')->store('foods', 'public');
        } else {
            unset($validated['image']);
        }

        $validated['is_active'] = $request->has('is_active');

        $food->update($validated);

        return redirect()->route('admin.foods.index')
            ->with('success', 'Makanan berhasil diperbarui!');
    }

    public function destroy(Food $food)
    {
        // Delete image if it's in storage (not a default asset)
        if (!str_starts_with($food->image, 'assets/')) {
            Storage::disk('public')->delete($food->image);
        }

        $food->delete();

        return redirect()->route('admin.foods.index')
            ->with('success', 'Makanan berhasil dihapus!');
    }
}
