{{-- 
    CREAR NUEV        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">INCIDENCIA
    ======================
    
    Formulario para crear tickets/incidencias en el sistema de soporte.
    Permite registrar problemas técnicos, consultas y seguimientos.
    
    Características:
    - Asociación a cliente específico
    - Niveles de prioridad (alta, media, baja)
    - Estados de seguimiento
    - Descripción detallada del problema
    - Fecha de creación automática
--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Nueva Incidencia') }}
        </h2>
    </x-slot>

    <div class="py-0">
            <!-- FORMULARIO COMPACTO SIN MÁRGENES -->
            <div class="bg-white dark:bg-gray-800 w-full">
                <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    
                    <!-- ENCABEZADO -->
                    <div class="mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Nueva Incidencia</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                            Completa la información para crear un nuevo ticket de soporte
                        </p>
                    </div>

                    <!-- FORMULARIO -->
                    <form action="{{ route('incidencias.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- CLIENTE (SELECTOR) -->
                        <div>
                            <label for="cliente_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Cliente Asociado *
                            </label>
                            <select name="cliente_id" id="cliente_id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Selecciona un cliente...</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
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
                                   value="{{ old('titulo') }}"
                                   placeholder="Ej: Problema con acceso al sistema"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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
                                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descripcion') }}</textarea>
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
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Selecciona prioridad...</option>
                                <option value="baja" {{ old('prioridad') == 'baja' ? 'selected' : '' }}>
                                    🟢 Baja - Consulta general o mejora
                                </option>
                                <option value="media" {{ old('prioridad') == 'media' ? 'selected' : '' }}>
                                    🟡 Media - Problema que afecta funcionalidad
                                </option>
                                <option value="alta" {{ old('prioridad') == 'alta' ? 'selected' : '' }}>
                                    🔴 Alta - Problema crítico o urgente
                                </option>
                            </select>
                            @error('prioridad')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ESTADO INICIAL -->
                        <div>
                            <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Estado Inicial
                            </label>
                            <select name="estado" id="estado"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="abierta" {{ old('estado', 'abierta') == 'abierta' ? 'selected' : '' }}>
                                    📝 Abierta - Esperando revisión
                                </option>
                                <option value="en_progreso" {{ old('estado') == 'en_progreso' ? 'selected' : '' }}>
                                    ⚙️ En Progreso - Siendo atendida
                                </option>
                            </select>
                            @error('estado')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Por defecto se creará como "Abierta"
                            </p>
                        </div>

                        <!-- FECHA DE CREACIÓN (AUTOMÁTICA) -->
                        <div>
                            <label for="fecha" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Fecha de Registro
                            </label>
                            <input type="date" name="fecha" id="fecha" 
                                   value="{{ old('fecha', date('Y-m-d')) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('fecha')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- INFORMACIÓN ADICIONAL -->
                        <div class="bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-blue-900 dark:text-blue-100 mb-2">💡 Consejos para crear incidencias efectivas:</h4>
                            <ul class="text-xs text-blue-800 dark:text-blue-200 space-y-1">
                                <li>• Usa un título descriptivo y específico</li>
                                <li>• Incluye pasos para reproducir el problema</li>
                                <li>• Menciona el navegador/dispositivo si es relevante</li>
                                <li>• Indica el nivel de impacto en las operaciones</li>
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
                                Crear Incidencia
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>