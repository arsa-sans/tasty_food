<?php

namespace App\Http\Controllers;

use App\Models\Food;

class HomeController extends Controller
{
    public function index()
    {
        $tentangFoods = Food::active()->section('tentang')->latest()->take(4)->get();
        $beritaFoods = Food::active()->section('berita')->latest()->take(5)->get();
        $galeriFoods = Food::active()->section('galeri')->latest()->take(8)->get();

        return view('home', compact('tentangFoods', 'beritaFoods', 'galeriFoods'));
    }

    public function galeri()
    {
        $galeriFoods = Food::active()->section('galeri')->latest()->get();

        return view('galeri', compact('galeriFoods'));
    }

    public function berita()
    {
        $beritaFoods = Food::active()->section('berita')->latest()->get();

        return view('berita', compact('beritaFoods'));
    }
}
