<x-layouts.app title="Student Profile — Aji Zaenul Musthofa">

    @php
        $isFound = ($nrp ?? '') == '5025241065';

        $profile = [
            'name'     => $isFound ? 'Aji Zaenul Musthofa' : 'Student Data Not Found',
            'role'     => $isFound ? 'Undergraduate Informatics Engineering Student' : 'Department of Informatics Student',
            'nrp'      => $nrp ?? '5025241065',
            'major'    => $isFound ? 'Informatics Engineering (S1 / Bachelor)' : '—',
            'email'    => $isFound ? '5025241065@student.its.ac.id' : '—',
            'standing' => $isFound ? 'Semester 5' : '—',
            'advisor'  => $isFound ? 'Bagus Jati Santoso, S.Kom., Ph.D.' : '—',
            'focus'    => $isFound ? 'Software Engineering, Artificial Intelligence (AI), and Intelligent Systems.' : '—',
            'profile_img' => '/images/student.jpg',
        ];

        $skills = $isFound ? [
            ['category' => 'C / C++', 'icon' => 'fa-solid fa-code', 'tools' => ['Make', 'GDB']],
            ['category' => 'JavaScript', 'icon' => 'fa-brands fa-js', 'tools' => ['React', 'Express.js', 'Next.js', 'Three.js', 'TypeScript']],
            ['category' => 'CSS', 'icon' => 'fa-brands fa-css3-alt', 'tools' => ['Tailwind CSS']],
            ['category' => 'Database', 'icon' => 'fa-solid fa-database', 'tools' => ['MySQL', 'PostgreSQL', 'SQLite']],
            ['category' => 'Graphics', 'icon' => 'fa-solid fa-palette', 'tools' => ['Canva', 'Figma']],
            ['category' => 'Linux', 'icon' => 'fa-brands fa-linux', 'tools' => ['Ubuntu']],
            ['category' => 'Tools', 'icon' => 'fa-solid fa-toolbox', 'tools' => ['Git']],
        ] : [];
    @endphp

    <!-- Profile Hero Section (Matches User Screenshot) -->
    <section class="relative bg-slate-50/70 dark:bg-slate-950 py-12 lg:py-16 transition-colors duration-300">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="mb-8">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    Student <span class="text-its-accent dark:text-blue-400">Profile</span>
                </h1>
            </div>

            <!-- Profile Cards Grid (2 Columns: Photo Card + Info Card) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-stretch">

                <!-- Left Column: Student Photo Card -->
                <div class="lg:col-span-4 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-3.5 shadow-sm flex items-center justify-center">
                    <div class="w-full aspect-[3/4] rounded-2xl overflow-hidden bg-blue-600 shadow-inner">
                        <img src="/images/student.jpg" alt="{{ $profile['name'] }}"
                            class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Right Column: Academic Profile Info Card -->
                <div class="lg:col-span-8 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-8 sm:p-10 shadow-sm flex flex-col justify-center">
                    <!-- Title & Subtitle -->
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                            {{ $profile['name'] }}
                        </h2>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mt-1">
                            {{ $profile['role'] }}
                        </p>
                    </div>

                    <!-- 6 Info Items in 2 Columns -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 lg:gap-x-12 gap-y-7 mt-8 sm:mt-10">
                        <!-- Item 1: NRP -->
                        <x-info-card
                            title="NRP"
                            :value="$profile['nrp']"
                            icon="fa-regular fa-id-card">
                            <span class="sr-only">Student Identification Number</span>
                        </x-info-card>

                        <!-- Item 2: MAJOR & DEGREE -->
                        <x-info-card
                            title="MAJOR & DEGREE"
                            :value="$profile['major']"
                            icon="fa-solid fa-graduation-cap">
                            <span class="sr-only">Study Program &amp; Degree</span>
                        </x-info-card>

                        <!-- Item 3: INSTITUTIONAL EMAIL -->
                        <x-info-card
                            title="INSTITUTIONAL EMAIL"
                            :value="$profile['email']"
                            icon="fa-solid fa-envelope">
                            <span class="sr-only">Institutional ITS Email</span>
                        </x-info-card>

                        <!-- Item 4: CURRENT ACADEMIC STANDING -->
                        <x-info-card
                            title="CURRENT ACADEMIC STANDING"
                            :value="$profile['standing']"
                            icon="fa-solid fa-chart-line">
                            <span class="sr-only">Current Semester &amp; Standing</span>
                        </x-info-card>

                        <!-- Item 5: ACADEMIC ADVISOR -->
                        <x-info-card
                            title="ACADEMIC ADVISOR"
                            :value="$profile['advisor']"
                            icon="fa-solid fa-user">
                            <span class="sr-only">Academic Advisor</span>
                        </x-info-card>

                        <!-- Item 6: FOCUS & RESEARCH INTEREST -->
                        <x-info-card
                            title="FOCUS & RESEARCH INTEREST"
                            :value="$profile['focus']"
                            icon="fa-solid fa-lightbulb">
                            <span class="sr-only">Research Focus &amp; Expertise</span>
                        </x-info-card>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="py-16 lg:py-24 bg-slate-50 dark:bg-slate-950 relative transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Title -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    Technical <span class="text-its-accent">Skills &amp; Competencies</span>
                </h2>
                <p class="text-slate-600 dark:text-slate-400 mt-3 text-base sm:text-lg">
                    {{ $isFound ? 'Hover over any technology category below to inspect specific frameworks, tools, and technical proficiencies.' : 'No skill profile available for this student record.' }}
                </p>
            </div>

            <!-- Interactive Skills Grid / Fallback -->
            @if(count($skills) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @foreach($skills as $skill)
                        <div class="group relative h-52 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col items-center justify-center p-6 overflow-hidden">

                            <!-- Default Front View -->
                            <div class="flex flex-col items-center justify-center space-y-3 group-hover:opacity-0 transition-opacity duration-300">
                                <div class="w-16 h-16 rounded-2xl bg-its-light/60 dark:bg-slate-800 text-its-accent dark:text-blue-400 flex items-center justify-center text-3xl shadow-inner group-hover:scale-90 transition duration-300">
                                    <i class="{{ $skill['icon'] }}"></i>
                                </div>
                                <h3 class="text-lg font-bold text-slate-800 dark:text-white tracking-wide text-center">
                                    {{ $skill['category'] }}
                                </h3>
                            </div>

                            <!-- Hover Overlay View -->
                            <div class="absolute inset-0 bg-its-blue text-white rounded-2xl p-6 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-95 group-hover:scale-100 z-10 shadow-2xl">
                                <h3 class="text-lg font-bold text-white mb-3 text-center border-b border-blue-400/30 pb-1 w-full">
                                    {{ $skill['category'] }}
                                </h3>

                                <div class="flex flex-wrap justify-center gap-2 overflow-y-auto max-h-32 no-scrollbar py-1">
                                    @foreach($skill['tools'] as $tool)
                                        <span class="bg-white/10 hover:bg-white/20 text-blue-100 text-xs font-semibold px-3 py-1 rounded-lg border border-white/15 transition-colors">
                                            {{ $tool }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="max-w-md mx-auto bg-white rounded-2xl border border-slate-200 p-8 text-center shadow-sm">
                    <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
                        <i class="fa-solid fa-folder-open text-xl"></i>
                    </div>
                    <h4 class="text-base font-bold text-slate-700">No Skills Recorded</h4>
                    <p class="text-xs text-slate-500 mt-1">NRP {{ $nrp ?? 'Unspecified' }} does not have any skill categories associated with their profile.</p>
                </div>
            @endif

        </div>
    </section>

</x-layouts.app>
