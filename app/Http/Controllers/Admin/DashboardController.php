<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        $totalFoods = Food::count();
        $activeFoods = Food::active()->count();
        $totalReviews = Review::count();
        $unreadReviews = Review::unread()->count();
        $latestReviews = Review::latest()->take(5)->get();
        $latestFoods = Food::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalFoods',
            'activeFoods',
            'totalReviews',
            'unreadReviews',
            'latestReviews',
            'latestFoods'
        ));
    }
}
