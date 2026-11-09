@extends('adminlte::page')

@section('title', 'Manajemen Pengguna & RBAC')

@section('content_header')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="m-0 font-weight-bold">Manajemen Pengguna &amp; Hak Akses</h1>
            <p class="text-muted small mb-0 mt-1">Kelola akun dan matriks otorisasi peran sistem Departemen Teknik Informatika ITS</p>
        </div>
        <div>
            <span class="badge px-3 py-2 rounded-pill font-weight-bold" style="background-color: rgba(220, 38, 38, 0.12); color: #dc2626; border: 1px solid rgba(220, 38, 38, 0.25); font-size: 0.8rem;">
                <i class="bi bi-shield-lock-fill me-1"></i> Khusus Hak Akses Admin
            </span>
        </div>
    </div>
@stop

@section('content')
    {{-- Tabel Pengguna & Role --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h3 class="card-title mb-0">
                <i class="bi bi-people me-2 text-primary"></i> Daftar Akun Pengguna Terdaftar
            </h3>
        </div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Nama Pengguna</th>
                        <th>Email Login</th>
                        <th style="width: 140px;">Role Spatie</th>
                        <th>Status Wewenang</th>
                        <th style="width: 130px;">Terdaftar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="font-monospace text-muted">{{ $user->id }}</td>
                            <td class="fw-bold">{{ $user->name }}</td>
                            <td><span class="font-monospace text-muted">{{ $user->email }}</span></td>
                            <td>
                                @foreach($user->roles as $role)
                                    @if($role->name === 'Admin')
                                        <span class="badge-role-admin"><i class="bi bi-shield-check"></i> {{ $role->name }}</span>
                                    @else
                                        <span class="badge-role-staf"><i class="bi bi-person-badge"></i> {{ $role->name }}</span>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @if($user->hasRole('Admin'))
                                    <span class="text-success small fw-bold">
                                        <i class="bi bi-check-circle-fill me-1"></i> Akses Penuh Termasuk Hak Hapus Data
                                    </span>
                                @else
                                    <span class="text-muted small">
                                        <i class="bi bi-dash-circle me-1"></i> Akses Terbatas (Tanpa Hak Hapus)
                                    </span>
                                @endif
                            </td>
                            <td class="small text-muted font-monospace">{{ $user->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Ringkasan Matriks Role & Permissions --}}
    <div class="row g-4">
        @foreach($roles as $role)
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="card-title mb-0">
                            @if($role->name === 'Admin')
                                <i class="bi bi-shield-fill-check text-primary me-2"></i> Peran: Admin (Full Access)
                            @else
                                <i class="bi bi-person-fill-gear text-info me-2"></i> Peran: Staf (Restricted)
                            @endif
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <p class="small text-muted mb-3">Daftar izin (*permissions*) aktif di database Spatie untuk role ini:</p>
                        <div class="d-flex flex-wrap gap-2">
                            @forelse($role->permissions as $perm)
                                <span class="badge font-monospace" style="{{ $perm->name === 'delete-ideas' ? 'background: rgba(220, 38, 38, 0.12); color: #dc2626; border: 1px solid rgba(220, 38, 38, 0.25);' : 'background: var(--its-light); color: var(--its-accent); border: 1px solid var(--its-border);' }} font-size: 0.78rem; padding: 0.4rem 0.75rem;">
                                    {{ $perm->name }}
                                </span>
                            @empty
                                <span class="text-muted small">Tidak ada permission.</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop

