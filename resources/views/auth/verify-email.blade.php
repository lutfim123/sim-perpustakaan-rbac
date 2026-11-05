<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-slate-900 tracking-tight">Verifikasi Email</h1>
        <p class="text-sm text-slate-500 mt-1 leading-relaxed">
            Terima kasih telah mendaftar. Sebelum memulai, mohon verifikasi alamat email Anda melalui tautan yang baru saja kami kirimkan.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-xs font-medium text-emerald-800 rounded-lg">
            {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda daftarkan.') }}
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full">
                {{ __('Kirim Ulang Email Verifikasi') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-xs text-slate-500 hover:text-slate-800 transition">
                {{ __('Keluar dari akun') }}
            </button>
        </form>
    </div>
</x-guest-layout>
