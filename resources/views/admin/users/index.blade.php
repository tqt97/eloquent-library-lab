<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
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
                                            <x-table.th field="id" column="ID" />
                                            <x-table.th column="Name" />
                                            <x-table.th column="Email" />
                                            <x-table.th column="Last login" />
                                            <x-table.th align="center" />
                                        </x-table.thead>
                                        <tbody>
                                            @forelse ($users as $user)
                                                <x-table.tr>
                                                    <x-table.td value="{{ $user->id  }}" />
                                                    <x-table.td value="{{ $user->name }}" />
                                                    <x-table.td value="{{ $user->email  }}" />
                                                    <x-table.td
                                                        value="{{ $user->logins()->latest()->first()?->created_at ?? '-'  }}" />
                                                    <x-table.td class="text-right">
                                                        <a href="" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                    </x-table.td>
                                                </x-table.tr>
                                            @empty
                                                <x-table.empty colspan="5" message="No users found" icon="search" />
                                            @endforelse
                                        </tbody>
                                    </x-table>

                                    <x-table.pagination :paginator="$users" />

                                </div>
                            </div>
                        </div>
                    </main>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
