<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProcesoDocumento extends Model
{
    protected $table = 'proceso_documento';

    protected $primaryKey = 'id_proceso_documento';

    public $timestamps = false;

    protected $fillable = [
        "id_proceso_documento", "id_proceso", "id_documento", "ruta_fisica_archivo", "ruta_http_archivo", "nombre_archivo",
        "id_usuario_creacion"
    ];
}
