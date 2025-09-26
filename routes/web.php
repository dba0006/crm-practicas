<?php

/**
 * RUTAS WEB DEL CRM LARAVEL
 * ========================
 * 
 * Este archivo define todas las rutas web de la aplicación CRM.
 * Organizado en secciones lógicas para fácil mantenimiento.
 * 
 * Estructura:
 * 1. Rutas públicas (welcome, etc.)
 * 2. Rutas protegidas por autenticación (dashboard, profile)
 * 3. Rutas CRUD para módulos del CRM (clientes, incidencias, facturas)
 * 4. Rutas de autenticación (incluidas desde auth.php)
 */

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/**
 * RUTA PRINCIPAL DE LA APLICACIÓN
 * ===============================
 * Página de bienvenida que se muestra a usuarios no autenticados.
 * No requiere autenticación y sirve como landing page.
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * DASHBOARD PRINCIPAL
 * ==================
 * Página principal del CRM que se muestra después del login.
 * Requiere que el usuario esté autenticado y su email verificado.
 * 
 * Middleware aplicado:
 * - auth: Usuario debe estar logueado
 * - verified: Email debe estar verificado
 */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * RUTAS DE GESTIÓN DE PERFIL DE USUARIO
 * =====================================
 * Grupo de rutas protegidas para que los usuarios gestionen sus perfiles.
 * Todas requieren autenticación (middleware 'auth').
 * 
 * Rutas incluidas:
 * - GET /profile: Mostrar formulario de edición
 * - PATCH /profile: Actualizar datos del perfil
 * - DELETE /profile: Eliminar cuenta de usuario
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * RUTAS CRUD PARA GESTIÓN DE CLIENTES
 * ===================================
 * Sistema completo de gestión de clientes con todas las operaciones CRUD.
 * 
 * Rutas automáticas generadas por Route::resource():
 * - GET /clientes                    → index   (Listar todos los clientes)
 * - GET /clientes/create             → create  (Formulario para nuevo cliente)
 * - POST /clientes                   → store   (Guardar nuevo cliente)
 * - GET /clientes/{id}               → show    (Ver detalles de un cliente)
 * - GET /clientes/{id}/edit          → edit    (Formulario para editar cliente)
 * - PUT/PATCH /clientes/{id}         → update  (Actualizar cliente existente)
 * - DELETE /clientes/{id}            → destroy (Eliminar cliente)
 * 
 * Middleware: Requiere autenticación para acceder a cualquier ruta
 */
Route::resource('clientes', App\Http\Controllers\ClienteController::class)->middleware('auth');

/**
 * RUTAS CRUD PARA GESTIÓN DE INCIDENCIAS
 * ======================================
 * Sistema de tickets y gestión de incidencias/soporte técnico.
 * Misma estructura que clientes pero para manejo de incidencias.
 * 
 * Funcionalidades:
 * - Crear nuevas incidencias
 * - Asignar incidencias a clientes
 * - Seguimiento del estado de resolución
 * - Historial de incidencias por cliente
 * 
 * Middleware: Requiere autenticación
 */
Route::resource('incidencias', App\Http\Controllers\IncidenciaController::class)->middleware('auth');

/**
 * RUTAS CRUD PARA GESTIÓN DE FACTURAS
 * ===================================
 * Sistema completo de facturación y gestión financiera.
 * Permite crear, editar y gestionar facturas de clientes.
 * 
 * Funcionalidades:
 * - Crear facturas para clientes existentes
 * - Gestionar estados de pago
 * - Consultar historial de facturación
 * - Generar reportes financieros
 * 
 * Middleware: Requiere autenticación
 */
Route::resource('facturas', App\Http\Controllers\FacturaController::class)->middleware('auth');

/**
 * RUTAS DE GESTIÓN DE TRABAJADORES (SOLO ADMINISTRADORES)
 * =======================================================
 * Sistema de gestión de usuarios/trabajadores exclusivo para administradores.
 * Permite crear, listar y eliminar cuentas de trabajadores.
 * 
 * Rutas incluidas:
 * - GET /trabajadores              → index   (Listar trabajadores)
 * - GET /trabajadores/create       → create  (Formulario nuevo trabajador)
 * - POST /trabajadores             → store   (Guardar nuevo trabajador)
 * - DELETE /trabajadores/{id}      → destroy (Eliminar trabajador)
 * 
 * Middleware: 
 * - auth: Requiere autenticación
 * - admin: Solo administradores pueden acceder
 */
Route::middleware(['auth', 'admin'])->prefix('trabajadores')->name('users.')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('create');
    Route::post('/', [App\Http\Controllers\UserController::class, 'store'])->name('store');
    Route::delete('/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('destroy');
});

/**
 * RUTAS DE AUTENTICACIÓN
 * =====================
 * Incluye todas las rutas relacionadas con autenticación:
 * - Login/Logout
 * - Registro de usuarios
 * - Recuperación de contraseñas
 * - Verificación de email
 * - Confirmación de contraseñas
 * 
 * Estas rutas están definidas en el archivo routes/auth.php
 * y son generadas automáticamente por Laravel Breeze.
 */
require __DIR__.'/auth.php';
