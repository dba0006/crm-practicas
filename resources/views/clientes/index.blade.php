{{-- 
    LISTADO DE CLIENTES
    ===================
    
    Esta vista muestra una tabla con todos los clientes registrados en el sistema.
    Incluye funcionalidades para:
    - Crear nuevos clientes
    - Ver detalles de cada cliente
    - Editar información existente
    - Eliminar clientes (con confirmación)
    
    Usa Tailwind CSS para un diseño consistente con el resto de la aplicación.
--}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Clientes') }}
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
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Gestión de Clientes</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Base de datos de contactos y empresas</p>
                        </div>
                        <a href="{{ route('clientes.create') }}" 
                           class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-colors font-medium shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Nuevo Cliente
                        </a>
                    </div>

                    <!-- TABLA DE CLIENTES -->
                    @if($clientes->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Teléfono</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($clientes as $cliente)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $cliente->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $cliente->nombre }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $cliente->email }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $cliente->telefono ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                                <!-- BOTÓN VER -->
                                                <a href="{{ route('clientes.show', $cliente) }}" 
                                                   class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                    Ver
                                                </a>
                                                
                                                <!-- BOTÓN EDITAR -->
                                                <a href="{{ route('clientes.edit', $cliente) }}" 
                                                   class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">
                                                    Editar
                                                </a>
                                                
                                                <!-- BOTÓN ELIMINAR -->
                                                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?')">
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
                        <!-- MENSAJE CUANDO NO HAY CLIENTES -->
                        <div class="text-center py-8">
                            <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m3 5.197v-1a4 4 0 00-3-3.87M9 12a4 4 0 100-8 4 4 0 000 8zm0 0a6 6 0 016 6v1H3v-1a6 6 0 016-6z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No hay clientes</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Empieza creando tu primer cliente.</p>
                            <div class="mt-6">
                                <a href="{{ route('clientes.create') }}" 
                                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                    + Crear Primer Cliente
                                </a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
</x-app-layout>
