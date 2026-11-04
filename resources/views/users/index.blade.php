<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Kelola Role & Hak Akses Pengguna') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Fitur khusus Administrator untuk mengatur peran pengguna (Admin, Dosen, Mahasiswa)
                </p>
            </div>
            <span class="inline-flex items-center px-3 py-1 bg-rose-100 text-rose-800 border border-rose-200 text-xs font-bold rounded-full">
                🔒 Khusus Hak Akses Admin
            </span>
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

            {{-- Info Box Keamanan --}}
            <div class="p-4 bg-indigo-50 border border-indigo-200 rounded-xl text-xs text-indigo-900 flex items-start gap-3">
                <svg class="w-5 h-5 text-indigo-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div>
                    <h4 class="font-bold text-sm mb-1">Proteksi Keamanan Berlapis (Defense-in-Depth)</h4>
                    <p class="leading-relaxed">
                        Halaman ini dilindungi oleh Route Middleware <code>permission:kelola role pengguna</code> dan verifikasi server-side di <code>UserRoleController</code>. Pengguna dengan peran <strong>Dosen</strong> atau <strong>Mahasiswa</strong> yang berusaha mengakses rute <code>/users</code> secara langsung akan otomatis diblokir dengan respons <strong>HTTP 403 Forbidden</strong>.
                    </p>
                </div>
            </div>

            {{-- Tabel Daftar Pengguna & Form Ubah Role --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider border-b">
                            <tr>
                                <th class="px-6 py-3.5 font-semibold">Nama Pengguna</th>
                                <th class="px-6 py-3.5 font-semibold">Alamat Email</th>
                                <th class="px-6 py-3.5 font-semibold">Terdaftar Sejak</th>
                                <th class="px-6 py-3.5 font-semibold">Peran Saat Ini</th>
                                <th class="px-6 py-3.5 font-semibold text-right">Ubah Peran (Role)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($users as $user)
                                @php
                                    $currentRole = $user->getRoleNames()->first() ?? 'Tanpa Role';
                                    $badgeStyle = match($currentRole) {
                                        'Admin' => 'bg-rose-100 text-rose-800 border-rose-200',
                                        'Dosen' => 'bg-sky-100 text-sky-800 border-sky-200',
                                        'Mahasiswa' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                        default => 'bg-gray-100 text-gray-600 border-gray-200',
                                    };
                                @endphp
                                <tr class="hover:bg-gray-50/70 transition">
                                    <td class="px-6 py-4 font-bold text-gray-900">
                                        {{ $user->name }}
                                        @if($user->id === auth()->id())
                                            <span class="ms-1 px-2 py-0.5 text-[10px] bg-indigo-100 text-indigo-700 font-semibold rounded">Anda</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 font-mono text-xs">{{ $user->email }}</td>
                                    <td class="px-6 py-4 text-gray-500 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full border {{ $badgeStyle }}">
                                            {{ $currentRole }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form method="POST" action="{{ route('users.update-role', $user) }}" class="inline-flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')

                                            <select name="role" class="text-xs border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 py-1.5 pl-2.5 pr-8">
                                                @foreach($roles as $r)
                                                    <option value="{{ $r->name }}" {{ $currentRole === $r->name ? 'selected' : '' }}>
                                                        {{ $r->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <button type="submit" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded-md shadow-sm transition">
                                                Terapkan
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($users->hasPages())
                    <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

