<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SIM Perpustakaan') }} - Role-Based Access Control System</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-950 text-slate-100 min-h-screen flex flex-col selection:bg-indigo-500 selection:text-white">

    <!-- Top Navigation Bar -->
    <header class="border-b border-slate-800/80 bg-slate-900/60 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center shadow-lg shadow-indigo-500/20 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <span class="font-extrabold text-lg tracking-tight text-white block">SIM Perpustakaan</span>
                    <span class="text-[11px] text-slate-400 font-medium tracking-wide uppercase">RBAC Academic System</span>
                </div>
            </div>

            <nav class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold shadow-md shadow-indigo-600/30 transition">
                        Buka Dashboard &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white transition">
                        Log In
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white text-sm font-semibold shadow-lg shadow-indigo-600/25 transition">
                        Daftar Akun
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <main class="flex-grow flex items-center justify-center py-16 sm:py-24 px-4 relative overflow-hidden">
        {{-- Background Glow Blobs --}}
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[350px] bg-indigo-600/20 blur-[130px] rounded-full pointer-events-none"></div>
        <div class="absolute bottom-10 right-10 w-[300px] h-[300px] bg-violet-600/15 blur-[120px] rounded-full pointer-events-none"></div>

        <div class="max-w-5xl mx-auto text-center relative z-10 space-y-8">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900 border border-slate-700/80 text-xs font-medium text-indigo-300 shadow-inner">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                <span>Laravel 12 &bull; Breeze &bull; Spatie Permission 8.x &bull; MySQL</span>
            </div>

            <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight leading-tight sm:leading-none">
                Sistem Manajemen Buku <br>
                <span class="bg-gradient-to-r from-indigo-400 via-violet-400 to-sky-400 bg-clip-text text-transparent">
                    Role-Based Access Control
                </span>
            </h1>

            <p class="max-w-2xl mx-auto text-slate-400 text-base sm:text-lg leading-relaxed">
                Platform katalogisasi perpustakaan kampus terpadu dengan autentikasi aman, proteksi otorisasi server-side berlapis, dan pembatasan peran terstandar untuk <strong class="text-slate-200">Admin</strong>, <strong class="text-slate-200">Dosen</strong>, dan <strong class="text-slate-200">Mahasiswa</strong>.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-base shadow-xl shadow-indigo-600/30 transition">
                        Masuk ke Dashboard Saya &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-base shadow-xl shadow-indigo-600/30 transition flex items-center justify-center gap-2">
                        <span>Masuk ke Sistem</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-200 font-semibold text-base border border-slate-700/80 transition">
                        Daftar Mahasiswa Baru
                    </a>
                @endauth
            </div>

            <!-- Role Access Overview Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 pt-12 text-left">
                <!-- Admin Card -->
                <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800 backdrop-blur-sm hover:border-rose-500/50 transition group">
                    <div class="w-10 h-10 rounded-xl bg-rose-500/10 text-rose-400 flex items-center justify-center mb-4 group-hover:scale-110 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div class="flex items-center justify-between mb-1">
                        <h3 class="font-bold text-white text-base">Role: Administrator</h3>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-500/20 text-rose-300">5/5 Izin</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed mb-4">
                        Hak akses tertinggi: mengelola katalog buku (CRUD lengkap), serta mengubah dan menetapkan role seluruh pengguna.
                    </p>
                    <div class="text-[11px] font-mono text-slate-500 pt-3 border-t border-slate-800/80">
                        Demo: <span class="text-slate-300">admin@gmail.com</span>
                    </div>
                </div>

                <!-- Dosen Card -->
                <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800 backdrop-blur-sm hover:border-sky-500/50 transition group">
                    <div class="w-10 h-10 rounded-xl bg-sky-500/10 text-sky-400 flex items-center justify-center mb-4 group-hover:scale-110 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div class="flex items-center justify-between mb-1">
                        <h3 class="font-bold text-white text-base">Role: Dosen</h3>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-sky-500/20 text-sky-300">3/5 Izin</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed mb-4">
                        Dapat melihat katalog, menambah buku baru, dan memperbarui data buku. Operasi hapus buku diblokir (403).
                    </p>
                    <div class="text-[11px] font-mono text-slate-500 pt-3 border-t border-slate-800/80">
                        Demo: <span class="text-slate-300">dosen@gmail.com</span>
                    </div>
                </div>

                <!-- Mahasiswa Card -->
                <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800 backdrop-blur-sm hover:border-emerald-500/50 transition group">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center mb-4 group-hover:scale-110 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="flex items-center justify-between mb-1">
                        <h3 class="font-bold text-white text-base">Role: Mahasiswa</h3>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-500/20 text-emerald-300">1/5 Izin</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed mb-4">
                        Read-only: dapat mencari dan melihat detail buku. Penambahan, pengubahan, atau penghapusan diblokir (403).
                    </p>
                    <div class="text-[11px] font-mono text-slate-500 pt-3 border-t border-slate-800/80">
                        Demo: <span class="text-slate-300">mahasiswa@gmail.com</span>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-800/80 bg-slate-900/40 py-6 text-center text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-3">
            <span>&copy; {{ date('Y') }} Sistem Informasi Manajemen Perpustakaan &bull; Pemrograman Web Lanjut</span>
            <span class="font-mono text-slate-400">Password Demo Semua Akun: <code class="text-indigo-400 bg-slate-800 px-2 py-0.5 rounded">password</code></span>
        </div>
    </footer>

</body>
</html>
