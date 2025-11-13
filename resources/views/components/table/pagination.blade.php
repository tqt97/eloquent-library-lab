@props([
    'paginator',
    'align' => 'end',
])
@if ($paginator->hasPages() > 0)
    <div class="mt-4 p-4">
        {{ $paginator->withQueryString()->links() }}
    </div>
@endif
