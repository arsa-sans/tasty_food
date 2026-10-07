<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subjek' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'nama' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'nullable|string|max:5000',
            'message' => 'nullable|string|max:5000',
        ]);

        $subjek = $request->input('subjek') ?? $request->input('subject') ?? ($request->input('phone') ? 'Telepon: ' . $request->input('phone') : 'Pesan dari Pengunjung');
        $nama = $request->input('nama') ?? $request->input('name') ?? 'Pengunjung';
        $email = $request->input('email');
        $pesan = $request->input('pesan') ?? $request->input('message') ?? '';

        // Save directly to Message
        Message::create([
            'subjek' => $subjek,
            'nama' => $nama,
            'email' => $email,
            'pesan' => $pesan,
            'status' => 'belum_dibaca',
        ]);

        return redirect()->route('kontak')
            ->with('success', 'Pesan Anda berhasil dikirim! Terima kasih telah menghubungi Tasty Food.');
    }
}
