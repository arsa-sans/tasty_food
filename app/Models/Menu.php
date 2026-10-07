<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'slug',
        'kategori',
        'harga',
        'deskripsi',
        'image',
        'is_tersedia',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'is_tersedia' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function resolveRouteBinding($value, $field = null)
    {
        if (is_numeric($value)) {
            return $this->where('id', $value)->first();
        }
        return $this->where($field ?? 'slug', $value)->first() ?? $this->where('id', $value)->first();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($menu) {
            if (empty($menu->slug)) {
                $baseSlug = Str::slug($menu->nama);
                $slug = $baseSlug;
                $count = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }
                $menu->slug = $slug;
            }
        });
    }

    public function scopeTersedia($query)
    {
        return $query->where('is_tersedia', true);
    }

    public function getFormattedHargaAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

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

        if (Str::startsWith($this->image, 'storage/')) {
            return asset($this->image);
        }

        return asset('storage/' . $this->image);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
