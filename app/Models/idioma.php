<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class idioma extends Model
{
    use HasFactory;
    protected $table = 'idioma';


    public function expediente()
    {
        return $this->belongsToMany(Registro_Atencion_Sedes::class);
    }
}
