<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallCenter extends Model
{
    use HasFactory;

    public function tipoServicio()
    {
        // Esta función define una relación inversa con TipoServicio
        return $this->belongsTo(TipoServicio::class);
    }

    public function derivadas()
    {
        return $this->belongsToMany(Derivada::class);
    }

    public function coordinations()
    {
        return $this->belongsToMany(Coordination::class, 'callcenter_coordinations','call_center_id','coordinations_id');
    }
}
