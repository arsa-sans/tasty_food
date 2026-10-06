<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Galeri (15 authentic Indonesian food galleries)
        Galeri::truncate();
        $galeriItems = [
            [
                'judul' => 'Rujak Buah Segar',
                'deskripsi' => 'Aneka potongan buah tropis segar dengan siraman bumbu rujak gula merah pedas manis gurih.',
                'image' => 'galeri_images/HU7vYeKkNe2gAfooNPf4kXL5iagrNM1WVaF0Eouh.jpg',
            ],
            [
                'judul' => 'Terang Bulan Manis',
                'deskripsi' => 'Martabak manis tebal bertekstur lembut dengan taburan keju, cokelat, dan kacang legit.',
                'image' => 'galeri_images/XvHJ7D3Oypxgp1a5I3EdxBRtJIrWFGd037GlrT9C.jpg',
            ],
            [
                'judul' => 'Aneka Masakan Nusantara',
                'deskripsi' => 'Ragam kuliner tradisional Indonesia dengan kekayaan bumbu rempah autentik.',
                'image' => 'galeri_images/rhdOOSLnMoiCXWI5R3PK51gWk1dIZqrwW2Iw1VWr.jpg',
            ],
            [
                'judul' => 'Sate Taichan Pedas Gurih',
                'deskripsi' => 'Daging ayam bakar gurih tanpa kecap disajikan bersama sambal pedas segar dan jeruk nipis.',
                'image' => 'galeri_images/Hp4B9T8AskPWQZvGU6KsLS8AOYAoQeIQFwP4IHFR.jpg',
            ],
            [
                'judul' => 'Martabak Telur Spesial',
                'deskripsi' => 'Kulit martabak renyah dengan isian telur bebek dan daging sapi cincang berbumbu daun bawang.',
                'image' => 'galeri_images/WxSGPEJEuvKlJc6myHK9NSdSMhHeWlctm1Iufe4y.jpg',
            ],
            [
                'judul' => 'Tumpeng Nasi Kuning',
                'deskripsi' => 'Sajian nasi tumpeng kuning wangi rempah dengan lauk-pauk komplit khas syukuran Nusantara.',
                'image' => 'galeri_images/tEnDEM8LtIFpU77XC6KyF7okstsAGhRhifeTsSFY.jpg',
            ],
            [
                'judul' => 'Nasi Liwet Sunda',
                'deskripsi' => 'Nasi liwet gurih beraroma serai dan daun salam dengan taburan teri medan dan petai.',
                'image' => 'galeri_images/vKPNybImfhfJSq9BaUY3eZvyfptJap5Bain8ilf3.jpg',
            ],
            [
                'judul' => 'Rendang Daging Sapi',
                'deskripsi' => 'Daging sapi empuk dimasak perlahan dalam kuah santan dan rempah asli Minangkabau.',
                'image' => 'galeri_images/Lx9GVtz4AQAIQs7jKM1ulvVsH426QSdyVzVk78M7.jpg',
            ],
            [
                'judul' => 'Sate Ayam Madura',
                'deskripsi' => 'Sate daging ayam bakar bumbu kacang lembut gurih manis legit disajikan hangat.',
                'image' => 'galeri_images/DYoQyYneyLY4v0xBQ6hJ0GNcct28TKow9UUbk9O6.jpg',
            ],
            [
                'judul' => 'Nasi Goreng Spesial',
                'deskripsi' => 'Nasi goreng bumbu khas Indonesia dengan telur mata sapi, ayam suwir, dan kerupuk renyah.',
                'image' => 'galeri_images/OdfWaXQuTAxoFiXN6bGf1Y28r50XgcMfYzNxtReo.jpg',
            ],
            [
                'judul' => 'Prasmanan Kuliner Nusantara',
                'deskripsi' => 'Sajian aneka hidangan tradisional istimewa untuk momen bersantap bersama keluarga.',
                'image' => 'galeri_images/HbIBh0d6ScDq641Uzqr6qIwPwxUFf8eofNqLLCHh.jpg',
            ],
            [
                'judul' => 'Mie Yamin Manis Gurih',
                'deskripsi' => 'Mie kenyal dengan balutan kecap manis spesial, taburan ayam cincang, dan kuah kaldu hangat.',
                'image' => 'galeri_images/gZdNq9JGeVHkfJ63bTtmmfifB8qftzsUSaPAs7tk.jpg',
            ],
            [
                'judul' => 'Bakso Sapi Urat',
                'deskripsi' => 'Bakso urat daging sapi asli dengan kuah kaldu bening gurih bertabur daun bawang dan bawang goreng.',
                'image' => 'galeri_images/jbK588efIMTMdg3tmoll13AmPTZTHuoERvNrL9w1.jpg',
            ],
            [
                'judul' => 'Mie Ayam Rancabolang',
                'deskripsi' => 'Mie ayam legendaris dengan potongan ayam semur gurih, caisim segar, dan kuah kaldu harum.',
                'image' => 'galeri_images/Duh3e6rFYWQce4ctbscHmruI0oYXoEICRBz5oXj3.jpg',
            ],
            [
                'judul' => 'Nasi Goreng Kampung',
                'deskripsi' => 'Nasi goreng tradisional bercita rasa gurih pedas terasi dengan aroma wangi bakaran wajan.',
                'image' => 'galeri_images/cmByX07zFtfTnRapyg8IHqcAWf0CJEavqZBVjmNI.jpg',
            ],
        ];

        foreach ($galeriItems as $g) {
            Galeri::create($g);
        }

        // 2. Seed Berita (Articles on authentic Indonesian foods)
        Berita::truncate();
        $beritaItems = [
            [
                'judul' => 'Mie Ayam, Kuliner Sederhana yang Dicintai Semua Orang',
                'slug' => 'mie-ayam-kuliner-sederhana-yang-dicintai-semua-orang',
                'konten' => '<p>Mie ayam menjadi salah satu kuliner yang tetap populer di tengah banyaknya makanan modern yang bermunculan. Mulai dari pelajar, pekerja kantoran, hingga keluarga, hidangan ini mudah ditemukan dan dinikmati oleh berbagai kalangan.</p><p>Perpaduan mie yang kenyal, potongan ayam berbumbu semur gurih manis, sayuran sawi segar, serta kuah kaldu hangat menjadi daya tarik utama mie ayam. Harganya yang relatif terjangkau juga membuat makanan ini menjadi pilihan favorit untuk makan siang maupun sekadar mengisi perut di sore hari.</p><p>Menariknya, mie ayam kini hadir dalam berbagai variasi. Ada mie ayam bakso, mie ayam pangsit, mie ayam jamur, hingga versi modern dengan tambahan topping beragam. Meski terus berkembang, cita rasa sederhana dan familiar tetap menjadi alasan banyak orang menyukainya.</p>',
                'image' => 'berita_images/VbiVSFCwGNVSyUU7VKejatLJG94HWeZjMc3mqqkA.jpg',
                'status' => 'published',
                'tanggal' => '2026-07-26',
            ],
            [
                'judul' => 'Opor Ayam, Kelezatan Kuah Santan Berbumbu Rempah dan Makna Tradisi di Hari Kemenangan',
                'slug' => 'opor-ayam-kelezatan-kuah-santan-berbumbu-rempah-dan-makna-tradisi-di-hari-kemenangan',
                'konten' => '<p>Di balik semaraknya perayaan Hari Raya di Indonesia, aroma harum hidangan hangat selalu menyertai momen kumpul keluarga. Salah satu sajian yang tak pernah absen dari meja makan adalah opor ayam.</p><p>Dibuat dari potongan ayam yang dimasak perlahan dalam kuah santan kaya rempah seperti ketumbar, jintan, serai, daun salam, dan lengkuas, opor ayam menghadirkan rasa gurih yang lembut dan menenangkan lidah.</p><p>Sajian ini paling nikmat disantap bersama ketupat atau lontong empuk, sambal goreng ati, dan taburan kerupuk udang renyah yang menyempurnakan santapan kebersamaan.</p>',
                'image' => 'berita_images/HkcCu6iNLTZjzPhXardjGuJopI6WCgcWpOUfozu8.jpg',
                'status' => 'published',
                'tanggal' => '2026-07-25',
            ],
            [
                'judul' => 'Menjelajahi Nasi Goreng: Sejarah, Ciri Khas, dan Ragam Kuliner Favorit Dunia',
                'slug' => 'menjelajahi-nasi-goreng-sejarah-ciri-khas-dan-ragam-kuliner-favorit-dunia',
                'konten' => '<p>Nasi goreng bukan sekadar makanan pengisi perut di kala lapar, melainkan warisan kuliner yang menceritakan perjalanan budaya dan kreativitas dapur Nusantara. Hidangan ini bahkan telah berulang kali dinobatkan sebagai salah satu makanan terlezat di dunia.</p><p>Ciri khas nasi goreng Indonesia terletak pada penggunaan kecap manis dan bumbu ulek yang terdiri dari bawang merah, bawang putih, cabai, dan terasi. Dimasak di atas wajan panas dengan api besar menghasilkan aroma khas bakaran wajan yang sangat menggugah selera.</p>',
                'image' => 'berita_images/jhdqO070J0VgTzgsNg0AtxKcWbBwGU7WnymfK1l4.jpg',
                'status' => 'published',
                'tanggal' => '2026-07-25',
            ],
            [
                'judul' => 'Kenapa Makanan Indonesia Banyak Disukai Orang Luar? Ini Alasannya!',
                'slug' => 'kenapa-makanan-indonesia-banyak-disukai-orang-luar-ini-alasannya',
                'konten' => '<p>Dalam beberapa tahun terakhir, kuliner Indonesia semakin mendunia. Mulai dari rendang, sate, gado-gado, hingga nasi goreng kerap memikat lidah para pecinta kuliner internasional.</p><p>Kekuatan utama kuliner Indonesia terletak pada keberanian meracik bumbu rempah alami yang melimpah. Perpaduan rasa manis, asam, asin, gurih, dan pedas yang seimbang menciptakan pengalaman kuliner yang mendalam dan tidak terlupakan.</p>',
                'image' => 'berita_images/xxV1D1G806xbj0s8YAK4ohoA5U739W3qeqf9Bpl8.jpg',
                'status' => 'published',
                'tanggal' => '2026-07-25',
            ],
            [
                'judul' => 'Nasi Uduk, Gurihnya Kuliner Betawi yang Memikat Lidah Lintas Generasi',
                'slug' => 'nasi-uduk-gurihnya-kuliner-betawi-yang-memikat-lidah-lintas-generasi',
                'konten' => '<p>Bagi masyarakat Jakarta dan sekitarnya, memulai hari tanpa sepiring nasi uduk hangat rasanya ada yang kurang. Nasi gurih beraroma daun pandan, serai, dan daun salam ini telah menjadi menu sarapan wajib bagi banyak orang.</p><p>Disajikan dengan berbagai pilihan lauk seperti ayam goreng lengkuas, tempe orek manis, bihun goreng, telur balado, semur tahu, dan sambal kacang pedas yang khas membuat sajian ini begitu lengkap dan memuaskan.</p>',
                'image' => 'berita_images/0OrgHcMCuu8sK3FMmDfr61o8xqKjZPmiqTzFW5HV.webp',
                'status' => 'published',
                'tanggal' => '2026-07-24',
            ],
            [
                'judul' => 'Rendang Daging Sapi, Mahakarya Kuliner Minangkabau yang Mendunia',
                'slug' => 'rendang-daging-sapi-mahakarya-kuliner-minangkabau-yang-mendunia',
                'konten' => '<p>Rendang adalah salah satu kebanggaan kuliner Indonesia yang telah diakui secara global. Proses memasaknya yang membutuhkan waktu berjam-jam menggunakan santan kental dan belasan jenis rempah menghasilkan serat daging yang sangat empuk dan meresap sempurna.</p><p>Keunikan rendang tidak hanya pada kelezatannya, tetapi juga filosofi kesabaran dan ketekunan yang terkandung dalam proses memasaknya.</p>',
                'image' => 'assets/images/foods/rendang.webp',
                'status' => 'published',
                'tanggal' => '2026-07-23',
            ],
            [
                'judul' => 'Sate Ayam Madura, Gurih Manis Bumbu Kacang Tradisional',
                'slug' => 'sate-ayam-madura-gurih-manis-bumbu-kacang-tradisional',
                'konten' => '<p>Sate ayam Madura terkenal dengan aroma bakarannya yang khas serta lumuran saus kacang yang kental, legit, dan gurih. Daging ayam yang dipotong dadu direndam dalam bumbu kecap sebelum dibakar di atas bara arang batok kelapa.</p><p>Disajikan bersama lontong hangat, irisan bawang merah segar, dan cabai rawit ulek, sate Madura selalu menjadi pilihan bersantap yang tak pernah mengecewakan.</p>',
                'image' => 'assets/images/foods/sate.webp',
                'status' => 'published',
                'tanggal' => '2026-07-22',
            ],
            [
                'judul' => 'Soto Ayam Lamongan, Kuah Kuning Koya Gurih Penuh Cita Rasa',
                'slug' => 'soto-ayam-lamongan-kuah-kuning-koya-gurih-penuh-cita-rasa',
                'konten' => '<p>Soto ayam khas Lamongan memiliki ciri khas pada kuah kaldu kuningnya yang harum rempah dan tambahan bubuk koya yang terbuat dari kerupuk udang dan bawang putih goreng.</p><p>Koya inilah yang membuat kuah soto menjadi kental, gurih, dan memiliki sensasi rasa yang membedakannya dari jenis soto lainnya di Indonesia.</p>',
                'image' => 'assets/images/foods/soto.webp',
                'status' => 'published',
                'tanggal' => '2026-07-21',
            ],
        ];

        foreach ($beritaItems as $b) {
            Berita::create($b);
        }

        // 3. Seed Messages (Contact messages inbox)
        Message::truncate();
        $messages = [
            [
                'subjek' => 'Pemesanan Menu Katering Prasmanan',
                'nama' => 'Bunga Citra',
                'email' => 'bunga@gmail.com',
                'pesan' => 'Halo Tasty Food, apakah restoran menyediakan paket katering nasi kotak dan prasmanan untuk acara syukuran kantor 50 porsi?',
                'status' => 'belum_dibaca',
            ],
            [
                'subjek' => 'Reservasi Meja Makan Keluarga',
                'nama' => 'Ikmal Ramadhan',
                'email' => 'ikmal@gmail.com',
                'pesan' => 'Halo admin, saya ingin reservasi meja untuk 8 orang di akhir pekan ini jam 19.00. Apakah tersedia area VIP yang nyaman?',
                'status' => 'dibaca',
            ],
            [
                'subjek' => 'Penawaran Kerjasama Pemasok Bahan Segar',
                'nama' => 'Iko Johansyah',
                'email' => 'marketing@cyberlabs.co.id',
                'pesan' => 'Kami dari distributor bahan pangan segar ingin menawarkan kerjasama pasokan sayuran dan daging berkualitas untuk restoran Tasty Food.',
                'status' => 'dibaca',
            ],
        ];

        foreach ($messages as $m) {
            Message::create($m);
        }
    }
}
