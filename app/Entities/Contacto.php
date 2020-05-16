<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'contacto';

    protected $primaryKey = 'id_contacto';

    public $timestamps = false;

    protected $fillable = [
        "id_contacto", "nombre_contacto", "parentesco", "direccion", "barrio", "nombre_municipio", "celular", "telefono", "correo_electronico", "id_municipio", 'informacion_adicional', 'numero_documento'
    ];
}
