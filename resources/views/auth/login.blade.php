<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-gray-900">Masuk ke SIM Perpustakaan</h2>
        <p class="text-xs text-gray-500 mt-1">Gunakan akun Anda atau pilih akun uji coba di bawah ini</p>
    </div>

    <!-- Quick Fill Demo Accounts (Fitur Portofolio Interaktif) -->
    <div class="mb-5 p-3 rounded-xl bg-slate-50 border border-slate-200">
        <span class="text-[11px] font-bold uppercase text-slate-500 tracking-wider block mb-2">⚡ Isi Cepat Akun Demo:</span>
        <div class="grid grid-cols-3 gap-2">
            <button type="button" 
                    onclick="fillCredentials('admin@gmail.com', 'password')" 
                    class="py-1.5 px-2 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 rounded-lg text-xs font-semibold transition text-center">
                👑 Admin
            </button>
            <button type="button" 
                    onclick="fillCredentials('dosen@gmail.com', 'password')" 
                    class="py-1.5 px-2 bg-sky-50 hover:bg-sky-100 text-sky-700 border border-sky-200 rounded-lg text-xs font-semibold transition text-center">
                🎓 Dosen
            </button>
            <button type="button" 
                    onclick="fillCredentials('mahasiswa@gmail.com', 'password')" 
                    class="py-1.5 px-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 rounded-lg text-xs font-semibold transition text-center">
                🎒 Mahasiswa
            </button>
        </div>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
            @if (Route::has('register'))
                <a class="text-xs text-indigo-600 hover:text-indigo-800 font-medium" href="{{ route('register') }}">
                    {{ __('Belum punya akun? Daftar') }}
                </a>
            @endif

            <x-primary-button class="ms-3 bg-indigo-600 hover:bg-indigo-700">
                {{ __('Masuk Sekarang') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function fillCredentials(email, password) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
        }
    </script>
</x-guest-layout>
