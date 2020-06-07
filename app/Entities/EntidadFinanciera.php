<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class EntidadFinanciera extends Model
{
    protected $table = 'entidad_financiera';

    protected $primaryKey = 'id_entidad_financiera';

    public $timestamps = false;

    protected $fillable = [
        'id_entidad_financiera', 'nombre_entidad_financiera', 'eliminado'
    ];
}
