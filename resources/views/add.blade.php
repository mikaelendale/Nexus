<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Section') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                            @if (session('volunteer'))
                                <a href="{{ route('dashboard.show', session('volunteer')->id) }}"
                                    class="underline text-blue-500">View Volunteer</a>
                            @endif
                        </div>
                    @endif
                    <!-- Two Columns for Adding Sections -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="  sm:rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-800 dark:text-gray-200 leading-tight">Add New Volunteer</h3>
                                <div class="mt-2 max-w-xl text-sm text-gray-800 dark:text-gray-200 leading-tight">
                                    <p>add new volunteer to Nexus Volunteerism.</p><br>
                                    <p>ለኔክስስ ፈቃደኛ ሠራተኛነት አዲስ ፈቃደኛ ሠራተኛ ጨምር ።</p>

                                </div>
                                <div class="mt-5">
                                    <a href="{{ route('add.volunteers') }}"
                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-700 rounded inline-flex items-center shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                                        Add New
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- Total Analysis --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden  -sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg leading-6 font-medium text-gray-800 dark:text-gray-200 leading-tight ">Total Analysis</h3>
                    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div class="px-4 py-5 bg-white dark:bg-gray-800   rounded-lg overflow-hidden sm:p-6">
                            <dt class="text-sm font-medium text-gray-800 dark:text-gray-200 leading-tight text-gray-300 truncate">Total Volunteers</dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-800 dark:text-gray-200 leading-tight text-blue-300">{{ $totalVolunteers }}</dd>
                        </div>
                        <div class="px-4 py-5 bg-white dark:bg-gray-800   rounded-lg overflow-hidden sm:p-6">
                            <dt class="text-sm font-medium text-gray-800 dark:text-gray-200 leading-tight text-gray-300 truncate">Total Admins</dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-800 dark:text-gray-200 leading-tight text-red-300">{{ $totalAdmins }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
