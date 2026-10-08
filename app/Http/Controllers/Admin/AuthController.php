<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() || session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // Support both: (email + password) OR just (password)
        if ($request->filled('email')) {
            $credentials = $request->validate([
                'email' => 'required|string',
                'password' => 'required|string',
            ]);

            $remember = $request->boolean('remember');

            if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $remember)) {
                $request->session()->regenerate();
                session(['admin_logged_in' => true]);
                return redirect()->intended(route('admin.dashboard'));
            }
        }

        // Fallback for simple password check
        if ($request->input('password') === 'password123' || $request->input('password') === 'w3erty99a') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
            'password' => 'Password salah!',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->forget('admin_logged_in');

        return redirect()->route('admin.login');
    }
}
