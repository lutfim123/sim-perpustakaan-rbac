<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-slate-900 tracking-tight">Pendaftaran Akun</h1>
        <p class="text-sm text-slate-500 mt-1">Lengkapi data berikut untuk membuat akun baru.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Kata Sandi')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 pt-4 border-t border-slate-100 text-center">
        <p class="text-xs text-slate-500">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                Masuk di sini
            </a>
        </p>
    </div>
</x-guest-layout>
