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
        // Primero agregar la columna estado_pago si no existe
        if (!Schema::hasColumn('facturas', 'estado_pago')) {
            Schema::table('facturas', function (Blueprint $table) {
                $table->enum('estado_pago', ['pendiente', 'pagada', 'vencida'])
                      ->default('pendiente')
                      ->after('total');
            });
        }
        
        // Luego copiar datos de la columna 'estado' a 'estado_pago' si existe la columna 'estado'
        if (Schema::hasColumn('facturas', 'estado')) {
            // Copiamos los datos
            DB::statement('UPDATE facturas SET estado_pago = estado');
            
            // Eliminamos la columna antigua 'estado'
            Schema::table('facturas', function (Blueprint $table) {
                $table->dropColumn('estado');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facturas', function (Blueprint $table) {
            // Recrear la columna 'estado' y copiar los datos de vuelta
            $table->enum('estado', ['pendiente', 'pagada', 'vencida'])
                  ->default('pendiente')
                  ->after('total');
                  
            // Copiar datos de estado_pago a estado
            DB::statement('UPDATE facturas SET estado = estado_pago');
            
            // Eliminar la columna estado_pago
            $table->dropColumn('estado_pago');
        });
    }
};
