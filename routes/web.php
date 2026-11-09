<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IdeaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Tugas Mandiri: Dashboard & RBAC Implementation
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. RUTE PORTAL AKADEMIK PUBLIK (Multi-View)
// ==========================================
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/beranda', [PageController::class, 'index'])->name('beranda');
Route::get('/profil-mahasiswa', [PageController::class, 'profilMahasiswa'])->name('profil.mahasiswa');
Route::get('/ide-agent', [PageController::class, 'ideAgent'])->name('ide.agent');
Route::post('/ide-agent', [PageController::class, 'storeIdea'])->name('ide.agent.store');
Route::post('/agent/idea', [PageController::class, 'storeIdea']);

// =========================================================
// 2. RUTE DASHBOARD BACKOFFICE ADMINLTE & RBAC (Protected Auth)
// =========================================================
Route::middleware(['auth', 'verified'])->group(function () {
    // 2.1 Beranda Dashboard dengan 3+ Widget Box Agregat
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2.2 Manajemen Data Ide Riset (CRUD + Search when() + Pagination withQueryString())
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('ideas', IdeaController::class);

        // 2.3 Manajemen Pengguna & Hak Akses Spatie RBAC (Khusus Role Admin)
        Route::get('users', [UserController::class, 'index'])->name('users.index');
    });

    // 2.4 Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// 3. RUTE AUTENTIKASI (Laravel Breeze)
// ==========================================
require __DIR__.'/auth.php';

// ==========================================
// 4. FALLBACK 404
// ==========================================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
