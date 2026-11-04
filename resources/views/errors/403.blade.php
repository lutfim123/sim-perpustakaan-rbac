<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 - Akses Ditolak | SIM Perpustakaan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-xl w-full bg-slate-800/90 border border-slate-700/80 rounded-2xl shadow-2xl p-6 sm:p-8 text-center backdrop-blur-md">
        
        {{-- Icon Shield Alert --}}
        <div class="w-20 h-20 mx-auto mb-5 rounded-full bg-rose-500/10 border-2 border-rose-500/30 flex items-center justify-center text-rose-500 animate-pulse">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>

        {{-- Status Code & Title --}}
        <span class="inline-block px-3 py-1 bg-rose-500/20 text-rose-400 border border-rose-500/30 rounded-full text-xs font-bold tracking-widest uppercase mb-3">
            HTTP 403 Forbidden
        </span>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
            Akses Ditolak oleh Sistem Keamanan
        </h1>
        
        <p class="text-slate-300 text-sm mt-3 leading-relaxed">
            {{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses (permission) yang sah untuk membuka rute atau menjalankan operasi ini.' }}
        </p>

        {{-- Current User Role Diagnostic Card --}}
        @auth
            <div class="mt-6 p-4 rounded-xl bg-slate-900/70 border border-slate-700/60 text-left text-xs space-y-2">
                <div class="flex justify-between items-center pb-2 border-b border-slate-800">
                    <span class="text-slate-400">Pengguna Aktif:</span>
                    <span class="font-semibold text-white">{{ auth()->user()->name }} ({{ auth()->user()->email }})</span>
                </div>
                <div class="flex justify-between items-center pb-2 border-b border-slate-800">
                    <span class="text-slate-400">Peran Sistem (Role):</span>
                    @php
                        $userRole = auth()->user()->getRoleNames()->first() ?? 'Tanpa Role';
                    @endphp
                    <span class="px-2.5 py-0.5 rounded-full font-bold {{ $userRole === 'Admin' ? 'bg-rose-500/20 text-rose-300' : ($userRole === 'Dosen' ? 'bg-sky-500/20 text-sky-300' : 'bg-emerald-500/20 text-emerald-300') }}">
                        {{ $userRole }}
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-400">Penyebab 403:</span>
                    <span class="text-amber-400 font-medium">Otorisasi Server-Side (Policy / Middleware)</span>
                </div>
            </div>
        @endauth

        {{-- Explanatory Note for Assignment --}}
        <div class="mt-4 p-3 bg-indigo-950/40 rounded-lg border border-indigo-900/50 text-indigo-300 text-xs text-left">
            💡 <strong>Prinsip Keamanan Web Lanjut:</strong> Menyembunyikan tombol aksi pada UI saja tidak cukup. Server tetap memverifikasi otorisasi setiap HTTP Request. Permintaan akses ilegal melalui manipulasi URL langsung atau form submission otomatis diblokir di sisi server.
        </div>

        {{-- Action Buttons --}}
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-md transition">
                Kembali ke Dashboard
            </a>
            <a href="{{ route('books.index') }}" class="w-full sm:w-auto px-5 py-2.5 bg-slate-700 hover:bg-slate-600 text-slate-200 text-sm font-semibold rounded-lg border border-slate-600 transition">
                Buka Katalog Buku
            </a>
        </div>

    </div>

</body>
</html>

