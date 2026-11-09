@php
    $isDark = request('mode') === 'dark' || (!request()->has('mode') && session('theme_mode') === 'dark');
@endphp

<x-layouts.app title="Department of Informatics ITS — Home" :mode="$isDark ? 'dark' : 'light'">

    <!-- Dynamic Interactive Greeting via URL (?user=UserName) -->
    @if(isset($user) && filled($user))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
            <x-status-banner type="welcome" title="Welcome to the Academic Portal">
                <span class="sr-only">Halo, {{ $user }}! Selamat Datang di Portal Akademik</span>
                Hello, <span class="font-extrabold text-its-accent">{{ $user }}</span>! Welcome to the Academic Portal of the Department of Informatics ITS. Explore academic programs, research laboratories, student profile, and autonomous Agentic AI platform.
            </x-status-banner>
        </div>
    @endif

    <!-- Hero Section: Department of Informatics ITS -->
    <section class="relative bg-gradient-to-b from-blue-50 via-white to-slate-50 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 py-16 lg:py-24 overflow-hidden transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">

                <!-- Left Text Column -->
                <div class="lg:col-span-6 space-y-6 text-center lg:text-left">


                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                        Shaping the Future of <span class="bg-gradient-to-r from-its-accent via-blue-600 to-indigo-600 bg-clip-text text-transparent">Computer Science</span>
                    </h1>

                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        Welcome to the Department of Informatics at ITS. We pioneer research, foster world-class tech
                        leaders, and build innovative solutions for global impact.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#majors"
                            class="w-full sm:w-auto px-7 py-3.5 rounded-xl bg-its-accent hover:bg-its-blue text-white font-semibold text-center text-sm shadow-lg shadow-blue-500/25 transition duration-200">
                            Explore Majors
                        </a>
                        <a href="#labs"
                            class="w-full sm:w-auto px-7 py-3.5 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-slate-300 dark:hover:border-slate-600 text-slate-700 dark:text-slate-200 font-semibold text-center text-sm shadow-xs hover:shadow transition duration-200">
                            Our Laboratories
                        </a>
                        <a href="{{ route('ide.agent', $isDark ? ['mode' => 'dark'] : []) }}"
                            class="w-full sm:w-auto px-7 py-3.5 rounded-xl bg-indigo-50 dark:bg-indigo-950/70 border border-indigo-200 dark:border-indigo-800 text-indigo-700 dark:text-indigo-300 hover:bg-indigo-100 font-semibold text-center text-sm shadow-xs transition duration-200 flex items-center justify-center gap-2">
                            <i class="fa-solid fa-brain"></i> AI Platform
                        </a>
                    </div>

                    <!-- Quick Stats -->
                    <div class="grid grid-cols-3 gap-4 pt-8 border-t border-slate-200/80 dark:border-slate-800">
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-its-accent dark:text-blue-400">1985</div>
                            <div class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium">Established</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-its-accent dark:text-blue-400">50+</div>
                            <div class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium">Lecturers</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-its-accent dark:text-blue-400">5+</div>
                            <div class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 font-medium">Study Programs</div>
                        </div>
                    </div>
                </div>

                <!-- Right Image Column (Foto Gedung Informatika ITS) -->
                <div class="lg:col-span-6 relative">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <!-- Decorative Accent backdrop -->
                        <div class="absolute -top-4 -bottom-4 -left-4 -right-4 bg-gradient-to-tr from-blue-200 to-indigo-100 dark:from-blue-900/40 dark:to-indigo-900/30 rounded-3xl transform -rotate-1 -z-10 blur-xs">
                        </div>

                        <!-- Main Hero Image Box -->
                        <div class="relative aspect-[16/10] sm:aspect-[4/3] rounded-2xl bg-slate-200 dark:bg-slate-800 border-4 border-white dark:border-slate-800 shadow-2xl overflow-hidden flex flex-col items-center justify-center text-slate-400 group">
                            <!-- Background Grid Effect -->
                            <div class="absolute inset-0 bg-[linear-gradient(to_right,#00000008_1px,transparent_1px),linear-gradient(to_bottom,#00000008_1px,transparent_1px)] bg-[size:16px_16px]">
                            </div>

                            <img src="/images/department.jpg" alt="Departemen Teknik Informatika ITS"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Available Majors Section -->
    <section id="majors" class="py-20 bg-white dark:bg-slate-900 border-t border-slate-200/80 dark:border-slate-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
                <h2 class="text-xs font-bold uppercase tracking-widest text-its-accent dark:text-blue-400">
                    Undergraduate Academic Programs
                </h2>
                <h3 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">Available Majors</h3>
                <p class="text-slate-600 dark:text-slate-400">
                    Explore our undergraduate study programs designed to equip future tech pioneers with theoretical depth and industrial mastery.
                </p>
            </div>

            <!-- Majors Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                @php
                    $majors = [
                        [
                            'code' => 'IF',
                            'title' => 'Informatics Engineering',
                            'native' => 'Teknik Informatika',
                            'icon' => 'fa-laptop-code',
                            'desc' => 'Focuses on theoretical computer science, algorithms, database systems, cybersecurity, and intelligent systems engineering.',
                            'url' => 'https://www.its.ac.id/informatika/akademik/program-studi/program-studi-s1/',
                        ],
                        [
                            'code' => 'RPL',
                            'title' => 'Software Engineering',
                            'native' => 'Rekayasa Perangkat Lunak',
                            'icon' => 'fa-cubes',
                            'desc' => 'Dedicated to modern enterprise software construction, microservices architecture, DevOps, agile methodologies, and quality assurance.',
                            'url' => 'https://www.its.ac.id/informatika/akademik/program-studi/program-studi-sarjana-s1-rekayasa-perangkat-lunak/',
                        ],
                        [
                            'code' => 'RKA',
                            'title' => 'AI Engineering',
                            'native' => 'Rekayasa Kecerdasan Artifisial',
                            'icon' => 'fa-brain',
                            'desc' => 'Specializes in machine learning, deep learning, computer vision, natural language processing, and scalable AI infrastructure.',
                            'url' => 'https://www.its.ac.id/informatika/akademik/program-studi/program-studi-sarjana-s1-rekayasa-kecerdasan-artifisial/',
                        ],
                    ];
                @endphp

                @foreach ($majors as $major)
                    <div class="bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-700/80 rounded-2xl p-8 hover:shadow-xl transition duration-300 flex flex-col justify-between group relative overflow-hidden">
                        <!-- Background Accent Card Line -->
                        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-its-accent to-its-blue group-hover:h-2 transition-all">
                        </div>

                        <div>
                            <!-- Header with Badge & Icon -->
                            <div class="flex items-center justify-between mb-6">
                                <div class="w-14 h-14 rounded-xl bg-blue-100/80 dark:bg-blue-900/50 text-its-accent dark:text-blue-300 flex items-center justify-center text-2xl group-hover:scale-110 transition duration-300">
                                    <i class="fa-solid {{ $major['icon'] }}"></i>
                                </div>
                                <span class="text-sm font-extrabold px-3.5 py-1.5 rounded-full bg-its-blue text-white shadow-sm">
                                    {{ $major['code'] }}
                                </span>
                            </div>

                            <h4 class="text-2xl font-bold text-slate-900 dark:text-white group-hover:text-its-accent transition mb-1">
                                {{ $major['title'] }}
                            </h4>
                            <p class="text-xs font-semibold text-slate-400 mb-4">{{ $major['native'] }}</p>

                            <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                                {{ $major['desc'] }}
                            </p>
                        </div>

                        <div class="pt-6 border-t border-slate-200/80 dark:border-slate-700 flex items-center justify-between">
                            <a href="{{ $major['url'] }}" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center text-xs font-bold text-its-accent dark:text-blue-400 hover:text-its-blue transition group-hover:translate-x-1">
                                Visit Program <i class="fa-solid fa-arrow-right ml-1.5"></i>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Research Laboratories Section with Draggable Marquee -->
    <section id="labs" class="py-20 bg-slate-100/70 dark:bg-slate-950 overflow-hidden border-y border-slate-200/60 dark:border-slate-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <h2 class="text-xs font-bold uppercase tracking-widest text-its-accent dark:text-blue-400">
                    Research &amp; Innovation Laboratories
                </h2>
                <h3 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">Informatics Laboratories</h3>
                <p class="text-slate-600 dark:text-slate-400">
                    Explore our 8 dedicated laboratories driving cutting-edge research, industry collaborations, and hands-on learning.
                </p>
            </div>
        </div>

        @php
            $labs = [
                [
                    'name' => 'Algoritma dan Pemrograman (ALPRO)',
                    'url' => 'https://www.its.ac.id/informatika/fasilitas/laboratorium/laboratorium-algoritma-dan-pemrograman/',
                    'image_url' => '/images/labs/alpro.png',
                ],
                [
                    'name' => 'Rekayasa Perangkat Lunak (RPL)',
                    'url' => 'https://www.its.ac.id/informatika/fasilitas/laboratorium/laboratorium-rekayasa-perangkat-lunak/',
                    'image_url' => '/images/labs/rpl.png',
                ],
                [
                    'name' => 'Net-Centric Computing (NCC)',
                    'url' => 'https://www.its.ac.id/informatika/en/net-centric-computing-laboratory/',
                    'image_url' => '/images/labs/ncc.jpg',
                ],
                [
                    'name' => 'Komputasi Cerdas Visi (KCV)',
                    'url' => 'https://www.its.ac.id/informatika/en/laboratory/information-intelligent-management-laboratory/',
                    'image_url' => '/images/labs/kcv.jpeg',
                ],
                [
                    'name' => 'Arsitektur dan Jaringan Komputer (Netics)',
                    'url' => 'https://www.its.ac.id/informatika/fasilitas/laboratorium/laboratorium-arsitektur-dan-jaringan-komputer/',
                    'image_url' => '/images/labs/netics.png',
                ],
                [
                    'name' => 'Pemodelan dan Komputasi Terapan (PKT)',
                    'url' => 'https://www.its.ac.id/informatika/en/laboratory/applied-modelling-and-computation-laboratory/',
                    'image_url' => '/images/labs/pkt.jpg',
                ],
                [
                    'name' => 'Manajemen Cerdas Informasi (MCI)',
                    'url' => 'https://www.its.ac.id/informatika/en/laboratory/information-intelligent-management-laboratory/',
                    'image_url' => '/images/labs/mci.jpeg',
                ],
                [
                    'name' => 'Grafika, Interaksi, Gim, dan Analitik (GIGA)',
                    'url' => 'https://www.its.ac.id/informatika/fasilitas/laboratorium/laboratorium-grafika-interaksi-dan-game/',
                    'image_url' => '/images/labs/giga.png',
                ],
            ];
        @endphp

        <!-- Draggable Marquee Wrapper -->
        <div class="relative w-full overflow-hidden py-4 select-none">
            <!-- Left and Right Gradient Overlay Fades -->
            <div class="absolute left-0 top-0 bottom-0 w-24 bg-gradient-to-r from-slate-100/90 dark:from-slate-950 to-transparent z-10 pointer-events-none">
            </div>
            <div class="absolute right-0 top-0 bottom-0 w-24 bg-gradient-to-l from-slate-100/90 dark:from-slate-950 to-transparent z-10 pointer-events-none">
            </div>

            <!-- Scrollable & Draggable Outer Container -->
            <div id="marqueeContainer" class="overflow-x-auto no-scrollbar cursor-grab active:cursor-grabbing flex">
                <div id="marqueeTrack" class="flex space-x-6 w-max">
                    @foreach (array_merge($labs, $labs, $labs) as $lab)
                        <a href="{{ $lab['url'] }}" target="_blank" rel="noopener noreferrer" draggable="false"
                            class="lab-card w-72 h-56 bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 rounded-2xl p-5 shadow-xs hover:shadow-xl hover:border-its-accent dark:hover:border-blue-500 transition-all duration-300 flex flex-col items-center justify-center text-center space-y-3 shrink-0 group">
                            <!-- Lab Logo -->
                            <div class="w-14 h-14 rounded-xl bg-white dark:bg-slate-800 text-its-blue flex items-center justify-center text-2xl border border-blue-100 dark:border-slate-700 shadow-inner group-hover:scale-110 transition duration-300 overflow-hidden p-2">
                                <img src="{{ $lab['image_url'] }}" alt="{{ $lab['name'] }} Logo"
                                    class="w-full h-full object-contain">
                            </div>
                            <!-- Lab Name -->
                            <h5 class="text-sm font-bold text-slate-800 dark:text-slate-200 group-hover:text-its-accent dark:group-hover:text-blue-400 transition line-clamp-2 px-2">
                                {{ $lab['name'] }}
                            </h5>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Single Featured Student Spotlight Section -->
    <section id="student" class="py-20 bg-white dark:bg-slate-900 border-b border-slate-200/80 dark:border-slate-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
                <h2 class="text-xs font-bold uppercase tracking-widest text-its-accent dark:text-blue-400">
                    Student Spotlights
                </h2>
                <h3 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">Featured Student Spotlight</h3>
                <p class="text-slate-600 dark:text-slate-400">
                    Celebrating excellence and innovations pioneered by Informatics ITS students on global stages.
                </p>
            </div>

            <!-- Single Student Profile Container (Matches Image 1 design with user's photo) -->
            <div class="max-w-4xl mx-auto bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 rounded-3xl overflow-hidden shadow-xl transition-all">
                <div class="grid grid-cols-1 md:grid-cols-12 items-stretch">

                    <!-- Left Column: Student Profile Photo (Image 1 style) -->
                    <div class="md:col-span-5 relative min-h-[340px] md:min-h-full overflow-hidden bg-blue-600 flex items-center justify-center">
                        <img src="/images/student.jpg" alt="Aji Zaenul Musthofa"
                            class="w-full h-full object-cover">

                        <!-- Corner Badge Overlay -->
                        <div class="absolute top-4 left-4 bg-black/60 backdrop-blur-xs text-white px-3.5 py-1 rounded-full text-xs font-bold shadow-xs">
                            Informatics 2024
                        </div>
                    </div>

                    <!-- Right Column: Student Profile Information (Image 1 typography & copy) -->
                    <div class="md:col-span-7 p-8 md:p-10 flex flex-col justify-between space-y-6">
                        <div>
                            <h4 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mb-1 leading-tight">
                                Aji Zaenul Musthofa
                            </h4>
                            <span class="sr-only">5025241065</span>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-6">
                                Undergraduate Informatics Engineering Student
                            </p>

                            <p class="text-slate-600 dark:text-slate-300 leading-relaxed text-sm">
                                &ldquo;Undergraduate Computer Science student with a strong foundation in software engineering, artificial intelligence, and autonomous intelligent systems. Eager to leverage academic projects and technical skills to build scalable software solutions, develop intelligent AI-driven applications, and solve complex computational challenges in a dynamic engineering team.&rdquo;
                            </p>
                        </div>

                        <!-- Card Footer Links (Image 1 Read Full Profile ->) -->
                        <div class="pt-6 border-t border-slate-100 dark:border-slate-800 flex items-center">
                            <a href="{{ route('profil.mahasiswa', $isDark ? ['mode' => 'dark'] : []) }}"
                                class="inline-flex items-center text-sm font-bold text-its-accent dark:text-blue-400 hover:text-its-blue dark:hover:text-blue-300 transition group">
                                Read Full Profile <i class="fa-solid fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- Smooth Infinite JavaScript Draggable Marquee Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('marqueeContainer');
            const track = document.getElementById('marqueeTrack');
            if (!container || !track) return;

            let speed = 1.2;
            let isHovered = false;
            let isDragging = false;
            let startX = 0;
            let scrollLeftPos = 0;
            let dragDistance = 0;

            container.scrollLeft = track.scrollWidth / 3;

            function tick() {
                if (!isHovered && !isDragging) {
                    container.scrollLeft += speed;
                }

                const oneSetWidth = track.scrollWidth / 3;
                if (container.scrollLeft >= oneSetWidth * 2) {
                    container.scrollLeft -= oneSetWidth;
                } else if (container.scrollLeft <= 0) {
                    container.scrollLeft += oneSetWidth;
                }

                requestAnimationFrame(tick);
            }
            requestAnimationFrame(tick);

            container.addEventListener('mouseenter', () => isHovered = true);
            container.addEventListener('mouseleave', () => {
                isHovered = false;
                isDragging = false;
            });

            container.addEventListener('mousedown', (e) => {
                isDragging = true;
                dragDistance = 0;
                startX = e.pageX - container.offsetLeft;
                scrollLeftPos = container.scrollLeft;
            });

            container.addEventListener('mouseup', () => {
                isDragging = false;
            });

            container.addEventListener('mousemove', (e) => {
                if (!isDragging) return;
                e.preventDefault();
                const x = e.pageX - container.offsetLeft;
                const walk = (x - startX) * 1.5;
                dragDistance = Math.abs(walk);
                container.scrollLeft = scrollLeftPos - walk;
            });

            const labCards = document.querySelectorAll('.lab-card');
            labCards.forEach(card => {
                card.addEventListener('click', (e) => {
                    if (dragDistance > 8) {
                        e.preventDefault();
                    }
                });
            });

            let touchStartX = 0;
            container.addEventListener('touchstart', (e) => {
                isHovered = true;
                touchStartX = e.touches[0].pageX;
                scrollLeftPos = container.scrollLeft;
            }, { passive: true });

            container.addEventListener('touchmove', (e) => {
                const touchX = e.touches[0].pageX;
                const walk = (touchX - touchStartX) * 1.5;
                container.scrollLeft = scrollLeftPos - walk;
            }, { passive: true });

            container.addEventListener('touchend', () => {
                isHovered = false;
            });
        });
    </script>

</x-layouts.app>
