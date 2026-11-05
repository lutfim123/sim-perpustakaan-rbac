<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-semibold text-slate-900 tracking-tight">
                    Katalog Buku
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                    Daftar seluruh koleksi buku yang tersedia di perpustakaan
                </p>
            </div>
            
            @can('tambah buku')
                <div>
                    <x-button href="{{ route('books.create') }}" variant="primary" class="inline-flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Tambah Buku</span>
                    </x-button>
                </div>
            @endcan
        </div>
    </x-slot>

    <div x-data="{ deleteModalOpen: false, deleteActionUrl: '', deleteBookTitle: '' }" class="space-y-6">

        {{-- Flash Alerts --}}
        @if(session('success'))
            <x-alert type="success">{{ session('success') }}</x-alert>
        @endif

        @if(session('error'))
            <x-alert type="error">{{ session('error') }}</x-alert>
        @endif

        {{-- Pencarian & Filter Satu Baris Ringkas --}}
        <x-card class="p-3 sm:p-4">
            <form method="GET" action="{{ route('books.index') }}" class="flex flex-col sm:flex-row items-center gap-3">
                <div class="relative flex-1 w-full">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari judul, penulis, atau ISBN..." 
                           class="w-full pl-9 pr-3 py-2 text-sm bg-white border border-slate-300 rounded-lg text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="w-full sm:w-48 shrink-0">
                    <select name="kategori" 
                            class="w-full py-2 px-3 text-sm bg-white border border-slate-300 rounded-lg text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoriList ?? [] as $kat)
                            <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center gap-2 w-full sm:w-auto shrink-0">
                    <button type="submit" 
                            class="flex-1 sm:flex-initial px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Cari
                    </button>

                    @if(request('search') || request('kategori'))
                        <a href="{{ route('books.index') }}" 
                           class="px-3 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 rounded-lg transition" 
                           title="Reset filter pencarian">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </x-card>

        {{-- Tabel Daftar Buku --}}
        <div class="bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-xs text-slate-500 uppercase tracking-wider border-b border-slate-200">
                        <tr>
                            <th scope="col" class="px-5 py-3.5 font-medium">Judul Buku</th>
                            <th scope="col" class="px-5 py-3.5 font-medium">Penulis</th>
                            <th scope="col" class="px-5 py-3.5 font-medium">Penerbit & Tahun</th>
                            <th scope="col" class="px-5 py-3.5 font-medium">Kategori</th>
                            <th scope="col" class="px-5 py-3.5 font-medium text-center">Stok</th>
                            <th scope="col" class="px-5 py-3.5 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($books as $book)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="px-5 py-4">
                                    <div class="font-medium text-slate-900">{{ $book->judul }}</div>
                                    <div class="text-xs text-slate-500 font-mono mt-0.5">ISBN: {{ $book->isbn }}</div>
                                </td>
                                <td class="px-5 py-4 text-slate-700 whitespace-nowrap">{{ $book->penulis }}</td>
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <div class="text-slate-900">{{ $book->penerbit }}</div>
                                    <div class="text-xs text-slate-500">{{ $book->tahun_terbit }}</div>
                                </td>
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <x-badge variant="neutral">{{ $book->kategori }}</x-badge>
                                </td>
                                <td class="px-5 py-4 text-center whitespace-nowrap">
                                    <x-badge :variant="$book->stok > 0 ? 'success' : 'danger'">
                                        {{ $book->stok }} eks
                                    </x-badge>
                                </td>
                                <td class="px-5 py-4 text-right space-x-2 whitespace-nowrap">
                                    <a href="{{ route('books.show', $book) }}" 
                                       class="text-xs font-medium text-slate-600 hover:text-indigo-600 transition">
                                        Detail
                                    </a>

                                    @can('edit buku')
                                        <a href="{{ route('books.edit', $book) }}" 
                                           class="text-xs font-medium text-slate-600 hover:text-indigo-600 transition">
                                            Edit
                                        </a>
                                    @endcan

                                    @can('hapus buku')
                                        <button type="button" 
                                                @click="deleteModalOpen = true; deleteActionUrl = '{{ route('books.destroy', $book) }}'; deleteBookTitle = '{{ addslashes($book->judul) }}'" 
                                                class="text-xs font-medium text-rose-600 hover:text-rose-700 transition">
                                            Hapus
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center">
                                    <div class="max-w-sm mx-auto space-y-3">
                                        <div class="w-10 h-10 mx-auto rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                        </div>
                                        <p class="text-sm text-slate-500">
                                            @if(request('search') || request('kategori'))
                                                Tidak ada buku yang sesuai dengan filter pencarian Anda.
                                            @else
                                                Belum ada data buku yang terdaftar di sistem.
                                            @endif
                                        </p>
                                        @if(request('search') || request('kategori'))
                                            <a href="{{ route('books.index') }}" class="inline-block text-xs font-medium text-indigo-600 hover:text-indigo-700">
                                                Hapus Filter Pencarian
                                            </a>
                                        @elseif(auth()->user()->can('tambah buku'))
                                            <x-button href="{{ route('books.create') }}" variant="primary" class="text-xs">
                                                Tambah Buku Pertama
                                            </x-button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Navigasi Halaman --}}
            @if($books->hasPages())
                <div class="px-5 py-4 border-t border-slate-200 bg-slate-50/50">
                    {{ $books->links() }}
                </div>
            @endif
        </div>

        {{-- Modal Konfirmasi Hapus Buku (Alpine.js) --}}
        <div x-show="deleteModalOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs" 
             style="display: none;"
             @keydown.escape.window="deleteModalOpen = false">
            <div @click.away="deleteModalOpen = false" 
                 class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 space-y-4 border border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-rose-50 text-rose-600 rounded-lg shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900">Konfirmasi Hapus Buku</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                </div>

                <p class="text-sm text-slate-600">
                    Apakah Anda yakin ingin menghapus buku <strong class="text-slate-900" x-text="deleteBookTitle"></strong> dari katalog perpustakaan?
                </p>

                <div class="flex justify-end gap-2.5 pt-3 border-t border-slate-100">
                    <button type="button" 
                            @click="deleteModalOpen = false" 
                            class="px-4 py-2 text-xs font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition">
                        Batal
                    </button>

                    <form :action="deleteActionUrl" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-4 py-2 text-xs font-medium text-white bg-rose-600 hover:bg-rose-700 rounded-lg transition">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
