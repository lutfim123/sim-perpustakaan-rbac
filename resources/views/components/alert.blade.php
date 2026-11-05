@props(['type' => 'success', 'timeout' => 5000])

@php
$classes = match($type) {
    'error', 'danger' => 'bg-rose-50 border-rose-200 text-rose-800',
    'warning' => 'bg-amber-50 border-amber-200 text-amber-800',
    default => 'bg-emerald-50 border-emerald-200 text-emerald-800',
};
@endphp

<div x-data="{ show: true }" 
     x-init="if ({{ $timeout }} > 0) setTimeout(() => show = false, {{ $timeout }})" 
     x-show="show" 
     x-transition:leave="transition ease-in duration-200" 
     x-transition:leave-start="opacity-100 scale-100" 
     x-transition:leave-end="opacity-0 scale-95" 
     {{ $attributes->merge(['class' => "p-4 border rounded-lg text-sm flex items-center justify-between shadow-xs {$classes}"]) }}
     role="alert">
    <div class="flex items-center gap-2.5">
        @if($type === 'error' || $type === 'danger')
            <svg class="w-4 h-4 shrink-0 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        @else
            <svg class="w-4 h-4 shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        @endif
        <span>{{ $slot }}</span>
    </div>
    <button @click="show = false" type="button" class="text-slate-400 hover:text-slate-600 p-1 rounded-md transition" aria-label="Tutup notifikasi">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
</div>

