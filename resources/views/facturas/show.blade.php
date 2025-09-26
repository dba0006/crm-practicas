{{-- 
    DETALLE DE        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">ACTURA
    ==================
    
    Vista para mostrar información completa de una factura específica.
    Incluye detalles financieros, cliente asociado y acciones disponibles.
    
    Funcionalidades:
    - Visualización completa de datos de factura
    - Información del cliente asociado
    - Estados de pago con colores
    - Acciones de edición y eliminación
    - Navegación entre registros
--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalle de Factura') }}
        </h2>
    </x-slot>

    <div class="py-0">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- MENSAJE DE ÉXITO -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- TARJETA PRINCIPAL -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- ENCABEZADO CON ACCIONES -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Factura #{{ $factura->numero }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Creada el {{ $factura->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('facturas.edit', $factura) }}" 
                               class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                Editar
                            </a>
                            <a href="{{ route('facturas.index') }}" 
                               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                Volver al Listado
                            </a>
                        </div>
                    </div>

                    <!-- INFORMACIÓN PRINCIPAL -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        
                        <!-- DATOS DE LA FACTURA -->
                        <div class="space-y-6">
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                                <h4 class="text-lg font-semibold mb-4">📄 Información de Factura</h4>
                                
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="font-medium">Número:</span>
                                        <span class="text-indigo-600 dark:text-indigo-400 font-mono">{{ $factura->numero_factura }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between">
                                        <span class="font-medium">Fecha:</span>
                                        <span>{{ $factura->fecha->format('d/m/Y') }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium">Estado:</span>
                                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                                            @if($factura->estado_pago === 'pagada') bg-green-100 text-green-800 
                                            @elseif($factura->estado_pago === 'pendiente') bg-yellow-100 text-yellow-800 
                                            @else bg-red-100 text-red-800 @endif">
                                            @if($factura->estado_pago === 'pagada') ✅ Pagada
                                            @elseif($factura->estado_pago === 'pendiente') ⏳ Pendiente
                                            @else ❌ Vencida @endif
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- DESCRIPCIÓN -->
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                                <h4 class="text-lg font-semibold mb-4">📝 Descripción</h4>
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                    {{ $factura->descripcion }}
                                </p>
                            </div>
                        </div>

                        <!-- DATOS DEL CLIENTE -->
                        <div class="space-y-6">
                            <div class="bg-blue-50 dark:bg-blue-900 p-6 rounded-lg">
                                <h4 class="text-lg font-semibold mb-4 text-blue-900 dark:text-blue-100">👤 Información del Cliente</h4>
                                
                                <div class="space-y-3">
                                    <div>
                                        <span class="font-medium text-blue-800 dark:text-blue-200">Nombre:</span>
                                        <p class="text-blue-900 dark:text-blue-100">{{ $factura->cliente->nombre }}</p>
                                    </div>
                                    
                                    <div>
                                        <span class="font-medium text-blue-800 dark:text-blue-200">Email:</span>
                                        <p class="text-blue-900 dark:text-blue-100">
                                            <a href="mailto:{{ $factura->cliente->email }}" class="hover:underline">
                                                {{ $factura->cliente->email }}
                                            </a>
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <span class="font-medium text-blue-800 dark:text-blue-200">Teléfono:</span>
                                        <p class="text-blue-900 dark:text-blue-100">
                                            @if($factura->cliente->telefono)
                                                <a href="tel:{{ $factura->cliente->telefono }}" class="hover:underline">
                                                    {{ $factura->cliente->telefono }}
                                                </a>
                                            @else
                                                <span class="text-gray-500">No especificado</span>
                                            @endif
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <span class="font-medium text-blue-800 dark:text-blue-200">Empresa:</span>
                                        <p class="text-blue-900 dark:text-blue-100">
                                            {{ $factura->cliente->empresa ?? 'No especificada' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 pt-4 border-t border-blue-200 dark:border-blue-700">
                                    <a href="{{ route('clientes.show', $factura->cliente) }}" 
                                       class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
                                        Ver perfil completo del cliente →
                                    </a>
                                </div>
                            </div>

                            <!-- RESUMEN FINANCIERO -->
                            <div class="bg-green-50 dark:bg-green-900 p-6 rounded-lg">
                                <h4 class="text-lg font-semibold mb-4 text-green-900 dark:text-green-100">💰 Resumen Financiero</h4>
                                
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="font-medium text-green-800 dark:text-green-200">Monto Base:</span>
                                        <span class="text-green-900 dark:text-green-100 font-mono">${{ number_format($factura->monto, 2) }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between">
                                        <span class="font-medium text-green-800 dark:text-green-200">Impuesto:</span>
                                        <span class="text-green-900 dark:text-green-100 font-mono">${{ number_format($factura->impuesto, 2) }}</span>
                                    </div>
                                    
                                    <div class="border-t border-green-200 dark:border-green-700 pt-3">
                                        <div class="flex justify-between text-lg font-bold">
                                            <span class="text-green-800 dark:text-green-200">TOTAL:</span>
                                            <span class="text-green-900 dark:text-green-100 font-mono">${{ number_format($factura->total, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ACCIONES ADICIONALES -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex justify-center">
                            
                            <!-- ACCIONES PRINCIPALES -->
                            <div class="flex space-x-3">
                                <form action="{{ route('facturas.destroy', $factura) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors duration-200"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar esta factura? Esta acción no se puede deshacer.')">
                                        Eliminar Factura
                                    </button>
                                </form>
                                
                                <a href="{{ route('facturas.create') }}" 
                                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                    Nueva Factura
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- METADATOS -->
                    <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Factura creada el {{ $factura->created_at->format('d/m/Y H:i:s') }} | 
                            Última actualización: {{ $factura->updated_at->format('d/m/Y H:i:s') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>