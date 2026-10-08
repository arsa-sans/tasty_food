<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;

class HomeController extends Controller
{
    public function index()
    {
        // 5 latest published articles for the Home news section (1 featured + 4 grid)
        $beritas = Berita::published()->latest('tanggal')->take(5)->get();

        // 6 latest galleries for the Home gallery section
        $galeris = Galeri::latest()->take(6)->get();

        // 4 signature dishes for the floating cards under Tentang Kami
        $signatureDishes = Berita::published()
            ->whereIn('slug', [
                'menjelajahi-nasi-goreng-sejarah-ciri-khas-dan-ragam-kuliner-favorit-dunia',
                'rendang-daging-sapi-mahakarya-kuliner-minang-yang-mendunia',
                'sate-ayam-madura-gurih-manis-bumbu-kacang-tradisional',
                'soto-ayam-lamongan-kuah-kuning-koya-gurih-penuh-cita-rasa',
            ])
            ->get();

        // Fallback to any 4 published articles if specific slugs not found
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
