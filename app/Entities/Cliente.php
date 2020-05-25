<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Persona;

class Cliente extends Model
{
    protected $table = 'cliente';

    protected $primaryKey = 'id_cliente';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_cliente", "id_persona", "id_intermediario", "id_contacto", "estado_vital_cliente",
        "fecha_fallecimiento", "nombre_persona_recomienda", "numero_documento_beneficiario",
        "nombre_beneficiario", "parentesco_beneficiario", "estado_cliente", "fecha_creacion",
        "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion", "eliminado",
        'celular2', 'id_tipo_documento_beneficiario'
    ];

    public function getNombreCompleto() {
        $persona = Persona::find($this->id_persona);
        return $persona->getNombreCompleto();
    }
}
