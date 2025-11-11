@props(['value' => null])
@php
    $class = 'px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium text-gray-900';
@endphp

<td {{ $attributes->merge(['class' => $class]) }}>
    {{  $value ?? $slot }}
</td>
