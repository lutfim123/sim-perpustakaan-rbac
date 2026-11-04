<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Detail Informasi Buku') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Koleksi: {{ $book->judul }}
                </p>
            </div>
            <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition">
                &larr; Kembali ke Katalog
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                
                {{-- Header Card --}}
                <div class="bg-gradient-to-r from-slate-800 to-indigo-900 p-6 sm:p-8 text-white">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-xs font-semibold">
                            {{ $book->kategori }}
                        </span>
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $book->stok > 0 ? 'bg-emerald-500/80 text-white' : 'bg-rose-500/80 text-white' }}">
                            {{ $book->stok > 0 ? 'Tersedia (' . $book->stok . ' Eksemplar)' : 'Stok Habis' }}
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                        {{ $book->judul }}
                    </h1>
                    <p class="text-indigo-200 text-sm mt-2 font-mono">
                        ISBN: {{ $book->isbn }}
                    </p>
                </div>

                {{-- Detail Specifications Grid --}}
                <div class="p-6 sm:p-8 space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 pb-6 border-b border-gray-100">
                        <div>
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Penulis / Pengarang</span>
                            <p class="text-base font-bold text-gray-800 mt-1">{{ $book->penulis }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Penerbit</span>
                            <p class="text-base font-bold text-gray-800 mt-1">{{ $book->penerbit }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Tahun Terbit</span>
                            <p class="text-base font-bold text-gray-800 mt-1">{{ $book->tahun_terbit }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Kategori Keilmuan</span>
                            <p class="text-base font-bold text-gray-800 mt-1">{{ $book->kategori }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Ditambahkan Oleh</span>
                            <p class="text-base font-bold text-gray-800 mt-1">{{ $book->user?->name ?? 'Sistem Perpustakaan' }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Waktu Pendaftaran</span>
                            <p class="text-base font-bold text-gray-800 mt-1">{{ $book->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    {{-- Sinopsis / Deskripsi --}}
                    <div>
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-2">Sinopsis / Ringkasan Buku</h3>
                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100 text-gray-700 text-sm leading-relaxed whitespace-pre-line">
                            {{ $book->deskripsi ?: 'Tidak ada sinopsis atau deskripsi tambahan untuk buku ini.' }}
                        </div>
                    </div>

                    {{-- Actions Bar --}}
                    <div class="flex flex-wrap items-center justify-between gap-3 pt-6 border-t border-gray-100">
                        <a href="{{ route('books.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">
                            &larr; Kembali ke Daftar Buku
                        </a>

                        <div class="flex items-center gap-2">
                            {{-- Edit: Admin & Dosen --}}
                            @can('edit buku')
                                <a href="{{ route('books.edit', $book) }}" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                                    Edit Data Buku
                                </a>
                            @endcan

                            {{-- Hapus: Khusus Admin --}}
                            @can('hapus buku')
                                <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini dari database?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                                        Hapus Buku
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>

