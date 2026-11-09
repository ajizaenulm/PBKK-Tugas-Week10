@extends('adminlte::page')

@section('title', 'Detail Ide Riset: ' . $idea->code)

@section('content_header')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="m-0 font-weight-bold">Detail Ide Riset [{{ $idea->code }}]</h1>
            <p class="text-muted small mb-0 mt-1">Spesifikasi proposal dan arsitektur platform inovasi</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.ideas.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
            </a>
            <a href="{{ route('admin.ideas.edit', $idea->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil me-1"></i> Edit Data
            </a>
            @role('Admin')
                <form action="{{ route('admin.ideas.destroy', $idea->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ide ini? Tindakan tidak dapat dibatalkan.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash3 me-1"></i> Hapus
                    </button>
                </form>
            @endrole
        </div>
    </div>
@stop

@section('content')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header py-3">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-file-text me-2 text-primary"></i> {{ $idea->title }}
                    </h3>
                </div>
                <div class="card-body p-4">
                    <p class="lead" style="line-height: 1.7;">{{ $idea->description }}</p>

                    <h6 class="font-weight-bold mt-4 text-uppercase small text-muted">Teknologi &amp; Stack Terintegrasi:</h6>
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        @if(!empty($idea->tech_stack) && is_array($idea->tech_stack))
                            @foreach($idea->tech_stack as $tech)
                                <span class="badge font-monospace" style="background: var(--its-light); color: var(--its-accent); font-size: 0.8rem; padding: 0.45rem 0.75rem;">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        @else
                            <span class="text-muted small">Belum ada rincian tech stack.</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header py-3">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-info-circle me-2 text-primary"></i> Informasi Meta Proposal
                    </h3>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted small">Kode Proposal</span>
                            <span class="badge font-monospace" style="background: var(--its-light); color: var(--its-accent); font-weight: 700;">
                                {{ $idea->code }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted small">Inovator</span>
                            <strong>{{ $idea->author }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted small">NRP</span>
                            <span class="font-monospace">{{ $idea->nrp }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted small">Kategori</span>
                            <span class="text-end small font-weight-bold">{{ $idea->category }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted small">Arsitektur</span>
                            <span class="text-end small font-weight-bold">{{ $idea->architecture }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted small">Prioritas</span>
                            <span>
                                @if($idea->priority === 'Kritis')
                                    <span class="badge text-bg-danger">Kritis</span>
                                @elseif($idea->priority === 'Tinggi')
                                    <span class="badge text-bg-warning">Tinggi</span>
                                @elseif($idea->priority === 'Sedang')
                                    <span class="badge text-bg-info">Sedang</span>
                                @else
                                    <span class="badge text-bg-secondary">Rendah</span>
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted small">Status</span>
                            <span>
                                @if($idea->status === 'Disetujui')
                                    <span class="badge text-bg-success">Disetujui</span>
                                @elseif($idea->status === 'Review')
                                    <span class="badge text-bg-primary">Review</span>
                                @else
                                    <span class="badge text-bg-danger">Ditolak</span>
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted small">Didaftarkan Pada</span>
                            <small class="text-muted font-monospace">{{ $idea->created_at->format('d M Y, H:i') }}</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
