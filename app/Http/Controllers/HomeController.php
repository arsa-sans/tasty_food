<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;

class HomeController extends Controller
{
    public function index()
    {
        $beritas = Berita::published()->latest('tanggal')->take(5)->get();

        $galeris = Galeri::latest()->take(6)->get();

        $signatureDishes = Berita::published()
            ->whereIn('slug', [
                'menjelajahi-nasi-goreng-sejarah-ciri-khas-dan-ragam-kuliner-favorit-dunia',
                'rendang-daging-sapi-mahakarya-kuliner-minang-yang-mendunia',
                'sate-ayam-madura-gurih-manis-bumbu-kacang-tradisional',
                'soto-ayam-lamongan-kuah-kuning-koya-gurih-penuh-cita-rasa',
            ])
            ->get();

        if ($signatureDishes->count() < 4) {
            $signatureDishes = Berita::published()->latest('tanggal')->take(4)->get();
        }

        return view('home', compact('beritas', 'galeris', 'signatureDishes'));
    }

    public function galeri()
    {
        $galeris = Galeri::latest()->get();

        return view('galeri', compact('galeris'));
    }

    public function berita()
    {
        $beritas = Berita::published()->latest('tanggal')->get();

        return view('berita', compact('beritas'));
    }

    public function makananDetail($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();

        $otherBeritas = Berita::published()
            ->where('id', '!=', $berita->id)
            ->latest('tanggal')
            ->take(4)
            ->get();

        return view('berita-detail', compact('berita', 'otherBeritas'));
    }
}
