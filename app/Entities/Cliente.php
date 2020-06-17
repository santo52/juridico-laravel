<?php

namespace App\Entities;

use \App\BaseModel;
use App\Entities\Persona;
use App\Builder\ClienteBuilder;

class Cliente extends BaseModel
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
        'celular2', 'id_tipo_documento_beneficiario', 'telefono_beneficiario', 'celular_beneficiario',
        'celular2_beneficiario', 'correo_electronico_beneficiario'
    ];

    public function persona()
    {
        return $this->hasOne('App\Entities\Persona', 'id_persona', 'id_persona');
    }

    public function honorarios() {
        return $this->hasMany('App\Entities\Honorario', 'id_cliente', 'id_cliente');
    }

    public function contacto()
    {
        return $this->hasOne('App\Entities\Contacto', 'id_contacto', 'id_contacto');
    }

    public function tipoDocumentoBeneficiario()
    {
        return $this->hasOne('App\Entities\TipoDocumento', 'id_tipo_documento', 'id_tipo_documento_beneficiario');
    }

    public function intermediario()
    {
        return $this->hasOne('App\Entities\Intermediario', 'id_intermediario', 'id_intermediario');
    }

    public function procesos()
    {
        return $this->belongsTo('App\Entities\Proceso');
    }

    public function getSiglasTipoDocumento()
    {
        return $this->persona->getSiglasTipoDocumento();
    }

    public function getNombreCompleto()
    {
        return $this->persona->getNombreCompleto();
    }

    public function getTipoDocumento()
    {
        return $this->persona->getTipoDocumento();
    }

    public function getFechaCreacion($format = 'Y-m-d h:i:s')
    {
        return date($format, strtotime($this->fecha_creacion));
    }

    public function getEstadoVital()
    {
        return $this->estado_vital_cliente == 1 ? 'vivo' : 'fallecido';
    }

    public function getNumeroDocumento()
    {
        return $this->persona->numero_documento;
    }

    public function getLugarExpedicionDocumento()
    {
        return $this->persona->getLugarExpedicionDocumento();
    }

    public function getPrimerNombre() {
        return $this->persona->primer_nombre;
    }

    public function getPrimerApellido() {
        return $this->persona->primer_apellido;
    }

    public function getSegundoNombre() {
        return $this->persona->segundo_nombre;
    }

    public function getSegundoApellido() {
        return $this->persona->segundo_apellido;
    }

    public function getTelefono() {
        return $this->persona->telefono;
    }

    public function getCelular() {
        return $this->persona->celular;
    }

    public function getEmail() {
        return $this->persona->correo_electronico;
    }

    public function getDireccion() {
        return $this->persona->direccion;
    }

    public function getBarrio() {
        return $this->persona->barrio;
    }

    public function getTipoDocumentoBeneficiario() {
        return $this->tipoDocumentoBeneficiario ? $this->tipoDocumentoBeneficiario->nombre_tipo_documento : 'Ninguno';
    }

    public function getDocumentoBeneficiario() {
        return $this->numero_documento_beneficiario;
    }

    public function getParentescoBeneficiario() {
        return $this->parentesco_beneficiario;
    }

    public function getNombreBeneficiario() {
        return $this->nombre_beneficiario;
    }

    public function getNumerosContactoCliente() {
        $telefono = trim($this->getTelefono());
        $celular = trim($this->getCelular());
        $celular2 = trim($this->celular2);

        $compiled = [];

        if($telefono) {
            $compiled[] = $telefono;
        }

        if($celular) {
            $compiled[] = $celular;
        }

        if($celular2) {
            $compiled[] = $celular2;
        }

        return implode(' | ', $compiled);
    }

    public function getNumerosContactoBeneficiario() {
        $telefono = trim($this->telefono_beneficiario);
        $celular = trim($this->celular_beneficiario);
        $celular2 = trim($this->celular2_beneficiario);

        $compiled = [];

        if($telefono) {
            $compiled[] = $telefono;
        }

        if($celular) {
            $compiled[] = $celular;
        }

        if($celular2) {
            $compiled[] = $celular2;
        }

        return implode(' | ', $compiled);
    }
}
