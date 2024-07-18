<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Details') }}
        </h2>
    </x-slot>

    {{-- Top Volunteers Section --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 mb-4">Top Volunteers</h3>

                    {{-- Medal Icon --}}
                    <div class="flex justify-center mb-6">
                        <img src="https://th.bing.com/th/id/R.ca7100aa2e2cbc9ae54cd1a9502f1559?rik=e2W9PAMY88mO%2fg&pid=ImgRaw"
                            alt="Medal Icon" class="w-12 h-12">
                    </div>

                    {{-- Volunteer Detail Cards --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($volunteers as $volunteer)
                            <a href="{{ route('dashboard.show', $volunteer->id) }}"
                                class="block bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-300 transform hover:scale-105">
                                <div class="flex flex-col items-center text-center">
                                    <p class="font-semibold text-lg"><strong>Id:</strong> {{ $volunteer->volunteer_id }}
                                    </p>
                                    <p class="text-gray-700 dark:text-gray-300"><strong>Name:</strong>
                                        {{ $volunteer->name }}</p>
                                    <p class="text-gray-700 dark:text-gray-300"><strong>Done:</strong>
                                        {{ $volunteer->total }} Hours</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
