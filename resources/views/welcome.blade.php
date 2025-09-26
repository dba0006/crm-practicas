<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>CRM Laravel</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900 min-h-screen flex flex-col">
        <!-- NAVEGACION -->
        <nav class="bg-white dark:bg-gray-800 shadow-md border-b border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h1 class="text-xl font-bold text-gray-900 dark:text-gray-100">CRM Laravel</h1>
                    </div>

                    <!-- Menu de autenticación -->
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-200">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-200">Iniciar Sesión</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-sm transition-colors duration-200">Registrarse</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- CONTENIDO PRINCIPAL -->
        <main class="flex-1 flex items-center justify-center px-4">
            <div class="w-full sm:max-w-md">
                <div class="bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg p-8">
                    <div class="text-center">
                        <!-- Logo CRM -->
                        <div class="mb-8">
                            <div class="w-20 h-20 mx-auto bg-gradient-to-br from-indigo-600 to-indigo-800 rounded-full flex items-center justify-center mb-4 shadow-lg">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">CRM Laravel</h1>
                            <p class="text-lg text-gray-600 dark:text-gray-400">Sistema de Gestión de Relaciones con Clientes</p>
                        </div>

                        <!-- Botones de acción -->
                        <div class="space-y-3">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="w-full bg-indigo-600 hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-white font-semibold py-3 px-8 rounded-lg shadow-sm transition ease-in-out duration-150 inline-flex justify-center items-center">
                                    Ir al Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="w-full bg-indigo-600 hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-white font-semibold py-3 px-8 rounded-lg shadow-sm transition ease-in-out duration-150 inline-flex justify-center items-center">
                                    Iniciar Sesión
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="w-full bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-900 dark:text-gray-100 font-semibold py-3 px-8 rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm transition ease-in-out duration-150 inline-flex justify-center items-center">
                                        Registrarse
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- FOOTER MINIMALISTA -->
        <footer class="py-6">
            <div class="max-w-md mx-auto text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    &copy; {{ date('Y') }} CRM Laravel
                </p>
            </div>
        </footer>
    </body>
</html>