<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: auto; margin: 0; padding: 0;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
        <body class="font-sans antialiased" style="margin: 0; padding: 0; height: 100vh; display: flex; flex-direction: column;">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="bg-white dark:bg-gray-800" style="margin: 0; padding: 0; flex: 1;">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700" style="margin: 0; padding: 0; flex-shrink: 0;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
                <div class="text-center text-sm text-gray-600 dark:text-gray-400">
                    © {{ date('Y') }} CRM Laravel - Sistema de gestión empresarial
                </div>
            </div>
        </footer>
    </body>
</html>
