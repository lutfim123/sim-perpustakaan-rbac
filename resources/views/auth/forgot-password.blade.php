<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-slate-900 tracking-tight">Atur Ulang Kata Sandi</h1>
        <p class="text-sm text-slate-500 mt-1 leading-relaxed">
            Masukkan alamat email akun Anda. Kami akan mengirimkan tautan untuk mengatur ulang kata sandi.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full">
                {{ __('Kirim Tautan Atur Ulang') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 pt-4 border-t border-slate-100 text-center">
        <a href="{{ route('login') }}" class="text-xs text-slate-500 hover:text-indigo-600 transition">
            &larr; Kembali ke halaman masuk
        </a>
    </div>
</x-guest-layout>
