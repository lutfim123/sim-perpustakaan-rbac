<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Profil Saya" description="Kelola informasi akun dan pengaturan keamanan kata sandi Anda." />
    </x-slot>

    <div class="space-y-6 max-w-4xl">
        <x-card>
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </x-card>

        <x-card>
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </x-card>

        <x-card>
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </x-card>
    </div>
</x-app-layout>
