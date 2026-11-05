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
        <div x-data="{ sidebarOpen: false }" class="min-h-screen flex">
            
            {{-- Mobile Backdrop --}}
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="sidebarOpen = false" 
                 class="fixed inset-0 z-40 bg-slate-900/40 backdrop-blur-xs lg:hidden"
                 style="display: none;"></div>

            {{-- Sidebar Kiri (Desktop tetap, Mobile drawer) --}}
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
                   class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 transition-transform duration-200 ease-in-out lg:static lg:translate-x-0 flex flex-col shrink-0">
                @include('layouts.navigation')
            </aside>

            {{-- Kolom Utama --}}
            <div class="flex-1 flex flex-col min-w-0">
                
                {{-- Topbar Tipis --}}
                <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-6 lg:px-8 shrink-0">
                    {{-- Hamburger Button Mobile --}}
                    <div class="flex items-center gap-3">
                        <button @click="sidebarOpen = true" type="button" aria-label="Buka navigasi menu"
                                class="lg:hidden p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Profil & Tombol Keluar --}}
                    <div class="flex items-center gap-3">
                        @php
                            $roleName = Auth::user()->getRoleNames()->first() ?? 'Pengguna';
                            $badgeVariant = match($roleName) {
                                'Admin' => 'danger',
                                'Dosen' => 'primary',
                                'Mahasiswa' => 'success',
                                default => 'neutral',
                            };
                        @endphp

                        <div class="flex items-center gap-2">
                            <span class="text-sm font-medium text-slate-800">{{ Auth::user()->name }}</span>
                            <x-badge :variant="$badgeVariant">
                                {{ $roleName }}
                            </x-badge>
                        </div>

                        <div class="h-4 w-px bg-slate-200 mx-1"></div>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-slate-600 hover:text-rose-600 hover:bg-rose-50 rounded-lg border border-slate-200 hover:border-rose-200 transition-colors focus:outline-none focus:ring-2 focus:ring-rose-500"
                                    aria-label="Keluar dari akun">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>
                </header>

                {{-- Area Konten --}}
                <main class="flex-1 p-4 sm:p-6 lg:p-8">
                    <div class="max-w-7xl mx-auto">
                        {{-- Render Slot Header jika ada (sebagai judul halaman di area konten) --}}
                        @isset($header)
                            <div class="mb-6">
                                {{ $header }}
                            </div>
                        @endisset

                        {{ $slot }}
                    </div>
                </main>

            </div>

        </div>
    </body>
</html>
