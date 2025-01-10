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
            $table->string('estado_expediente_unidad_juridica', 255)->nullable();
            $table->string('tipologia', 50)->nullable();
            $table->string('familia', 50)->nullable();
            $table->string('recepcion_documentos', 50)->nullable();
            $table->string('redaccion_demanda', 50)->nullable();
            $table->string('firma_demanda', 50)->nullable();
            $table->string('ingreso_demanda', 50)->nullable();
            $table->string('recepcion_demanda', 50)->nullable();
            $table->string('fechas_audiencia', 500)->nullable();
            $table->string('redaccion_otros_memoriales', 50)->nullable();
            $table->string('conclusion_este_proceso', 50)->nullable();
            $table->string('referida_a_unidad_juridica', 50)->nullable();
            $table->string('observaciones_unidad_juridica', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registro_atencion_sedes', function (Blueprint $table) {
            $table->dropColumn('estado_expediente_unidad_juridica');
            $table->dropColumn('tipologia');
            $table->dropColumn('familia');
            $table->dropColumn('recepcion_documentos');
            $table->dropColumn('redaccion_demanda');
            $table->dropColumn('firma_demanda');
            $table->dropColumn('ingreso_demanda');
            $table->dropColumn('recepcion_demanda');
            $table->dropColumn('fechas_audiencia');
            $table->dropColumn('redaccion_otros_memoriales');
            $table->dropColumn('conclusion_este_proceso');
            $table->dropColumn('referida_a_unidad_juridica');
            $table->dropColumn('observaciones_unidad_juridica');
        });
    }
};
