<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE foods MODIFY COLUMN section VARCHAR(50) NOT NULL DEFAULT 'galeri'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE foods MODIFY COLUMN section ENUM('tentang', 'berita', 'galeri') NOT NULL DEFAULT 'galeri'");
    }
};
