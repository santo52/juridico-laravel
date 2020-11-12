<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';

    protected $primaryKey = 'id_area';

    public $timestamps = false;

    protected $fillable = [
        "id_area", "nombre", "eliminado"
    ];
}
