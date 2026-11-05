<x-app-layout>
    @php
        $role = auth()->user()->getRoleNames()->first() ?? 'Pengguna';
        $badgeVariant = match($role) {
            'Admin' => 'danger',
            'Dosen' => 'primary',
            'Mahasiswa' => 'success',
            default => 'neutral',
        };
        $stokHabis = $recentBooks->where('stok', '<=', 0)->count();
    @endphp

    {{-- Bagian a: Sapaan singkat satu baris --}}
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <h1 class="text-xl sm:text-2xl font-semibold text-slate-900 tracking-tight">
                Halo, {{ auth()->user()->name }}
            </h1>
            <x-badge :variant="$badgeVariant">
                {{ $role }}
            </x-badge>
        </div>
    </x-slot>

    <div class="space-y-6">

        {{-- Notifikasi Sesi --}}
        @if(session('success'))
            <x-alert type="success">{{ session('success') }}</x-alert>
        @endif

        @if(session('error'))
            <x-alert type="error">{{ session('error') }}</x-alert>
        @endif

        {{-- Bagian b: Tiga kartu statistik (+1 untuk Admin) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 @role('Admin') lg:grid-cols-4 @else lg:grid-cols-3 @endrole gap-4 sm:gap-5">
            <x-stat label="Judul Buku" :value="$totalBuku ?? 0" />
            <x-stat label="Total Stok" :value="($totalStok ?? 0) . ' eks'" />
            <x-stat label="Stok Habis" :value="$stokHabis" />
            @role('Admin')
                <x-stat label="Total Pengguna" :value="$totalUser ?? 0" />
            @endrole
        </div>

        {{-- Bagian c: Tabel Buku Terbaru --}}
        <div class="bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-200 flex items-center justify-between">
                <h2 class="text-sm sm:text-base font-semibold text-slate-900">Buku Terbaru</h2>
                <a href="{{ route('books.index') }}" class="text-xs sm:text-sm font-medium text-indigo-600 hover:text-indigo-700 transition">
                    Lihat semua &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-xs text-slate-500 uppercase tracking-wider border-b border-slate-200">
                        <tr>
                            <th scope="col" class="px-5 py-3 font-medium">Judul</th>
                            <th scope="col" class="px-5 py-3 font-medium">Penulis</th>
                            <th scope="col" class="px-5 py-3 font-medium">Kategori</th>
                            <th scope="col" class="px-5 py-3 font-medium text-right">Stok</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($recentBooks ?? [] as $book)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="px-5 py-3.5">
                                    <div class="font-medium text-slate-900">{{ $book->judul }}</div>
                                    <div class="text-xs text-slate-500 font-mono mt-0.5">ISBN: {{ $book->isbn }}</div>
                                </td>
                                <td class="px-5 py-3.5 text-slate-600 whitespace-nowrap">{{ $book->penulis }}</td>
                                <td class="px-5 py-3.5 whitespace-nowrap">
                                    <x-badge variant="neutral">{{ $book->kategori }}</x-badge>
                                </td>
                                <td class="px-5 py-3.5 text-right whitespace-nowrap">
                                    <x-badge :variant="$book->stok > 0 ? 'success' : 'danger'">
                                        {{ $book->stok }} eks
                                    </x-badge>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-8 text-center text-sm text-slate-500">
                                    Belum ada data buku yang tersimpan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Fitur Hak Akses Saya (Ringkas, tertutup secara default) --}}
        <x-card class="p-4 sm:p-5">
            <div x-data="{ open: false }">
                <button @click="open = !open" 
                        type="button" 
                        class="w-full flex items-center justify-between text-left text-sm font-medium text-slate-700 hover:text-slate-900 transition focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-md py-0.5"
                        aria-expanded="false"
                        :aria-expanded="open.toString()">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>Lihat hak akses saya</span>
                    </span>
                    <svg class="w-4 h-4 text-slate-400 transform transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="mt-4 pt-4 border-t border-slate-100 space-y-2.5" 
                     style="display: none;">
                    
                    <div class="flex items-center justify-between text-xs py-1 border-b border-slate-50">
                        <span class="text-slate-600">Melihat katalog dan detail buku</span>
                        @can('lihat buku')
                            <span class="inline-flex items-center gap-1 font-medium text-emerald-700">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Diizinkan
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 font-medium text-slate-400">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Ditolak
                            </span>
                        @endcan
                    </div>

                    <div class="flex items-center justify-between text-xs py-1 border-b border-slate-50">
                        <span class="text-slate-600">Menambahkan data buku baru</span>
                        @can('tambah buku')
                            <span class="inline-flex items-center gap-1 font-medium text-emerald-700">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Diizinkan
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 font-medium text-slate-400">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Ditolak
                            </span>
                        @endcan
                    </div>

                    <div class="flex items-center justify-between text-xs py-1 border-b border-slate-50">
                        <span class="text-slate-600">Mengubah informasi dan stok buku</span>
                        @can('edit buku')
                            <span class="inline-flex items-center gap-1 font-medium text-emerald-700">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Diizinkan
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 font-medium text-slate-400">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Ditolak
                            </span>
                        @endcan
                    </div>

                    <div class="flex items-center justify-between text-xs py-1 border-b border-slate-50">
                        <span class="text-slate-600">Menghapus data buku dari sistem</span>
                        @can('hapus buku')
                            <span class="inline-flex items-center gap-1 font-medium text-emerald-700">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Diizinkan
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 font-medium text-slate-400">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Ditolak
                            </span>
                        @endcan
                    </div>

                    <div class="flex items-center justify-between text-xs py-1">
                        <span class="text-slate-600">Mengatur peran dan akun pengguna</span>
                        @can('kelola role pengguna')
                            <span class="inline-flex items-center gap-1 font-medium text-emerald-700">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Diizinkan
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 font-medium text-slate-400">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Ditolak
                            </span>
                        @endcan
                    </div>

                </div>
            </div>
        </x-card>

    </div>
</x-app-layout>
