<?php

namespace App\Entities;

use \App\BaseModel;
use App\Builder\ProcesoBuilder;
use Illuminate\Support\Facades\DB;

class Proceso extends BaseModel
{
    protected $table = 'proceso';

    protected $primaryKey = 'id_proceso';

    const CREATED_AT = 'fecha_creacion';

    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        "id_proceso", "id_cliente", "id_carpeta", "numero_proceso",
        "id_tipo_proceso", "id_entidad_demandada", "id_usuario_responsable",
        "valor_estudio", "fecha_retiro_servicio", "ultima_entidad_retiro",
        "acto_administrativo", "id_municipio", "normatividad_aplicada_caso",
        "observaciones_caso", "codigo_indice_archivos", "estado_proceso", "fecha_creacion",
        "id_usuario_creacion", "fecha_actualizacion", "id_usuario_actualizacion", 'eliminado',
        'id_entidad_justicia', 'dar_informacion_caso', 'id_etapa_proceso', 'caducidad',
        'entidad_justicia_primera_instancia', 'entidad_justicia_segunda_instancia', 'cuantia_demandada',
        'estimacion_pretenciones', 'valor_final_sentencia', 'fecha_radicacion_cumplimineto',
        'fecha_pago', 'ubicacion_fisica_archivo_muerto'
    ];

    public function newEloquentBuilder($builder)
    {
        return new ProcesoBuilder($builder, $this);
    }

    public function procesoEtapa() {
        return $this->hasMany('App\Entities\ProcesoEtapa', 'id_proceso', 'id_proceso');
    }

    // public function entidadJusticiaPrimeraInstancia()
    // {
    //     return $this->hasOne('App\Entities\EntidadJusticia', 'id_entidad_justicia', 'entidad_justicia_primera_instancia');
    // }

    // public function entidadJusticiaSegundaInstancia()
    // {
    //     return $this->hasOne('App\Entities\EntidadJusticia', 'id_entidad_justicia', 'entidad_justicia_segunda_instancia');
    // }

    public function responsable()
    {
        return $this->hasOne('App\Entities\Usuario', 'id_usuario', 'id_usuario_responsable');
    }

    public function etapa()
    {
        return $this->hasOne('App\Entities\EtapaProceso', 'id_etapa_proceso', 'id_etapa_proceso');
    }

    public function cliente()
    {
        return $this->hasOne('App\Entities\Cliente', 'id_cliente', 'id_cliente');
    }

    public function tipoProceso()
    {
        return $this->hasOne('App\Entities\TipoProceso', 'id_tipo_proceso', 'id_tipo_proceso');
    }

    public function entidadDemandada()
    {
        return $this->hasOne('App\Entities\EntidadDemandada', 'id_entidad_demandada', 'id_entidad_demandada');
    }

    public function entidadJusticia()
    {
        return $this->hasOne('App\Entities\EntidadJusticia', 'id_entidad_justicia', 'id_entidad_justicia');
    }

    public function municipio()
    {
        return $this->hasOne('App\Entities\Municipio', 'id_municipio', 'id_municipio');
    }

    public static function getAll()
    {
        return self::with('tipoProceso', 'entidadDemandada', 'municipio', 'entidadJusticia', 'cliente.persona', 'responsable', 'etapa')
            ->select('*', DB::raw("(select count(*) from proceso_bitacora pb where pb.id_proceso = proceso.id_proceso ) as totalComentarios"))
            ->where('proceso.eliminado', 0);
    }

    public static function get($id)
    {
        return self::with('municipio.departamento', 'cliente.persona', 'cliente.intermediario.persona', 'responsable', 'etapa')
            ->where('id_proceso', $id)
            ->first();
    }

    public function getNombreCompletoCliente()
    {
        return $this->cliente ? $this->cliente->getNombreCompleto() : '';
    }

    public function getFechaCreacion()
    {
        $timestamp = strtotime($this->fecha_creacion);
        return date('d/m/Y', $timestamp);
    }

    public function getHoraCreacion()
    {
        $timestamp = strtotime($this->fecha_creacion);
        return date('h:i A', $timestamp);
    }

    public function getPais()
    {
        return 'Colombia';
    }

    public function getDepartamento()
    {
        $municipio = $this->municipio;
        return $municipio ? $municipio->departamento->nombre_departamento : '';
    }

    public function getMunicipio()
    {
        $municipio = $this->municipio;
        return $municipio ? $municipio->nombre_municipio : '';
    }

    public function getTipoProceso()
    {
        return $this->tipoProceso->nombre_tipo_proceso;
    }

    public function getEntidadDemandada()
    {
        return $this->entidadDemandada->nombre_entidad_demandada;
    }

    public function getEntidadJusticia()
    {
        return $this->entidadJusticia->nombre_entidad_justicia;
    }

    public function getFechaRetiroServicioString()
    {
        if (empty($this->fecha_retiro_servicio)) {
            return '';
        }

        $timestamp = strtotime($this->fecha_retiro_servicio);
        return date('d/m/Y', $timestamp);
    }

    public function getFechaRetiroServicio()
    {
        return $this->fecha_retiro_servicio ? $this->fecha_retiro_servicio : 'Sin fecha';
    }
}
