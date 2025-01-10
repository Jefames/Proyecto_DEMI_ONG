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
            $table->string('estado_expediente_unidad_psicologica', 25)->nullable();
            $table->string('atencion_psicologica_recibida', 250)->nullable();
            $table->string('lugar_atencion_psicologica_recibida', 200)->nullable();
            $table->string('tipo_atencion_brindada', 50)->nullable();
            $table->string('fechas_atencion_recibidas', 250)->nullable();
            $table->string('tipos_violencia',75)->nullable();
            $table->string('sesion_atencion', 1500)->nullable();
            $table->string('diagnostico_atencion', 1500)->nullable();
            $table->string('evaluacion_atencion', 1500)->nullable();
            $table->string('orientacion_psicologica', 75)->nullable();
            $table->string('sesion_orientacion', 1500)->nullable();
            $table->string('diagnostico_orientacion', 1500)->nullable();
            $table->string('referida_a_unidad_psicologica', 150)->nullable();
            $table->string('observaciones_unidad_psicologica', 1500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registro_atencion_sedes', function (Blueprint $table) {
            $table->dropColumn('estado_expediente_unidad_psicologica');
            $table->dropColumn('atencion_psicologica_recibida');
            $table->dropColumn('lugar_atencion_psicologica_recibida');
            $table->dropColumn('tipo_atencion_brindada');
            $table->dropColumn('fechas_atencion_recibidas');
            $table->dropColumn('tipos_violencia');
            $table->dropColumn('sesion_atencion');
            $table->dropColumn('diagnostico_atencion');
            $table->dropColumn('evaluacion_atencion');
            $table->dropColumn('orientacion_psicologica');
            $table->dropColumn('sesion_orientacion');
            $table->dropColumn('diagnostico_orientacion');
            $table->dropColumn('referida_a_unidad_psicologica');
            $table->dropColumn('observaciones_unidad_psicologica');
        });
    }
};
