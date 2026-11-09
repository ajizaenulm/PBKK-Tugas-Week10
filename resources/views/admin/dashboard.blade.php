@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="m-0">Dashboard</h1>
            <p class="small mb-0 mt-1">
                Portal Manajemen Ide Inovasi Riset &middot; Departemen Teknik Informatika ITS
            </p>
        </div>
        <div>
            @if(auth()->user()->hasRole('Admin'))
                <span class="badge-role-admin">
                    <i class="bi bi-shield-check me-1"></i> Admin (Akses Penuh)
                </span>
            @else
                <span class="badge-role-staf">
                    <i class="bi bi-person-badge me-1"></i> Staf (Akses Terbatas)
                </span>
            @endif
        </div>
    </div>
@stop

@section('content')
    {{-- Alert Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-dismissible fade show border-0 mb-4 shadow-sm" role="alert" style="background: rgba(34, 197, 94, 0.12); color: #15803d; border-radius: 14px;">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- 4 Widget Statistik Dinamis (Requirement: Agregat Model::count()) --}}
    <div class="row g-3 mb-4">
        {{-- Widget 1: Total Ide Riset --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="metric-card">
                <div class="metric-header">
                    <span class="metric-label">Total Usulan Ide</span>
                    <div class="metric-icon-box metric-icon-blue">
                        <i class="bi bi-cpu"></i>
                    </div>
                </div>
                <div>
                    <div class="metric-value">{{ $totalIdeas }}</div>
                    <div class="metric-caption">Katalog ide inovasi riset</div>
                </div>
            </div>
        </div>

        {{-- Widget 2: Prioritas Tinggi / Kritis --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="metric-card">
                <div class="metric-header">
                    <span class="metric-label">Prioritas Tinggi</span>
                    <div class="metric-icon-box metric-icon-rose">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                </div>
                <div>
                    <div class="metric-value">{{ $highPriorityIdeas }}</div>
                    <div class="metric-caption">Perlu tindak lanjut tim</div>
                </div>
            </div>
        </div>

        {{-- Widget 3: Ide Telah Disetujui --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="metric-card">
                <div class="metric-header">
                    <span class="metric-label">Ide Disetujui</span>
                    <div class="metric-icon-box metric-icon-emerald">
                        <i class="bi bi-patch-check"></i>
                    </div>
                </div>
                <div>
                    <div class="metric-value">{{ $approvedIdeas }}</div>
                    <div class="metric-caption">Tahap validasi & inkubasi</div>
                </div>
            </div>
        </div>

        {{-- Widget 4: Pengguna & Struktur RBAC --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="metric-card">
                <div class="metric-header">
                    <span class="metric-label">Pengguna Terdaftar</span>
                    <div class="metric-icon-box metric-icon-slate">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
                <div>
                    <div class="metric-value">{{ $totalUsers }}</div>
                    <div class="metric-caption">{{ $totalAdmins }} Admin &middot; {{ $totalStaf }} Staf</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Usulan Ide Riset Terbaru --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">
                <i class="bi bi-stars text-primary me-2"></i> Usulan Ide Riset Terbaru
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.ideas.index') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-table me-1"></i> Kelola Data Ide
                </a>
            </div>
        </div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width: 105px;">Kode</th>
                        <th>Judul Ide Riset</th>
                        <th>Inovator / NRP</th>
                        <th>Kategori</th>
                        <th style="width: 110px;">Prioritas</th>
                        <th style="width: 110px;">Status</th>
                        <th class="text-center" style="width: 130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentIdeas as $idea)
                        <tr>
                            <td>
                                <span class="badge font-monospace" style="background: var(--its-light); color: var(--its-accent); font-weight: 700;">
                                    {{ $idea->code }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $idea->title }}</div>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $idea->author }}</div>
                                <small class="text-muted font-monospace">{{ $idea->nrp }}</small>
                            </td>
                            <td>
                                <span class="text-muted small">{{ $idea->category }}</span>
                            </td>
                            <td>
                                @if($idea->priority === 'Kritis')
                                    <span class="badge text-bg-danger">Kritis</span>
                                @elseif($idea->priority === 'Tinggi')
                                    <span class="badge text-bg-warning">Tinggi</span>
                                @elseif($idea->priority === 'Sedang')
                                    <span class="badge text-bg-info">Sedang</span>
                                @else
                                    <span class="badge text-bg-secondary">Rendah</span>
                                @endif
                            </td>
                            <td>
                                @if($idea->status === 'Disetujui')
                                    <span class="badge text-bg-success">Disetujui</span>
                                @elseif($idea->status === 'Review')
                                    <span class="badge text-bg-primary">Review</span>
                                @else
                                    <span class="badge text-bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('admin.ideas.show', $idea->id) }}" class="btn-action" title="Detail Ide">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.ideas.edit', $idea->id) }}" class="btn-action" title="Edit Ide">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    {{-- HAK EKSKLUSIF ADMIN: Tombol Hapus hanya dirender jika Role Admin murni --}}
                                    @role('Admin')
                                        <form action="{{ route('admin.ideas.destroy', $idea->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ide [{{ $idea->code }}]?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-action-delete" title="Hapus (Admin)">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    @endrole
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-muted"></i>
                                Belum ada data usulan ide riset.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
