<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Katalog Koleksi Buku') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Daftar seluruh buku yang terdaftar di Sistem Informasi Manajemen Perpustakaan
                </p>
            </div>
            
            {{-- Tombol Tambah Buku: Hanya tampil jika pengguna memiliki izin 'tambah buku' (Admin & Dosen) --}}
            @can('tambah buku')
                <div>
                    <a href="{{ route('books.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                        <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Buku Baru
                    </a>
                </div>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Flash Alert --}}
            @if(session('success'))
                <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-md shadow-sm">
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-800 rounded-md shadow-sm">
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
            @endif

            {{-- Filter & Search Bar --}}
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                <form method="GET" action="{{ route('books.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center">
                    <div class="md:col-span-6 relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul buku, nama penulis, atau ISBN..." 
                               class="w-full text-sm border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 pl-10 pr-4 py-2">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>

                    <div class="md:col-span-4">
                        <select name="kategori" class="w-full text-sm border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 py-2">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoriList ?? [] as $kat)
                                <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2 flex gap-2">
                        <button type="submit" class="w-full py-2 px-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition">
                            Cari
                        </button>
                        @if(request('search') || request('kategori'))
                            <a href="{{ route('books.index') }}" class="py-2 px-3 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-medium rounded-lg transition" title="Reset Filter">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Tabel Daftar Buku --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider border-b">
                            <tr>
                                <th class="px-6 py-3.5 font-semibold">Judul Buku & ISBN</th>
                                <th class="px-6 py-3.5 font-semibold">Penulis</th>
                                <th class="px-6 py-3.5 font-semibold">Penerbit & Tahun</th>
                                <th class="px-6 py-3.5 font-semibold">Kategori</th>
                                <th class="px-6 py-3.5 font-semibold text-center">Stok</th>
                                <th class="px-6 py-3.5 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($books as $book)
                                <tr class="hover:bg-gray-50/70 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-900">{{ $book->judul }}</div>
                                        <div class="text-xs text-gray-400 font-mono mt-0.5">ISBN: {{ $book->isbn }}</div>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-700">{{ $book->penulis }}</td>
                                    <td class="px-6 py-4">
                                        <div>{{ $book->penerbit }}</div>
                                        <div class="text-xs text-gray-400">{{ $book->tahun_terbit }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-indigo-50 text-indigo-700 border border-indigo-100">
                                            {{ $book->kategori }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2.5 py-1 text-xs font-bold rounded-lg {{ $book->stok > 0 ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                            {{ $book->stok }} eks
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                        {{-- Tombol Detail: Terbuka untuk semua (Admin, Dosen, Mahasiswa) --}}
                                        <a href="{{ route('books.show', $book) }}" class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-md transition">
                                            Detail
                                        </a>

                                        {{-- Tombol Edit: Hanya untuk Admin & Dosen (@can 'edit buku') --}}
                                        @can('edit buku')
                                            <a href="{{ route('books.edit', $book) }}" class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-sky-600 bg-sky-50 hover:bg-sky-100 rounded-md transition">
                                                Edit
                                            </a>
                                        @endcan

                                        {{-- Tombol Hapus: Khusus Admin SAJA (@can 'hapus buku') --}}
                                        @can('hapus buku')
                                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku \'{{ $book->judul }}\'?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-md transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        Tidak ada data buku yang ditemukan sesuai kriteria pencarian.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links --}}
                @if($books->hasPages())
                    <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                        {{ $books->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

