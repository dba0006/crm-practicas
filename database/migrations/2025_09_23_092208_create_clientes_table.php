<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * MIGRACIÓN: CREAR TABLA CLIENTES
 * ===============================
 * 
 * Esta migración crea la tabla 'clientes' que almacena la información
 * básica de todos los clientes del CRM. Es la tabla central del sistema
 * ya que tanto incidencias como facturas referencian a clientes.
 * 
 * Estructura de la tabla:
 * - id: Clave primaria auto-incremental
 * - nombre: Nombre completo del cliente (obligatorio)
 * - email: Dirección de correo único para identificación
 * - telefono: Número de contacto (opcional)
 * - direccion: Dirección física (opcional)
 * - timestamps: created_at y updated_at automáticos
 * 
 * Relaciones:
 * - Un cliente puede tener múltiples incidencias (1:N)
 * - Un cliente puede tener múltiples facturas (1:N)
 */
return new class extends Migration
{
    /**
     * EJECUTAR LA MIGRACIÓN
     * =====================
     * 
     * Crea la tabla 'clientes' con todos sus campos y restricciones.
     * Se ejecuta cuando se hace: php artisan migrate
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            // Clave primaria auto-incremental
            $table->id();
            
            // Información básica del cliente
            $table->string('nombre');                    // Nombre completo (obligatorio)
            $table->string('email')->unique();          // Email único para identificación
            $table->string('telefono')->nullable();     // Teléfono de contacto (opcional)
            $table->string('direccion')->nullable();    // Dirección física (opcional)
            
            // Timestamps automáticos (created_at, updated_at)
            $table->timestamps();
            
            // Índices para optimización de consultas
            $table->index('email');   // Índice en email para búsquedas rápidas
            $table->index('nombre');  // Índice en nombre para búsquedas por nombre
        });
    }

    /**
     * REVERTIR LA MIGRACIÓN
     * =====================
     * 
     * Elimina la tabla 'clientes' si existe.
     * Se ejecuta cuando se hace: php artisan migrate:rollback
     * 
     * CUIDADO: Esto eliminará todos los datos de clientes
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
