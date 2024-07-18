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
                    
                    {{-- Volunteer Detail Cards --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($volunteers as $volunteer)
                            <a href="{{ route('dashboard.show', $volunteer->id) }}" class="block bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-300 transform hover:scale-105">
                                <div class="flex flex-col items-center text-center">
                                    {{-- Volunteer Avatar --}}
                                    <div class="w-24 h-24 mb-4 overflow-hidden rounded-full bg-indigo-100 dark:bg-indigo-800">
                                        <svg class="w-full h-full text-indigo-600 dark:text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 15.292 4 4 0 010-15.292z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.8 9.282A5.978 5.978 0 0118 12c0 1.85-.63 3.555-1.68 4.928M9.2 9.282A5.978 5.978 0 006 12c0 1.85.63 3.555 1.68 4.928M7.166 14H8.75m6.5 0H16.834M8.75 14a4 4 0 006.5 0" />
                                        </svg>
                                    </div>
                                    <p class="font-semibold text-lg"><strong>Id:</strong> {{ $volunteer->volunteer_id }}</p>
                                    <p class="text-gray-700 dark:text-gray-300"><strong>Name:</strong> {{ $volunteer->name }}</p>
                                    <p class="text-gray-700 dark:text-gray-300"><strong>Done:</strong> {{ $volunteer->total }} Hours</p>
                                </div>
                            </a>
                        @endforeach
                    </div> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
