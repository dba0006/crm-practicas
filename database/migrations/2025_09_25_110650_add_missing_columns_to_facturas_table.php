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
        Schema::table('facturas', function (Blueprint $table) {
            $table->string('numero')->unique()->after('cliente_id');
            $table->decimal('monto', 10, 2)->after('fecha');
            $table->decimal('impuesto', 10, 2)->default(0)->after('monto');
            $table->text('descripcion')->nullable()->after('impuesto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facturas', function (Blueprint $table) {
            $table->dropColumn(['numero', 'monto', 'impuesto', 'descripcion']);
        });
    }
};
