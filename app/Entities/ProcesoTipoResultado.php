<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProcesoTipoResultado extends Model
{
    protected $table = 'proceso_tipo_resultado';

    protected $primaryKey = 'id_proceso_tipo_resultado';

    public $timestamps = false;

    protected $fillable = [
        "id_proceso_tipo_resultado", "id_tipo_resultado", "valor_proceso_tipo_resultado", "id_proceso"
    ];

    public function proceso() {
        $this->belongsTo('App\Entities\Proceso', 'id_proceso', 'id_proceso');
    }

    public function tipoResultado() {
        $this->belongsTo('App\Entities\TipoResultado', 'id_tipo_resultado', 'id_tipo_resultado');
    }
}
