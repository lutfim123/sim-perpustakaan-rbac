@props(['title' => null, 'description' => null])

<div {{ $attributes->merge(['class' => 'flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6']) }}>
    <div>
        <h1 class="text-xl sm:text-2xl font-semibold text-slate-900 tracking-tight">
            {{ $title ?? $slot }}
        </h1>
        @if($description)
            <p class="text-sm text-slate-500 mt-1">
                {{ $description }}
            </p>
        @endif
    </div>

    @isset($actions)
        <div class="flex items-center gap-2">
            {{ $actions }}
        </div>
    @endisset
</div>

