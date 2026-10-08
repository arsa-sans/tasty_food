<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            [
                'nama' => 'Cash On Delivery (COD)',
                'tipe' => 'cash',
                'nomor_rekening' => null,
                'atas_nama' => null,
                'instruksi' => 'Bayar tunai secara langsung kepada kurir pengantar saat pesanan makanan telah sampai di alamat tujuan Anda.',
                'gambar' => null,
                'is_aktif' => true,
            ],
            [
                'nama' => 'QRIS (Semua E-Wallet & M-Banking)',
                'tipe' => 'e_wallet',
                'nomor_rekening' => '0812-3456-7890',
                'atas_nama' => 'Tasty Food Resto',
                'instruksi' => 'Scan kode QRIS menggunakan GoPay, OVO, DANA, ShopeePay, BCA Mobile, Livin Mandiri, atau aplikasi perbankan lainnya, lalu upload bukti transfernya.',
                'gambar' => 'assets/qris-sample.png',
                'is_aktif' => true,
            ],
            [
                'nama' => 'Transfer Bank BCA',
                'tipe' => 'bank',
                'nomor_rekening' => '8735091234',
                'atas_nama' => 'PT Tasty Food Indonesia',
                'instruksi' => 'Transfer ke rekening BCA di atas sesuai total tagihan, kemudian upload screenshot struk transfer yang berhasil.',
                'gambar' => null,
                'is_aktif' => true,
            ],
            [
                'nama' => 'Transfer Bank Mandiri',
                'tipe' => 'bank',
                'nomor_rekening' => '1320019882233',
                'atas_nama' => 'PT Tasty Food Indonesia',
                'instruksi' => 'Transfer ke rekening Mandiri di atas sesuai total tagihan, kemudian upload screenshot bukti pembayaran m-banking.',
                'gambar' => null,
                'is_aktif' => true,
            ],
        ];

        foreach ($methods as $m) {
            PaymentMethod::updateOrCreate(
                ['nama' => $m['nama']],
                $m
            );
        }
    }
}
