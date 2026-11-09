<?php

namespace App\Http\Controllers;

use App\Models\AgentIdea;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Halaman 1: Beranda (Tugas 4: / dan /beranda)
     * Mendukung Tantangan 2: Alert Status Interaktif melalui parameter nama user di URL (?user=NamaUser)
     */
    public function index(Request $request)
    {
        if ($request->has('mode')) {
            session(['theme_mode' => $request->query('mode')]);
        }
        $user = $request->query('user');

        return view('home', compact('user'));
    }

    /**
     * Halaman 2: Profil Mahasiswa (Tugas 4: /profil-mahasiswa)
     */
    public function profilMahasiswa(Request $request, $nrp = '5025241065')
    {
        if ($request->has('mode')) {
            session(['theme_mode' => $request->query('mode')]);
        }
        return view('mahasiswa', compact('nrp'));
    }

    /**
     * Halaman 3: Ide-Riset & Platform Agentic AI (Tugas 4: /ide-agent)
     * Mendukung Tantangan 1: Toggle Tema Dinamis melalui parameter rute (?mode=dark)
     */
    public function ideAgent(Request $request)
    {
        if ($request->has('mode')) {
            $mode = $request->query('mode');
            session(['theme_mode' => $mode]);
        } else {
            $mode = session('theme_mode', $request->cookie('theme_mode', 'light'));
        }
        $isDark = $mode === 'dark';

        $initialIdeas = [
            [
                'id' => 'IDE-001',
                'author' => 'Aji Zaenul Musthofa',
                'nrp' => '5025241065',
                'title' => 'Magentic: Autonomous Multi-Agent Collaborative IDE',
                'category' => 'Autonomous Code Generation & Refactoring',
                'architecture' => 'Multi-Agent Collaboration',
                'target_user' => 'Mahasiswa & Developer Tim Skripsi',
                'priority' => 'Tinggi',
                'description' => 'Platform web-based IDE dengan integrasi Monaco Editor dan agen otonom yang mampu melakukan multi-file refactoring serta auto-review code pull request.',
                'tech_stack' => ['Laravel 11', 'Monaco Editor', 'WebSocket Reverb', 'Python LLM Agent'],
                'created_at' => '2026-09-24 10:15',
            ],
            [
                'id' => 'IDE-002',
                'author' => 'Anak Agung Putu Arda Nareswara',
                'nrp' => '5025241074',
                'title' => 'Real-Time Multiplayer Presence & Code Syncer',
                'category' => 'Real-Time Collaborative Debugger',
                'architecture' => 'Tool-Calling LLM',
                'target_user' => 'Tim Pengembang Software Kelompok',
                'priority' => 'Tinggi',
                'description' => 'Sistem sinkronisasi cursor multiplayer interaktif dengan feedback linting otomatis dan rekomendasi sintaks AI secara real-time.',
                'tech_stack' => ['Vue 3 / TypeScript', 'Tailwind CSS', 'Laravel Reverb'],
                'created_at' => '2026-09-25 14:30',
            ],
            [
                'id' => 'IDE-003',
                'author' => 'Abdullah Sultan Barizy',
                'nrp' => '5025241092',
                'title' => 'Automated Unit Test & Vulnerability Patching Agent',
                'category' => 'Automated Testing & QA Agent',
                'architecture' => 'ReAct Agent Loop',
                'target_user' => 'Asisten Lab & Mahasiswa PBKK',
                'priority' => 'Sedang',
                'description' => 'Agent yang membaca spesifikasi tugas lab pemrograman, menjalankan test suite secara otomatis, dan memberikan saran perbaikan kerentanan.',
                'tech_stack' => ['PHPUnit / Pest', 'Docker Sandbox', 'Ollama API'],
                'created_at' => '2026-09-26 09:00',
            ],
        ];

        $dbIdeas = AgentIdea::latest()->get()->map(function ($idea) {
            return [
                'id' => $idea->code ?? ('IDE-' . str_pad((string) $idea->id, 3, '0', STR_PAD_LEFT)),
                'author' => $idea->author,
                'nrp' => $idea->nrp,
                'title' => $idea->title,
                'category' => $idea->category,
                'architecture' => $idea->architecture,
                'target_user' => $idea->target_user,
                'priority' => $idea->priority,
                'description' => $idea->description,
                'tech_stack' => is_array($idea->tech_stack) ? $idea->tech_stack : [],
                'created_at' => $idea->created_at ? $idea->created_at->format('Y-m-d H:i') : now()->format('Y-m-d H:i'),
            ];
        })->toArray();

        $allIdeas = count($dbIdeas) > 0 ? $dbIdeas : $initialIdeas;

        return view('ide_agent', compact('allIdeas', 'mode', 'isDark'));
    }

    /**
     * Menyimpan formulir pengumpulan ide baru ke session pra-database
     */
    public function storeIdea(Request $request)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:100',
            'nrp' => 'required|numeric|digits:10',
            'title' => 'required|string|max:255',
            'category' => 'nullable|string',
            'architecture' => 'nullable|string',
            'target_user' => 'nullable|string|max:100',
            'priority' => 'nullable|string|in:Rendah,Sedang,Tinggi,Kritis',
            'description' => 'nullable|string',
            'tech_stack' => 'nullable|array',
        ], [
            'author.required' => 'The Name field is required.',
            'nrp.required' => 'The NRP field is required.',
            'nrp.digits' => 'NRP must be exactly 10 digits.',
            'title.required' => 'The FP Idea field is required.',
        ]);

        $category = $validated['category'] ?? 'Autonomous Agentic System';
        $architecture = $validated['architecture'] ?? 'ReAct Multi-Agent Loop';
        $target_user = $validated['target_user'] ?? 'Mahasiswa Informatika & Dosen';
        $priority = $validated['priority'] ?? 'Tinggi';
        $description = $validated['description'] ?? $validated['title'];

        $lastId = AgentIdea::max('id') ?? 0;
        $code = 'IDE-' . str_pad((string) ($lastId + 1), 3, '0', STR_PAD_LEFT);
        $techStack = $validated['tech_stack'] ?? ['Laravel 11', 'Tailwind CSS', 'Monaco Editor'];

        AgentIdea::create([
            'code' => $code,
            'author' => $validated['author'],
            'nrp' => $validated['nrp'],
            'title' => $validated['title'],
            'category' => $category,
            'architecture' => $architecture,
            'target_user' => $target_user,
            'priority' => $priority,
            'description' => $description,
            'tech_stack' => $techStack,
            'status' => 'Review',
        ]);

        $newIdea = [
            'id' => $code,
            'author' => $validated['author'],
            'nrp' => $validated['nrp'],
            'title' => $validated['title'],
            'category' => $category,
            'architecture' => $architecture,
            'target_user' => $target_user,
            'priority' => $priority,
            'description' => $description,
            'tech_stack' => $techStack,
            'created_at' => now()->format('Y-m-d H:i'),
        ];

        $ideas = session('submitted_ideas', []);
        array_unshift($ideas, $newIdea);
        session(['submitted_ideas' => $ideas]);

        // Retain mode parameter if current request was in dark mode
        $currentMode = $request->query('mode', session('theme_mode'));
        $redirectParams = ($currentMode === 'dark') ? ['mode' => 'dark'] : [];
        $redirectUrl = route('ide.agent', $redirectParams) . '#daftar-ide';

        return redirect($redirectUrl)
            ->with('success', 'Innovation idea proposal "' . $validated['title'] . '" was successfully submitted! (Pengajuan Ide Berhasil Dikirim!)');
    }
}
