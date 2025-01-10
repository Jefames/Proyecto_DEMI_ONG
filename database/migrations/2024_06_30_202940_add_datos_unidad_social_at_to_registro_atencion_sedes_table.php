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
        Schema::table('registro_atencion_sedes', function (Blueprint $table) {
            $table->string('estado_expediente', 50)->nullable();
            $table->string('acciones_desarrolladas', 50)->nullable();
            $table->string('referida_a', 100)->nullable();
            $table->string('observaciones_unidad_social', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registro_atencion_sedes', function (Blueprint $table) {
            $table->dropColumn('estado_expediente');
            $table->dropColumn('acciones_desarrolladas');
            $table->dropColumn('referida_a');
            $table->dropColumn('observaciones_unidad_social');
        });
    }
};
