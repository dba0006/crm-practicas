{{-- Dashboard CRM - Vista principal con acceso a módulos --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard - CRM Laravel') }}
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 w-full h-full flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-2 h-full">
            
            <div class="mb-2 border-b border-gray-200 dark:border-gray-700 pb-1">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                    ¡Bienvenido al CRM Laravel!
                </h3>
                <p class="text-gray-600 dark:text-gray-400">
                    Sistema completo de gestión de relaciones con clientes. Accede rápidamente a todas las funcionalidades.
                </p>
            </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
                        
                        <!-- CLIENTES -->
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-2 hover:shadow-md transition-all">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="bg-blue-100 dark:bg-blue-800 p-2 rounded-lg mr-3">
                                        <svg class="h-5 w-5 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 919.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-blue-900 dark:text-blue-100">Clientes</h4>
                                        <p class="text-sm text-blue-700 dark:text-blue-300">Base de contactos</p>
                                    </div>
                                </div>
                                <a href="{{ route('clientes.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-sm font-medium transition-colors">
                                    Gestionar
                                </a>
                            </div>
                        </div>

                        <!-- FACTURAS -->
                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-lg p-2 hover:shadow-md transition-all">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="bg-green-100 dark:bg-green-800 p-2 rounded mr-3">
                                        <svg class="h-6 w-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-green-900 dark:text-green-100">Facturas</h4>
                                        <p class="text-sm text-green-700 dark:text-green-300">Gestión financiera</p>
                                    </div>
                                </div>
                                <a href="{{ route('facturas.index') }}" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded text-sm font-medium transition-colors">
                                    Gestionar
                                </a>
                            </div>
                        </div>

                        <!-- INCIDENCIAS -->
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-lg p-2 hover:shadow-md transition-all">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="bg-yellow-100 dark:bg-yellow-800 p-2 rounded mr-3">
                                        <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.268 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-yellow-900 dark:text-yellow-100">Incidencias</h4>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-300">Soporte técnico</p>
                                    </div>
                                </div>
                                <a href="{{ route('incidencias.index') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1.5 rounded text-sm font-medium transition-colors">
                                    Gestionar
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- ACCIONES RÁPIDAS -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-2">
                        <h4 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-1">
                            🚀 Acciones Rápidas
                        </h4>
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('clientes.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Nuevo Cliente
                            </a>
                            
                            <a href="{{ route('facturas.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Nueva Factura
                            </a>
                            
                            <a href="{{ route('incidencias.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Nueva Incidencia
                            </a>
                        </div>
                    </div>

                    <!-- INFORMACIÓN DEL SISTEMA -->
                    <div class="mt-2 pt-2 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-center text-sm text-gray-500 dark:text-gray-400">
                            <span>📊 CRM Laravel - Sistema completo de gestión</span>
                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>