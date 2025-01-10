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
        Schema::create('coordinacion_interinstitucional', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('nombre', 50);
            $table->string('dpi', 13);
            $table->string('sexo', 15);
            $table->string('edad', 3);
            $table->string('pueblo', 25);
            $table->string('estado_civil', 15);
            $table->string('escolaridad', 25);
            $table->text('descripcion_caso');
            $table->string('referida_instituciones', 25);
            $table->string('referida_departamento', 25);
            $table->string('tipo_asesoria', 35);

            $table->unsignedBigInteger('tipo_servicio_id'); // Clave foránea
            $table->unsignedBigInteger('user_creator_id'); // Clave foránea

            $table->foreign('user_creator_id')->references('id')->on('users');
            $table->foreign('tipo_servicio_id')->references('id')->on('service_types')->onDelete('cascade');

            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coordinacion_interinstitucional');
    }
};
