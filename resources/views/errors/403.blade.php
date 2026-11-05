<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akses Ditolak - SIM Perpustakaan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased bg-slate-50 text-slate-900 flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white border border-slate-200 rounded-lg shadow-sm p-8 text-center space-y-4">
        
        {{-- Ikon Sederhana --}}
        <div class="w-12 h-12 mx-auto rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>

        <div>
            <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">403 Forbidden</span>
            <h1 class="text-xl font-semibold text-slate-900 tracking-tight mt-1">
                Akses Ditolak
            </h1>
            <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                Anda tidak memiliki izin yang diperlukan untuk mengakses halaman ini atau menjalankan tindakan yang diminta.
            </p>
        </div>

        <div class="pt-2">
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center justify-center w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Kembali ke Dashboard
            </a>
        </div>

    </div>

</body>
</html>
