<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat Permissions
        $permissions = [
            'view-dashboard',
            'view-ideas',
            'create-ideas',
            'edit-ideas',
            'delete-ideas',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Buat Roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->syncPermissions(Permission::all());

        $stafRole = Role::firstOrCreate(['name' => 'Staf']);
        $stafRole->syncPermissions([
            'view-dashboard',
            'view-ideas',
            'create-ideas',
            'edit-ideas',
            // Tanpa delete-ideas! (Eksklusif Admin)
        ]);

        // 3. Buat Akun Uji Coba Demo
        // Akun 1: Admin Utama
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@akademik.its.ac.id'],
            [
                'name' => 'Administrator Portal (Admin)',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $adminUser->syncRoles([$adminRole]);

        // Akun 2: Staf Akademik
        $stafUser = User::firstOrCreate(
            ['email' => 'staf@akademik.its.ac.id'],
            [
                'name' => 'Staf Layanan Akademik (Staf)',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $stafUser->syncRoles([$stafRole]);
    }
}

