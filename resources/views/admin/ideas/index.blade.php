@extends('adminlte::page')

@section('title', 'Manajemen Data Ide Riset')

@section('content_header')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="m-0 font-weight-bold">Manajemen Data Ide Riset</h1>
            <p class="text-muted small mb-0 mt-1">
                Katalog usulan ide riset inovasi Departemen Teknik Informatika ITS
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge px-3 py-2 rounded-pill font-weight-bold" style="background: var(--its-light); color: var(--its-accent); border: 1px solid var(--its-border); font-size: 0.8rem;">
                Total: <strong>{{ $ideas->total() }}</strong> Ide
            </span>
            <a href="{{ route('admin.ideas.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Tambah Ide Baru
            </a>
        </div>
    </div>
@stop

@section('content')
    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-dismissible fade show border-0 mb-4 shadow-sm" role="alert" style="background: rgba(34, 197, 94, 0.12); color: #15803d; border-radius: 14px;">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Filter & Pencarian Data Kueri when() (Requirement PBKK) --}}
    <div class="card mb-4">
        <div class="card-header py-3">
            <h3 class="card-title mb-0">
                <i class="bi bi-funnel me-1 text-primary"></i> Filter &amp; Pencarian Data
            </h3>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.ideas.index') }}">
                <div class="row g-3 align-items-end">
                    {{-- Input Kata Kunci Pencarian --}}
                    <div class="col-md-5">
                        <label class="form-label small text-muted font-weight-bold">Kata Kunci:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Cari judul, inovator, NRP, kode..." value="{{ request('search') }}">
                        </div>
                    </div>

                    {{-- Filter Prioritas --}}
                    <div class="col-md-3">
                        <label class="form-label small text-muted font-weight-bold">Prioritas:</label>
                        <select name="priority" class="form-select">
                            <option value="">-- Semua Prioritas --</option>
                            <option value="Rendah" {{ request('priority') === 'Rendah' ? 'selected' : '' }}>Rendah</option>
                            <option value="Sedang" {{ request('priority') === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="Tinggi" {{ request('priority') === 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                            <option value="Kritis" {{ request('priority') === 'Kritis' ? 'selected' : '' }}>Kritis</option>
                        </select>
                    </div>

                    {{-- Filter Status --}}
                    <div class="col-md-2">
                        <label class="form-label small text-muted font-weight-bold">Status:</label>
                        <select name="status" class="form-select">
                            <option value="">-- Semua Status --</option>
                            <option value="Review" {{ request('status') === 'Review' ? 'selected' : '' }}>Review</option>
                            <option value="Disetujui" {{ request('status') === 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="Ditolak" {{ request('status') === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    {{-- Tombol Submit & Reset --}}
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-search me-1"></i> Filter
                        </button>
                        @if(request('search') || request('priority') || request('status'))
                            <a href="{{ route('admin.ideas.index') }}" class="btn btn-outline-secondary" title="Reset Filter">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Data Ide --}}
    <div class="card">
        <div class="card-body p-0 table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width: 105px;">Kode</th>
                        <th>Judul &amp; Inovator</th>
                        <th>Kategori &amp; Arsitektur</th>
                        <th style="width: 110px;">Prioritas</th>
                        <th style="width: 110px;">Status</th>
                        <th style="width: 130px;" class="text-center">Aksi RBAC</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ideas as $idea)
                        <tr>
                            <td>
                                <span class="badge font-monospace" style="background: var(--its-light); color: var(--its-accent); font-weight: 700;">
                                    {{ $idea->code }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $idea->title }}</div>
                                <small class="text-muted font-monospace">
                                    <i class="bi bi-person me-1"></i>{{ $idea->author }} &bull; NRP: {{ $idea->nrp }}
                                </small>
                            </td>
                            <td>
                                <div class="fw-semibold small">{{ $idea->category }}</div>
                                <small class="text-muted"><i class="bi bi-diagram-3 me-1"></i>{{ $idea->architecture }}</small>
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
                                    {{-- Tombol Lihat (Admin & Staf) --}}
                                    <a href="{{ route('admin.ideas.show', $idea->id) }}" class="btn-action" title="Detail Ide">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- Tombol Edit (Admin & Staf) --}}
                                    <a href="{{ route('admin.ideas.edit', $idea->id) }}" class="btn-action" title="Edit Data">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    {{-- HAK EKSKLUSIF ADMIN: Tombol Hapus hanya dirender jika Role Admin murni --}}
                                    @role('Admin')
                                        <form action="{{ route('admin.ideas.destroy', $idea->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ide [{{ $idea->code }}]? Tindakan ini tidak dapat dibatalkan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-action-delete" title="Hapus Data (Admin)">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    @endrole
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-muted"></i>
                                Tidak ada data ide riset yang cocok dengan kriteria pencarian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer Pagination (withQueryString() Requirement) --}}
        @if($ideas->hasPages())
            <div class="card-footer d-flex flex-wrap justify-content-between align-items-center py-3 gap-2">
                <div class="small text-muted">
                    Menampilkan <strong>{{ $ideas->firstItem() ?? 0 }}</strong> &ndash; <strong>{{ $ideas->lastItem() ?? 0 }}</strong> dari <strong>{{ $ideas->total() }}</strong> usulan ide
                </div>
                <div>
                    {{ $ideas->links('admin.partials.pagination') }}
                </div>
            </div>
        @endif
    </div>
@stop
