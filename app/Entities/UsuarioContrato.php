<?php

namespace App;

namespace App\Entities;

use \App\BaseModel;

class UsuarioContrato extends BaseModel
{
    protected $table = 'usuario_contrato';

    protected $primaryKey = 'id_usuario_contrato';

    public $timestamps = false;

    protected $fillable = [
        "id_usuario_contrato", "tipo_contrato", "fecha_inicio", "fecha_fin", 'id_usuario'
    ];

    public function usuario(){
        return $this->belongsTo('App\Entities\Usuario', 'id_usuario', 'id_usuario');
    }

    public static function getTiposContrato() {
        return [
            1 => "Indefinido",
            2 => "Fijo",
            3 => "Prestación de servicios",
            4 => "Obra o Labor",
            5 => "Aprendizaje",
            6 => "Ocasional de trabajo"
        ];
    }

    public function getTipoContrato() {
        $tipos = $this->getTiposContrato();
        if(!$this->tipo_contrato) {
            return $tipos[1];
        }

        return $tipos[$this->tipo_contrato];
    }

    public function getFechaInicio() {
        return $this->fecha_inicio ? $this->fecha_inicio : ' - ';
    }

    public function getFechaFin() {
        return $this->fecha_fin ? $this->fecha_fin : ' - ';
    }
}
