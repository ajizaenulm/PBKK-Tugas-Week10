@extends('adminlte::page')

@section('title', 'Tambah Ide Riset Baru')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="m-0 font-weight-bold">Tambah Ide Riset Agentic AI</h1>
            <small class="text-muted">Formulir pendaftaran proposal ide inovasi riset mahasiswa</small>
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
                <form action="{{ route('admin.ideas.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row g-3">
                            {{-- Inovator & NRP --}}
                            <div class="col-md-6">
                                <label class="form-label font-weight-bold">Nama Lengkap Inovator / Mahasiswa <span class="text-danger">*</span></label>
                                <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author') }}" placeholder="Contoh: Aji Zaenul Musthofa" required>
                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label font-weight-bold">NRP Mahasiswa (10 Digit) <span class="text-danger">*</span></label>
                                <input type="text" name="nrp" class="form-control @error('nrp') is-invalid @enderror" value="{{ old('nrp') }}" placeholder="Contoh: 5025241065" maxlength="10" required>
                                @error('nrp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Judul Ide --}}
                            <div class="col-12">
                                <label class="form-label font-weight-bold">Judul Ide Riset / Platform Agentic AI <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Contoh: Magentic: Autonomous Multi-Agent Collaborative IDE" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kategori & Arsitektur --}}
                            <div class="col-md-6">
                                <label class="form-label font-weight-bold">Kategori Sistem Agen <span class="text-danger">*</span></label>
                                <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                                    <option value="Autonomous Code Generation & Refactoring">Autonomous Code Generation & Refactoring</option>
                                    <option value="Real-Time Collaborative Debugger">Real-Time Collaborative Debugger</option>
                                    <option value="Automated Testing & QA Agent">Automated Testing & QA Agent</option>
                                    <option value="Academic Advisor & Curriculum Planner">Academic Advisor & Curriculum Planner</option>
                                    <option value="Campus Security & Network Defense Agent">Campus Security & Network Defense Agent</option>
                                    <option value="Semantic Code Search & Knowledge Graph">Semantic Code Search & Knowledge Graph</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label font-weight-bold">Arsitektur Agen <span class="text-danger">*</span></label>
                                <select name="architecture" class="form-select @error('architecture') is-invalid @enderror" required>
                                    <option value="Multi-Agent Collaboration">Multi-Agent Collaboration</option>
                                    <option value="ReAct Agent Loop">ReAct Agent Loop</option>
                                    <option value="Tool-Calling LLM">Tool-Calling LLM</option>
                                    <option value="Reflexion & Self-Correction Agent">Reflexion & Self-Correction Agent</option>
                                    <option value="Hierarchical Plan-and-Solve Agent">Hierarchical Plan-and-Solve Agent</option>
                                </select>
                            </div>

                            {{-- Target User & Prioritas & Status --}}
                            <div class="col-md-4">
                                <label class="form-label font-weight-bold">Target Pengguna <span class="text-danger">*</span></label>
                                <input type="text" name="target_user" class="form-control" value="{{ old('target_user', 'Mahasiswa & Dosen Teknik Informatika') }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label font-weight-bold">Tingkat Prioritas <span class="text-danger">*</span></label>
                                <select name="priority" class="form-select" required>
                                    <option value="Rendah">Rendah</option>
                                    <option value="Sedang" selected>Sedang</option>
                                    <option value="Tinggi">Tinggi</option>
                                    <option value="Kritis">Kritis</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label font-weight-bold">Status Verifikasi <span class="text-danger">*</span></label>
                                <select name="status" class="form-select" required>
                                    <option value="Review" selected>Review</option>
                                    <option value="Disetujui">Disetujui</option>
                                    <option value="Ditolak">Ditolak</option>
                                </select>
                            </div>

                            {{-- Tech Stack --}}
                            <div class="col-12">
                                <label class="form-label font-weight-bold">Tech Stack (Pisahkan dengan koma)</label>
                                <input type="text" name="tech_stack_input" class="form-control" value="{{ old('tech_stack_input', 'Laravel 11, AdminLTE 4, SQLite, Python LLM') }}" placeholder="Contoh: Laravel 11, AdminLTE 4, SQLite, Gemini API">
                                <small class="text-muted">Teknologi pendukung yang direncanakan untuk platform ini.</small>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-12">
                                <label class="form-label font-weight-bold">Deskripsi & Ringkasan Inovasi <span class="text-danger">*</span></label>
                                <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Jelaskan fungsionalitas utama ide riset..." required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.ideas.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan Ide Baru
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

