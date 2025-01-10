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
            $table->unsignedBigInteger('nac_department_id'); // Clave foránea
            $table->unsignedBigInteger('nac_muni_id'); // Clave foránea

            $table->foreign('nac_department_id')->references('id')->on('departments');
            $table->foreign('nac_muni_id')->references('id')->on('municipios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registro_atencion_sedes', function (Blueprint $table) {
            // Eliminar la columna 'nac_department_id' y su llave foreanea
            $table->dropForeign(['nac_department_id']);
            $table->dropColumn('nac_department_id');

            // Eliminar la columna 'nac_muni_id' y su llave foreanea
            $table->dropForeign(['nac_muni_id']);
            $table->dropColumn('nac_muni_id');
        });
    }
};
