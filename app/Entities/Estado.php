<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estado';

    protected $primaryKey = 'id_estado';

    protected $timestamps = false;

    protected $fillable = [
        "id_estado", "id_clase_estado", "codigo_estado", "nombre_estado"
    ];
}
