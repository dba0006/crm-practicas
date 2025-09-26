<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id(); // Identificador único de la incidencia
            $table->unsignedBigInteger('cliente_id'); // Relación con cliente
            $table->string('titulo'); // Título breve de la incidencia
            $table->text('descripcion'); // Descripción de la incidencia
            $table->enum('estado', ['abierta', 'en_progreso', 'cerrada'])->default('abierta'); // Estado
            $table->timestamps(); // Marca de tiempo

            // Clave foránea: una incidencia pertenece a un cliente
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::dropIfExists('incidencias'); // Elimina la tabla incidencias si existe
    }
};
