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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id(); // Identificador único de la factura
            $table->unsignedBigInteger('cliente_id'); // Relación con cliente
            $table->date('fecha'); // Fecha de emisión
            $table->decimal('total', 10, 2); // Importe total
            $table->string('estado')->default('pendiente'); // Estado de la factura
            $table->timestamps(); // Marca de tiempo

            // Clave foránea: una factura pertenece a un cliente
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::dropIfExists('facturas'); // Elimina la tabla facturas si existe
    }
};
