<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-gray-900">Registrasi Mahasiswa Baru</h2>
        <p class="text-xs text-gray-500 mt-1">Akun yang didaftarkan akan otomatis diberikan peran <span class="font-bold text-emerald-600">Mahasiswa</span></p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Contoh: Ahmad Fauzi" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@kampus.ac.id" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
            <a class="text-xs text-indigo-600 hover:text-indigo-800 font-medium" href="{{ route('login') }}">
                {{ __('Sudah terdaftar? Masuk') }}
            </a>

            <x-primary-button class="ms-4 bg-indigo-600 hover:bg-indigo-700">
                {{ __('Daftar Sekarang') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
