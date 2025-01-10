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
            $table->unsignedBigInteger('escolaridad'); // Clave foránea

            $table->foreign('escolaridad')->references('id')->on('escolaridad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registro_atencion_sedes', function (Blueprint $table) {
            // Eliminar la columna 'escolaridad' y su llave foreanea
            $table->dropForeign(['escolaridad']);
            $table->dropColumn('escolaridad');
        });
    }
};
