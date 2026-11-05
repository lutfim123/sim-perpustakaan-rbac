<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-slate-900 tracking-tight">Konfirmasi Kata Sandi</h1>
        <p class="text-sm text-slate-500 mt-1 leading-relaxed">
            Ini adalah area keamanan aplikasi. Mohon konfirmasikan kata sandi Anda sebelum melanjutkan.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Kata Sandi')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full">
                {{ __('Konfirmasi') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
