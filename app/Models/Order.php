<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
        'payment_method_id',
        'metode_pembayaran',
        'tipe_pembayaran',
        'bukti_pembayaran',
        'status_pembayaran',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getBuktiPembayaranUrlAttribute(): ?string
    {
        if (!$this->bukti_pembayaran) {
            return null;
        }

        if (\Illuminate\Support\Str::startsWith($this->bukti_pembayaran, ['http://', 'https://'])) {
            return $this->bukti_pembayaran;
        }

        if (\Illuminate\Support\Str::startsWith($this->bukti_pembayaran, 'storage/')) {
            return asset($this->bukti_pembayaran);
        }

        return asset('storage/' . $this->bukti_pembayaran);
    }

    public function getStatusPembayaranLabelAttribute(): string
    {
        return match ($this->status_pembayaran) {
            'belum_bayar' => 'Belum Dibayar',
            'menunggu_verifikasi' => 'Menunggu Verifikasi',
            'lunas' => 'Lunas',
            'ditolak' => 'Bukti Ditolak',
            null => 'Belum Dibayar',
            default => ucfirst(str_replace('_', ' ', (string) $this->status_pembayaran)),
        };
    }

    public function getStatusPembayaranBadgeClassAttribute(): string
    {
        return match ($this->status_pembayaran) {
            'belum_bayar', null => 'bg-secondary text-white',
            'menunggu_verifikasi' => 'bg-warning text-dark',
            'lunas' => 'bg-success text-white',
            'ditolak' => 'bg-danger text-white',
            default => 'bg-secondary text-white',
        };
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
