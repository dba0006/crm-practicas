{{-- 
    DETALLE DE        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">NCIDENCIA
    =====================
    
    Vista para mostrar información completa de una incidencia específica.
    Incluye detalles del problema, cliente asociado y historial de estados.
    
    Funcionalidades:
    - Visualización completa de la incidencia
    - Información del cliente asociado
    - Estados y prioridades con colores
    - Acciones de gestión disponibles
    - Navegación entre incidencias
--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalle de Incidencia') }}
        </h2>
    </x-slot>

    <div class="py-0">
            <!-- TARJETA PRINCIPAL SIN MÁRGENES -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden w-full">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-gray-900 dark:text-gray-100">
            
                    <!-- MENSAJE DE ÉXITO -->
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <!-- ENCABEZADO CON ACCIONES -->
                    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Incidencia #{{ $incidencia->id }}</h3>
                            <h4 class="text-lg text-gray-700 dark:text-gray-300 mb-1">{{ $incidencia->titulo }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Registrada el {{ $incidencia->fecha->format('d/m/Y') }} | 
                                Creada: {{ $incidencia->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('incidencias.edit', $incidencia) }}" 
                               class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                Editar
                            </a>
                            <a href="{{ route('incidencias.index') }}" 
                               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                Volver al Listado
                            </a>
                        </div>
                    </div>

                    <!-- INDICADORES DE ESTADO -->
                    <div class="flex flex-wrap gap-4 mb-8">
                        <!-- PRIORIDAD -->
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-medium">Prioridad:</span>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                                @if($incidencia->prioridad === 'alta') bg-red-100 text-red-800
                                @elseif($incidencia->prioridad === 'media') bg-yellow-100 text-yellow-800
                                @else bg-green-100 text-green-800 @endif">
                                @if($incidencia->prioridad === 'alta') 🔴 Alta
                                @elseif($incidencia->prioridad === 'media') 🟡 Media
                                @else 🟢 Baja @endif
                            </span>
                        </div>

                        <!-- ESTADO -->
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-medium">Estado:</span>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                                @if($incidencia->estado === 'abierta') bg-blue-100 text-blue-800
                                @elseif($incidencia->estado === 'en_proceso') bg-yellow-100 text-yellow-800
                                @elseif($incidencia->estado === 'resuelta') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800 @endif">
                                @if($incidencia->estado === 'abierta') 📝 Abierta
                                @elseif($incidencia->estado === 'en_proceso') ⚙️ En Proceso
                                @elseif($incidencia->estado === 'resuelta') ✅ Resuelta
                                @else 🔒 Cerrada @endif
                            </span>
                        </div>
                    </div>

                    <!-- INFORMACIÓN PRINCIPAL -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        
                        <!-- DESCRIPCIÓN DEL PROBLEMA (COLUMNA PRINCIPAL) -->
                        <div class="lg:col-span-2 space-y-6">
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                                <h4 class="text-lg font-semibold mb-4 flex items-center">
                                    📋 Descripción del Problema
                                </h4>
                                
                                <div class="prose dark:prose-invert max-w-none">
                                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">
{{ $incidencia->descripcion }}
                                    </p>
                                </div>
                            </div>

                            <!-- ACCIONES RÁPIDAS PARA CAMBIAR ESTADO -->
                            @if($incidencia->estado !== 'cerrada')
                            <div class="bg-yellow-50 dark:bg-yellow-900 border border-yellow-200 dark:border-yellow-700 p-6 rounded-lg">
                                <h4 class="text-lg font-semibold mb-4 text-yellow-900 dark:text-yellow-100">⚡ Acciones Rápidas</h4>
                                
                                <div class="flex flex-wrap gap-3">
                                    @if($incidencia->estado === 'abierta')
                                        <form action="{{ route('incidencias.update', $incidencia) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="cliente_id" value="{{ $incidencia->cliente_id }}">
                                            <input type="hidden" name="titulo" value="{{ $incidencia->titulo }}">
                                            <input type="hidden" name="descripcion" value="{{ $incidencia->descripcion }}">
                                            <input type="hidden" name="prioridad" value="{{ $incidencia->prioridad }}">
                                            <input type="hidden" name="fecha" value="{{ $incidencia->fecha->format('Y-m-d') }}">
                                            <input type="hidden" name="estado" value="en_proceso">
                                            <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg">
                                                ⚙️ Marcar En Proceso
                                            </button>
                                        </form>
                                    @endif

                                    @if($incidencia->estado === 'en_proceso')
                                        <form action="{{ route('incidencias.update', $incidencia) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="cliente_id" value="{{ $incidencia->cliente_id }}">
                                            <input type="hidden" name="titulo" value="{{ $incidencia->titulo }}">
                                            <input type="hidden" name="descripcion" value="{{ $incidencia->descripcion }}">
                                            <input type="hidden" name="prioridad" value="{{ $incidencia->prioridad }}">
                                            <input type="hidden" name="fecha" value="{{ $incidencia->fecha->format('Y-m-d') }}">
                                            <input type="hidden" name="estado" value="resuelta">
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                                                ✅ Marcar Como Resuelta
                                            </button>
                                        </form>
                                    @endif

                                    @if($incidencia->estado === 'resuelta')
                                        <form action="{{ route('incidencias.update', $incidencia) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="cliente_id" value="{{ $incidencia->cliente_id }}">
                                            <input type="hidden" name="titulo" value="{{ $incidencia->titulo }}">
                                            <input type="hidden" name="descripcion" value="{{ $incidencia->descripcion }}">
                                            <input type="hidden" name="prioridad" value="{{ $incidencia->prioridad }}">
                                            <input type="hidden" name="fecha" value="{{ $incidencia->fecha->format('Y-m-d') }}">
                                            <input type="hidden" name="estado" value="cerrada">
                                            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                                                🔒 Cerrar Incidencia
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- INFORMACIÓN DEL CLIENTE (SIDEBAR) -->
                        <div class="space-y-6">
                            <div class="bg-blue-50 dark:bg-blue-900 p-6 rounded-lg">
                                <h4 class="text-lg font-semibold mb-4 text-blue-900 dark:text-blue-100 flex items-center">
                                    👤 Cliente Asociado
                                </h4>
                                
                                <div class="space-y-3">
                                    <div>
                                        <span class="font-medium text-blue-800 dark:text-blue-200">Nombre:</span>
                                        <p class="text-blue-900 dark:text-blue-100">{{ $incidencia->cliente->nombre }}</p>
                                    </div>
                                    
                                    <div>
                                        <span class="font-medium text-blue-800 dark:text-blue-200">Email:</span>
                                        <p class="text-blue-900 dark:text-blue-100">
                                            <a href="mailto:{{ $incidencia->cliente->email }}" class="hover:underline">
                                                {{ $incidencia->cliente->email }}
                                            </a>
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <span class="font-medium text-blue-800 dark:text-blue-200">Teléfono:</span>
                                        <p class="text-blue-900 dark:text-blue-100">
                                            @if($incidencia->cliente->telefono)
                                                <a href="tel:{{ $incidencia->cliente->telefono }}" class="hover:underline">
                                                    {{ $incidencia->cliente->telefono }}
                                                </a>
                                            @else
                                                <span class="text-gray-500">No especificado</span>
                                            @endif
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <span class="font-medium text-blue-800 dark:text-blue-200">Empresa:</span>
                                        <p class="text-blue-900 dark:text-blue-100">
                                            {{ $incidencia->cliente->empresa ?? 'No especificada' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 pt-4 border-t border-blue-200 dark:border-blue-700">
                                    <a href="{{ route('clientes.show', $incidencia->cliente) }}" 
                                       class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
                                        Ver perfil completo del cliente →
                                    </a>
                                </div>
                            </div>

                            <!-- INFORMACIÓN TÉCNICA -->
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                                <h4 class="text-lg font-semibold mb-4">📊 Información Técnica</h4>
                                
                                <div class="space-y-3 text-sm">
                                    <div class="flex justify-between">
                                        <span class="font-medium">ID:</span>
                                        <span class="font-mono text-indigo-600 dark:text-indigo-400">#{{ $incidencia->id }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between">
                                        <span class="font-medium">Fecha Registro:</span>
                                        <span>{{ $incidencia->fecha->format('d/m/Y') }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between">
                                        <span class="font-medium">Creada:</span>
                                        <span>{{ $incidencia->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between">
                                        <span class="font-medium">Actualizada:</span>
                                        <span>{{ $incidencia->updated_at->format('d/m/Y H:i') }}</span>
                                    </div>

                                    @if($incidencia->estado === 'cerrada')
                                    <div class="flex justify-between pt-2 border-t">
                                        <span class="font-medium text-green-600 dark:text-green-400">Tiempo Resolución:</span>
                                        <span class="text-green-700 dark:text-green-300">
                                            {{ $incidencia->created_at->diffForHumans($incidencia->updated_at) }}
                                        </span>
                                    </div>
                                    @else
                                    <div class="flex justify-between pt-2 border-t">
                                        <span class="font-medium">Tiempo Abierta:</span>
                                        <span>{{ $incidencia->created_at->diffForHumans() }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ACCIONES ADICIONALES -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex flex-wrap gap-4 justify-end items-center">
                            
                            <!-- ACCIONES PRINCIPALES -->
                            <div class="flex space-x-3">
                                <form action="{{ route('incidencias.destroy', $incidencia) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors duration-200"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar esta incidencia? Esta acción no se puede deshacer.')">
                                        Eliminar Incidencia
                                    </button>
                                </form>
                                
                                <a href="{{ route('incidencias.create') }}" 
                                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                    Nueva Incidencia
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- METADATOS -->
                    <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Incidencia registrada el {{ $incidencia->created_at->format('d/m/Y H:i:s') }} | 
                            Última actualización: {{ $incidencia->updated_at->format('d/m/Y H:i:s') }}
                            @if($incidencia->estado === 'cerrada')
                                | ✅ Resuelta
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>