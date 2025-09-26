{{-- 
    FORMULARIO         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> CREACIÓN DE CLIENTE
    =================================
    
    Este formulario permite crear un nuevo cliente en el sistema CRM.
    Incluye validación tanto en frontend como backend.
    
    Campos obligatorios:
    - Nombre: Nombre completo del cliente
    - Email: Dirección de correo (debe ser única)
    
    Campos opcionales:
    - Teléfono: Número de contacto
    - Dirección: Dirección física del cliente
--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nuevo Cliente') }}
        </h2>
    </x-slot>

    <div class="py-0">
            <!-- FORMULARIO COMPACTO SIN MÁRGENES -->
            <div class="bg-white dark:bg-gray-800 w-full">
                <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="p-6">
                    
                    <!-- ENCABEZADO -->
                    <div class="mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Nuevo Cliente</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Completa la información básica del cliente</p>
                    </div>
                    
                    <!-- FORMULARIO -->
                    <form action="{{ route('clientes.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- CAMPO NOMBRE (OBLIGATORIO) -->
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nombre Completo *
                            </label>
                            <input type="text" 
                                   id="nombre"
                                   name="nombre" 
                                   value="{{ old('nombre') }}"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-100 @error('nombre') border-red-500 @enderror" 
                                   required>
                            <!-- Mensaje de error para nombre -->
                            @error('nombre')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- CAMPO EMAIL (OBLIGATORIO) -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Correo Electrónico *
                            </label>
                            <input type="email" 
                                   id="email"
                                   name="email" 
                                   value="{{ old('email') }}"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-100 @error('email') border-red-500 @enderror" 
                                   required>
                            <!-- Mensaje de error para email -->
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- CAMPO TELÉFONO (OPCIONAL) -->
                        <div>
                            <label for="telefono" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Teléfono
                            </label>
                            <input type="text" 
                                   id="telefono"
                                   name="telefono" 
                                   value="{{ old('telefono') }}"
                                   placeholder="666777888"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-100 @error('telefono') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                📱 Se formateará automáticamente como: +34 666 777 888
                            </p>
                            <!-- Mensaje de error para teléfono -->
                            @error('telefono')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- CAMPO DIRECCIÓN (OPCIONAL) -->
                        <div>
                            <label for="direccion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Dirección
                            </label>
                            <textarea id="direccion"
                                      name="direccion" 
                                      rows="3"
                                      placeholder="Dirección completa del cliente"
                                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-100 @error('direccion') border-red-500 @enderror">{{ old('direccion') }}</textarea>
                            <!-- Mensaje de error para dirección -->
                            @error('direccion')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NOTA SOBRE CAMPOS OBLIGATORIOS -->
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            * Campos obligatorios
                        </p>

                        <!-- BOTONES DE ACCIÓN -->
                        <div class="flex justify-end space-x-3 pt-4">
                            <!-- Botón Cancelar -->
                            <a href="{{ route('clientes.index') }}" 
                               class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                Cancelar
                            </a>
                            
                            <!-- Botón Guardar -->
                            <button type="submit" 
                                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors duration-200">
                                Guardar Cliente
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
</x-app-layout>
