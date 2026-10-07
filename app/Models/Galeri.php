<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeris';

    protected $fillable = [
        'image',
        'judul',
        'deskripsi',
    ];

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('assets/images/foods/nasi-goreng.webp');
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        if (Str::startsWith($this->image, 'assets/')) {
            return asset($this->image);
        }

        return asset('storage/' . $this->image);
    }
}
