@props(['column' => null])

@php
    $class = 'px-6 py-3 border-b border-gray-200 text-gray-300 text-left text-xs leading-4 font-medium uppercase tracking-wider';
@endphp
<th {{ $attributes->merge(['class' => $class]) }}>
    {{ $column ?? $slot }}
</th>
