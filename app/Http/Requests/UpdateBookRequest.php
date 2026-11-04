<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan membuat permintaan ini.
     * Menggunakan Spatie Permission 'edit buku'.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('edit buku') ?? false;
    }

    /**
     * Aturan validasi pembaruan buku.
     */
    public function rules(): array
    {
        $bookId = $this->route('book') instanceof \App\Models\Book
            ? $this->route('book')->id
            : $this->route('book');

        return [
            'judul' => ['required', 'string', 'max:255'],
            'penulis' => ['required', 'string', 'max:255'],
            'penerbit' => ['required', 'string', 'max:255'],
            'tahun_terbit' => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'kategori' => ['required', 'string', 'max:100'],
            'isbn' => ['required', 'string', 'max:50', 'unique:books,isbn,' . $bookId],
            'stok' => ['required', 'integer', 'min:0'],
            'deskripsi' => ['nullable', 'string'],
        ];
    }

    /**
     * Pesan kesalahan khusus bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'judul.required' => 'Judul buku wajib diisi.',
            'penulis.required' => 'Nama penulis wajib diisi.',
            'penerbit.required' => 'Nama penerbit wajib diisi.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'kategori.required' => 'Kategori buku wajib dipilih/diisi.',
            'isbn.required' => 'Nomor ISBN wajib diisi.',
            'isbn.unique' => 'Nomor ISBN ini sudah terdaftar untuk buku lain.',
            'stok.required' => 'Jumlah stok buku wajib diisi.',
            'stok.min' => 'Stok buku minimal 0.',
        ];
    }
}
