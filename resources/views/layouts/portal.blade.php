@php
    // Sinkronisasi mode tema dari query string, session, atau cookie
    if (request()->has('mode')) {
        $mode = request('mode');
        session(['theme_mode' => $mode]);
        if (function_exists('cookie')) {
            cookie()->queue(cookie('theme_mode', $mode, 60 * 24 * 365));
        }
    } else {
        $mode = session('theme_mode', request()->cookie('theme_mode', $mode ?? 'light'));
    }
    $isDark = ($mode === 'dark');
    $currentRoute = request()->route() ? request()->route()->getName() : '';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth {{ $isDark ? 'dark' : '' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Portal akademik mahasiswa Departemen Teknik Informatika Institut Teknologi Sepuluh Nopember (ITS) Surabaya">
    <title>{{ isset($title) ? $title . ' — ITS Informatics' : 'Portal Profil Akademik & Agentic AI — Teknik Informatika ITS' }}</title>

    <!-- Google Fonts: Plus Jakarta Sans, Inter & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Immediate Theme Initialization (Prevents FOUC & Synchronizes with LocalStorage/Cookie) -->
    <script>
        (function() {
            const hasQuery = {{ request()->has('mode') ? 'true' : 'false' }};
            const isServerDark = {{ $isDark ? 'true' : 'false' }};
            let isDark;

            if (hasQuery) {
                isDark = isServerDark;
            } else {
                const stored = localStorage.getItem('theme_mode');
                isDark = (stored !== null) ? (stored === 'dark') : isServerDark;
            }

            if (isDark) {
                document.documentElement.classList.add('dark');
                try {
                    localStorage.setItem('theme_mode', 'dark');
                    document.cookie = "theme_mode=dark;path=/;max-age=31536000";
                } catch(e) {}
            } else {
                document.documentElement.classList.remove('dark');
                try {
                    localStorage.setItem('theme_mode', 'light');
                    document.cookie = "theme_mode=light;path=/;max-age=31536000";
                } catch(e) {}
            }
        })();
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
            font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11';
        }
        .font-mono, code, kbd, samp, pre { 
            font-family: 'JetBrains Mono', ui-monospace, SFMono-Regular, monospace; 
            font-feature-settings: 'calt' 1, 'liga' 1;
        }
        h1, h2, h3, h4, h5, h6 { 
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            letter-spacing: -0.028em; 
            font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11';
        }
    </style>

    <!-- Vite Asset Bundler (Lokal via NPM & Vite Compiler - Tanpa CDN Framework) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{ $styles ?? '' }}
