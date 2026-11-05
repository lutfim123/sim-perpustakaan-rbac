<div class="h-full flex flex-col justify-between">
    <div>
        {{-- Brand Header --}}
        <div class="h-16 flex items-center gap-3 px-6 border-b border-slate-200">
            <div class="w-9 h-9 rounded-lg bg-indigo-600 flex items-center justify-center text-white shrink-0 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <div class="min-w-0">
                <span class="block font-semibold text-slate-900 text-sm tracking-tight truncate">SIM Perpustakaan</span>
                <span class="block text-xs text-slate-400 truncate">Katalog & Sirkulasi</span>
            </div>
        </div>

        {{-- Navigasi Menu --}}
        <nav class="p-3 space-y-1">
            {{-- 1. Dashboard --}}
            <a href="{{ route('dashboard') }}" 
               class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-slate-100 text-slate-900 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }}">
                <svg class="w-5 h-5 shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Dashboard</span>
            </a>

            {{-- 2. Katalog Buku (Khusus yang memiliki hak 'lihat buku') --}}
            @can('lihat buku')
            <a href="{{ route('books.index') }}" 
               class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('books.*') ? 'bg-slate-100 text-slate-900 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }}">
                <svg class="w-5 h-5 shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span>Katalog Buku</span>
            </a>
            @endcan

            {{-- 3. Kelola Pengguna (Khusus yang memiliki hak 'kelola role pengguna' - Admin) --}}
            @can('kelola role pengguna')
            <a href="{{ route('users.index') }}" 
               class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('users.*') ? 'bg-slate-100 text-slate-900 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }}">
                <svg class="w-5 h-5 shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span>Kelola Pengguna</span>
            </a>
            @endcan

            {{-- 4. Profil Saya --}}
            <a href="{{ route('profile.edit') }}" 
               class="flex items-center gap-3 px-3 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('profile.*') ? 'bg-slate-100 text-slate-900 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium' }}">
                <svg class="w-5 h-5 shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span>Profil Saya</span>
            </a>
        </nav>
    </div>

    {{-- User Profile Card di Bawah Sidebar --}}
    <div class="p-4 border-t border-slate-200">
        <div class="flex items-center justify-between gap-2">
            <div class="min-w-0">
                <p class="text-xs font-semibold text-slate-900 truncate">{{ Auth::user()->name }}</p>
                <p class="text-[11px] text-slate-500 truncate">{{ Auth::user()->email }}</p>
            </div>
            @php
                $roleName = Auth::user()->getRoleNames()->first() ?? 'Pengguna';
                $badgeVariant = match($roleName) {
                    'Admin' => 'danger',
                    'Dosen' => 'primary',
                    'Mahasiswa' => 'success',
                    default => 'neutral',
                };
            @endphp
            <x-badge :variant="$badgeVariant" class="shrink-0">
                {{ $roleName }}
            </x-badge>
        </div>
    </div>
</div>
