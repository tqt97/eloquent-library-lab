@props(['size' => 5])
@php
    $class = 'w-' . $size . ' h-' . $size .' text-gray-500';
@endphp
<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
    viewBox="0 0 24 24" {{ $attributes->merge(['class' => $class]) }}>
    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
</svg>
