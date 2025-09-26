<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Esta migración crea las tablas principales para la autenticación de usuarios.
// Incluye la tabla 'users', 'password_reset_tokens' y 'sessions'.
return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     * Crea la tabla de usuarios y tablas auxiliares para autenticación y sesiones.
     */
    public function up(): void
    {
        // Tabla principal de usuarios del sistema
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Identificador único del usuario
            $table->string('name'); // Nombre del usuario
            $table->string('email')->unique(); // Email único para cada usuario
            $table->timestamp('email_verified_at')->nullable(); // Fecha de verificación de email
            $table->string('password'); // Contraseña cifrada
            // Campo 'role' para definir el rol del usuario (admin, user)
            // Por defecto será 'user'.
            $table->string('role')->default('user');
            $table->rememberToken(); // Token para recordar sesión
            $table->timestamps(); // Timestamps de creación y actualización
        });

        // Tabla para almacenar tokens de recuperación de contraseña
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Email asociado al token
            $table->string('token'); // Token de recuperación
            $table->timestamp('created_at')->nullable(); // Fecha de creación del token
        });

        // Tabla para gestionar sesiones de usuario
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID de la sesión
            $table->foreignId('user_id')->nullable()->index(); // Relación con usuario (puede ser null)
            $table->string('ip_address', 45)->nullable(); // IP de la sesión
            $table->text('user_agent')->nullable(); // Navegador/cliente
            $table->longText('payload'); // Datos de la sesión
            $table->integer('last_activity')->index(); // Última actividad
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
