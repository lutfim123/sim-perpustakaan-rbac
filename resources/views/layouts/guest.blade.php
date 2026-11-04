<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIM Perpustakaan') }} - Autentikasi</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-slate-900 min-h-screen flex flex-col justify-center items-center p-4 selection:bg-indigo-500 selection:text-white">
        
        <div class="mb-4 text-center">
            <a href="/" class="inline-flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center shadow-lg shadow-indigo-500/20 text-white group-hover:scale-105 transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div class="text-left">
                    <span class="font-extrabold text-xl tracking-tight text-white block">SIM Perpustakaan</span>
                    <span class="text-xs text-indigo-400 font-medium tracking-wide">Role-Based Access Control</span>
                </div>
            </a>
        </div>

        <div class="w-full sm:max-w-md bg-white shadow-2xl rounded-2xl border border-slate-700/30 overflow-hidden p-6 sm:p-8">
            {{ $slot }}
        </div>

        <div class="mt-6 text-center text-xs text-slate-500">
            <a href="/" class="hover:text-indigo-400 transition">&larr; Kembali ke Halaman Utama</a>
        </div>
    </body>
</html>
