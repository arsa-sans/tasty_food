<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->paginate(15);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function show(Review $review)
    {
        // Mark as read when admin views it
        if (!$review->is_read) {
            $review->update(['is_read' => true]);
        }

        return view('admin.reviews.show', compact('review'));
    }

    // Tidak ada hapus karena trasparansi
    // public function destroy(Review $review)
    // {
    //     $review->delete();

    //     return redirect()->route('admin.reviews.index')
    //         ->with('success', 'Ulasan berhasil dihapus!');
    // }
}
