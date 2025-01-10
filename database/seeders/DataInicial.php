<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataInicial extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //DATOS PARA LA TABLA DEPARTAMENTOS
        DB::table('departments')->insert([
            ['id' => 1, 'name' => 'GUATEMALA', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 2, 'name' => 'EL PROGRESO', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 3, 'name' => 'SACATEPEQUEZ', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 4, 'name' => 'CHIMALTENANGO', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 5, 'name' => 'ESCUINTLA', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 6, 'name' => 'SANTA ROSA', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 7, 'name' => 'SOLOLA', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 8, 'name' => 'TOTONICAPAN', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 9, 'name' => 'QUETZALTENANGO', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 10, 'name' => 'SUCHITEPEQUEZ', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 11, 'name' => 'RETALHULEU', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 12, 'name' => 'SAN MARCOS', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 13, 'name' => 'HUEHUETENANGO', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 14, 'name' => 'EL QUICHE', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 15, 'name' => 'BAJA VERAPAZ', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 16, 'name' => 'ALTA VERAPAZ', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 17, 'name' => 'EL PETEN', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 18, 'name' => 'IZABAL', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 19, 'name' => 'ZACAPA', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 20, 'name' => 'CHIQUIMULA', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 21, 'name' => 'JALAPA', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 22, 'name' => 'JUTIAPA', 'created_at' => NULL, 'updated_at' => NULL],
        ]);

        //LLENAR TABLA TIPO DE SERVICIO
        DB::table('service_types')->insert([
            ['id' => 2, 'cod_service' => '01', 'nombre_servicio' => 'Centro De Llamadas', 'created_at' => NULL, 'updated_at' => NULL],
        ]);

        //LLENAR DATO TABLA USUARIO
        DB::table('users')->insert([
            'cod_user' => '010101',
            'name' => 'Jerry',
            'apellidos' => 'Cordero',
            'email' => 'jerry@demi.gt',
            'password' => bcrypt('Demo123#'),
            'tipo_servicio_id' => 2,
            'departamento_id' => 1,
            'rol' => 'Administrador',
            'estado' => 1,
        ]);

        //DATOS TABLA COORDINACION
        DB::table('coordinations')->insert([
            ['id' => 1, 'nombre' => 'PNC', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 2, 'nombre' => 'MP', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 3, 'nombre' => 'PGN', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 4, 'nombre' => 'Fiscalia de la Mujer', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 5, 'nombre' => 'PDH', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 6, 'nombre' => 'Adulto Mayor', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 7, 'nombre' => 'DMM', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 8, 'nombre' => 'Seguro Escolar', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 9, 'nombre' => 'CONRED', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 10, 'nombre' => 'Hospital San Juan de Dios', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 11, 'nombre' => 'Hospital Roosevelt', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 12, 'nombre' => 'COVIAL', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 13, 'nombre' => 'IGSS', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 14, 'nombre' => 'Otros', 'created_at' => NULL, 'updated_at' => NULL],
        ]);

        //DATOS TABLA DERIVADAS
        DB::table('derivadas')->insert([
            ['id' => 1, 'nombre' => 'PNC', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 2, 'nombre' => 'MP', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 3, 'nombre' => 'PGN', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 4, 'nombre' => 'Fiscalia de la Mujer', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 5, 'nombre' => 'PDH', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 6, 'nombre' => 'Adulto Mayor', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 7, 'nombre' => 'DMM', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 8, 'nombre' => 'Seguro Escolar', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 9, 'nombre' => 'CONRED', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 10, 'nombre' => 'Hospital San Juan de Dios', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 11, 'nombre' => 'Hospital Roosevelt', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 12, 'nombre' => 'COVIAL', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 13, 'nombre' => 'IGSS', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 14, 'nombre' => 'Otros', 'created_at' => NULL, 'updated_at' => NULL],
        ]);

    }
}
