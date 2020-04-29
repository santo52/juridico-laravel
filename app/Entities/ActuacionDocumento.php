<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ActuacionDocumento extends Model
{
    protected $table = 'actuacion_documento';

    protected $primaryKey = 'id_actuacion_documento';

    protected $timestamps = false;

    protected $fillable = [
        "id_actuacion_documento", "id_actuacion", "id_documento"
    ];
}
