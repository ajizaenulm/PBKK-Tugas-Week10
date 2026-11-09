<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Fitur Challenge Nilai Plus A+: Tombol Auto-Login Test Accounts untuk Evaluasi Dosen/Asdos
     */
    public function quickLogin(Request $request): RedirectResponse
    {
        $role = $request->input('role', 'admin');
        $email = ($role === 'staf') ? 'staf@akademik.its.ac.id' : 'admin@akademik.its.ac.id';

        $user = \App\Models\User::where('email', $email)->first();

        if (! $user) {
            return redirect()->route('login')->withErrors(['email' => 'Akun seeder belum dibuat. Jalankan php artisan db:seed']);
        }

        Auth::login($user);
        $request->session()->regenerate();

        $roleName = $user->hasRole('Admin') ? 'Admin (Akses Penuh)' : 'Staf (Akses Terbatas)';
        return redirect()->intended(route('dashboard', absolute: false))->with('success', "Berhasil masuk secara instan sebagai {$roleName}!");
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
