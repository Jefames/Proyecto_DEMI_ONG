<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordination extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'coordinations';

    use HasFactory;

    public function expediente()
    {
        return $this->belongsToMany(CallCenter::class);
    }
}
