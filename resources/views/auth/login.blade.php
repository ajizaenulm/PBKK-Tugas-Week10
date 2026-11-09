<x-guest-layout>
    <div class="bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 rounded-3xl p-6 sm:p-8 shadow-sm transition-colors duration-300">
        
        <!-- Header: Department Badge & Title -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-950/70 border border-blue-100 dark:border-blue-800/60 text-its-accent dark:text-blue-400 text-lg mb-3 shadow-xs">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Portal Akademik <span class="text-its-accent dark:text-blue-400">Admin</span>
            </h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                Departemen Teknik Informatika &mdash; Institut Teknologi Sepuluh Nopember
            </p>
        </div>

        <!-- Session Status Alert -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Quick Login Demo Buttons (Sesuai REQUIREMENTS.md) -->
        <div class="mb-6 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-700/60">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-slate-700 dark:text-slate-300 flex items-center gap-1.5">
                    <i class="fa-solid fa-bolt text-amber-500"></i> Akun Uji Coba Demo
                </span>
                <span class="text-[11px] font-mono text-slate-500 dark:text-slate-400 bg-white dark:bg-slate-800 px-2 py-0.5 rounded-md border border-slate-200 dark:border-slate-700">
                    password: password
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                <!-- Tombol Quick Login Admin -->
                <form method="POST" action="{{ route('login.quick') }}" class="w-full">
                    @csrf
                    <input type="hidden" name="role" value="admin">
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-3 py-2.5 bg-its-accent hover:bg-its-blue text-white rounded-xl shadow-xs transition duration-200 text-xs font-bold focus:ring-2 focus:ring-offset-1 focus:ring-its-accent cursor-pointer">
                        <i class="fa-solid fa-user-shield text-xs"></i>
                        <span>Login Admin</span>
                    </button>
                </form>

                <!-- Tombol Quick Login Staf -->
                <form method="POST" action="{{ route('login.quick') }}" class="w-full">
                    @csrf
                    <input type="hidden" name="role" value="staf">
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-3 py-2.5 bg-its-accent hover:bg-its-blue text-white rounded-xl shadow-xs transition duration-200 text-xs font-bold focus:ring-2 focus:ring-offset-1 focus:ring-its-accent cursor-pointer">
                        <i class="fa-solid fa-user-tie text-xs"></i>
                        <span>Login Staf</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Divider -->
        <div class="relative flex py-2 items-center mb-5">
            <div class="flex-grow border-t border-slate-200 dark:border-slate-800"></div>
            <span class="flex-shrink mx-3 text-[11px] font-medium text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                Atau Login Manual
            </span>
            <div class="flex-grow border-t border-slate-200 dark:border-slate-800"></div>
        </div>

        <!-- Form Login Manual -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                    Email Akademik
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500 text-xs">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        placeholder="admin@akademik.its.ac.id"
                        class="w-full pl-9 pr-3.5 py-2.5 text-sm rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-its-accent/20 focus:border-its-accent transition">
                </div>
                @if ($errors->has('email'))
                    <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                    Kata Sandi
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500 text-xs">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full pl-9 pr-3.5 py-2.5 text-sm rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-its-accent/20 focus:border-its-accent transition">
                </div>
                @if ($errors->has('password'))
                    <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between pt-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="w-4 h-4 rounded border-slate-300 dark:border-slate-700 text-its-accent focus:ring-its-accent/20 dark:bg-slate-800">
                    <span class="ms-2 text-xs text-slate-600 dark:text-slate-400 font-medium">Remember me</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit"
                    class="w-full py-3 px-4 rounded-xl bg-its-accent hover:bg-its-blue text-white text-sm font-bold shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 transition duration-200 flex items-center justify-center gap-2 cursor-pointer">
                    <span>Masuk ke Dashboard</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </div>

            <div class="text-center pt-2">
                <a href="{{ route('home') }}" class="text-xs text-slate-500 hover:text-its-accent dark:text-slate-400 dark:hover:text-blue-400 transition font-medium">
                    &larr; Kembali ke Beranda Portal
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
