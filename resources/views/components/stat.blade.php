@props(['label', 'value', 'description' => null])

<div {{ $attributes->merge(['class' => 'bg-white border border-slate-200 rounded-lg shadow-sm p-5']) }}>
    <p class="text-xs font-medium uppercase tracking-wider text-slate-500">{{ $label }}</p>
    <p class="text-2xl font-semibold text-slate-900 mt-2 tracking-tight">{{ $value }}</p>
    @if($description)
        <p class="text-xs text-slate-500 mt-1">{{ $description }}</p>
    @endif
</div>

