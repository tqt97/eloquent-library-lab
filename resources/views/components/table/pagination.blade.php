@props([
    'paginator',
    'align' => 'end',
])
@if ($paginator->total() > 0)
    <div class="mt-4 p-4">
        {{ $paginator->withQueryString()->links() }}
    </div>
@endif
