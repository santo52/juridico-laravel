<?php

namespace App\Entities;

use \App\BaseModel;
use App\Builders\Builder;

class TipoResultado extends BaseModel
{
    protected $table = 'tipo_resultado';

    protected $primaryKey = 'id_tipo_resultado';

    public $timestamps = false;

    protected $fillable = [
        "id_tipo_resultado", "nombre_tipo_resultado", "unico_tipo_resultado", "eliminado",
        "tipo_campo"
    ];

    public function procesoTiposResultado()
    {
        return $this->hasMany('App\Entities\ProcesoTipoResultado', 'id_tipo_resultado', 'id_tipo_resultado');
    }

    public function newEloquentBuilder($builder) {
        return new Builder($builder, $this);
    }
}

