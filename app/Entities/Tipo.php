<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipo';

    protected $primaryKey = 'id_tipo';

    public $timestamps = false;

    protected $fillable = [
        "id_tipo", "id_clase_tipo", "codigo_tipo", "nombre_tipo"
    ];
}
