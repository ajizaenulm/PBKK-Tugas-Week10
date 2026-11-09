<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;

class UserController extends Controller implements HasMiddleware
{
    /**
     * Khusus Role Admin murni (Spesifikasi RBAC)
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
            new Middleware('role:Admin'),
        ];
    }

    /**
     * Tampilkan Daftar Pengguna & Hak Akses Role Spatie
     */
    public function index()
    {
        $users = User::with('roles', 'permissions')->get();
        $roles = Role::with('permissions')->get();

        return view('admin.users.index', compact('users', 'roles'));
    }
}
