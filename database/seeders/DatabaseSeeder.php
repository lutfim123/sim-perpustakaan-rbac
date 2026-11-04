<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Menyiapkan Role, Permission, Akun Pengujian ketiga role, dan Data Sampel Buku.
     */
    public function run(): void
    {
        // 1. Seed Roles dan Permissions Spatie
        $this->call(RolePermissionSeeder::class);

        // 2. Akun Pengujian 1: Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator Sistem',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->syncRoles(['Admin']);

        // 3. Akun Pengujian 2: Dosen
        $dosen = User::updateOrCreate(
            ['email' => 'dosen@gmail.com'],
            [
                'name' => 'Dr. Dosen Pengajar, M.Kom.',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $dosen->syncRoles(['Dosen']);

        // 4. Akun Pengujian 3: Mahasiswa
        $mahasiswa = User::updateOrCreate(
            ['email' => 'mahasiswa@gmail.com'],
            [
                'name' => 'Mahasiswa Berprestasi',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $mahasiswa->syncRoles(['Mahasiswa']);

        // 5. Seed Koleksi Buku Awal
        $this->call(BookSeeder::class);
    }
}
