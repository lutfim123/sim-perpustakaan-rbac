<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Dashboard Sistem Manajemen Buku') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Implementasi Autentikasi Laravel Breeze & Role-Based Access Control (RBAC) Spatie
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow transition">
                    <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Buka Katalog Buku
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Flash Messages --}}
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

            @php
                $role = auth()->user()->getRoleNames()->first() ?? 'Tanpa Role';
                $roleColor = match($role) {
                    'Admin' => 'text-rose-600 bg-rose-50 border-rose-200',
                    'Dosen' => 'text-sky-600 bg-sky-50 border-sky-200',
                    'Mahasiswa' => 'text-emerald-600 bg-emerald-50 border-emerald-200',
                    default => 'text-gray-600 bg-gray-50 border-gray-200',
                };
            @endphp

            {{-- Welcome Banner --}}
            <div class="bg-gradient-to-r from-indigo-700 via-indigo-800 to-slate-900 rounded-2xl shadow-lg p-6 sm:p-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-xs font-semibold uppercase tracking-wider mb-3">
                            Status Autentikasi: Terverifikasi
                        </span>
                        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                            Selamat Datang, {{ auth()->user()->name }}!
                        </h1>
                        <p class="text-indigo-200 text-sm mt-2 max-w-2xl">
                            Anda masuk dengan email <strong>{{ auth()->user()->email }}</strong> dan memiliki peran 
                            <span class="font-bold underline decoration-indigo-400 underline-offset-2">{{ $role }}</span>. 
                            Sistem secara otomatis menyesuaikan hak akses dan fungsi menu sesuai matriks keamanan RBAC.
                        </p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-xl p-4 border border-white/20 min-w-[200px] text-center">
                        <span class="text-xs uppercase font-medium text-indigo-200">Peran Sistem Anda</span>
                        <div class="text-2xl font-black mt-1 text-white tracking-wide">
                            {{ $role }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Metric Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center gap-4">
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul Buku</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalBuku ?? 0 }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center gap-4">
                    <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Stok</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalStok ?? 0 }} Eks</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center gap-4">
                    <div class="p-3 bg-sky-50 text-sky-600 rounded-xl">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total User</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalUser ?? 0 }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center gap-4">
                    <div class="p-3 bg-rose-50 text-rose-600 rounded-xl">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Hak Akses Anda</p>
                        <p class="text-lg font-bold text-gray-800">
                            {{ auth()->user()->getAllPermissions()->count() }} / 5 Izin
                        </p>
                    </div>
                </div>
            </div>

            {{-- RBAC Matrix & Permission Status Showcase --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-4 pb-3 border-b">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <span>🛡️ Matriks Hak Akses Pengguna Aktif (Spatie Permission Engine)</span>
                        </h3>
                        <p class="text-sm text-gray-500">
                            Pemeriksaan status izin pada sesi login Anda saat ini berdasarkan tabel ketentuan tugas.
                        </p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $roleColor }}">
                        Role: {{ $role }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
                    {{-- 1. Lihat Buku --}}
                    <div class="p-4 rounded-xl border {{ auth()->user()->can('lihat buku') ? 'bg-emerald-50/60 border-emerald-200' : 'bg-gray-50 border-gray-200' }}">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold text-gray-700">Lihat Buku</span>
                            @can('lihat buku')
                                <span class="px-2 py-0.5 text-[10px] font-bold bg-emerald-600 text-white rounded-full">DIIZINKAN</span>
                            @else
                                <span class="px-2 py-0.5 text-[10px] font-bold bg-rose-600 text-white rounded-full">DITOLAK</span>
                            @endcan
                        </div>
                        <p class="text-xs text-gray-600">Akses katalog dan detail buku.</p>
                        <p class="text-[11px] text-gray-400 mt-2">Ketentuan: Admin, Dosen, Mahasiswa</p>
                    </div>

                    {{-- 2. Tambah Buku --}}
                    <div class="p-4 rounded-xl border {{ auth()->user()->can('tambah buku') ? 'bg-emerald-50/60 border-emerald-200' : 'bg-gray-50 border-gray-200' }}">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold text-gray-700">Tambah Buku</span>
                            @can('tambah buku')
                                <span class="px-2 py-0.5 text-[10px] font-bold bg-emerald-600 text-white rounded-full">DIIZINKAN</span>
                            @else
                                <span class="px-2 py-0.5 text-[10px] font-bold bg-rose-600 text-white rounded-full">DITOLAK</span>
                            @endcan
                        </div>
                        <p class="text-xs text-gray-600">Menambah buku baru ke perpustakaan.</p>
                        <p class="text-[11px] text-gray-400 mt-2">Ketentuan: Admin, Dosen</p>
                    </div>

                    {{-- 3. Edit Buku --}}
                    <div class="p-4 rounded-xl border {{ auth()->user()->can('edit buku') ? 'bg-emerald-50/60 border-emerald-200' : 'bg-gray-50 border-gray-200' }}">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold text-gray-700">Edit Buku</span>
                            @can('edit buku')
                                <span class="px-2 py-0.5 text-[10px] font-bold bg-emerald-600 text-white rounded-full">DIIZINKAN</span>
                            @else
                                <span class="px-2 py-0.5 text-[10px] font-bold bg-rose-600 text-white rounded-full">DITOLAK</span>
                            @endcan
                        </div>
                        <p class="text-xs text-gray-600">Mengubah informasi dan stok buku.</p>
                        <p class="text-[11px] text-gray-400 mt-2">Ketentuan: Admin, Dosen</p>
                    </div>

                    {{-- 4. Hapus Buku --}}
                    <div class="p-4 rounded-xl border {{ auth()->user()->can('hapus buku') ? 'bg-emerald-50/60 border-emerald-200' : 'bg-gray-50 border-gray-200' }}">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold text-gray-700">Hapus Buku</span>
                            @can('hapus buku')
                                <span class="px-2 py-0.5 text-[10px] font-bold bg-emerald-600 text-white rounded-full">DIIZINKAN</span>
                            @else
                                <span class="px-2 py-0.5 text-[10px] font-bold bg-rose-600 text-white rounded-full">DITOLAK</span>
                            @endcan
                        </div>
                        <p class="text-xs text-gray-600">Menghapus data buku dari database.</p>
                        <p class="text-[11px] text-gray-400 mt-2">Ketentuan: Admin SAJA</p>
                    </div>

                    {{-- 5. Kelola Role --}}
                    <div class="p-4 rounded-xl border {{ auth()->user()->can('kelola role pengguna') ? 'bg-emerald-50/60 border-emerald-200' : 'bg-gray-50 border-gray-200' }}">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold text-gray-700">Kelola Role</span>
                            @can('kelola role pengguna')
                                <span class="px-2 py-0.5 text-[10px] font-bold bg-emerald-600 text-white rounded-full">DIIZINKAN</span>
                            @else
                                <span class="px-2 py-0.5 text-[10px] font-bold bg-rose-600 text-white rounded-full">DITOLAK</span>
                            @endcan
                        </div>
                        <p class="text-xs text-gray-600">Mengubah hak akses & role user.</p>
                        <p class="text-[11px] text-gray-400 mt-2">Ketentuan: Admin SAJA</p>
                    </div>
                </div>

                {{-- Security Alert --}}
                <div class="mt-4 p-3 bg-amber-50 rounded-lg border border-amber-200 text-xs text-amber-800 flex items-start gap-2">
                    <svg class="w-4 h-4 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span>
                        <strong>Catatan Keamanan:</strong> Tombol aksi yang tidak diizinkan disembunyikan pada antarmuka Blade via directive <code>@@can</code>. Namun bila pengguna mencoba mengetikkan URL langsung di browser (contoh: <code>/books/create</code> oleh Mahasiswa atau permintaan <code>DELETE</code> oleh Dosen), server secara ketat menolak dengan <strong>HTTP 403 Forbidden</strong> melalui Controller Policy.
                    </span>
                </div>
            </div>

            {{-- Recent Books Table & Quick Actions --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Koleksi Buku Terbaru</h3>
                        <p class="text-xs text-gray-500">Daftar buku yang baru saja ditambahkan ke sistem perpustakaan.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        @can('tambah buku')
                            <a href="{{ route('books.create') }}" class="inline-flex items-center px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-lg shadow-sm transition">
                                <svg class="w-3.5 h-3.5 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Tambah Buku Baru
                            </a>
                        @endcan
                        <a href="{{ route('books.index') }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-gray-700 hover:bg-gray-50 text-xs font-semibold rounded-lg transition">
                            Lihat Semua Buku &rarr;
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider border-b">
                            <tr>
                                <th class="px-6 py-3 font-semibold">Judul Buku</th>
                                <th class="px-6 py-3 font-semibold">Penulis</th>
                                <th class="px-6 py-3 font-semibold">Kategori</th>
                                <th class="px-6 py-3 font-semibold">Tahun</th>
                                <th class="px-6 py-3 font-semibold">Stok</th>
                                <th class="px-6 py-3 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($recentBooks ?? [] as $book)
                                <tr class="hover:bg-gray-50/80 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $book->judul }}
                                        <div class="text-xs text-gray-400 font-mono">ISBN: {{ $book->isbn }}</div>
                                    </td>
                                    <td class="px-6 py-4">{{ $book->penulis }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-indigo-50 text-indigo-700">
                                            {{ $book->kategori }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $book->tahun_terbit }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-0.5 text-xs font-bold rounded {{ $book->stok > 0 ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                            {{ $book->stok }} eks
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                        <a href="{{ route('books.show', $book) }}" class="text-xs text-indigo-600 hover:text-indigo-900 font-medium">Detail</a>
                                        
                                        @can('edit buku')
                                            <a href="{{ route('books.edit', $book) }}" class="text-xs text-sky-600 hover:text-sky-900 font-medium">Edit</a>
                                        @endcan

                                        @can('hapus buku')
                                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs text-rose-600 hover:text-rose-900 font-medium">Hapus</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                        Belum ada data buku yang tersimpan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Demo Testing Helper Cards (Sangat berguna untuk demonstrasi video tugas) --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="text-sm font-bold text-gray-800 uppercase tracking-wider flex items-center gap-2">
                        <span>🧪 Akun Uji Coba Demonstrasi Tugas (Password: <code>password</code>)</span>
                    </h4>
                    <span class="text-xs text-gray-400">Gunakan akun ini untuk pengujian role</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
                    <div class="p-4 rounded-xl border border-rose-200 bg-rose-50/50">
                        <div class="flex items-center justify-between font-bold text-rose-900 mb-1">
                            <span>1. Akun Admin</span>
                            <span class="px-2 py-0.5 rounded bg-rose-200 text-rose-800 text-[10px]">Lengkap (5/5)</span>
                        </div>
                        <p class="font-mono text-gray-700">admin@gmail.com</p>
                        <p class="text-gray-500 mt-2">Dapat: Lihat, Tambah, Edit, Hapus Buku, serta Kelola Role User.</p>
                    </div>

                    <div class="p-4 rounded-xl border border-sky-200 bg-sky-50/50">
                        <div class="flex items-center justify-between font-bold text-sky-900 mb-1">
                            <span>2. Akun Dosen</span>
                            <span class="px-2 py-0.5 rounded bg-sky-200 text-sky-800 text-[10px]">Sebagian (3/5)</span>
                        </div>
                        <p class="font-mono text-gray-700">dosen@gmail.com</p>
                        <p class="text-gray-500 mt-2">Dapat: Lihat, Tambah, Edit Buku. Dilarang: Hapus & Kelola Role (403).</p>
                    </div>

                    <div class="p-4 rounded-xl border border-emerald-200 bg-emerald-50/50">
                        <div class="flex items-center justify-between font-bold text-emerald-900 mb-1">
                            <span>3. Akun Mahasiswa</span>
                            <span class="px-2 py-0.5 rounded bg-emerald-200 text-emerald-800 text-[10px]">Read-Only (1/5)</span>
                        </div>
                        <p class="font-mono text-gray-700">mahasiswa@gmail.com</p>
                        <p class="text-gray-500 mt-2">Hanya dapat Lihat Buku. Tambah, Edit, Hapus ditolak (403).</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
