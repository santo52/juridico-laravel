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
        "tipo_campo", "privado"
    ];

    public function procesoTiposResultado()
    {
        return $this->hasMany('App\Entities\ProcesoTipoResultado', 'id_tipo_resultado', 'id_tipo_resultado');
    }

    public function newEloquentBuilder($builder) {
        return new Builder($builder, $this);
    }

    public function getValue() {

        if($this->tipo_campo == 5) {
            $value = number_format($this->value, 2, ',', '.');
            return "$ {$value}";
        }

        return $this->value;
    }

    public function getTipoCampo() {
        switch($this->tipo_campo) {
            case 1: return 'Alfanumerico';
            case 2: return 'Documento';
            case 3: return 'Fecha';
            case 4: return 'Numero';
            case 5: return 'Moneda';
            default: return 'Alfanumerico';
        }
    }

    public function getGrupo() {
        return $this->unico_tipo_resultado == 1 ? 'Valor específico' : 'Formato';
    }
}

