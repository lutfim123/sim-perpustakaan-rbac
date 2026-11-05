<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SIM Perpustakaan') }} - Sistem Manajemen Perpustakaan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-950 text-slate-100 min-h-screen flex flex-col selection:bg-indigo-500 selection:text-white">

    <!-- Top Navigation Bar -->
    <header class="border-b border-slate-800/80 bg-slate-900/60 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-500/20 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <span class="font-bold text-lg tracking-tight text-white block">SIM Perpustakaan</span>
                    <span class="text-[11px] text-slate-400 font-medium tracking-wide uppercase">Katalog & Sirkulasi</span>
                </div>
            </div>

            <nav class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold shadow-md transition">
                        Buka Dashboard &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold shadow-md transition">
                        Daftar
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <main class="flex-grow flex items-center justify-center py-16 sm:py-24 px-4 relative overflow-hidden">
        <div class="max-w-5xl mx-auto text-center relative z-10 space-y-8">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900 border border-slate-800 text-xs font-medium text-indigo-300">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                <span>Sistem Informasi Manajemen Perpustakaan</span>
            </div>

            <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight leading-tight sm:leading-none">
                Katalog & Sirkulasi Buku <br>
                <span class="text-indigo-400">
                    Perpustakaan Terpadu
                </span>
            </h1>

            <p class="max-w-2xl mx-auto text-slate-400 text-base sm:text-lg leading-relaxed">
                Platform pengelolaan katalog perpustakaan dengan kontrol hak akses berbasis peran untuk <strong class="text-slate-200">Admin</strong>, <strong class="text-slate-200">Dosen</strong>, dan <strong class="text-slate-200">Mahasiswa</strong>.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-base transition">
                        Buka Dashboard &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-base transition flex items-center justify-center gap-2">
                        <span>Masuk ke Akun</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-3.5 rounded-lg bg-slate-900 hover:bg-slate-800 text-slate-200 font-semibold text-base border border-slate-800 transition">
                        Daftar Akun Baru
                    </a>
                @endauth
            </div>

            <!-- Role Access Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 pt-12 text-left">
                <!-- Admin Card -->
                <div class="p-6 rounded-xl bg-slate-900 border border-slate-800 transition">
                    <div class="w-10 h-10 rounded-lg bg-rose-500/10 text-rose-400 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div class="flex items-center justify-between mb-1">
                        <h2 class="font-bold text-white text-base">Administrator</h2>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-500/20 text-rose-300">Akses Penuh</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Mengelola data katalog buku secara menyeluruh serta mengatur wewenang dan peran akun pengguna dalam sistem.
                    </p>
                </div>

                <!-- Dosen Card -->
                <div class="p-6 rounded-xl bg-slate-900 border border-slate-800 transition">
                    <div class="w-10 h-10 rounded-lg bg-indigo-500/10 text-indigo-400 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div class="flex items-center justify-between mb-1">
                        <h2 class="font-bold text-white text-base">Dosen</h2>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-500/20 text-indigo-300">Manajemen Buku</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Dapat melihat seluruh koleksi, mendaftarkan judul buku baru, dan memperbarui informasi buku yang ada.
                    </p>
                </div>

                <!-- Mahasiswa Card -->
                <div class="p-6 rounded-xl bg-slate-900 border border-slate-800 transition">
                    <div class="w-10 h-10 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="flex items-center justify-between mb-1">
                        <h2 class="font-bold text-white text-base">Mahasiswa</h2>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-500/20 text-emerald-300">Katalog Pustaka</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Mencari dan melihat detail koleksi pustaka, memantau ketersediaan stok buku secara real-time.
                    </p>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-800/80 bg-slate-900/40 py-6 text-center text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-3">
            <span>&copy; {{ date('Y') }} SIM Perpustakaan &bull; Sistem Informasi Perpustakaan & Manajemen Buku</span>
            <span>Berbasis Role-Based Access Control</span>
        </div>
    </footer>

</body>
</html>
