<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Nexus') }}</title>
    <!-- Include dom-to-image library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/custom.css">
    <link rel="shortcut icon" href="{{asset('images/Nexus.png')}}" type="image/x-icon">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

    </div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <footer class="bg-dark  dark:bg-gray-900">
        <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
            <div class="mt-8 flex justify-center space-x-6"> 

                <a target="_blank" href="https://wa.me/+251955133507" class="text-gray-400 hover:text-">
                    <span class="text-gray-800 dark:text-gray-200 leading-tight sr-only">WhatsApp</span>
                    <i class="fa-brands fa-whatsapp"></i>
                </a>

                <a target="_blank" href="https://t.me/lalo_dev" class="text-gray-400 hover:text-">
                    <span class="text-gray-800 dark:text-gray-200 leading-tight sr-only">Telegram</span>
                    <i class="fa-brands fa-telegram"></i>
                </a>

                <a target="_blank" href="https://instagram.com/lalo_dev_official" class="text-gray-400 hover:text-">
                    <span class="text-gray-800 dark:text-gray-200 leading-tight sr-only">Instagram</span>
                    <i class="fa-brands fa-instagram"></i>
                </a> 
            </div>
            <p class=" text-gray-800 dark:text-gray-200 leading-tight mt-8 text-center text-base ">&copy; 2024 <a href="http://lalodev.com">Lalo Dev</a>, Inc. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
