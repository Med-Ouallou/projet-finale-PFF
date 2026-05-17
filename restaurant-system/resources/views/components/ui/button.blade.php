@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
])

@php
    $baseClasses = 'inline-flex justify-center items-center gap-x-2 font-semibold rounded-xl transition-all active:scale-95 disabled:opacity-50 disabled:pointer-events-none';
    
    $variants = [
        'primary' => 'bg-emerald-600 text-white hover:bg-emerald-700 shadow-lg shadow-emerald-200/60 hover:shadow-xl hover:shadow-emerald-300/50 hover:-translate-y-0.5',
        'secondary' => 'border border-gray-200 text-gray-700 bg-white hover:bg-gray-50 shadow-sm hover:border-gray-300',
        'dark' => 'bg-emerald-900 text-white hover:bg-emerald-950 shadow-xl shadow-emerald-900/20 hover:-translate-y-0.5',
        'outline' => 'border-2 border-emerald-600 text-emerald-600 hover:bg-emerald-50',
    ];

    $sizes = [
        'sm' => 'py-2 px-4 text-xs',
        'md' => 'py-3 px-6 text-sm',
        'lg' => 'py-3.5 px-7 text-sm',
        'xl' => 'py-4 px-8 text-base',
    ];

    $classes = "{$baseClasses} {$variants[$variant]} {$sizes[$size]}";
@endphp

<button {{ $attributes->merge(['type' => $type, 'class' => $classes]) }}>
    {{ $slot }}
</button>
