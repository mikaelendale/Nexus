<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Volunteer Information</h3>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6" style="padding: 20px; border-radius: 10px;"
                        id="volunteer-detail">
                        <!-- Volunteer Details -->
                        <div>
                            <p><strong>Name:</strong> {{ $volunteer->name }}</p>
                            <p><strong>Volunteer ID:</strong> {{ $volunteer->volunteer_id }}</p>
                            <!-- Add more fields as necessary -->
                        </div>

                        <!-- Form and Progress Bar -->
                        <div>
                            <!-- Display Validation Errors -->
                            @if ($errors->any())
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                                            role="alert">
                                            <strong class="font-bold">Error!</strong>
                                            <span class="block sm:inline">{{ $error }}</span>
                                        </div>
                                    @endforeach
                                </ul>
                            @endif

                            <!-- Check for success message and display it -->
                            @if (session('success'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                                    role="alert">
                                    <strong class="font-bold">Success!</strong>
                                    <span class="block sm:inline">{{ session('success') }}</span>
                                </div>
                            @endif

                            <!-- Form -->
                            <form action="{{ route('updated.hours', ['volunteer' => $volunteer->id]) }}" method="POST"
                                class="mb-4">
                                @csrf
                                @method('PUT')

                                <!-- Organization Selection -->
                                <div>
                                    <label for="org_id"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Organization</label>
                                    <select name="org_id" id="org_id"
                                        class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @foreach ($orgs as $org)
                                            <option value="{{ $org->id }}"
                                                {{ $org->id == Auth::user()->ambassador_of ? 'selected' : '' }}>
                                                {{ $org->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Hours Input -->
                                <div class="mt-4">
                                    <label for="hours"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount of
                                        Hours</label>
                                    <input type="number" name="hours" id="hours"
                                        class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        required>
                                </div>

                                <div class="mt-4 flex justify-end">
                                    <button type="submit"
                                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Submit</button>
                                </div><br>
                            </form>

                            <!-- Progress Bar Calculation -->
                            @php
                                // Ensure default values
                                $totalHours = $totalHours ?? 0;
                                $goal = $goal ?? 72;
                                $percentage = ($totalHours / $goal) * 100;
                                $assignedOrgs = $assignedOrgs ?? [];
                            @endphp

                            <!-- Progress Bar -->
                            <div class="w-full bg-gray-200 rounded-full h-4 mb-4">
                                <div class="h-4 rounded-full"
                                    style="width: {{ $percentage }}%; background-color: {{ $percentage >= 100 ? 'green' : 'blue' }};">
                                </div>
                            </div>

                            <div class="flex justify-between">
                                <span
                                    class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ number_format($percentage, 2) }}%</span>
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ $totalHours }}
                                    out of {{ $goal }} hours completed</span>
                            </div>
                            <br>

                            <!-- Organizations and Hours Worked -->
                            @if ($orgs->isNotEmpty())
                                <h2 class="text-lg font-semibold mb-4">Organizations and Hours Worked:</h2>
                                <div class="overflow-hidden sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-200 leading-tight uppercase tracking-wider">
                                                    Organization</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-800 dark:text-gray-200 leading-tight uppercase tracking-wider">
                                                    Hours Worked</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orgs as $org)
                                                <tr class="bg-dark">
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 leading-tight">
                                                        {{ $org->name }}</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 leading-tight">
                                                        {{ $org->hours }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>No organizations found for this volunteer.</p>
                            @endif

                            <!-- Add Organization Form -->
                            @if ($orgs->isNotEmpty() && count($orgs) > count($assignedOrgs))
                                <form action="{{ route('volunteers.addOrg', ['volunteer' => $volunteer->id]) }}"
                                    method="POST" class="mt-4">
                                    @csrf
                                    <label for="org_id"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Add
                                        Organization</label>
                                    <select name="org_id" id="org_id"
                                        class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @foreach ($orgs as $org)
                                            <option value="{{ $org->id }}"
                                                {{ $org->id == Auth::user()->ambassador_of ? 'selected' : '' }}>
                                                {{ $org->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div class="mt-4 flex justify-end">
                                        <button type="submit"
                                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Add
                                            Organization</button>
                                    </div>
                                </form>
                            @endif
                        </div>

                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('dashboard') }}"
                                class="py-4 px-2 text-indigo-600 hover:text-indigo-900">Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
