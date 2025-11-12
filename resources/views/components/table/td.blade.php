@props(['value' => null, 'colspan' => null, 'class' => ''])

<td @if($colspan) colspan="{{ $colspan }}" @endif
    class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 {{ $class }}">
    {{ $value ?? $slot }}
</td>
