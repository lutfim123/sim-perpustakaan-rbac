<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    /**
     * Menampilkan daftar pengguna dan peran mereka.
     * Hak akses: Admin SAJA (Dosen & Mahasiswa ditolak 403).
     */
    public function index(): View
    {
        // Proteksi Otorisasi Server-Side
        abort_if(
            !auth()->user()->can('kelola role pengguna'),
            403,
            'Akses Ditolak: Fitur Kelola Role Pengguna hanya dapat diakses oleh Administrator.'
        );

        $users = User::with('roles')->latest()->paginate(10);
        $roles = Role::all();

        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Memperbarui peran (role) seorang pengguna.
     * Hak akses: Admin SAJA (Dosen & Mahasiswa ditolak 403).
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        // Proteksi Otorisasi Server-Side
        abort_if(
            !auth()->user()->can('kelola role pengguna'),
            403,
            'Akses Ditolak: Anda tidak memiliki wewenang untuk mengubah role pengguna.'
        );

        $request->validate([
            'role' => ['required', 'string', 'exists:roles,name'],
        ], [
            'role.required' => 'Pilih peran yang ingin diberikan kepada pengguna.',
            'role.exists' => 'Peran yang dipilih tidak valid dalam sistem.',
        ]);

        $user->syncRoles([$request->role]);

        return back()->with('success', 'Peran pengguna ' . $user->name . ' berhasil diubah menjadi ' . $request->role . '!');
    }
}
