<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Menampilkan daftar buku perpustakaan.
     * Hak akses: Admin, Dosen, Mahasiswa.
     */
    public function index(Request $request): View
    {
        // Proteksi Otorisasi Server-Side via Policy
        Gate::authorize('viewAny', Book::class);

        $query = Book::with('user')->latest();

        // Fitur Pencarian Judul, Penulis, atau ISBN
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        // Fitur Filter Kategori
        if ($kategori = $request->input('kategori')) {
            $query->where('kategori', $kategori);
        }

        $books = $query->paginate(8)->withQueryString();
        $kategoriList = Book::select('kategori')->distinct()->pluck('kategori');

        return view('books.index', compact('books', 'kategoriList'));
    }

    /**
     * Menampilkan formulir penambahan buku baru.
     * Hak akses: Admin, Dosen (Mahasiswa ditolak 403).
     */
    public function create(): View
    {
        // Proteksi Otorisasi Server-Side via Policy
        Gate::authorize('create', Book::class);

        return view('books.create');
    }

    /**
     * Menyimpan data buku baru ke database.
     * Hak akses: Admin, Dosen (Mahasiswa ditolak 403).
     */
    public function store(StoreBookRequest $request): RedirectResponse
    {
        // Validasi dan Otorisasi FormRequest sudah otomatis dieksekusi
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        Book::create($data);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku baru "' . $data['judul'] . '" berhasil ditambahkan ke katalog!');
    }

    /**
     * Menampilkan detail informasi satu buku.
     * Hak akses: Admin, Dosen, Mahasiswa.
     */
    public function show(Book $book): View
    {
        // Proteksi Otorisasi Server-Side via Policy
        Gate::authorize('view', $book);

        return view('books.show', compact('book'));
    }

    /**
     * Menampilkan formulir edit buku.
     * Hak akses: Admin, Dosen (Mahasiswa ditolak 403).
     */
    public function edit(Book $book): View
    {
        // Proteksi Otorisasi Server-Side via Policy
        Gate::authorize('update', $book);

        return view('books.edit', compact('book'));
    }

    /**
     * Memperbarui data buku di database.
     * Hak akses: Admin, Dosen (Mahasiswa ditolak 403).
     */
    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        // Validasi dan Otorisasi FormRequest sudah otomatis dieksekusi
        $book->update($request->validated());

        return redirect()
            ->route('books.index')
            ->with('success', 'Data buku "' . $book->judul . '" berhasil diperbarui!');
    }

    /**
     * Menghapus buku dari database.
     * Hak akses: Admin SAJA (Dosen & Mahasiswa ditolak 403).
     */
    public function destroy(Book $book): RedirectResponse
    {
        // Proteksi Otorisasi Server-Side via Policy
        Gate::authorize('delete', $book);

        $judul = $book->judul;
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku "' . $judul . '" berhasil dihapus dari perpustakaan!');
    }
}