</head>
<body class="bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100 antialiased min-h-screen flex flex-col selection:bg-its-accent selection:text-white transition-colors duration-300">

    <!-- ==================== STATIC NAVBAR ITS ==================== -->
    <header class="sticky top-0 z-50 bg-white/90 border-slate-200/80 dark:bg-slate-900/90 dark:border-slate-800 backdrop-blur-md border-b shadow-xs transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-center h-20">

                <!-- Desktop Navigation Links (Centered) -->
                <nav class="hidden md:flex items-center space-x-1 lg:space-x-2 text-sm font-semibold">
                    <!-- Page 1: Home -->
                    <a href="{{ route('home', $isDark ? ['mode' => 'dark'] : []) }}"
                        class="nav-page-link px-3.5 py-2 rounded-xl transition duration-200 {{ request()->routeIs('home') || request()->is('beranda') ? 'bg-blue-50 text-its-accent font-bold border border-blue-100 dark:bg-blue-950/70 dark:text-blue-400 dark:border-blue-800/60' : 'text-slate-600 hover:text-its-accent hover:bg-slate-100/70 dark:text-slate-300 dark:hover:text-white dark:hover:bg-slate-800' }}">
                        <i class="fa-solid fa-house mr-1.5 text-xs opacity-80"></i> Home
                    </a>

                    <!-- Page 2: Student Profile -->
                    <a href="{{ route('profil.mahasiswa', $isDark ? ['mode' => 'dark'] : []) }}"
                        class="nav-page-link px-3.5 py-2 rounded-xl transition duration-200 {{ request()->routeIs('profil.mahasiswa') || request()->is('profil-mahasiswa*') ? 'bg-blue-50 text-its-accent font-bold border border-blue-100 dark:bg-blue-950/70 dark:text-blue-400 dark:border-blue-800/60' : 'text-slate-600 hover:text-its-accent hover:bg-slate-100/70 dark:text-slate-300 dark:hover:text-white dark:hover:bg-slate-800' }}">
                        <i class="fa-solid fa-id-card mr-1.5 text-xs opacity-80"></i> Student Profile
                    </a>

                    <!-- Page 3: Agentic AI & Ideas -->
                    <a href="{{ route('ide.agent', $isDark ? ['mode' => 'dark'] : []) }}"
                        class="nav-page-link px-3.5 py-2 rounded-xl transition duration-200 {{ request()->routeIs('ide.agent') || request()->is('ide-agent*') ? 'bg-blue-50 text-its-accent font-bold border border-blue-100 dark:bg-blue-950/70 dark:text-blue-400 dark:border-blue-800/60' : 'text-slate-600 hover:text-its-accent hover:bg-slate-100/70 dark:text-slate-300 dark:hover:text-white dark:hover:bg-slate-800' }}">
                        <i class="fa-solid fa-brain mr-1.5 text-xs opacity-80"></i> Agentic AI &amp; Ideas
                    </a>

                    <!-- AdminLTE Dashboard / Login Link -->
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="nav-page-link px-3.5 py-2 rounded-xl transition duration-200 bg-amber-500/10 text-amber-600 hover:bg-amber-500/20 font-bold border border-amber-300/50 dark:bg-amber-400/10 dark:text-amber-300">
                            <i class="fa-solid fa-gauge-high mr-1.5 text-xs"></i> Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('login', $isDark ? ['mode' => 'dark'] : []) }}"
                            class="nav-page-link px-3.5 py-2 rounded-xl transition duration-200 {{ request()->routeIs('login') ? 'bg-blue-50 text-its-accent font-bold border border-blue-100 dark:bg-blue-950/70 dark:text-blue-400 dark:border-blue-800/60' : 'text-slate-600 hover:text-its-accent hover:bg-slate-100/70 dark:text-slate-300 dark:hover:text-white dark:hover:bg-slate-800' }}">
                            <i class="fa-solid fa-lock mr-1.5 text-xs opacity-80"></i> Login Admin
                        </a>
                    @endauth
                </nav>

                <!-- Right Actions: Dark Mode Toggle & Quick CTA (Pinned to Right) -->
                <div class="hidden md:flex items-center gap-3 absolute right-0 top-1/2 -translate-y-1/2">
                    <!-- Toggle Dynamic Dark Mode Button -->
                    <a href="{{ request()->fullUrlWithQuery(['mode' => $isDark ? 'light' : 'dark']) }}"
                        id="theme-toggle-btn"
                        title="{{ $isDark ? 'Switch to Light Mode' : 'Switch to Dark Mode' }}"
                        data-theme-toggle="{{ $isDark ? 'light' : 'dark' }}"
                        class="px-3 py-2 rounded-xl text-xs font-semibold flex items-center gap-1.5 shadow-xs transition {{ $isDark ? 'bg-slate-800 hover:bg-slate-700 text-amber-400 border border-slate-700' : 'bg-slate-100 hover:bg-slate-200 text-slate-700 border border-slate-200' }}">
                        <i class="fa-solid {{ $isDark ? 'fa-sun text-amber-400' : 'fa-moon text-slate-600' }} text-sm" id="theme-toggle-icon"></i>
                        <span id="theme-toggle-text">{{ $isDark ? 'Light' : 'Dark' }}</span>
                    </a>

                    <a href="{{ route('ide.agent', $isDark ? ['mode' => 'dark'] : []) }}#form-ide"
                        id="nav-submit-idea"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-its-accent hover:bg-its-blue text-white text-xs font-bold shadow-sm shadow-blue-500/20 transition duration-200">
                        <i class="fa-solid fa-plus text-[10px]"></i> Submit Idea
                    </a>
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="flex md:hidden items-center gap-2 absolute right-0 top-1/2 -translate-y-1/2">
                    <!-- Mobile Toggle Mode -->
                    <a href="{{ request()->fullUrlWithQuery(['mode' => $isDark ? 'light' : 'dark']) }}"
                        id="mobile-theme-toggle-btn"
                        data-theme-toggle="{{ $isDark ? 'light' : 'dark' }}"
                        class="p-2 text-sm {{ $isDark ? 'text-amber-400' : 'text-slate-600' }}">
                        <i class="fa-solid {{ $isDark ? 'fa-sun' : 'fa-moon' }}" id="mobile-theme-toggle-icon"></i>
                    </a>

                    <button type="button" id="mobile-menu-btn"
                        class="p-2 rounded-lg text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800 focus:outline-none"
                        aria-label="Toggle menu">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

            <!-- Mobile Navigation Dropdown -->
            <div id="mobile-menu" class="hidden md:hidden pb-4 pt-2 border-t border-slate-100 dark:border-slate-800 space-y-1 text-sm font-semibold">
                <a href="{{ route('home', $isDark ? ['mode' => 'dark'] : []) }}"
                    class="nav-page-link block px-3 py-2 rounded-lg {{ request()->routeIs('home') ? 'bg-blue-500/10 text-its-accent font-bold' : 'text-slate-600 dark:text-slate-300' }}">
                    <i class="fa-solid fa-house mr-2 text-xs"></i> Home
                </a>
                <a href="{{ route('profil.mahasiswa', $isDark ? ['mode' => 'dark'] : []) }}"
                    class="nav-page-link block px-3 py-2 rounded-lg {{ request()->routeIs('profil.mahasiswa') ? 'bg-blue-500/10 text-its-accent font-bold' : 'text-slate-600 dark:text-slate-300' }}">
                    <i class="fa-solid fa-id-card mr-2 text-xs"></i> Student Profile
                </a>
                <a href="{{ route('ide.agent', $isDark ? ['mode' => 'dark'] : []) }}"
                    class="nav-page-link block px-3 py-2 rounded-lg {{ request()->routeIs('ide.agent') ? 'bg-blue-500/10 text-its-accent font-bold' : 'text-slate-600 dark:text-slate-300' }}">
                    <i class="fa-solid fa-brain mr-2 text-xs"></i> Agentic AI &amp; Ideas
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" class="nav-page-link block px-3 py-2 rounded-lg text-amber-600 dark:text-amber-400 font-bold">
                        <i class="fa-solid fa-gauge-high mr-2 text-xs"></i> Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('login', $isDark ? ['mode' => 'dark'] : []) }}" class="nav-page-link block px-3 py-2 rounded-lg {{ request()->routeIs('login') ? 'bg-blue-500/10 text-its-accent font-bold' : 'text-slate-600 dark:text-slate-300' }}">
                        <i class="fa-solid fa-lock mr-2 text-xs"></i> Login Admin
                    </a>
                @endauth
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const html = document.documentElement;

                // Mobile hamburger toggle
                const btn = document.getElementById('mobile-menu-btn');
                const menu = document.getElementById('mobile-menu');
                if (btn && menu) {
                    btn.addEventListener('click', () => {
                        menu.classList.toggle('hidden');
                    });
                }

                // Sync button state on load with html class
                const syncButtonState = (isDark) => {
                    const textEl = document.getElementById('theme-toggle-text');
                    const iconEl = document.getElementById('theme-toggle-icon');
                    const mobileIconEl = document.getElementById('mobile-theme-toggle-icon');
                    const desktopBtn = document.getElementById('theme-toggle-btn');
                    const mobileBtn = document.getElementById('mobile-theme-toggle-btn');

                    if (isDark) {
                        if (textEl) textEl.textContent = 'Light';
                        if (iconEl) iconEl.className = 'fa-solid fa-sun text-amber-400 text-sm';
                        if (mobileIconEl) mobileIconEl.className = 'fa-solid fa-sun text-amber-400';
                        if (desktopBtn) {
                            desktopBtn.className = 'px-3 py-2 rounded-xl text-xs font-semibold flex items-center gap-1.5 shadow-xs transition bg-slate-800 hover:bg-slate-700 text-amber-400 border border-slate-700';
                            desktopBtn.setAttribute('title', 'Switch to Light Mode');
                            desktopBtn.setAttribute('data-theme-toggle', 'light');
                        }
                        if (mobileBtn) {
                            mobileBtn.className = 'p-2 text-sm text-amber-400';
                            mobileBtn.setAttribute('data-theme-toggle', 'light');
                        }
                    } else {
                        if (textEl) textEl.textContent = 'Dark';
                        if (iconEl) iconEl.className = 'fa-solid fa-moon text-slate-600 text-sm';
                        if (mobileIconEl) mobileIconEl.className = 'fa-solid fa-moon text-slate-600';
                        if (desktopBtn) {
                            desktopBtn.className = 'px-3 py-2 rounded-xl text-xs font-semibold flex items-center gap-1.5 shadow-xs transition bg-slate-100 hover:bg-slate-200 text-slate-700 border border-slate-200';
                            desktopBtn.setAttribute('title', 'Switch to Dark Mode');
                            desktopBtn.setAttribute('data-theme-toggle', 'dark');
                        }
                        if (mobileBtn) {
                            mobileBtn.className = 'p-2 text-sm text-slate-600';
                            mobileBtn.setAttribute('data-theme-toggle', 'dark');
                        }
                    }
                };

                // Sync on initial DOM load
                syncButtonState(html.classList.contains('dark'));

                // In-place smooth theme toggle (prevents scrolling to the top!)
                const handleThemeToggle = (e) => {
                    if (e) e.preventDefault();

                    const isDarkNow = html.classList.contains('dark');
                    const nextMode = isDarkNow ? 'light' : 'dark';

                    // 1. Toggle <html> class immediately
                    if (nextMode === 'dark') {
                        html.classList.add('dark');
                    } else {
                        html.classList.remove('dark');
                    }

                    // 2. Persist in localStorage and cookie
                    try {
                        localStorage.setItem('theme_mode', nextMode);
                        document.cookie = "theme_mode=" + nextMode + ";path=/;max-age=31536000";
                    } catch (err) {}

                    // 3. Update toggle buttons UI
                    syncButtonState(nextMode === 'dark');

                    // 4. Update URL without reloading (preserves user scroll position!)
                    try {
                        const newUrl = new URL(window.location.href);
                        newUrl.searchParams.set('mode', nextMode);
                        window.history.replaceState(null, '', newUrl.pathname + newUrl.search + newUrl.hash);

                        // Sync in background with Laravel session
                        fetch(newUrl.pathname + newUrl.search, {
                            headers: { 'X-Requested-With': 'XMLHttpRequest' }
                        }).catch(() => {});
                    } catch (err) {}

                    // 5. Update navigation links to carry mode parameter
                    document.querySelectorAll('a[href]').forEach(a => {
                        try {
                            const aUrl = new URL(a.href, window.location.origin);
                            if (aUrl.origin === window.location.origin && !aUrl.pathname.startsWith('/#')) {
                                if (['/', '/beranda', '/profil-mahasiswa', '/ide-agent', '/login'].includes(aUrl.pathname)) {
                                    if (nextMode === 'dark') {
                                        aUrl.searchParams.set('mode', 'dark');
                                    } else {
                                        aUrl.searchParams.delete('mode');
                                    }
                                    a.href = aUrl.pathname + aUrl.search + aUrl.hash;
                                }
                            }
                        } catch(err) {}
                    });
                };

                document.querySelectorAll('[data-theme-toggle]').forEach(el => {
                    el.addEventListener('click', handleThemeToggle);
                });
            });
        </script>
    </header>

    <!-- ==================== CONTAINER KONTEN UTAMA ==================== -->
    <main class="flex-grow">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- ==================== STATIC FOOTER ITS ==================== -->
    <!-- ========================================================================= -->
    <!-- FOOTER: SIMPLIFIED FOOTER                                                 -->
    <!-- ========================================================================= -->
    <footer id="contact" class="{{ $isDark ? 'bg-black text-slate-400 border-slate-900' : 'bg-slate-950 text-slate-400 border-slate-800' }} dark:bg-black dark:border-slate-900 bg-slate-950 text-slate-400 border-slate-800 py-8 border-t mt-auto transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-xs sm:text-sm text-slate-400">
            &copy; 2026 Institut Teknologi Sepuluh Nopember (ITS) | Framework-Based Programming | Department of Informatics
        </div>
    </footer>

    {{ $scripts ?? '' }}
</body>
</html>
