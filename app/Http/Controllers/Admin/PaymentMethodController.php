<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of payment methods.
     */
    public function index(Request $request)
    {
        $query = PaymentMethod::query();

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nomor_rekening', 'like', "%{$search}%")
                  ->orWhere('atas_nama', 'like', "%{$search}%");
            });
        }

        $paymentMethods = $query->latest()->paginate(10)->withQueryString();

        return view('admin.payment-methods.index', compact('paymentMethods'));
    }

    /**
     * Show the form for creating a new payment method.
     */
    public function create()
    {
        return view('admin.payment-methods.create');
    }

    /**
     * Store a newly created payment method in storage.
     */
    public function store(Request $request)
    {
        // Hanya nama dan tipe yang wajib, sisanya opsional sesuai permintaan user
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|in:cash,e_wallet,bank',
            'nomor_rekening' => 'nullable|string|max:255',
            'atas_nama' => 'nullable|string|max:255',
            'instruksi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'is_aktif' => 'boolean',
        ], [
            'nama.required' => 'Nama metode pembayaran wajib diisi.',
            'tipe.required' => 'Jenis / tipe pembayaran (Cash, E-Wallet, atau Bank) wajib dipilih.',
        ]);

        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

            $storageDir = storage_path('app/public/payment_images');
            $publicDir = public_path('storage/payment_images');

            if (!File::isDirectory($storageDir)) {
                File::makeDirectory($storageDir, 0755, true, true);
            }
            if (!File::isDirectory($publicDir)) {
                File::makeDirectory($publicDir, 0755, true, true);
            }

            $file->move($storageDir, $filename);
            File::copy($storageDir . '/' . $filename, $publicDir . '/' . $filename);

            $imagePath = 'payment_images/' . $filename;
        }

        PaymentMethod::create([
            'nama' => $validated['nama'],
            'tipe' => $validated['tipe'],
            'nomor_rekening' => $validated['nomor_rekening'] ?? null,
            'atas_nama' => $validated['atas_nama'] ?? null,
            'instruksi' => $validated['instruksi'] ?? null,
            'gambar' => $imagePath,
            'is_aktif' => $request->has('is_aktif'),
        ]);

        return redirect()->route('admin.payment-methods.index')
            ->with('success', "Metode pembayaran '{$validated['nama']}' berhasil ditambahkan!");
    }

    /**
     * Show the form for editing the specified payment method.
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.payment-methods.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified payment method in storage.
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|in:cash,e_wallet,bank',
            'nomor_rekening' => 'nullable|string|max:255',
            'atas_nama' => 'nullable|string|max:255',
            'instruksi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'is_aktif' => 'boolean',
        ], [
            'nama.required' => 'Nama metode pembayaran wajib diisi.',
            'tipe.required' => 'Jenis / tipe pembayaran wajib dipilih.',
        ]);

        $data = [
            'nama' => $validated['nama'],
            'tipe' => $validated['tipe'],
            'nomor_rekening' => $validated['nomor_rekening'] ?? null,
            'atas_nama' => $validated['atas_nama'] ?? null,
            'instruksi' => $validated['instruksi'] ?? null,
            'is_aktif' => $request->has('is_aktif'),
        ];

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

            $storageDir = storage_path('app/public/payment_images');
            $publicDir = public_path('storage/payment_images');

            if (!File::isDirectory($storageDir)) {
                File::makeDirectory($storageDir, 0755, true, true);
            }
            if (!File::isDirectory($publicDir)) {
                File::makeDirectory($publicDir, 0755, true, true);
            }

            $file->move($storageDir, $filename);
            File::copy($storageDir . '/' . $filename, $publicDir . '/' . $filename);

            $data['gambar'] = 'payment_images/' . $filename;
        }

        $paymentMethod->update($data);

        return redirect()->route('admin.payment-methods.index')
            ->with('success', "Metode pembayaran '{$paymentMethod->nama}' berhasil diperbarui!");
    }

    /**
     * Remove the specified payment method from storage.
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        $nama = $paymentMethod->nama;
        $paymentMethod->delete();

        return redirect()->route('admin.payment-methods.index')
            ->with('success', "Metode pembayaran '{$nama}' berhasil dihapus!");
    }
}
