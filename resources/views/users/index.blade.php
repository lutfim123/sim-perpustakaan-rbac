<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-semibold text-slate-900 tracking-tight">
                    {{ __('Kelola Role & Hak Akses Pengguna') }}
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                    Atur peran dan wewenang akses akun pengguna dalam sistem
                </p>
            </div>
            <x-badge variant="danger">
                Khusus Administrator
            </x-badge>
        </div>
    </x-slot>

    <div class="space-y-6">

        {{-- Flash Messages --}}
        @if(session('success'))
            <x-alert type="success">{{ session('success') }}</x-alert>
        @endif

        @if(session('error'))
            <x-alert type="error">{{ session('error') }}</x-alert>
        @endif

        {{-- Tabel Daftar Pengguna & Ubah Role --}}
        <div class="bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-xs text-slate-500 uppercase tracking-wider border-b border-slate-200">
                        <tr>
                            <th scope="col" class="px-5 py-3.5 font-medium">Nama Pengguna</th>
                            <th scope="col" class="px-5 py-3.5 font-medium">Email</th>
                            <th scope="col" class="px-5 py-3.5 font-medium">Terdaftar</th>
                            <th scope="col" class="px-5 py-3.5 font-medium">Peran Saat Ini</th>
                            <th scope="col" class="px-5 py-3.5 font-medium text-right">Ubah Peran</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($users as $user)
                            @php
                                $currentRole = $user->getRoleNames()->first() ?? 'Tanpa Role';
                                $badgeVariant = match($currentRole) {
                                    'Admin' => 'danger',
                                    'Dosen' => 'primary',
                                    'Mahasiswa' => 'success',
                                    default => 'neutral',
                                };
                            @endphp
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="px-5 py-4 font-medium text-slate-900 whitespace-nowrap">
                                    {{ $user->name }}
                                    @if($user->id === auth()->id())
                                        <span class="ms-1.5 px-2 py-0.5 text-[10px] bg-slate-100 text-slate-600 font-semibold rounded">
                                            Anda
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-slate-600 font-mono text-xs whitespace-nowrap">
                                    {{ $user->email }}
                                </td>
                                <td class="px-5 py-4 text-slate-500 text-xs whitespace-nowrap">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <x-badge :variant="$badgeVariant">
                                        {{ $currentRole }}
                                    </x-badge>
                                </td>
                                <td class="px-5 py-4 text-right whitespace-nowrap">
                                    <form method="POST" action="{{ route('users.update-role', $user) }}" class="inline-flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')

                                        <select name="role" 
                                                class="text-xs bg-white border border-slate-300 rounded-lg py-1.5 pl-2.5 pr-8 text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                            @foreach($roles as $r)
                                                <option value="{{ $r->name }}" {{ $currentRole === $r->name ? 'selected' : '' }}>
                                                    {{ $r->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <button type="submit" 
                                                class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded-lg shadow-sm transition focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                            Simpan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="px-5 py-4 border-t border-slate-200 bg-slate-50/50">
                    {{ $users->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
