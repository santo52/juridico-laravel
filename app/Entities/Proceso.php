<?php

namespace App\Entities;

use \App\BaseModel;
use App\Builders\ProcesoBuilder;
use App\Collection\ProcesoCollection;
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

    public function newCollection(array $models = []) {
        return new ProcesoCollection($models);
    }

    public function newEloquentBuilder($builder)
    {
        return new ProcesoBuilder($builder, $this);
    }

    public function procesoEtapa() {
        return $this->hasMany('App\Entities\ProcesoEtapa', 'id_proceso', 'id_proceso');
    }

    public function procesoTiposResultado()
    {
        return $this->hasMany('App\Entities\ProcesoTipoResultado', 'id_proceso', 'id_proceso');
    }

    public function responsable()
    {
        return $this->hasOne('App\Entities\Usuario', 'id_usuario', 'id_usuario_responsable');
    }

    public function etapa()
    {
        return $this->hasOne('App\Entities\EtapaProceso', 'id_etapa_proceso', 'id_etapa_proceso');
    }

    public function honorarios(){
        return $this->hasMany('App\Entities\Honorario', 'id_proceso', 'id_proceso');
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

    public function entidadPrimeraInstancia() {
        return $this->hasOne('App\Entities\EntidadJusticia', 'id_entidad_justicia', 'entidad_justicia_primera_instancia');
    }

    public function entidadSegundaInstancia() {
        return $this->hasOne('App\Entities\EntidadJusticia', 'id_entidad_justicia', 'entidad_justicia_segunda_instancia');
    }

    public function municipio()
    {
        return $this->hasOne('App\Entities\Municipio', 'id_municipio', 'id_municipio');
    }

    public static function getAll($request = null)
    {

        $procesos = self::
            with( 'cliente.persona', 'tipoProceso', 'entidadDemandada', 'municipio', 'entidadJusticia', 'responsable', 'etapa', 'procesoEtapa.procesoEtapaActuaciones.cobro.pago')
            ->select(
                'proceso.*',
                'p.numero_documento as documento_cliente',
                'nombre_tipo_proceso',
                'nombre_entidad_demandada',
                'nombre_etapa_proceso as etapa_actual',
                'mc.nombre_municipio',
                'ejpi.nombre_entidad_justicia as entidad_primera_instancia',
                'ejsi.nombre_entidad_justicia as entidad_segunda_instancia',
                DB::raw("CONCAT(p.primer_apellido, ' ', p.segundo_apellido, ' ', p.primer_nombre, ' ', p.segundo_nombre) as nombre_cliente" ),
                DB::raw("CONCAT(pu.primer_apellido, ' ', pu.segundo_apellido, ' ', pu.primer_nombre, ' ', pu.segundo_nombre) as nombre_responsable" ),
                DB::raw("(select count(*) from proceso_bitacora pb where pb.id_proceso = proceso.id_proceso ) as totalComentarios"))
            ->leftjoin('cliente as c', 'c.id_cliente', '=', 'proceso.id_cliente')
            ->leftjoin('persona as p', 'c.id_persona', '=', 'p.id_persona')
            ->leftjoin('municipio as mc', 'mc.id_municipio', '=', 'p.id_municipio')

            ->leftjoin('usuario as u', 'u.id_usuario', '=', 'proceso.id_usuario_responsable')
            ->leftjoin('persona as pu', 'u.id_persona', '=', 'pu.id_persona')

            ->leftjoin('tipo_proceso as tp', 'tp.id_tipo_proceso', '=', 'proceso.id_tipo_proceso')
            ->leftjoin('entidad_demandada as ed', 'ed.id_entidad_demandada', '=', 'proceso.id_entidad_demandada')
            ->leftjoin('etapa_proceso as ep', 'ep.id_etapa_proceso', '=', 'proceso.id_etapa_proceso')
            ->leftjoin('entidad_justicia as ejpi', 'ejpi.id_entidad_justicia', '=', 'proceso.entidad_justicia_primera_instancia')
            ->leftjoin('entidad_justicia as ejsi', 'ejsi.id_entidad_justicia', '=', 'proceso.entidad_justicia_segunda_instancia')
            ->where('proceso.eliminado', 0);

        //app\builders\Builder.php
        return $procesos->applyFilters('id_proceso', $request, function($query, $search, $searchBy) {
            if($search && in_array('estado_proceso', $searchBy)) {

                $estado = false;
                if(strpos('activo', strtolower($search)) !== false) {
                    $estado = 1;
                } else if(strpos('finalizado', strtolower($search)) !== false) {
                    $estado = 2;
                }

                $query->orHavingRaw("estado_proceso = '{$estado}'");
            }
        });
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
        $entidad = $this->entidadDemandada;
        return $entidad ? $entidad->nombre_entidad_demandada : '';
    }

    public function getEntidadJusticia()
    {
        $entidad = $this->entidadJusticia;
        return $entidad ? $entidad->nombre_entidad_justicia : '';
    }

    public function getEntidadJusticiaPrimeraInstancia() {
        $entidad = $this->entidadPrimeraInstancia;
        return $entidad ? $entidad->nombre_entidad_justicia : '';
    }

    public function getEntidadJusticiaSegundaInstancia() {
        $entidad = $this->entidadSegundaInstancia;
        return $entidad ? $entidad->nombre_entidad_justicia : '';
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

    public function getTotalCobrado() {
        $total = 0;
        if($this->procesoEtapa) {
            foreach($this->procesoEtapa as $item) {
                $total += $item->getTotalCobrado();
            }
        }
        return $total;
    }

    public function getTotalPagado() {
        $total = 0;
        if($this->procesoEtapa) {
            foreach($this->procesoEtapa as $item) {
                $total += $item->getTotalPagado();
            }
        }
        return $total;
    }
}
