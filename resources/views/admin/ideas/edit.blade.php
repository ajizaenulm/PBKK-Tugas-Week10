@extends('adminlte::page')

@section('title', 'Edit Ide Riset: ' . $idea->code)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="m-0 font-weight-bold">Edit Ide Riset [{{ $idea->code }}]</h1>
            <small class="text-muted">Perbarui data proposal ide riset inovasi mahasiswa</small>
        </div>
        <div>
            <a href="{{ route('admin.ideas.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if($errors->any())
                <div class="alert alert-danger shadow-sm">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm">
                <form action="{{ route('admin.ideas.update', $idea->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row g-3">
                            {{-- Inovator & NRP --}}
                            <div class="col-md-6">
                                <label class="form-label font-weight-bold">Nama Lengkap Inovator <span class="text-danger">*</span></label>
                                <input type="text" name="author" class="form-control" value="{{ old('author', $idea->author) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label font-weight-bold">NRP Mahasiswa <span class="text-danger">*</span></label>
                                <input type="text" name="nrp" class="form-control" value="{{ old('nrp', $idea->nrp) }}" maxlength="10" required>
                            </div>

                            {{-- Judul Ide --}}
                            <div class="col-12">
                                <label class="form-label font-weight-bold">Judul Ide Riset <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $idea->title) }}" required>
                            </div>

                            {{-- Kategori & Arsitektur --}}
                            <div class="col-md-6">
                                <label class="form-label font-weight-bold">Kategori Sistem Agen <span class="text-danger">*</span></label>
                                <select name="category" class="form-select" required>
                                    @php
                                        $cats = [
                                            'Autonomous Code Generation & Refactoring',
                                            'Real-Time Collaborative Debugger',
                                            'Automated Testing & QA Agent',
                                            'Academic Advisor & Curriculum Planner',
                                            'Campus Security & Network Defense Agent',
                                            'Semantic Code Search & Knowledge Graph',
                                        ];
                                    @endphp
                                    @foreach($cats as $cat)
                                        <option value="{{ $cat }}" {{ old('category', $idea->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label font-weight-bold">Arsitektur Agen <span class="text-danger">*</span></label>
                                <select name="architecture" class="form-select" required>
                                    @php
                                        $archs = [
                                            'Multi-Agent Collaboration',
                                            'ReAct Agent Loop',
                                            'Tool-Calling LLM',
                                            'Reflexion & Self-Correction Agent',
                                            'Hierarchical Plan-and-Solve Agent',
                                        ];
                                    @endphp
                                    @foreach($archs as $arch)
                                        <option value="{{ $arch }}" {{ old('architecture', $idea->architecture) === $arch ? 'selected' : '' }}>{{ $arch }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Target User & Prioritas & Status --}}
                            <div class="col-md-4">
                                <label class="form-label font-weight-bold">Target Pengguna <span class="text-danger">*</span></label>
                                <input type="text" name="target_user" class="form-control" value="{{ old('target_user', $idea->target_user) }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label font-weight-bold">Tingkat Prioritas <span class="text-danger">*</span></label>
                                <select name="priority" class="form-select" required>
                                    @foreach(['Rendah', 'Sedang', 'Tinggi', 'Kritis'] as $p)
                                        <option value="{{ $p }}" {{ old('priority', $idea->priority) === $p ? 'selected' : '' }}>{{ $p }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label font-weight-bold">Status Verifikasi <span class="text-danger">*</span></label>
                                <select name="status" class="form-select" required>
                                    @foreach(['Review', 'Disetujui', 'Ditolak'] as $st)
                                        <option value="{{ $st }}" {{ old('status', $idea->status) === $st ? 'selected' : '' }}>{{ $st }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tech Stack --}}
                            <div class="col-12">
                                <label class="form-label font-weight-bold">Tech Stack (Pisahkan dengan koma)</label>
                                <input type="text" name="tech_stack_input" class="form-control" value="{{ old('tech_stack_input', is_array($idea->tech_stack) ? implode(', ', $idea->tech_stack) : '') }}">
                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-12">
                                <label class="form-label font-weight-bold">Deskripsi & Ringkasan Inovasi <span class="text-danger">*</span></label>
                                <textarea name="description" rows="4" class="form-control" required>{{ old('description', $idea->description) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.ideas.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-warning font-weight-bold">
                            <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

