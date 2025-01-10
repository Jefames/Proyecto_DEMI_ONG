<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $table = 'municipios';

    public function departamento()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function expediente()
    {
        return $this->belongsToMany(Registro_Atencion_Sedes::class);
    }
}
