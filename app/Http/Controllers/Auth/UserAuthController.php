<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    /**
     * Tampilkan halaman login untuk pengunjung publik.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    /**
     * Proses login pengunjung / user.
     * Hanya membutuhkan input email dan password.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $remember)) {
            $request->session()->regenerate();

            // Jika admin login lewat sini, set session admin juga
            if (Auth::user()->role === 'admin') {
                session(['admin_logged_in' => true]);
            }

            // Tautkan pesanan dari session tamu sebelumnya (jika ada) ke user yang baru login
            $sessionOrderCodes = session()->get('order_history', []);
            if (!empty($sessionOrderCodes)) {
                Order::whereIn('order_code', $sessionOrderCodes)
                    ->whereNull('user_id')
                    ->update(['user_id' => Auth::id()]);
            }

            return redirect()->intended(route('home'))
                ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Tampilkan halaman registrasi untuk pengunjung publik.
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    /**
     * Proses pendaftaran akun baru pengunjung / user.
     * Membutuhkan: nama lengkap, email, password, dan konfirmasi password.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain atau masuk ke akun Anda.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok dengan password yang dimasukkan.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'customer',
        ]);

        // Login otomatis setelah registrasi sukses
        Auth::login($user);
        $request->session()->regenerate();

        // Tautkan pesanan dari session tamu sebelumnya (jika ada) ke user baru
        $sessionOrderCodes = session()->get('order_history', []);
        if (!empty($sessionOrderCodes)) {
            Order::whereIn('order_code', $sessionOrderCodes)
                ->whereNull('user_id')
                ->update(['user_id' => $user->id]);
        }

        return redirect()->route('home')
            ->with('success', 'Pendaftaran berhasil! Selamat datang di Tasty Food, ' . $user->name . '!');
    }

    /**
     * Logout akun user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->forget('admin_logged_in');

        return redirect()->route('home')
            ->with('success', 'Anda telah berhasil keluar dari akun.');
    }
}
