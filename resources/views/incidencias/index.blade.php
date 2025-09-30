{{-- 
    LISTADO DE INCIDENCIAS
    ======================
    
    Esta vista muestra el sistema de tickets/incidencias del CRM.
    Permite gestionar el soporte técnico y seguimiento de problemas.
    
    Funcionalidades:
    - Ver todas las incidencias con prioridad y estado
    - Crear nuevas incidencias
    - Ver detalles y seguimiento de cada incidencia
    - Editar incidencias existentes
    - Cambiar estados de resolución
    - Filtrado visual por prioridad y estado
--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Incidencias') }}
        </h2>
    </x-slot>

            <!-- CONTENIDO UNIFICADO SIN MÁRGENES -->
            <div class="bg-white dark:bg-gray-800 w-full pb-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                    
                    <!-- MENSAJE DE ÉXITO -->
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <!-- ENCABEZADO -->
                    <div class="flex justify-between items-center mb-3 pb-2 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Sistema de Incidencias</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Gestión de tickets y soporte técnico</p>
                        </div>
                        <a href="{{ route('incidencias.create') }}" 
                           class="inline-flex items-center bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors font-medium shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Nueva Incidencia
                        </a>
                    </div>

                    <!-- ESTADÍSTICAS RÁPIDAS -->
                    @if($incidencias->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                            <!-- Total -->
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg text-center">
                                <div class="text-2xl font-bold">{{ $incidencias->count() }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Total</div>
                            </div>
                            <!-- Abiertas -->
                            <div class="bg-blue-100 dark:bg-blue-900 p-4 rounded-lg text-center">
                                <div class="text-2xl font-bold text-blue-800 dark:text-blue-200">
                                    {{ $incidencias->where('estado', 'abierta')->count() }}
                                </div>
                                <div class="text-sm text-blue-600 dark:text-blue-400">Abiertas</div>
                            </div>
                            <!-- En proceso -->
                            <div class="bg-yellow-100 dark:bg-yellow-900 p-4 rounded-lg text-center">
                                <div class="text-2xl font-bold text-yellow-800 dark:text-yellow-200">
                                    {{ $incidencias->where('estado', 'en_proceso')->count() }}
                                </div>
                                <div class="text-sm text-yellow-600 dark:text-yellow-400">En Proceso</div>
                            </div>
                            <!-- Resueltas -->
                            <div class="bg-green-100 dark:bg-green-900 p-4 rounded-lg text-center">
                                <div class="text-2xl font-bold text-green-800 dark:text-green-200">
                                    {{ $incidencias->where('estado', 'resuelta')->count() }}
                                </div>
                                <div class="text-sm text-green-600 dark:text-green-400">Resueltas</div>
                            </div>
                            <!-- Cerradas -->
                            <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg text-center">
                                <div class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                                    {{ $incidencias->where('estado', 'cerrada')->count() }}
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Cerradas</div>
                            </div>
                        </div>
                    @endif

                    <!-- TABLA DE INCIDENCIAS -->
                    @if($incidencias->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Cliente</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Título</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Prioridad</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estado</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($incidencias as $incidencia)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                #{{ $incidencia->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $incidencia->cliente->nombre }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                                <div class="max-w-xs truncate">{{ $incidencia->titulo }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <!-- PRIORIDAD CON COLORES -->
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                    @if($incidencia->prioridad === 'alta') bg-red-100 text-red-800
                                                    @elseif($incidencia->prioridad === 'media') bg-yellow-100 text-yellow-800
                                                    @else bg-green-100 text-green-800 @endif">
                                                    {{ ucfirst($incidencia->prioridad) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <!-- ESTADO CON COLORES -->
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                    @if($incidencia->estado === 'abierta') bg-blue-100 text-blue-800
                                                    @elseif($incidencia->estado === 'en_proceso') bg-yellow-100 text-yellow-800
                                                    @elseif($incidencia->estado === 'resuelta') bg-green-100 text-green-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ str_replace('_', ' ', ucfirst($incidencia->estado)) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $incidencia->fecha->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                <!-- BOTÓN VER -->
                                                <a href="{{ route('incidencias.show', $incidencia) }}" 
                                                   class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                    Ver
                                                </a>
                                                
                                                <!-- BOTÓN EDITAR -->
                                                <a href="{{ route('incidencias.edit', $incidencia) }}" 
                                                   class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">
                                                    Editar
                                                </a>
                                                
                                                <!-- BOTÓN ELIMINAR -->
                                                <form action="{{ route('incidencias.destroy', $incidencia) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                            onclick="return confirm('¿Estás seguro de que deseas eliminar esta incidencia?')">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- MENSAJE CUANDO NO HAY INCIDENCIAS -->
                        <div class="text-center py-8">
                            <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No hay incidencias</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Empieza creando tu primera incidencia o ticket.</p>
                            <div class="mt-6">
                                <a href="{{ route('incidencias.create') }}" 
                                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                    + Crear Primera Incidencia
                                </a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>