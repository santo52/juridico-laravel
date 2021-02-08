<?php

namespace App\Entities;

use \App\BaseModel;
use App\Builders\Builder;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;

class Usuario extends BaseModel implements
AuthenticatableContract,
AuthorizableContract,
CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;

    protected $table = 'usuario';

    protected $primaryKey = 'id_usuario';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'id_persona', 'id_perfil', 'nombre_usuario', 'contrasena',
        'estado_usuario', 'fecha_creacion', 'id_usuario_creacion', 'id_area',
        'fecha_actualizacion', 'id_usuario_actualizacion', 'password', 'eliminado'
    ];

    protected $hidden = [
        'contrasena', 'password'
    ];

    public function persona()
    {
        return $this->hasOne('App\Entities\Persona', 'id_persona', 'id_persona');
    }

    public function area()
    {
        return $this->hasOne('App\Entities\Area', 'id_area', 'id_area');
    }

    public function usuarioContratos(){
        return $this->hasMany('App\Entities\UsuarioContrato', 'id_usuario', 'id_usuario');
    }

    public function newEloquentBuilder($builder) {
        return new Builder($builder, $this);
    }

    public function getNombreCompleto($desc = true) {
        $persona = $this->persona;
        return $persona ? $persona->getNombreCompleto($desc) : $this->nombre_usuario;
    }

    public function getArea() {
        $area = $this->area;
        return $area ? $area->nombre : 'Sin area';
    }

    public function getTipoDocumento() {
        $persona = $this->persona;
        return $persona ? $persona->getTipoDocumento() : $this->nombre_usuario;
    }

    public function getSedeOperativa() {
        $persona = $this->persona;
        return $persona ? $persona->getMunicipio() : '';
    }

    public function getDireccion() {
        $persona = $this->persona;
        return $persona ? $persona->direccion : '';
    }

    public function getTelefono() {
        $persona = $this->persona;
        return $persona ? $persona->telefono : '';
    }

    public function getCorreoElectronico() {
        $persona = $this->persona;
        return $persona ? $persona->correo_electronico : '';
    }
}

