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
        Schema::table('coordinacion_interinstitucional', function (Blueprint $table) {
            
            $table->string('seg_nombre', 50)->after('nombre');
            $table->string('ter_nombre', 50)->after('seg_nombre');
            $table->string('apellido', 50)->after('ter_nombre');
            $table->string('seg_apellido', 50)->after('apellido');
            $table->string('ter_apellido', 50)->after('seg_apellido');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coordinacion_interinstitucional', function (Blueprint $table) {
            $table->dropColumn('seg_nombre');
            $table->dropColumn('ter_nombre');
            $table->dropColumn('apellido');
            $table->dropColumn('seg_apellido');
            $table->dropColumn('ter_apellido');
        });
    }
};
