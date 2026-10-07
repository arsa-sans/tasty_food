<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'nama_pelanggan',
        'telepon',
        'email',
        'alamat_lengkap',
        'latitude',
        'longitude',
        'catatan',
        'total_harga',
        'status',
        'keterangan_admin',
        'rating',
        'ulasan',
        'is_diterima',
        'diterima_at',
    ];

    protected $casts = [
        'total_harga' => 'decimal:2',
        'latitude' => 'float',
        'longitude' => 'float',
        'rating' => 'integer',
        'is_diterima' => 'boolean',
        'diterima_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
            'dikonfirmasi' => 'Pesanan Dikonfirmasi',
            'sedang_dimasak' => 'Sedang Dimasak / Dibuat',
            'dalam_pengiriman' => 'Dalam Pengiriman',
            'selesai' => 'Telah Sampai ke Pelanggan',
            'dibatalkan' => 'Pesanan Dibatalkan',
            default => ucfirst(str_replace('_', ' ', $this->status)),
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'menunggu_konfirmasi' => 'bg-warning text-dark',
            'dikonfirmasi' => 'bg-info text-white',
            'sedang_dimasak' => 'bg-primary text-white',
            'dalam_pengiriman' => 'bg-secondary text-white',
            'selesai' => 'bg-success text-white',
            'dibatalkan' => 'bg-danger text-white',
            default => 'bg-secondary text-white',
        };
    }

    public function getGoogleMapsUrlAttribute(): ?string
    {
        if ($this->latitude && $this->longitude) {
            return "https://www.google.com/maps?q={$this->latitude},{$this->longitude}";
        }
        return null;
    }
}
