<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $isAdmin = session('admin_logged_in') || (Auth::check() && Auth::user()->role === 'admin');

        if (!$isAdmin) {
            return redirect()->route('admin.login')->with('error', 'Akses khusus Administrator. Silakan login sebagai admin.');
        }

        return $next($request);
    }
}
