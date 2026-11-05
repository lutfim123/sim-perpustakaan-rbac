<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIM Perpustakaan') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full font-sans antialiased text-slate-900 bg-slate-50">
        <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">
            
            {{-- Kolom Kiri: Branding & Tagline (Desktop) --}}
            <div class="hidden lg:flex flex-col justify-between bg-slate-900 text-white p-12">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-indigo-600 flex items-center justify-center text-white shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="font-semibold text-lg tracking-tight">SIM Perpustakaan</span>
                </div>

                <div class="max-w-md space-y-3">
                    <h2 class="text-2xl font-bold tracking-tight text-white">
                        Sistem Informasi Manajemen Perpustakaan
                    </h2>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Platform katalog dan sirkulasi buku perpustakaan akademik berbasis peran.
                    </p>
                </div>

                <div class="text-xs text-slate-500">
                    &copy; {{ date('Y') }} SIM Perpustakaan
                </div>
            </div>

            {{-- Kolom Kanan: Form Autentikasi --}}
            <div class="flex flex-col justify-center items-center p-6 sm:p-10 bg-slate-50">
                {{-- Header Mobile --}}
                <div class="lg:hidden mb-6 flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="font-semibold text-slate-900 text-base">SIM Perpustakaan</span>
                </div>

                <div class="w-full max-w-md bg-white border border-slate-200 rounded-lg shadow-sm p-6 sm:p-8">
                    {{ $slot }}
                </div>

                <div class="mt-6 text-center text-xs text-slate-500">
                    <a href="/" class="hover:text-indigo-600 font-medium transition">&larr; Kembali ke Beranda</a>
                </div>
            </div>

        </div>
    </body>
</html>
