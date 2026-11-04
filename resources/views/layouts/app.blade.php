<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - SIM Manajemen Buku</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900 pb-16">
        
        {{-- Demo Role Switcher Bar (Fitur Kreatif untuk Pengujian & Presentasi Video) --}}
        @auth
            <div class="bg-slate-900 text-white text-xs px-4 py-2 border-b border-slate-800">
                <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                            DEMO MODE
                        </span>
                        <span class="text-slate-300">
                            Login sebagai: <strong>{{ auth()->user()->name }}</strong> 
                            (Role: <span class="text-amber-400 font-bold">{{ auth()->user()->getRoleNames()->first() ?? 'Tanpa Role' }}</span>)
                        </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-slate-400 text-[11px]">Beralih Akun Cepat:</span>
                        <form method="POST" action="{{ route('demo.switch-role') }}" class="inline">
                            @csrf
                            <input type="hidden" name="role" value="Admin">
                            <button type="submit" class="px-2.5 py-1 rounded text-[11px] font-semibold bg-rose-600 hover:bg-rose-700 text-white transition shadow-sm" title="Login sebagai Admin (admin@gmail.com)">
                                👑 Admin
                            </button>
                        </form>

                        <form method="POST" action="{{ route('demo.switch-role') }}" class="inline">
                            @csrf
                            <input type="hidden" name="role" value="Dosen">
                            <button type="submit" class="px-2.5 py-1 rounded text-[11px] font-semibold bg-sky-600 hover:bg-sky-700 text-white transition shadow-sm" title="Login sebagai Dosen (dosen@gmail.com)">
                                🎓 Dosen
                            </button>
                        </form>

                        <form method="POST" action="{{ route('demo.switch-role') }}" class="inline">
                            @csrf
                            <input type="hidden" name="role" value="Mahasiswa">
                            <button type="submit" class="px-2.5 py-1 rounded text-[11px] font-semibold bg-emerald-600 hover:bg-emerald-700 text-white transition shadow-sm" title="Login sebagai Mahasiswa (mahasiswa@gmail.com)">
                                🎒 Mahasiswa
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endauth

        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-sm border-b border-gray-100">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
