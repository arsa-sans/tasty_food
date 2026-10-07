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
            $table->unsignedTinyInteger('rating')->nullable()->after('keterangan_admin');
            $table->text('ulasan')->nullable()->after('rating');
            $table->boolean('is_diterima')->default(false)->after('ulasan');
            $table->timestamp('diterima_at')->nullable()->after('is_diterima');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['rating', 'ulasan', 'is_diterima', 'diterima_at']);
        });
    }
};
