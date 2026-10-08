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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // e.g. "QRIS All Payment", "BCA Virtual Account", "Tunai (COD)"
            $table->enum('tipe', ['cash', 'e_wallet', 'bank'])->default('bank');
            $table->string('nomor_rekening')->nullable(); // no rek atau no HP e-wallet
            $table->string('atas_nama')->nullable(); // nama pemilik rekening
            $table->text('instruksi')->nullable(); // petunjuk pembayaran
            $table->string('gambar')->nullable(); // QRIS image atau logo
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
