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
        Schema::create('registro_atencion_sedes', function (Blueprint $table) {
            $table->id();
            $table->integer('no_exp');
            $table->date('fecha_exp'); #
            $table->time('hora_exp'); #
            $table->date('fecha_pa'); #
            $table->string('nombre', 50); #
            $table->string('seg_nombre', 50)->nullable(); #
            $table->string('ter_nombre', 50)->nullable(); #
            $table->string('apellido', 50); #
            $table->string('apellido2', 50)->nullable(); #
            $table->string('apellido_cas', 50)->nullable(); #
            $table->date('fecha_nac'); #
            $table->integer('edad')->nullable();
            $table->string('sexo', 15); #
            $table->string('nacionalidad', 80)->nullable(); #
            $table->string('estado_civil', 50)->nullable(); #
            $table->unsignedBigInteger('escolaridad'); // Clave foránea
            $table->unsignedBigInteger('pueblo'); // Clave foránea
            $table->unsignedBigInteger('comunidad_linguistica'); // Clave foránea
            $table->string('religion', 50)->nullable(); #
            $table->string('profesion', 50)->nullable(); #
            $table->string('discapacidad', 50)->nullable(); #
            $table->string('hijos', 2)->nullable(); #
            $table->string('hijas', 2)->nullable(); #
            $table->string('direccion_casa', 150)->nullable(); #
            $table->string('tel_casaa', 15)->nullable(); #
            $table->string('tel_movil', 15)->nullable(); #
            $table->string('tel_referencia', 15)->nullable(); #
            $table->unsignedBigInteger('nac_department_id'); // Clave foránea
            $table->unsignedBigInteger('nac_muni_id'); // Clave foránea
            $table->string('ocupacion', 50)->nullable(); #
            $table->boolean('trabaja')->default(false); #

            //P3 MC
            $table->string('identificacion_necesidades', 75)->nullable();
            $table->string('servicios_brindados', 75)->nullable();
            $table->string('riesgo_violencia', 75)->nullable();
            $table->string('agresor', 75)->nullable();
            $table->string('frecuencia_eventos', 75)->nullable();
            $table->string('historial_acciones_usuario', 75)->nullable();
            $table->string('motivo_consulta', 75)->nullable();
            $table->string('tipo_atencion', 75)->nullable();

            //
            $table->unsignedBigInteger('tipo_servicio_id'); // Clave foránea
            $table->unsignedBigInteger('user_creator_id'); // Clave foránea


            $table->foreign('nac_department_id')->references('id')->on('departments');
            $table->foreign('nac_muni_id')->references('id')->on('municipios');
            $table->foreign('escolaridad')->references('id')->on('escolaridad');
            $table->foreign('pueblo')->references('id')->on('pueblos');
            $table->foreign('comunidad_linguistica')->references('id')->on('comunidad_linguistica');

            $table->foreign('user_creator_id')->references('id')->on('users');
            $table->foreign('tipo_servicio_id')->references('id')->on('service_types')->onDelete('cascade');

            $table->boolean('estado')->default(true);
            $table->timestamps();

            //--------------------------------------
//            $table->date('fecha_exp'); #
//            $table->string('tipologia', 50); #
//            $table->string('rama_drecho', 20); #
//            $table->string('tipo_atencion', 35); #
//            $table->string('tipo_caso', 35); #
//            $table->string('dpi', 13)->nullable();; #
//            $table->string('apellido', 50); #
//            $table->string('apellido2', 50)->nullable(); #
//            $table->string('apellido_cas', 50)->nullable(); #
//            $table->string('nombre', 50); #
//            $table->string('seg_nombre', 50)->nullable(); #
//            $table->string('ter_nombre', 50)->nullable(); #
//            $table->string('sexo', 15); #
//            $table->date('fecha_nac'); #
//            $table->unsignedBigInteger('nac_department_id'); // Clave foránea
//            $table->unsignedBigInteger('nac_muni_id'); // Clave foránea
//            $table->unsignedBigInteger('pueblo'); // Clave foránea
//            $table->unsignedBigInteger('comunidad_linguistica'); // Clave foránea
//            $table->string('ocupacion', 50)->nullable(); #
//            $table->boolean('trabaja')->default(false); #
//            $table->string('telefono', 15)->nullable(); #
//            $table->unsignedBigInteger('escolaridad'); // Clave foránea
//            $table->unsignedBigInteger('res_department_id'); // Clave foránea
//            $table->unsignedBigInteger('res_muni_id'); // Clave foránea
//            $table->string('lugar_poblado', 100)->nullable(); #
//            $table->string('direccion_res', 100)->nullable(); #
//            $table->string('institucion', 50); #
//            $table->string('programa', 50); #
//            $table->string('beneficio', 50); #
//            $table->unsignedBigInteger('ben_department_id'); // Clave foránea
//            $table->unsignedBigInteger('ben_muni_id'); // Clave foránea
//            $table->date('fecha_otor_benef'); #
//            $table->string('valor', 50)->nullable(); #
//            $table->string('Discapacidad', 50)->nullable(); #
//            $table->string('Cantidad', 50)->nullable(); #
//            $table->unsignedBigInteger('idioma'); // Clave foránea
//            $table->string('descripcion_caso'); #
//
//
//
//            $table->foreign('nac_department_id')->references('id')->on('departments');
//            $table->foreign('nac_muni_id')->references('id')->on('municipios');
//            $table->foreign('pueblo')->references('id')->on('pueblos');
//            $table->foreign('comunidad_linguistica')->references('id')->on('comunidad_linguistica');
//            $table->foreign('escolaridad')->references('id')->on('escolaridad');
//            $table->foreign('res_department_id')->references('id')->on('departments');
//            $table->foreign('res_muni_id')->references('id')->on('municipios');
//            $table->foreign('ben_department_id')->references('id')->on('departments');
//            $table->foreign('ben_muni_id')->references('id')->on('municipios');
//            $table->foreign('idioma')->references('id')->on('idioma');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_atencion_sedes');
    }
};
