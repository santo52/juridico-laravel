<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ClaseEstado extends Model
{
    protected $table = 'clase_estado';

    protected $primaryKey = 'id_clase_estado';

    public $timestamps = false;

    protected $fillable = [
        "id_clase_estado", "nombre_clase_estado"
    ];
}
