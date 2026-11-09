<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentIdea;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    /**
     * Tampilkan Beranda Dashboard AdminLTE dengan Widget Statistik Agregat Dinamis
     */
    public function index()
    {
        // 4. Widget Dashboard Agregat: Minimal 3 widget box statistik dinamis via query agregat
        $totalIdeas = AgentIdea::count();
        $highPriorityIdeas = AgentIdea::whereIn('priority', ['Tinggi', 'Kritis'])->count();
        $approvedIdeas = AgentIdea::where('status', 'Disetujui')->count();
        $reviewIdeas = AgentIdea::where('status', 'Review')->count();
        $totalUsers = User::count();
        $totalAdmins = User::role('Admin')->count();
        $totalStaf = User::role('Staf')->count();

        // 5 Ide terbaru
        $recentIdeas = AgentIdea::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalIdeas',
            'highPriorityIdeas',
            'approvedIdeas',
            'reviewIdeas',
            'totalUsers',
            'totalAdmins',
            'totalStaf',
            'recentIdeas'
        ));
    }
}

