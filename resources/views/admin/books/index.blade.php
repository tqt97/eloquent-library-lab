<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <main class="max-w-7xl mx-auto py-2">
                        <div class="flex justify-end">
                            <x-search-form action="{{ route('admin.books.index') }}" placeholder="Search books..." />
                        </div>


                        <div class="mt-8 flex flex-col">
                            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                                <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg">
                                    <x-table>
                                        <x-table.thead>
                                            <x-table.th column="Isbn" />
                                            <x-table.th field="title" column="Information" />
                                            <x-table.th column="Status" class="text-center" />
                                            <x-table.th column="Library" />
                                            <x-table.th />
                                        </x-table.thead>
                                        <tbody>
                                            @forelse ($books as $book)
                                                <x-table.tr>
                                                    <x-table.td value="{{ $book->isbn  }}" />
                                                    <x-table.td>
                                                        <p class="font-bold text-gray-950">{{ $book->title }}</p>
                                                        <p class="text-xs text-gray-800">Author:
                                                            <strong>{{ $book->authors->pluck('name')->implode(', ') }}</strong>
                                                        </p>
                                                        <p class="text-xs text-gray-800">Categories:
                                                            <strong>{{ $book->categories->pluck('name')->implode(', ') }}</strong>
                                                        </p>
                                                        <p class="text-xs text-gray-800">Published in
                                                            <strong>{{ $book->published_year }}</strong> by
                                                            <strong>{{ $book->publisher->name }}</strong>
                                                        </p>
                                                    </x-table.td>
                                                    <x-table.td>
                                                        <div class="text-center">
                                                            <p>{{ $book->stock }}</p>
                                                            <x-badge :text="$book->status"
                                                                :variant="$book->status === 'available' ? 'success' : 'danger'" />
                                                        </div>
                                                    </x-table.td>
                                                    <x-table.td value="{{ $book->library->name  }}" />
                                                    <x-table.td class="text-right">
                                                        <a href="" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                    </x-table.td>
                                                </x-table.tr>
                                            @empty
                                                <x-table.empty colspan="5" message="No books found" icon="book" />
                                            @endforelse
                                        </tbody>
                                    </x-table>

                                    <x-table.pagination :paginator="$books" />

                                </div>
                            </div>
                        </div>
                    </main>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
