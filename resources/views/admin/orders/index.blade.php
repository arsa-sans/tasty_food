@extends('layouts.kaiadmin')

@section('title', 'Pesanan Pelanggan')
@section('page-title', 'Kelola Pesanan Pelanggan')
@section('page-subtitle', 'Pantau dan perbarui status pesanan makanan, konfirmasi, proses memasak, hingga pengantaran kurir')

@section('breadcrumbs')
<div class="btn-group gap-2" role="group">
    <a href="{{ route('admin.orders.index') }}" class="btn {{ empty(request('status')) ? 'btn-primary' : 'btn-outline-primary' }} btn-round btn-sm">
        Semua ({{ $totalOrders }})
    </a>
    <a href="{{ route('admin.orders.index', ['status' => 'menunggu_konfirmasi']) }}" class="btn {{ request('status') === 'menunggu_konfirmasi' ? 'btn-warning' : 'btn-outline-warning' }} btn-round btn-sm">
        Menunggu Konfirmasi
        @if($unreadCount > 0)
            <span class="badge bg-danger text-white ms-1">{{ $unreadCount }}</span>
        @endif
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-round shadow-sm">
            <div class="card-header bg-transparent border-bottom d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <!-- Status Filter Pills -->
                <div class="d-flex flex-wrap gap-1">
                    <a href="{{ route('admin.orders.index') }}" class="badge {{ empty(request('status')) ? 'bg-primary' : 'bg-light text-dark border' }} text-decoration-none px-3 py-2">
                        Semua
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'menunggu_konfirmasi']) }}" class="badge {{ request('status') === 'menunggu_konfirmasi' ? 'bg-warning text-dark' : 'bg-light text-dark border' }} text-decoration-none px-3 py-2">
                        Menunggu Konfirmasi
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'dikonfirmasi']) }}" class="badge {{ request('status') === 'dikonfirmasi' ? 'bg-info text-white' : 'bg-light text-dark border' }} text-decoration-none px-3 py-2">
                        Dikonfirmasi
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'sedang_dimasak']) }}" class="badge {{ request('status') === 'sedang_dimasak' ? 'bg-primary' : 'bg-light text-dark border' }} text-decoration-none px-3 py-2">
                        Sedang Dimasak
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'dalam_pengiriman']) }}" class="badge {{ request('status') === 'dalam_pengiriman' ? 'bg-secondary' : 'bg-light text-dark border' }} text-decoration-none px-3 py-2">
                        Dalam Pengiriman
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'selesai']) }}" class="badge {{ request('status') === 'selesai' ? 'bg-success' : 'bg-light text-dark border' }} text-decoration-none px-3 py-2">
                        Selesai
                    </a>
                </div>

                <!-- Search by Code / Name -->
                <form action="{{ route('admin.orders.index') }}" method="GET" class="d-flex" style="max-width: 280px;">
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Cari kode atau nama..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Kode Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Menu Dipesan</th>
                                <th>Total Bayar</th>
                                <th>Status Pesanan</th>
                                <th>Waktu</th>
                                <th style="width: 140px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $ord)
                            <tr class="{{ $ord->status === 'menunggu_konfirmasi' ? 'table-warning fw-bold' : '' }}">
                                <td>
                                    <span class="badge bg-dark font-monospace">{{ $ord->order_code }}</span>
                                </td>
                                <td>
                                    <div class="text-dark">{{ $ord->nama_pelanggan }}</div>
                                    <small class="text-muted fw-normal">
                                        <i class="fab fa-whatsapp text-success me-1"></i>{{ $ord->telepon }}
                                    </small>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $ord->items->pluck('nama_menu')->implode(', ') }}
                                    </small>
                                </td>
                                <td>
                                    <span class="text-success fw-bold d-block">{{ $ord->formatted_total }}</span>
                                    <span class="badge {{ $ord->status_pembayaran_badge_class }} text-truncate" style="max-width: 130px; font-size: 10px;" title="{{ $ord->metode_pembayaran }} - {{ $ord->status_pembayaran_label }}">
                                        {{ $ord->metode_pembayaran ?? 'COD' }} ({{ $ord->status_pembayaran_label }})
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $ord->status_badge_class }} d-block mb-1">
                                        {{ $ord->status_label }}
                                    </span>
                                    @if($ord->is_diterima)
                                        <small class="badge bg-success text-white d-block">
                                            ✓ Diterima @if($ord->rating) ⭐ {{ $ord->rating }}/5 @endif
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">{{ $ord->created_at->format('d/m/Y H:i') }}</small>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.orders.show', $ord->id) }}" class="btn btn-sm btn-primary" title="Kelola & Update Status">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </a>
                                        <form action="{{ route('admin.orders.destroy', $ord->id) }}" method="POST" onsubmit="return confirm('Hapus pesanan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger ms-1" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-shopping-bag fa-3x mb-3 d-block text-secondary opacity-50"></i>
                                    Belum ada data pesanan pelanggan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($orders->hasPages())
            <div class="card-footer bg-transparent border-top d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
