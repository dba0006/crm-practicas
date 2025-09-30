{{-- 
    EDITAR IN        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">DENCIA
    =================
    
    Formulario para modificar datos de incidencias/tickets existentes.
    Permite cambiar prioridad, estado, descripción y cliente asociado.
    
    Funcionalidades:
    - Edición completa de incidencia
    - Cambio de cliente, prioridad y estado
    - Actualización de descripción y fecha
    - Seguimiento del historial de cambios
--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Incidencia') }}
        </h2>
    </x-slot>

    <div class="py-0">
            <!-- TARJETA PRINCIPAL SIN MÁRGENES -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden w-full">
                <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- ENCABEZADO -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Modificar Incidencia #{{ $incidencia->id }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Actualiza los datos de esta incidencia o ticket
                        </p>
                    </div>

                    <!-- FORMULARIO -->
                    <form action="{{ route('incidencias.update', $incidencia) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- CLIENTE ASOCIADO -->
                        <div>
                            <label for="cliente_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Cliente Asociado *
                            </label>
                            <select name="cliente_id" id="cliente_id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" 
                                        {{ old('cliente_id', $incidencia->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->nombre }} - {{ $cliente->email }}
                                    </option>
                                @endforeach
                            </select>
                            @error('cliente_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- TÍTULO DE LA INCIDENCIA -->
                        <div>
                            <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Título de la Incidencia *
                            </label>
                            <input type="text" name="titulo" id="titulo" required 
                                   value="{{ old('titulo', $incidencia->titulo) }}"
                                   placeholder="Ej: Problema con acceso al sistema"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('titulo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- DESCRIPCIÓN DETALLADA -->
                        <div>
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Descripción del Problema *
                            </label>
                            <textarea name="descripcion" id="descripcion" rows="5" required 
                                      placeholder="Describe detalladamente el problema, error o consulta..."
                                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descripcion', $incidencia->descripcion) }}</textarea>
                            @error('descripcion')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- PRIORIDAD -->
                        <div>
                            <label for="prioridad" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nivel de Prioridad *
                            </label>
                            <select name="prioridad" id="prioridad" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="baja" {{ old('prioridad', $incidencia->prioridad) == 'baja' ? 'selected' : '' }}>
                                    🟢 Baja - Consulta general o mejora
                                </option>
                                <option value="media" {{ old('prioridad', $incidencia->prioridad) == 'media' ? 'selected' : '' }}>
                                    🟡 Media - Problema que afecta funcionalidad
                                </option>
                                <option value="alta" {{ old('prioridad', $incidencia->prioridad) == 'alta' ? 'selected' : '' }}>
                                    🔴 Alta - Problema crítico o urgente
                                </option>
                            </select>
                            @error('prioridad')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ESTADO DE LA INCIDENCIA -->
                        <div>
                            <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Estado de la Incidencia *
                            </label>
                            <select name="estado" id="estado" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="abierta" {{ old('estado', $incidencia->estado) == 'abierta' ? 'selected' : '' }}>
                                    📝 Abierta - Esperando revisión
                                </option>
                                <option value="en_proceso" {{ old('estado', $incidencia->estado) == 'en_proceso' ? 'selected' : '' }}>
                                    ⚙️ En Proceso - Siendo atendida
                                </option>
                                <option value="resuelta" {{ old('estado', $incidencia->estado) == 'resuelta' ? 'selected' : '' }}>
                                    ✅ Resuelta - Problema solucionado
                                </option>
                                <option value="cerrada" {{ old('estado', $incidencia->estado) == 'cerrada' ? 'selected' : '' }}>
                                    🔒 Cerrada - Caso finalizado
                                </option>
                            </select>
                            @error('estado')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- FECHA DE REGISTRO -->
                        <div>
                            <label for="fecha" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Fecha de Registro *
                            </label>
                            <input type="date" name="fecha" id="fecha" required 
                                   value="{{ old('fecha', $incidencia->fecha->format('Y-m-d')) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('fecha')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- INFORMACIÓN DE ESTADO ACTUAL -->
                        <div class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-3">📊 Estado Actual</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-600 dark:text-gray-400">Prioridad Actual:</span>
                                    <div class="mt-1">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($incidencia->prioridad === 'alta') bg-red-100 text-red-800
                                            @elseif($incidencia->prioridad === 'media') bg-yellow-100 text-yellow-800
                                            @else bg-green-100 text-green-800 @endif">
                                            {{ ucfirst($incidencia->prioridad) }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-gray-600 dark:text-gray-400">Estado Actual:</span>
                                    <div class="mt-1">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($incidencia->estado === 'abierta') bg-blue-100 text-blue-800
                                            @elseif($incidencia->estado === 'en_progreso') bg-yellow-100 text-yellow-800
                                            @else bg-green-100 text-green-800 @endif">
                                            {{ str_replace('_', ' ', ucfirst($incidencia->estado)) }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-gray-600 dark:text-gray-400">Creada:</span>
                                    <div class="mt-1 text-gray-900 dark:text-gray-100">
                                        {{ $incidencia->created_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CONSEJOS DE EDICIÓN -->
                        <div class="bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">💡 Consejos para actualizar incidencias:</h4>
                            <ul class="text-xs text-blue-800 dark:text-blue-200 space-y-1">
                                <li>• Cambia el estado a "En Progreso" cuando comiences a trabajar en el problema</li>
                                <li>• Actualiza la prioridad si la situación ha cambiado</li>
                                <li>• Marca como "Cerrada" solo cuando el problema esté completamente resuelto</li>
                                <li>• Mantén la descripción actualizada con nueva información relevante</li>
                            </ul>
                        </div>

                        <!-- BOTONES DE ACCIÓN -->
                        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('incidencias.index') }}" 
                               class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg transition-colors duration-200">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg transition-colors duration-200">
                                Actualizar Incidencia
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>