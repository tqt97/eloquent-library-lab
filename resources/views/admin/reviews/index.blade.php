<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('reviews') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <main class="max-w-7xl mx-auto py-2">
                        <div class="flex justify-end">
                            <x-search-form action="{{ route('admin.reviews.index') }}"
                                placeholder="Search reviews..." />
                        </div>

                        <div class="mt-8 flex flex-col">
                            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg">
                                    <x-table>
                                        <x-table.thead>
                                            <x-table.th column="User" />
                                            <x-table.th column="Review for" />
                                            <x-table.th column="Rating" class="text-center" />
                                            <x-table.th column="Created At" />
                                            <x-table.th />
                                        </x-table.thead>
                                        <tbody>
                                            @forelse ($reviews as $review)
                                                <x-table.tr>
                                                    <x-table.td class="font-bold"
                                                        value="{{ $review->user->first_name ?? 'N/A'}}" />
                                                    <x-table.td>
                                                        @if ($review->reviewable)
                                                            {{ class_basename($review->reviewable_type) }}:
                                                            <strong>
                                                                {{ $review->reviewable->name ?? $review->reviewable->title ?? 'N/A' }}
                                                            </strong>
                                                        @else
                                                            <span class="text-gray-400">N/A</span>
                                                        @endif
                                                        <p class="text-xs">{{ Str::limit($review->content, 80) }}</p>
                                                    </x-table.td>
                                                    <x-table.td value="{{ $review->rating }}" class="text-center" />
                                                    <x-table.td value="{{ $review->created_at ?? 'N/A' }}" />
                                                    <x-table.td class="text-right">
                                                        <a href="" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                    </x-table.td>
                                                </x-table.tr>
                                            @empty
                                                <x-table.empty colspan="5" message="No reviews found" icon="user" />
                                            @endforelse
                                        </tbody>
                                    </x-table>

                                    <x-table.pagination :paginator="$reviews" />

                                </div>
                            </div>
                        </div>
                    </main>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
