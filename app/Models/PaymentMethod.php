<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tipe',
        'nomor_rekening',
        'atas_nama',
        'instruksi',
        'gambar',
        'is_aktif',
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }

    public function getGambarUrlAttribute(): ?string
    {
        if (!$this->gambar) {
            return null;
        }

        if (Str::startsWith($this->gambar, ['http://', 'https://'])) {
            return $this->gambar;
        }

        if (Str::startsWith($this->gambar, 'assets/')) {
            return asset($this->gambar);
        }

        if (Str::startsWith($this->gambar, 'storage/')) {
            return asset($this->gambar);
        }

        return asset('storage/' . $this->gambar);
    }

    public function getTipeLabelAttribute(): string
    {
        return match ($this->tipe) {
            'cash' => 'Tunai (COD)',
            'e_wallet' => 'E-Wallet / QRIS',
            'bank' => 'Transfer Bank',
            default => ucfirst($this->tipe),
        };
    }

    public function getTipeBadgeClassAttribute(): string
    {
        return match ($this->tipe) {
            'cash' => 'bg-success text-white',
            'e_wallet' => 'bg-warning text-dark',
            'bank' => 'bg-info text-white',
            default => 'bg-secondary text-white',
        };
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
