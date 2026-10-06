<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Menu::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $menus = [
            [
                'nama' => 'Nasi Goreng Spesial Tasty',
                'kategori' => 'Makanan Utama',
                'harga' => 28000,
                'deskripsi' => 'Nasi goreng bumbu Nusantara dengan telur mata sapi, ayam suwir gurih, acar segar, dan kerupuk renyah.',
                'image' => 'assets/images/foods/nasi-goreng.webp',
                'is_tersedia' => true,
            ],
            [
                'nama' => 'Rendang Daging Sapi Padang',
                'kategori' => 'Makanan Utama',
                'harga' => 38000,
                'deskripsi' => 'Daging sapi pilihan empuk dimasak perlahan dengan santan murni dan racikan rempah Minangkabau autentik.',
                'image' => 'assets/images/foods/rendang.webp',
                'is_tersedia' => true,
            ],
            [
                'nama' => 'Sate Ayam Madura (10 Tusuk)',
                'kategori' => 'Makanan Utama',
                'harga' => 30000,
                'deskripsi' => 'Daging ayam bakar empuk berbumbu kecap manis gurih dengan siraman bumbu kacang lembut kental dan lontong.',
                'image' => 'assets/images/foods/sate.webp',
                'is_tersedia' => true,
            ],
            [
                'nama' => 'Soto Ayam Lamongan Koya',
                'kategori' => 'Makanan Utama',
                'harga' => 25000,
                'deskripsi' => 'Kuah kaldu kuning harum rempah kaya rasa dengan suwiran ayam, soun, telur rebus, dan taburan koya gurih melimpah.',
                'image' => 'assets/images/foods/soto.webp',
                'is_tersedia' => true,
            ],
            [
                'nama' => 'Mie Ayam Pangsit Komplit',
                'kategori' => 'Makanan Utama',
                'harga' => 22000,
                'deskripsi' => 'Mie kenyal dengan semur ayam manis gurih, caisim segar, pangsit goreng renyah, dan kuah kaldu hangat.',
                'image' => 'galeri_images/Duh3e6rFYWQce4ctbscHmruI0oYXoEICRBz5oXj3.jpg',
                'is_tersedia' => true,
            ],
            [
                'nama' => 'Opor Ayam Kuah Santan Rempah',
                'kategori' => 'Makanan Utama',
                'harga' => 32000,
                'deskripsi' => 'Potongan ayam kampung empuk disajikan dalam kuah santan gurih beraroma ketumbar, lengkuas, dan serai.',
                'image' => 'assets/images/foods/opor-ayam.webp',
                'is_tersedia' => true,
            ],
            [
                'nama' => 'Nasi Uduk Betawi Komplit',
                'kategori' => 'Makanan Utama',
                'harga' => 25000,
                'deskripsi' => 'Nasi gurih harum daun pandan disajikan lengkap dengan ayam goreng lengkuas, tempe orek, bihun, dan sambal kacang pedas.',
                'image' => 'berita_images/0OrgHcMCuu8sK3FMmDfr61o8xqKjZPmiqTzFW5HV.webp',
                'is_tersedia' => true,
            ],
            [
                'nama' => 'Tumpeng Nasi Kuning Mini',
                'kategori' => 'Makanan Utama',
                'harga' => 35000,
                'deskripsi' => 'Sajian porsi personal nasi kuning wangi dengan lauk ayam suwir, perkedel kentang, serundeng, telur dadar iris, dan sambal balado.',
                'image' => 'galeri_images/tEnDEM8LtIFpU77XC6KyF7okstsAGhRhifeTsSFY.jpg',
                'is_tersedia' => true,
            ],
            [
                'nama' => 'Bakso Sapi Urat Mantap',
                'kategori' => 'Makanan Utama',
                'harga' => 24000,
                'deskripsi' => 'Bakso urat sapi asli kenyal berdaging disajikan dengan mie bihun, tahu bakso, kuah kaldu sapi sedap, dan bawang goreng.',
                'image' => 'galeri_images/jbK588efIMTMdg3tmoll13AmPTZTHuoERvNrL9w1.jpg',
                'is_tersedia' => true,
            ],
            [
                'nama' => 'Sate Taichan Sambal Pedas',
                'kategori' => 'Makanan Utama',
                'harga' => 28000,
                'deskripsi' => 'Daging ayam bakar gurih asin dengan lumuran perasan jeruk nipis dan sambal ulek rawit merah ekstra pedas.',
                'image' => 'galeri_images/Hp4B9T8AskPWQZvGU6KsLS8AOYAoQeIQFwP4IHFR.jpg',
                'is_tersedia' => true,
            ],
            [
                'nama' => 'Martabak Telur Bebek Spesial',
                'kategori' => 'Camilan & Tambahan',
                'harga' => 35000,
                'deskripsi' => 'Kulit martabak tipis renyah dengan isian telur bebek berlimpah, cacahan daging sapi cincang berbumbu, dan saus kuah cuka sedap.',
                'image' => 'galeri_images/WxSGPEJEuvKlJc6myHK9NSdSMhHeWlctm1Iufe4y.jpg',
                'is_tersedia' => true,
            ],
            [
                'nama' => 'Terang Bulan Cokelat Keju',
                'kategori' => 'Camilan & Tambahan',
                'harga' => 28000,
                'deskripsi' => 'Martabak manis berserat lembut empuk dengan olesan mentega wangi, parutan keju cheddar melimpah, dan susu kental cokelat.',
                'image' => 'galeri_images/XvHJ7D3Oypxgp1a5I3EdxBRtJIrWFGd037GlrT9C.jpg',
                'is_tersedia' => true,
            ],
            [
                'nama' => 'Rujak Buah Tropis Segar',
                'kategori' => 'Camilan & Tambahan',
                'harga' => 18000,
                'deskripsi' => 'Kombinasi potongan buah mangga, nanas, kedondong, bengkuang, dan jambu dengan siraman bumbu gula merah asam pedas legit.',
                'image' => 'galeri_images/HU7vYeKkNe2gAfooNPf4kXL5iagrNM1WVaF0Eouh.jpg',
                'is_tersedia' => true,
            ],
        ];

        foreach ($menus as $m) {
            $m['slug'] = Str::slug($m['nama']);
            Menu::create($m);
        }
    }
}
