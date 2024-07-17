<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Attendance') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative pb-5 border-b sm:pb-0">
                        <div class="md:flex md:items-center md:justify-between">
                            <h3 class="text-lg leading-6 font-medium text-white">Candidates</h3>
                            <div class="mt-3 flex md:mt-0 md:absolute md:top-3 md:right-0">
                                <button type="button"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Share</button>
                                <button type="button"
                                    class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create</button>
                            </div>
                        </div>
                        <div class="mt-4">
                            <!-- Dropdown menu on small screens -->
                            <div class="sm:hidden">
                                <label for="current-tab" class="sr-only">Select a tab</label>
                                <select id="current-tab" name="current-tab bg-dark"
                                    class="block w-full text-dark pl-3 pr-10 py-2 text-base border-dark focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option>Applied</option>

                                    <option>Phone Screening</option>

                                    <option selected>Interview</option>

                                    <option>Offer</option>

                                    <option>Hired</option>
                                </select>
                            </div>
                            <!-- Tabs at small breakpoint and up -->
                            <div class="hidden sm:block">
                                <nav class="-mb-px flex space-x-8">
                                    <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                                    <a href="#"
                                        class="border-transparent text-white hover:text-gray-700 hover:border-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
                                        Applied </a>

                                    <a href="#"
                                        class="border-transparent text-white hover:text-gray-700 hover:border-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
                                        Phone Screening </a>

                                    <a href="#"
                                        class="border-indigo-500 text-indigo-600 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm"
                                        aria-current="page"> Interview </a>

                                    <a href="#"
                                        class="border-transparent text-white hover:text-gray-700 hover:border-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
                                        Offer </a>

                                    <a href="#"
                                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">
                                        Hired </a>
                                </nav>
                            </div>
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

                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden   0 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                                    Name</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                                    Title</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                                    Email</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                                    Role</th>
                                                <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Odd row -->
                                            <tr class="bg-dark">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                                    Jane Cooper</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">Regional
                                                    Paradigm Technician</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                                    jane.cooper@example.com</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">Admin</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="#"
                                                        class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                </td>
                                            </tr>
                                            <tr class="bg-dark">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                                    Jane Cooper</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">Regional
                                                    Paradigm Technician</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                                    jane.cooper@example.com</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">Admin</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="#"
                                                        class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                </td>
                                            </tr>
                                            <!-- Even row -->
                                            <!-- More people... -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
