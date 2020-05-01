<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ClaseTipo extends Model
{
    protected $table = 'clase_tipo';

    protected $primaryKey = 'id_clase_tipo';

    public $timestamps = false;

    protected $fillable = [
        "id_clase_tipo", "nombre_clase_tipo"
    ];
}
