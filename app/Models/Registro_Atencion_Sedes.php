<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro_Atencion_Sedes extends Model
{
    use HasFactory;
    protected $table = 'registro_atencion_sedes';

    public function departamento()
    {
        return $this->belongsTo(Department::class, 'departamento_id');
    }

    public function escolaridad()
    {
        return $this->belongsTo(escolaridad::class);
    }

    public function comling()
    {
        return $this->belongsTo(ComunidadLinguistica::class);
    }

    public function idioma()
    {
        return $this->belongsTo(idioma::class);
    }

    public function pueblopert()
    {
        return $this->belongsTo(puebloper::class);
    }

    public function municipios()
    {
        return $this->belongsTo(municipio::class);
    }


}
