<?php

namespace App\Http\Controllers;

use App\Models\Food;

class HomeController extends Controller
{
    public function index()
    {
        // Newest items have priority (orderBy id desc)
        $tentangFoods = Food::active()->section('tentang')->orderBy('id', 'desc')->take(4)->get();
        $beritaFoods = Food::active()->section('berita')->orderBy('id', 'desc')->take(5)->get();
        $galeriFoods = Food::active()->section('galeri')->orderBy('id', 'desc')->take(6)->get();

        return view('home', compact('tentangFoods', 'beritaFoods', 'galeriFoods'));
    }

    public function galeri()
    {
        $galeriFoods = Food::active()->section('galeri')->orderBy('id', 'desc')->get();

        return view('galeri', compact('galeriFoods'));
    }

    public function berita()
    {
        $beritaFoods = Food::active()->section('berita')->orderBy('id', 'desc')->get();

        return view('berita', compact('beritaFoods'));
    }
}
