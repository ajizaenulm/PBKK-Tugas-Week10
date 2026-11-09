<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentIdea;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class IdeaController extends Controller implements HasMiddleware
{
    /**
     * Terapkan pengaman controller middleware permission Spatie (Spesifikasi Aturan Wajib)
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
            new Middleware('permission:view-ideas', only: ['index', 'show']),
            new Middleware('permission:create-ideas', only: ['create', 'store']),
            new Middleware('permission:edit-ideas', only: ['edit', 'update']),
            new Middleware('permission:delete-ideas', only: ['destroy']),
        ];
    }

    /**
     * Tampilkan Tabel Data Ide Agent
     * Menerapkan Challenge: Filter Pencarian dengan query kondisional when()
     * Menerapkan Challenge: Pengunci Link Pagination withQueryString()
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $priority = $request->query('priority');
        $status = $request->query('status');

        $ideas = AgentIdea::query()
            // 1. Kueri Kondisional when() untuk Kata Kunci Pencarian (Search)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('author', 'like', "%{$search}%")
                        ->orWhere('nrp', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%");
                });
            })
            // 2. Kueri Kondisional when() untuk Filter Prioritas
            ->when($priority, function ($query, $priority) {
                $query->where('priority', $priority);
            })
            // 3. Kueri Kondisional when() untuk Filter Status
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            // 4. Pengunci Link Pagination withQueryString() agar filter tidak hilang saat ganti halaman
            ->paginate(10)
            ->withQueryString();

        return view('admin.ideas.index', compact('ideas', 'search', 'priority', 'status'));
    }

    /**
     * Tampilkan Form Tambah Ide Baru
     */
    public function create()
    {
        return view('admin.ideas.create');
    }

    /**
     * Simpan Data Ide Baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:100',
            'nrp' => 'required|numeric|digits:10',
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'architecture' => 'required|string',
            'target_user' => 'required|string|max:100',
            'priority' => 'required|string|in:Rendah,Sedang,Tinggi,Kritis',
            'status' => 'required|string|in:Review,Disetujui,Ditolak',
            'description' => 'required|string',
            'tech_stack_input' => 'nullable|string',
        ]);

        $lastId = AgentIdea::max('id') ?? 0;
        $code = 'IDE-' . str_pad((string) ($lastId + 1), 3, '0', STR_PAD_LEFT);

        $techStack = [];
        if (!empty($validated['tech_stack_input'])) {
            $techStack = array_map('trim', explode(',', $validated['tech_stack_input']));
        }

        AgentIdea::create([
            'code' => $code,
            'author' => $validated['author'],
            'nrp' => $validated['nrp'],
            'title' => $validated['title'],
            'category' => $validated['category'],
            'architecture' => $validated['architecture'],
            'target_user' => $validated['target_user'],
            'priority' => $validated['priority'],
            'status' => $validated['status'],
            'description' => $validated['description'],
            'tech_stack' => $techStack,
        ]);

        return redirect()->route('admin.ideas.index')->with('success', "Ide riset baru [{$code}] berhasil ditambahkan!");
    }

    /**
     * Tampilkan Detail Ide
     */
    public function show($id)
    {
        $idea = AgentIdea::findOrFail($id);
        return view('admin.ideas.show', compact('idea'));
    }

    /**
     * Tampilkan Form Edit Ide
     */
    public function edit($id)
    {
        $idea = AgentIdea::findOrFail($id);
        return view('admin.ideas.edit', compact('idea'));
    }

    /**
     * Update Data Ide
     */
    public function update(Request $request, $id)
    {
        $idea = AgentIdea::findOrFail($id);

        $validated = $request->validate([
            'author' => 'required|string|max:100',
            'nrp' => 'required|numeric|digits:10',
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'architecture' => 'required|string',
            'target_user' => 'required|string|max:100',
            'priority' => 'required|string|in:Rendah,Sedang,Tinggi,Kritis',
            'status' => 'required|string|in:Review,Disetujui,Ditolak',
            'description' => 'required|string',
            'tech_stack_input' => 'nullable|string',
        ]);

        $techStack = [];
        if (!empty($validated['tech_stack_input'])) {
            $techStack = array_map('trim', explode(',', $validated['tech_stack_input']));
        }

        $idea->update([
            'author' => $validated['author'],
            'nrp' => $validated['nrp'],
            'title' => $validated['title'],
            'category' => $validated['category'],
            'architecture' => $validated['architecture'],
            'target_user' => $validated['target_user'],
            'priority' => $validated['priority'],
            'status' => $validated['status'],
            'description' => $validated['description'],
            'tech_stack' => $techStack,
        ]);

        return redirect()->route('admin.ideas.index')->with('success', "Data ide [{$idea->code}] berhasil diperbarui!");
    }

    /**
     * HAPUS DATA (HAK EKSKLUSIF ADMIN MURNI)
     * Aturan Spesifikasi: Menu tertentu seperti 'Hapus Data' hanya boleh dirender visual di Blade
     * dan dieksekusi di Controller apabila pengguna memegang peran Admin murni.
     */
    public function destroy($id)
    {
        // Pengaman Ganda Server-Side: Wajib Role 'Admin' Murni
        if (!auth()->user()->hasRole('Admin')) {
            abort(403, 'Akses Ditolak: Anda tidak memiliki wewenang Admin untuk menghapus data fisik ini.');
        }

        $idea = AgentIdea::findOrFail($id);
        $code = $idea->code;
        $idea->delete();

        return redirect()->route('admin.ideas.index')->with('success', "Data ide [{$code}] berhasil dihapus secara permanen oleh Admin.");
    }
}
