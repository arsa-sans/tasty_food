<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->string('nama_pelanggan');
            $table->string('telepon');
            $table->string('email')->nullable();
            $table->text('alamat_lengkap');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->text('catatan')->nullable();
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->enum('status', [
                'menunggu_konfirmasi',
                'dikonfirmasi',
                'sedang_dimasak',
                'dalam_pengiriman',
                'selesai',
                'dibatalkan'
            ])->default('menunggu_konfirmasi');
            $table->text('keterangan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
