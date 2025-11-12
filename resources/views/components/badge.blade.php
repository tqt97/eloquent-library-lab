@props([
    'text' => null,
    'variant' => 'primary', // primary, success, warning, danger, neutral
    'size' => 'xs',         // xs, sm, md, lg
    'pill' => false,
    'outline' => false,
])

@php
    $sizes = [
        'xs' => 'text-xs px-2 py-0.5',
        'sm' => 'text-sm px-2.5 py-0.5',
        'md' => 'text-sm px-3 py-1',
        'lg' => 'text-base px-4 py-1.5',
    ];

    $radius = $pill ? 'rounded-full' : 'rounded-md';

    $variants = [
        'primary' => $outline
            ? 'border border-blue-500 text-blue-600 bg-transparent'
            : 'bg-blue-50 text-blue-800',
        'success' => $outline
            ? 'border border-green-500 text-green-600 bg-transparent'
            : 'bg-green-50 text-green-800',
        'warning' => $outline
            ? 'border border-amber-500 text-amber-600 bg-transparent'
            : 'bg-amber-50 text-amber-800',
        'danger' => $outline
            ? 'border border-red-500 text-red-600 bg-transparent'
            : 'bg-red-50 text-red-800',
        'neutral' => $outline
            ? 'border border-gray-300 text-gray-700 bg-transparent'
            : 'bg-gray-100 text-gray-800',
    ];

    $classes = implode(' ', [
        'inline-flex items-center font-medium select-none',
        $sizes[$size] ?? $sizes['md'],
        $radius,
        $variants[$variant] ?? $variants['primary'],
    ]);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $text ?? $slot }}
</span>
