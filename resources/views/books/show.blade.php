<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl sm:text-2xl font-semibold text-slate-900 tracking-tight">
                    Detail Buku
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                    Informasi lengkap koleksi perpustakaan
                </p>
            </div>
            <x-button href="{{ route('books.index') }}" variant="secondary" class="inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali</span>
            </x-button>
        </div>
    </x-slot>

    <div x-data="{ deleteModalOpen: false }" class="space-y-6">

        {{-- Layout Detail Dua Kolom --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Kolom Kiri: Informasi Utama & Sinopsis --}}
            <div class="lg:col-span-2 space-y-6">
                <x-card class="p-6 sm:p-8 space-y-6">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <x-badge variant="neutral">{{ $book->kategori }}</x-badge>
                            <x-badge :variant="$book->stok > 0 ? 'success' : 'danger'">
                                {{ $book->stok > 0 ? $book->stok . ' Eksemplar Tersedia' : 'Stok Habis' }}
                            </x-badge>
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
                            {{ $book->judul }}
                        </h2>
                        <p class="text-sm text-slate-600 mt-1">
                            Karya <span class="font-medium text-slate-900">{{ $book->penulis }}</span>
                        </p>
                    </div>

                    <div class="pt-6 border-t border-slate-100">
                        <h3 class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">
                            Sinopsis & Deskripsi
                        </h3>
                        <div class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                            {{ $book->deskripsi ?: 'Tidak ada sinopsis atau catatan tambahan untuk buku ini.' }}
                        </div>
                    </div>
                </x-card>
            </div>

            {{-- Kolom Kanan: Metadata Buku --}}
            <div class="lg:col-span-1 space-y-6">
                <x-card class="p-6 space-y-4">
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-slate-500 pb-3 border-b border-slate-100">
                        Informasi Penerbitan
                    </h3>

                    <div class="space-y-3.5 text-xs">
                        <div class="flex justify-between items-start gap-2">
                            <span class="text-slate-500">Nomor ISBN</span>
                            <span class="font-mono text-slate-900 font-medium text-right">{{ $book->isbn }}</span>
                        </div>

                        <div class="flex justify-between items-start gap-2">
                            <span class="text-slate-500">Penerbit</span>
                            <span class="text-slate-900 font-medium text-right">{{ $book->penerbit }}</span>
                        </div>

                        <div class="flex justify-between items-start gap-2">
                            <span class="text-slate-500">Tahun Terbit</span>
                            <span class="text-slate-900 font-medium text-right">{{ $book->tahun_terbit }}</span>
                        </div>

                        <div class="flex justify-between items-start gap-2">
                            <span class="text-slate-500">Kategori</span>
                            <span class="text-slate-900 font-medium text-right">{{ $book->kategori }}</span>
                        </div>

                        <div class="flex justify-between items-start gap-2">
                            <span class="text-slate-500">Ketersediaan</span>
                            <span class="font-medium {{ $book->stok > 0 ? 'text-emerald-700' : 'text-rose-700' }} text-right">
                                {{ $book->stok }} eksemplar
                            </span>
                        </div>

                        <div class="pt-3 border-t border-slate-100 flex justify-between items-start gap-2">
                            <span class="text-slate-500">Dicatat Oleh</span>
                            <span class="text-slate-900 font-medium text-right">{{ $book->user?->name ?? 'Sistem' }}</span>
                        </div>

                        <div class="flex justify-between items-start gap-2">
                            <span class="text-slate-500">Tanggal Daftar</span>
                            <span class="text-slate-900 font-medium text-right">{{ $book->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </x-card>

                {{-- Tombol Aksi Tambahan --}}
                <div class="flex items-center justify-between gap-3">
                    <x-button href="{{ route('books.index') }}" variant="secondary" class="flex-1 text-center">
                        Daftar Buku
                    </x-button>

                    @can('edit buku')
                        <x-button href="{{ route('books.edit', $book) }}" variant="secondary" class="flex-1 text-center">
                            Edit
                        </x-button>
                    @endcan

                    @can('hapus buku')
                        <x-button type="button" @click="deleteModalOpen = true" variant="danger" class="flex-1 text-center">
                            Hapus
                        </x-button>
                    @endcan
                </div>
            </div>

        </div>

        {{-- Modal Konfirmasi Hapus Buku (Alpine.js) --}}
        @can('hapus buku')
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
                        Apakah Anda yakin ingin menghapus buku <strong class="text-slate-900">{{ $book->judul }}</strong> dari perpustakaan?
                    </p>

                    <div class="flex justify-end gap-2.5 pt-3 border-t border-slate-100">
                        <button type="button" 
                                @click="deleteModalOpen = false" 
                                class="px-4 py-2 text-xs font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition">
                            Batal
                        </button>

                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
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
        @endcan

    </div>
</x-app-layout>
