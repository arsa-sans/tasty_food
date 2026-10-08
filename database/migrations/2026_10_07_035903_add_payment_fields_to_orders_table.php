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
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('payment_method_id')->nullable()->after('catatan')->constrained('payment_methods')->nullOnDelete();
            $table->string('metode_pembayaran')->nullable()->after('payment_method_id');
            $table->string('tipe_pembayaran')->nullable()->after('metode_pembayaran'); // 'cash', 'e_wallet', 'bank'
            $table->string('bukti_pembayaran')->nullable()->after('tipe_pembayaran'); // path to uploaded proof screenshot
            $table->enum('status_pembayaran', ['belum_bayar', 'menunggu_verifikasi', 'lunas', 'ditolak'])->default('belum_bayar')->after('bukti_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['payment_method_id']);
            $table->dropColumn([
                'payment_method_id',
                'metode_pembayaran',
                'tipe_pembayaran',
                'bukti_pembayaran',
                'status_pembayaran'
            ]);
        });
    }
};
