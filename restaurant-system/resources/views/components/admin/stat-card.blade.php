@props([
    'label' => '',
    'value' => '',
    'badge' => '',
    'badgeColor' => 'emerald',
    'icon' => '',
    'iconColor' => 'emerald',
])

@php
    $iconColors = [
        'emerald' => 'bg-emerald-50 text-emerald-600',
        'amber' => 'bg-amber-50 text-amber-600',
        'blue' => 'bg-blue-50 text-blue-600',
        'violet' => 'bg-violet-50 text-violet-600',
        'red' => 'bg-red-50 text-red-600',
        'slate' => 'bg-slate-100 text-slate-600',
    ];

    $badgeColors = [
        'emerald' => 'text-emerald-600 bg-emerald-50',
        'amber' => 'text-amber-600 bg-amber-50',
        'blue' => 'text-blue-600 bg-blue-50',
        'red' => 'text-red-600 bg-red-50',
    ];

    $iconClass = $iconColors[$iconColor] ?? $iconColors['emerald'];
    $badgeClass = $badgeColors[$badgeColor] ?? $badgeColors['emerald'];
@endphp

<div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow">
    <div class="flex items-center justify-between mb-3">
        @if($icon)
            <div class="w-10 h-10 {{ $iconClass }} rounded-xl flex items-center justify-center">
                {!! $icon !!}
            </div>
        @endif
        @if($badge)
            <span class="inline-flex items-center gap-1 text-xs font-semibold {{ $badgeClass }} px-2.5 py-1 rounded-full">
                {{ $badge }}
            </span>
        @endif
    </div>
    <p class="text-2xl font-bold font-heading text-gray-800">{{ $value }}</p>
    <p class="text-xs text-gray-400 mt-1 font-medium">{{ $label }}</p>
</div>
