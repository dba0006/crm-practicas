{{-- 
    DETALLE DE CLIENTE
    ==================
    
    Esta vista muestra la información completa de un cliente específico.
    Incluye datos personales, incidencias y facturas asociadas.
--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalle de Cliente') }}
        </h2>
    </x-slot>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="bg-white dark:bg-gray-800 w-full h-full flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-2">
            
            <!-- INFORMACIÓN DEL CLIENTE -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                            {{ $cliente->nombre }}
                        </h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('clientes.edit', $cliente) }}" 
                               class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors font-medium">
                                Editar
                            </a>
                            <a href="{{ route('clientes.index') }}" 
                               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors font-medium">
                                Volver
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Email
                            </label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $cliente->email }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Teléfono
                            </label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $cliente->telefono ?? 'No especificado' }}</p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Dirección
                            </label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $cliente->direccion ?? 'No especificada' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- INCIDENCIAS Y FACTURAS -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                <!-- Incidencias -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-4">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Incidencias</h4>
                        @if($cliente->incidencias->count() > 0)
                            <div class="space-y-2">
                                @foreach($cliente->incidencias as $incidencia)
                                    <div class="flex justify-between items-center p-2 bg-gray-50 dark:bg-gray-700 rounded">
                                        <span class="text-sm text-gray-900 dark:text-gray-100">{{ $incidencia->titulo }}</span>
                                        <span class="text-xs px-2 py-1 rounded 
                                            @if($incidencia->estado == 'abierta') bg-red-100 text-red-800
                                            @elseif($incidencia->estado == 'en_progreso') bg-yellow-100 text-yellow-800
                                            @else bg-green-100 text-green-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $incidencia->estado)) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 dark:text-gray-400 text-sm">No hay incidencias registradas.</p>
                        @endif
                    </div>
                </div>

                <!-- Facturas -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-4">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Facturas</h4>
                        @if($cliente->facturas->count() > 0)
                            <div class="space-y-2">
                                @foreach($cliente->facturas as $factura)
                                    <div class="flex justify-between items-center p-2 bg-gray-50 dark:bg-gray-700 rounded">
                                        <span class="text-sm text-gray-900 dark:text-gray-100">Factura #{{ $factura->numero }}</span>
                                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">${{ number_format($factura->total, 2) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 dark:text-gray-400 text-sm">No hay facturas registradas.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
