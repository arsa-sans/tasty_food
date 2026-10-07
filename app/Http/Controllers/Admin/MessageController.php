<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = Message::query()->latest();

        if ($status === 'belum_dibaca') {
            $query->unread();
        }

        $messages = $query->paginate(15);
        $unreadCount = Message::unread()->count();

        return view('admin.messages.index', compact('messages', 'status', 'unreadCount'));
    }

    public function show(Message $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    public function markAsRead(Message $message)
    {
        $message->update(['status' => 'dibaca']);

        return back()->with('success', 'Pesan berhasil ditandai sudah dibaca!');
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Pesan berhasil dihapus!');
    }
}
