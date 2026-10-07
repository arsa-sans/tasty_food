<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'subjek',
        'nama',
        'email',
        'pesan',
        'status',
    ];

    public function scopeUnread($query)
    {
        return $query->where('status', 'belum_dibaca');
    }

    public function scopeRead($query)
    {
        return $query->where('status', 'dibaca');
    }
}
