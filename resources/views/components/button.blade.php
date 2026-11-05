@props(['variant' => 'primary', 'type' => 'button', 'href' => null])

@php
$classes = match($variant) {
    'secondary' => 'bg-white hover:bg-slate-50 text-slate-700 border-slate-300 focus:ring-slate-400',
    'danger' => 'bg-rose-600 hover:bg-rose-700 text-white border-transparent focus:ring-rose-500',
    default => 'bg-indigo-600 hover:bg-indigo-700 text-white border-transparent focus:ring-indigo-500',
};
$baseClasses = "inline-flex items-center justify-center px-4 py-2 text-sm font-medium border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors disabled:opacity-50 disabled:cursor-not-allowed {$classes}";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
        {{ $slot }}
    </button>
@endif
