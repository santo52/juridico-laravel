<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'pais';

    protected $primaryKey = 'id_pais';

    protected $timestamps = false;

    protected $fillable = [
        "id_pais", "nombre_pais"
    ];
}
