<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Builder\ProcesoBuilder;
use App\Entities\Cliente;
use Illuminate\Support\Facades\DB;

class Proceso extends Model
{
    protected $table = 'proceso';

    protected $primaryKey = 'id_proceso';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_proceso", "id_cliente", "id_carpeta", "numero_proceso", "id_tipo_proceso", "id_entidad_demandada", "id_usuario_responsable", "valor_estudio", "fecha_retiro_servicio", "id_ultima_entidad_servicio", "id_acto_administrativo_retiro", "id_municipio", "normatividad_aplicada_caso", "observaciones_caso", "codigo_indice_archivos", "estado_proceso", "fecha_creacion", "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion", 'eliminado', 'id_entidad_justicia', 'dar_informacion_caso', 'id_etapa_proceso'
    ];

    public function newEloquentBuilder($builder)
    {
        return new ProcesoBuilder($builder, $this);
    }

    public static function getAll()
    {
        return self::select('*', DB::raw("(select count(*) from proceso_bitacora pb where pb.id_proceso = proceso.id_proceso ) as totalComentarios"))
            ->leftjoin('tipo_proceso as tp', 'tp.id_tipo_proceso', 'proceso.id_tipo_proceso')
            ->leftjoin('entidad_demandada as ed', 'ed.id_entidad_demandada', 'proceso.id_entidad_demandada')
            ->leftjoin('municipio as m', 'm.id_municipio', 'proceso.id_municipio')
            ->leftjoin('entidad_justicia as ej', 'ej.id_entidad_justicia', 'proceso.id_entidad_justicia')
            ->leftjoin('usuario as u', 'u.id_usuario', 'proceso.id_usuario_responsable')
            ->leftjoin('cliente as c', 'c.id_cliente', 'proceso.id_cliente')
            ->leftjoin('persona as p', 'p.id_persona', 'c.id_persona')
            ->where('proceso.eliminado', 0);
    }

    public static function get($id)
    {
        return self::leftjoin('municipio as mu', 'mu.id_municipio', 'proceso.id_municipio')
            ->leftjoin('departamento as de', 'de.id_departamento', 'mu.id_departamento')
            ->where('id_proceso', $id)
            ->first();
    }

    public function getNombreCompletoCliente()
    {
        $cliente = Cliente::find($this->id_cliente);
        return $cliente->getNombreCompleto();
    }

    public function getNombreCompletoResponsable()
    {
        $usuario = Usuario::find($this->id_usuario_responsable);
        return $usuario->getNombreCompleto();
    }
}
