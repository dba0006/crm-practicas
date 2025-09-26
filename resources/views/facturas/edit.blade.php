{{-- 
    EDITAR FAC        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">RA
    ==============
    
    Formulario para modificar datos de facturas existentes.
    Permite actualizar información financiera, cliente asociado y estado de pago.
    
    Funcionalidades:
    - Edición de datos de factura
    - Cambio de cliente asociado
    - Actualización de montos e impuestos
    - Modificación de estado de pago
    - Validación de datos
--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Factura') }}
        </h2>
    </x-slot>

    <div class="py-0">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <!-- TARJETA PRINCIPAL -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- ENCABEZADO -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Modificar Factura #{{ $factura->numero_factura }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Actualiza la información de esta factura
                        </p>
                    </div>

                    <!-- FORMULARIO -->
                    <form action="{{ route('facturas.update', $factura) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- CLIENTE ASOCIADO -->
                        <div>
                            <label for="cliente_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Cliente *
                            </label>
                            <select name="cliente_id" id="cliente_id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" 
                                        {{ old('cliente_id', $factura->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->nombre }} - {{ $cliente->email }}
                                    </option>
                                @endforeach
                            </select>
                            @error('cliente_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NÚMERO DE FACTURA (NO EDITABLE) -->
                        <div>
                            <label for="numero_factura" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Número de Factura
                            </label>
                            <input type="text" value="{{ $factura->numero_factura }}" readonly
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-700 shadow-sm bg-gray-100 cursor-not-allowed">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                El número de factura no puede modificarse
                            </p>
                        </div>

                        <!-- DESCRIPCIÓN -->
                        <div>
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Descripción/Concepto *
                            </label>
                            <textarea name="descripcion" id="descripcion" rows="3" required 
                                      placeholder="Describe los productos o servicios facturados..."
                                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descripcion', $factura->descripcion) }}</textarea>
                            @error('descripcion')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- MONTOS FINANCIEROS -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- MONTO BASE -->
                            <div>
                                <label for="monto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Monto Base ($) *
                                </label>
                                <input type="number" name="monto" id="monto" step="0.01" min="0" required 
                                       value="{{ old('monto', $factura->monto) }}"
                                       placeholder="0.00"
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('monto')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- IMPUESTO -->
                            <div>
                                <label for="impuesto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Impuesto ($)
                                </label>
                                <input type="number" name="impuesto" id="impuesto" step="0.01" min="0" 
                                       value="{{ old('impuesto', $factura->impuesto) }}"
                                       placeholder="0.00"
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('impuesto')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- TOTAL (CALCULADO) -->
                            <div>
                                <label for="total" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Total ($)
                                </label>
                                <input type="number" name="total" id="total" step="0.01" readonly 
                                       value="{{ old('total', $factura->total) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-700 shadow-sm bg-gray-100 cursor-not-allowed">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Se calcula automáticamente
                                </p>
                            </div>
                        </div>

                        <!-- FECHA DE FACTURA -->
                        <div>
                            <label for="fecha" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Fecha de Factura *
                            </label>
                            <input type="date" name="fecha" id="fecha" required 
                                   value="{{ old('fecha', $factura->fecha->format('Y-m-d')) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('fecha')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ESTADO DE PAGO -->
                        <div>
                            <label for="estado_pago" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Estado de Pago *
                            </label>
                            <select name="estado_pago" id="estado_pago" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="pendiente" {{ old('estado_pago', $factura->estado_pago) == 'pendiente' ? 'selected' : '' }}>
                                    ⏳ Pendiente
                                </option>
                                <option value="pagada" {{ old('estado_pago', $factura->estado_pago) == 'pagada' ? 'selected' : '' }}>
                                    ✅ Pagada
                                </option>
                                <option value="vencida" {{ old('estado_pago', $factura->estado_pago) == 'vencida' ? 'selected' : '' }}>
                                    ❌ Vencida
                                </option>
                            </select>
                            @error('estado_pago')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- INFORMACIÓN DE ACTUALIZACIÓN -->
                        <div class="bg-yellow-50 dark:bg-yellow-900 border border-yellow-200 dark:border-yellow-700 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-yellow-900 dark:text-yellow-100 mb-2">⚠️ Importante al editar:</h4>
                            <ul class="text-xs text-yellow-800 dark:text-yellow-200 space-y-1">
                                <li>• El número de factura no puede cambiarse</li>
                                <li>• El total se recalculará automáticamente</li>
                                <li>• Verifica que el cliente sea correcto</li>
                                <li>• Los cambios se registrarán en el historial</li>
                            </ul>
                        </div>

                        <!-- BOTONES DE ACCIÓN -->
                        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('facturas.index') }}" 
                               class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg transition-colors duration-200">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg transition-colors duration-200">
                                Actualizar Factura
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT PARA CALCULAR TOTAL AUTOMÁTICAMENTE -->
    <script>
        // Función para calcular el total automáticamente
        function calcularTotal() {
            const monto = parseFloat(document.getElementById('monto').value) || 0;
            const impuesto = parseFloat(document.getElementById('impuesto').value) || 0;
            const total = monto + impuesto;
            
            document.getElementById('total').value = total.toFixed(2);
        }

        // Escuchar cambios en monto e impuesto
        document.getElementById('monto').addEventListener('input', calcularTotal);
        document.getElementById('impuesto').addEventListener('input', calcularTotal);

        // Calcular total al cargar la página
        document.addEventListener('DOMContentLoaded', calcularTotal);
    </script>
</x-app-layout>