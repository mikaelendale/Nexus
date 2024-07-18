<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Attendance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="pb-5 sm:flex sm:items-center sm:justify-between">
                        <h3 class="text-lg leading-6 font-medium text-gray-100">Volunteer List</h3>
                        <div class="mt-3 sm:mt-0 sm:ml-4">
                            <label for="mobile-search-candidate" class="sr-only">Search</label>
                            <label for="desktop-search-candidate" class="sr-only">Search</label>
                            <form action="{{ route('dashboard') }}" method="GET">
                                <div class="flex rounded-md shadow-sm">
                                    <div class="relative flex-grow focus-within:z-10">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="#000" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" name="search" id="search"
                                            value="{{ request('search') }}"
                                            class="bg-dark focus:ring-indigo-500 bg-gray focus:border-indigo-500 block w-full rounded-none rounded-l-md pl-10 sm:hidden"
                                            placeholder="Search">
                                        <input type="text" name="search" id="search"
                                            value="{{ request('search') }}"
                                            class="bg-dark-50 hidden bg-gray focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-l-md pl-10 sm:block sm:text-sm"
                                            placeholder="Search Volunteers">
                                    </div>
                                    <button type="submit"
                                        class="-ml-px relative inline-flex items-center px-4 py-2 border text-sm font-medium rounded-r-md text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                        <span class="ml-2">Enter</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                                    Name</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                                    Volunteer Id</th>
                                                <th scope="col" class="relative px-6 py-3"><span
                                                        class="sr-only">Edit</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($volunteers as $volunteer)
                                                <tr class="bg-dark">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                                        {{ $volunteer->name }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                                        {{ $volunteer->volunteer_id }}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a href="{{ route('dashboard.show', $volunteer->id) }}"
                                                            class="text-indigo-600 hover:text-indigo-900">Check</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @if ($volunteers->isEmpty())
                                                <tr>
                                                    <td colspan="3"
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                        No volunteers found.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        {{ $volunteers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
