<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Sesuai Ketentuan Fitur dan Hak Akses Tugas Mandiri:
     * - Admin: Login/Logout, Lihat buku, Tambah buku, Edit buku, Hapus buku, Kelola role pengguna
     * - Dosen: Login/Logout, Lihat buku, Tambah buku, Edit buku
     * - Mahasiswa: Login/Logout, Lihat buku
     */
    public function run(): void
    {
        // Bersihkan cache roles and permissions Spatie
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Definisikan Permissions
        $permissions = [
            'lihat buku',
            'tambah buku',
            'edit buku',
            'hapus buku',
            'kelola role pengguna',
        ];

        foreach ($permissions as $permName) {
            Permission::firstOrCreate(['name' => $permName]);
        }

        // 2. Buat Roles
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $dosen = Role::firstOrCreate(['name' => 'Dosen']);
        $mahasiswa = Role::firstOrCreate(['name' => 'Mahasiswa']);

        // 3. Assign Permissions sesuai Matriks Hak Akses
        // Admin: semua permission (5/5)
        $admin->syncPermissions(Permission::all());

        // Dosen: lihat buku, tambah buku, edit buku (3/5)
        $dosen->syncPermissions(['lihat buku', 'tambah buku', 'edit buku']);

        // Mahasiswa: hanya lihat buku (1/5)
        $mahasiswa->syncPermissions(['lihat buku']);
    }
}
