<?php

namespace Database\Seeders;

use App\Models\AgentIdea;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AgentIdeaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. Masukkan data kurasi awal dari Tugas 4
        $initialIdeas = [
            [
                'code' => 'IDE-001',
                'author' => 'Aji Zaenul Musthofa',
                'nrp' => '5025241065',
                'title' => 'Magentic: Autonomous Multi-Agent Collaborative IDE',
                'category' => 'Autonomous Code Generation & Refactoring',
                'architecture' => 'Multi-Agent Collaboration',
                'target_user' => 'Mahasiswa & Developer Tim Skripsi',
                'priority' => 'Tinggi',
                'description' => 'Platform web-based IDE dengan integrasi Monaco Editor dan agen otonom yang mampu melakukan multi-file refactoring serta auto-review code pull request.',
                'tech_stack' => ['Laravel 11', 'Monaco Editor', 'WebSocket Reverb', 'Python LLM Agent'],
                'status' => 'Disetujui',
                'created_at' => now()->subDays(10),
            ],
            [
                'code' => 'IDE-002',
                'author' => 'Anak Agung Putu Arda Nareswara',
                'nrp' => '5025241074',
                'title' => 'Real-Time Multiplayer Presence & Code Syncer',
                'category' => 'Real-Time Collaborative Debugger',
                'architecture' => 'Tool-Calling LLM',
                'target_user' => 'Tim Pengembang Software Kelompok',
                'priority' => 'Tinggi',
                'description' => 'Sistem sinkronisasi cursor multiplayer interaktif dengan feedback linting otomatis dan rekomendasi sintaks AI secara real-time.',
                'tech_stack' => ['Vue 3 / TypeScript', 'Tailwind CSS', 'Laravel Reverb'],
                'status' => 'Disetujui',
                'created_at' => now()->subDays(8),
            ],
            [
                'code' => 'IDE-003',
                'author' => 'Abdullah Sultan Barizy',
                'nrp' => '5025241092',
                'title' => 'Automated Unit Test & Vulnerability Patching Agent',
                'category' => 'Automated Testing & QA Agent',
                'architecture' => 'ReAct Agent Loop',
                'target_user' => 'Asisten Lab & Mahasiswa PBKK',
                'priority' => 'Sedang',
                'description' => 'Agent yang membaca spesifikasi tugas lab pemrograman, menjalankan test suite secara otomatis, dan memberikan saran perbaikan kerentanan.',
                'tech_stack' => ['PHPUnit / Pest', 'Docker Sandbox', 'Ollama API'],
                'status' => 'Review',
                'created_at' => now()->subDays(5),
            ],
        ];

        foreach ($initialIdeas as $idea) {
            AgentIdea::firstOrCreate(['code' => $idea['code']], $idea);
        }

        // 2. Siram puluhan data dummy realistis menggunakan Faker Generator
        $categories = [
            'Autonomous Code Generation & Refactoring',
            'Real-Time Collaborative Debugger',
            'Automated Testing & QA Agent',
            'Academic Advisor & Curriculum Planner',
            'Campus Security & Network Defense Agent',
            'Autonomous Cloud Infrastructure Provisioner',
            'Semantic Code Search & Knowledge Graph',
            'Automated Grading & Plagiarism Detector',
        ];

        $architectures = [
            'Multi-Agent Collaboration',
            'ReAct Agent Loop',
            'Tool-Calling LLM',
            'Reflexion & Self-Correction Agent',
            'Hierarchical Plan-and-Solve Agent',
        ];

        $targetUsers = [
            'Mahasiswa Tingkat Akhir',
            'Dosen Pembimbing & Penguji',
            'Asisten Laboratorium PBKK',
            'Tim Pengembang Riset Kampus',
            'Laboratorium Pemrograman & AI',
        ];

        $priorities = ['Rendah', 'Sedang', 'Tinggi', 'Kritis'];
        $statuses = ['Review', 'Disetujui', 'Ditolak'];

        $sampleTech = [
            ['Laravel 11', 'AdminLTE 3', 'SQLite', 'Python LangChain'],
            ['FastAPI', 'ChromaDB', 'Gemini 1.5 Pro', 'Tailwind CSS'],
            ['Docker Sandbox', 'PHPStan', 'Pest PHP', 'Vue 3'],
            ['Node.js', 'PostgreSQL', 'LangGraph', 'Next.js'],
            ['Laravel Reverb', 'WebRTC', 'Monaco Editor', 'Redis'],
            ['Ollama Local LLM', 'Bash Sandbox', 'Alpine Linux', 'Flask'],
        ];

        $distinctTitles = [
            4 => 'Semantic Code Search & Knowledge Graph Engine',
            5 => 'Autonomous Cloud Infrastructure Provisioner via Terraform Agent',
            6 => 'Platform Penjadwalan Sidang Tugas Akhir Berbasis Constraint Satisfaction',
            7 => 'Agen Cerdas Optimasi Kueri Basis Data Skala Besar',
            8 => 'Sistem Deteksi Anomali Trafik Jaringan Kampus Berbasis GNN',
            9 => 'Sistem Verifikasi Autentikasi Biometrik Wajah Multimodal Adaptif',
            10 => 'Platform Asisten Virtual Riset Tugas Akhir Mahasiswa',
            11 => 'Sistem Evaluasi Gaya Koding & Refactoring Otomatis Berbasis LLM',
            12 => 'Deteksi Plagiarisme Kode Algoritmik Berbasis Abstract Syntax Tree',
            13 => 'Sistem Tutor Cerdas Adaptif untuk Pembelajaran Struktur Data',
            14 => 'Pembangkit Arsitektur Microservices Otomatis Berbasis OpenAPI',
            15 => 'Agen Otonom Analisis Kinerja Kueri Elasticsearch Terdistribusi',
            16 => 'Platform Otomasi Deploy Container Laboratorium Berbasis Kubernetes',
            17 => 'Sistem Deteksi Serangan DDoS Menggunakan Federated Learning',
            18 => 'Asisten Rekomendasi Topik Skripsi dan Dosen Pembimbing Berbasis Analisis Semantik',
            19 => 'Pembangkit Dokumentasi API Otomatis dengan Arsitektur ReAct Loop',
            20 => 'Agen Otomasi Pengujian Penetrasi Keamanan Aplikasi Web OWASP Top 10',
            21 => 'Sistem Ekstraksi Entitas & Relasi Dokumen Kurikulum Akademik Berbasis NLP',
            22 => 'Platform Simulasi Jaringan Sensor Nirkabel IoT Kampus Cerdas',
            23 => 'Asisten Penelaah Literatur Ilmiah dan Sintesis Sitasi Otomatis',
            24 => 'Sistem Monitoring & Evaluasi Kode Praktikum Berbasis Real-Time Linting',
            25 => 'Agen Cerdas Diagnostik Kerusakan Perangkat Keras Laboratorium',
            26 => 'Platform Benchmarking Komparatif Kinerja Model Deep Learning On-Device',
            27 => 'Sistem Deteksi Fake Review Produk Digital Berbasis Analisis Sentimen Aspek',
            28 => 'Pembangkit Mock Data & Faker Skema Relasional Kompleks untuk Pengujian Basis Data',
            29 => 'Agen Penyeimbang Beban Server Web Dinamis Berbasis Reinforcement Learning',
            30 => 'Sistem Klasifikasi Otomatis Tiket Bantuan Layanan IT Helpdesk Kampus',
            31 => 'Platform Visualisasi Jalur Eksekusi Kode Berbasis Interactive Debugger Graph',
            32 => 'Otomasi Analisis Kerentanan Kode Sumber Menggunakan Multi-Agent LLM',
            33 => 'Sistem Rekomendasi Jadwal Kuliah Bebas Konflik Berbasis Algoritma Genetika',
            34 => 'Agen Cerdas Peringkas Log Server Terdistribusi dengan Deteksi Anomali',
            35 => 'Platform Kolaborasi Pair-Programming AI Berbasis WebSocket Real-Time',
        ];

        for ($i = 4; $i <= 35; $i++) {
            $code = 'IDE-' . str_pad((string) $i, 3, '0', STR_PAD_LEFT);
            $randomPriority = $faker->randomElement($priorities);
            $randomStatus = $faker->randomElement($statuses);
            $randomCategory = $faker->randomElement($categories);
            $title = $distinctTitles[$i] ?? ('Inovasi Sistem Agen Otonom ' . $code);

            AgentIdea::firstOrCreate(
                ['code' => $code],
                [
                    'code' => $code,
                    'author' => $faker->name,
                    'nrp' => '5025' . $faker->numerify('24####'),
                    'title' => $title,
                    'category' => $randomCategory,
                    'architecture' => $faker->randomElement($architectures),
                    'target_user' => $faker->randomElement($targetUsers),
                    'priority' => $randomPriority,
                    'description' => 'Pengembangan arsitektur cerdas untuk mengotomasi proses ' . strtolower($randomCategory) . ' di lingkungan Teknik Informatika ITS. ' . $faker->paragraph(2),
                    'tech_stack' => $faker->randomElement($sampleTech),
                    'status' => $randomStatus,
                    'created_at' => now()->subDays(rand(1, 40)),
                ]
            );
        }
    }
}
