@extends('layouts.kaiadmin')

@section('title', 'All Messages')
@section('page-title', 'All Messages')
@section('page-subtitle', 'Kelola pesan dan pertanyaan dari form kontak pengunjung Tasty Food')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-round shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom">
                <h5 class="card-title fw-bold mb-0">
                    <i class="fas fa-inbox text-primary me-2"></i> 
                    {{ $status === 'belum_dibaca' ? 'Daftar Pesan Belum Dibaca' : 'Daftar Semua Pesan' }}
                </h5>
                <span class="badge bg-secondary text-white">{{ $messages->total() }} Pesan</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 30%;">Subjek</th>
                                <th style="width: 25%;">Pengirim</th>
                                <th style="width: 15%;">Tanggal</th>
                                <th style="width: 15%;">Status</th>
                                <th style="width: 15%;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($messages as $msg)
                            <tr class="{{ $msg->status === 'belum_dibaca' ? 'table-warning fw-bold' : '' }}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($msg->status === 'belum_dibaca')
                                            <i class="fas fa-circle text-danger me-2" style="font-size: 8px;"></i>
                                        @endif
                                        <span class="text-truncate" style="max-width: 280px;" title="{{ $msg->subjek }}">
                                            {{ $msg->subjek }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div>{{ $msg->nama }}</div>
                                    <small class="text-muted fw-normal">{{ $msg->email }}</small>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $msg->created_at ? $msg->created_at->format('d M Y H:i') : '-' }}
                                    </small>
                                </td>
                                <td>
                                    @if($msg->status === 'belum_dibaca')
                                        <span class="badge bg-warning text-dark px-2 py-1">Belum Dibaca</span>
                                    @else
                                        <span class="badge bg-success px-2 py-1">Dibaca</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-icon btn-round btn-light dropdown-toggle hide-arrow" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.messages.show', $msg->id) }}">
                                                    <i class="fas fa-eye text-primary me-2"></i> View
                                                </a>
                                            </li>
                                            @if($msg->status === 'belum_dibaca')
                                            <li>
                                                <form action="{{ route('admin.messages.mark-as-read', $msg->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-check text-success me-2"></i> Tandai Dibaca
                                                    </button>
                                                </form>
                                            </li>
                                            @endif
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-trash-alt me-2"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-envelope-open fa-3x text-muted mb-3 d-block"></i>
                                    Tidak ada pesan yang ditemukan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($messages->hasPages())
            <div class="card-footer bg-transparent py-3">
                <div class="d-flex justify-content-center">
                    {{ $messages->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
