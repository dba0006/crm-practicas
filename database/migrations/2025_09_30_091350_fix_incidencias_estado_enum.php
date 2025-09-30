<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Para SQLite necesitamos recrear la tabla porque no soporta ALTER COLUMN en enums
        // Primero respaldamos los datos
        $incidencias = DB::table('incidencias')->get();
        
        // Eliminamos la tabla actual
        Schema::dropIfExists('incidencias');
        
        // Recreamos la tabla con el enum correcto
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->string('titulo');
            $table->text('descripcion');
            $table->enum('prioridad', ['baja', 'media', 'alta'])->default('media');
            $table->enum('estado', ['abierta', 'en_proceso', 'resuelta', 'cerrada'])->default('abierta');
            $table->date('fecha');
            $table->timestamps();
            
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
        
        // Restauramos los datos corrigiendo el estado
        foreach ($incidencias as $incidencia) {
            $estado = $incidencia->estado;
            // Convertir en_progreso a en_proceso si existe
            if ($estado === 'en_progreso') {
                $estado = 'en_proceso';
            }
            
            DB::table('incidencias')->insert([
                'id' => $incidencia->id,
                'cliente_id' => $incidencia->cliente_id,
                'titulo' => $incidencia->titulo,
                'descripcion' => $incidencia->descripcion,
                'prioridad' => $incidencia->prioridad ?? 'media',
                'estado' => $estado,
                'fecha' => $incidencia->fecha ?? now()->format('Y-m-d'),
                'created_at' => $incidencia->created_at,
                'updated_at' => $incidencia->updated_at,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Para revertir, volvemos al enum original
        $incidencias = DB::table('incidencias')->get();
        
        Schema::dropIfExists('incidencias');
        
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->string('titulo');
            $table->text('descripcion');
            $table->enum('prioridad', ['baja', 'media', 'alta'])->default('media');
            $table->enum('estado', ['abierta', 'en_progreso', 'cerrada'])->default('abierta');
            $table->date('fecha');
            $table->timestamps();
            
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
        
        foreach ($incidencias as $incidencia) {
            $estado = $incidencia->estado;
            if ($estado === 'en_proceso') {
                $estado = 'en_progreso';
            }
            if ($estado === 'resuelta') {
                $estado = 'cerrada';
            }
            
            DB::table('incidencias')->insert([
                'id' => $incidencia->id,
                'cliente_id' => $incidencia->cliente_id,
                'titulo' => $incidencia->titulo,
                'descripcion' => $incidencia->descripcion,
                'prioridad' => $incidencia->prioridad ?? 'media',
                'estado' => $estado,
                'fecha' => $incidencia->fecha ?? now()->format('Y-m-d'),
                'created_at' => $incidencia->created_at,
                'updated_at' => $incidencia->updated_at,
            ]);
        }
    }
};
