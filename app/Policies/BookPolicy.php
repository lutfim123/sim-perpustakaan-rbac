<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;

class BookPolicy
{
    /**
     * Menentukan apakah user dapat melihat daftar buku.
     * Hak akses: Admin, Dosen, Mahasiswa.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('lihat buku');
    }

    /**
     * Menentukan apakah user dapat melihat detail buku tertentu.
     * Hak akses: Admin, Dosen, Mahasiswa.
     */
    public function view(User $user, Book $book): bool
    {
        return $user->can('lihat buku');
    }

    /**
     * Menentukan apakah user dapat menambahkan buku baru.
     * Hak akses: Admin, Dosen (Mahasiswa ditolak 403).
     */
    public function create(User $user): bool
    {
        return $user->can('tambah buku');
    }

    /**
     * Menentukan apakah user dapat memperbarui/mengubah data buku.
     * Hak akses: Admin, Dosen (Mahasiswa ditolak 403).
     */
    public function update(User $user, Book $book): bool
    {
        return $user->can('edit buku');
    }

    /**
     * Menentukan apakah user dapat menghapus buku.
     * Hak akses: Admin SAJA (Dosen & Mahasiswa ditolak 403).
     */
    public function delete(User $user, Book $book): bool
    {
        return $user->can('hapus buku');
    }
}
