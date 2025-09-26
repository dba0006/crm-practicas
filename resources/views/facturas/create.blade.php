{{-- 
    FORMULARIO DE        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">REACIÓN DE FACTURA
    =================================
    
    Este formulario permite crear una nueva factura para un cliente.
    Incluye selección de cliente, datos de facturación y validación.
    
    Campos obligatorios:
    - Cliente: Debe seleccionar un cliente existente
    - Número de factura: Identificador único de la factura
    - Importe: Cantidad a facturar
    - Estado: Estado actual de pago
    - Fecha: Fecha de emisión de la factura
    
    Campo opcional:
    - Descripción: Detalles adicionales de la factura
--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nueva Factura') }}
        </h2>
    </x-slot>

    <div class="py-0">
            <!-- FORMULARIO COMPACTO SIN MÁRGENES -->
            <div class="bg-white dark:bg-gray-800 w-full">
                <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <!-- ENCABEZADO -->
                    <div class="mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Nueva Factura</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Información financiera y detalles de facturación</p>
                    </div>

                    <!-- ERRORES -->
                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <!-- FORMULARIO -->
                    <form action="{{ route('facturas.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- SELECCIÓN DE CLIENTE (OBLIGATORIO) -->
                        <div>
                            <label for="cliente_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Cliente *
                            </label>
                            <select id="cliente_id"
                                    name="cliente_id" 
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-100 @error('cliente_id') border-red-500 @enderror" 
                                    required>
                                <option value="">Selecciona un cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->nombre }} ({{ $cliente->email }})
                                    </option>
                                @endforeach
                            </select>
                            <!-- Mensaje de error para cliente -->
                            @error('cliente_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            <!-- Enlace para crear cliente si no existe -->
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                ¿No encuentras el cliente? <a href="{{ route('clientes.create') }}" class="text-indigo-600 hover:text-indigo-800">Crear nuevo cliente</a>
                            </p>
                        </div>

                        <!-- NÚMERO DE FACTURA (OBLIGATORIO) -->
                        <div>
                            <label for="numero" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Número de Factura *
                            </label>
                            <input type="text" 
                                   id="numero"
                                   name="numero" 
                                   value="{{ old('numero', 'FAC-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT)) }}"
                                   placeholder="Ej: FAC-2025-0001"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-100 @error('numero') border-red-500 @enderror" 
                                   required>
                            <!-- Mensaje de error para número -->
                            @error('numero')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- IMPORTE (OBLIGATORIO) -->
                        <!-- MONTO BASE -->
                        <div>
                            <label for="monto" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Monto Base (€) *
                            </label>
                            <input type="number" 
                                   id="monto"
                                   name="monto" 
                                   value="{{ old('monto') }}"
                                   step="0.01"
                                   min="0"
                                   placeholder="0.00"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-100 @error('monto') border-red-500 @enderror" 
                                   required>
                            @error('monto')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- IMPUESTO -->
                        <div>
                            <label for="impuesto" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Impuesto (€)
                            </label>
                            <input type="number" 
                                   id="impuesto"
                                   name="impuesto" 
                                   value="{{ old('impuesto', '0') }}"
                                   step="0.01"
                                   min="0"
                                   placeholder="0.00"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-100 @error('impuesto') border-red-500 @enderror">
                            @error('impuesto')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ESTADO DE LA FACTURA (OBLIGATORIO) -->
                        <div>
                            <label for="estado_pago" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Estado de Pago *
                            </label>
                            <select id="estado_pago"
                                    name="estado_pago" 
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-100 @error('estado_pago') border-red-500 @enderror" 
                                    required>
                                <option value="pendiente" {{ old('estado_pago') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="pagada" {{ old('estado_pago') == 'pagada' ? 'selected' : '' }}>Pagada</option>
                                <option value="vencida" {{ old('estado_pago') == 'vencida' ? 'selected' : '' }}>Vencida</option>
                            </select>
                            <!-- Mensaje de error para estado -->
                            @error('estado_pago')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- FECHA DE FACTURA (OBLIGATORIO) -->
                        <div>
                            <label for="fecha" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Fecha de Emisión *
                            </label>
                            <input type="date" 
                                   id="fecha"
                                   name="fecha" 
                                   value="{{ old('fecha', date('Y-m-d')) }}"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-100 @error('fecha') border-red-500 @enderror" 
                                   required>
                            <!-- Mensaje de error para fecha -->
                            @error('fecha')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- DESCRIPCIÓN (OPCIONAL) -->
                        <div>
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Descripción / Concepto
                            </label>
                            <textarea id="descripcion"
                                      name="descripcion" 
                                      rows="3"
                                      placeholder="Descripción de los servicios o productos facturados"
                                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-100 @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                            <!-- Mensaje de error para descripción -->
                            @error('descripcion')
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
                            <a href="{{ route('facturas.index') }}" 
                               class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                Cancelar
                            </a>
                            
                            <!-- Botón Guardar -->
                            <button type="submit" 
                                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors duration-200">
                                Crear Factura
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>