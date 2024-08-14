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
                            <!-- Existing Table for Organizations and Hours -->

                            <!-- New Table for Volunteer Projects -->
                            <h2 class="text-lg font-bold mt-8">Projects</h2>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Project Name</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Description</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Organization</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($projects as $project)
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                                    {{ $project->project_name }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                                    {{ $project->description }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                                    {{ $project->org->name ?? 'N/A' }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200">
                                                    {{ $project->created_at->format('M d, Y') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4"
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-200 text-center">
                                                    No projects found for this volunteer.
                                                </td>
                                            </tr>
                                        @endforelse
                                </tbody>
                            </table>

                        </div>



                        <!-- Form for Updating Volunteer Hours -->
                        <div>
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

                            @if (session('success'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                                    role="alert">
                                    <strong class="font-bold">Success!</strong>
                                    <span class="block sm:inline">{{ session('success') }}</span>
                                </div>
                            @endif

                            <!-- This select is for updating hours for already associated organizations -->
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
                                        @foreach ($volunteerOrgs as $org)
                                            <option value="{{ $org->id }}">{{ $org->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Hours Input -->
                                <div class="mt-4">
                                    <label for="hours"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount of
                                        Hours</label>
                                    <input type="number" name="hours" id="hours"
                                        class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>

                                <div class="mt-4 flex justify-end">
                                    <button type="submit"
                                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Submit</button>
                                </div>
                            </form>



                            <!-- Organizations and Hours Worked -->
                            @if ($assignedOrgs->isNotEmpty())
                                <h2 class="text-lg font-semibold mb-4">Organizations and Hours Worked:</h2>
                                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="  overflow-hidden sm:rounded-lg">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-dark">
                                                    <tr>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium  text-gray-800 dark:text-gray-200 leading-tight uppercase tracking-wider">
                                                            Organization</th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium  text-gray-800 dark:text-gray-200 leading-tight uppercase tracking-wider">
                                                            Hours Worked</th>
                                                        <th scope="col" class="relative px-6 py-3"><span
                                                                class="sr-only">Progress</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($assignedOrgs as $assignedOrg)
                                                        <tr class="bg-dark">
                                                            <!-- Organization Name -->
                                                            <td
                                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 leading-tight">
                                                                {{ $assignedOrg->org->name }}
                                                            </td>

                                                            <!-- Hours -->
                                                            <td
                                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200 leading-tight">
                                                                {{ $assignedOrg->hours }}
                                                            </td>

                                                            <!-- Progress Bar -->
                                                            <td
                                                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                                @php
                                                                    $orgGoal = 72; // Set a goal for each organization or fetch dynamically if needed
                                                                    $orgPercentage =
                                                                        ($assignedOrg->hours / $orgGoal) * 100;
                                                                @endphp
                                                                <div class="w-full bg-gray-200 rounded-full h-4 mb-4">
                                                                    <div class="h-4 rounded-full"
                                                                        style="width: {{ $orgPercentage }}%; background-color: {{ $orgPercentage >= 100 ? 'green' : 'blue' }};">
                                                                    </div>
                                                                </div>
                                                                <div class="flex justify-between">
                                                                    <span
                                                                        class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ number_format($orgPercentage, 2) }}%</span>
                                                                    <span
                                                                        class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ $assignedOrg->hours }}
                                                                        out of {{ $orgGoal }} hours
                                                                        completed</span>
                                                                </div>
                                                            </td>

                                                            <!-- Delete Button -->
                                                            <td
                                                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                                <form
                                                                    action="{{ route('volunteers.removeOrg', ['volunteer' => $volunteer->id, 'org' => $assignedOrg->org->id]) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure you want to remove this organization?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="text-red-600 hover:text-red-900">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p>No organizations found for this volunteer.</p>
                            @endif

                            <!-- Add Organization Form -->
                            <!-- This select is for adding new organizations -->
                            <form action="{{ route('volunteers.addOrg', ['volunteer' => $volunteer->id]) }}"
                                method="POST" class="mt-4">
                                @csrf
                                <label for="org_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Add
                                    Organization</label>
                                <select name="org_id" id="org_id"
                                    class="mt-1 block w-full rounded-md bg-gray-100 dark:bg-gray-700 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @foreach ($availableOrgs as $org)
                                        <option value="{{ $org->id }}">{{ $org->name }}</option>
                                    @endforeach
                                </select>

                                <div class="mt-4 flex justify-end">
                                    <button type="submit"
                                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Add
                                        Organization</button>
                                </div>
                            </form>
                            <!-- Button to Open Modal -->
                            <button id="openModal" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Add
                                Project</button>

                            <!-- Modal Structure -->
                            <div id="projectModal"
                                class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity hidden">
                                <div class="flex items-center justify-center h-full">
                                    <div class="bg-white dark:bg-gray-800  p-6 rounded-lg shadow-lg w-1/3">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">
                                            Submit a Project
                                        </h3>
                                        <form
                                            action="{{ route('volunteers.submitProject', ['id' => $volunteer->id]) }}"
                                            method="POST">
                                            @csrf
                                            <div class="mt-4">
                                                <label for="project_name"
                                                    class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    Project Name
                                                </label>
                                                <input type="text" name="project_name" id="project_name"
                                                    class="mt-1 block w-full rounded-md bg-white dark:bg-gray-800 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                    required>
                                            </div>

                                            <div class="mt-4">
                                                <label for="project_description"
                                                    class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    Project Description
                                                </label>
                                                <textarea name="project_description" id="project_description" rows="4"
                                                    class="mt-1 block w-full rounded-md bg-white dark:bg-gray-800 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                    required></textarea>
                                            </div>

                                            <!-- Add a select dropdown for the volunteer's organizations -->
                                            <div class="mt-4">
                                                <label for="org_id"
                                                    class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    Select Organization
                                                </label>
                                                <select name="org_id" id="org_id"
                                                    class="mt-1 block w-full rounded-md bg-white dark:bg-gray-800 border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                    required>
                                                    <option value="" disabled selected>Select an organization
                                                    </option>
                                                    @foreach ($volunteerOrgs as $org)
                                                        <option value="{{ $org->id }}">{{ $org->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mt-4 flex justify-end">
                                                <button type="button" id="closeModal"
                                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Cancel</button>
                                                <button type="submit"
                                                    class="ml-4 px-4 py-2 bg-indigo-600 text-white rounded-md">Submit</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <script>
                                // Script to handle modal visibility
                                document.getElementById('openModal').addEventListener('click', function() {
                                    document.getElementById('projectModal').classList.remove('hidden');
                                });

                                document.getElementById('closeModal').addEventListener('click', function() {
                                    document.getElementById('projectModal').classList.add('hidden');
                                });
                            </script>

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
