<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Entities\Proceso;
use App\Entities\ProcesoEtapa;
use App\Entities\ProcesoEtapaActuacion;
use App\Entities\TipoProceso;
use App\Entities\EtapaProceso;
use App\Entities\ProcesoBitacora;
use App\Entities\ProcesoEtapaActuacionPlantillas;
use App\Entities\Actuacion;
use App\Entities\PlantillaDocumento;

class SeguimientoProcesoController extends Controller
{
    public function index()
    {
        $procesos = Proceso::getAll()->orderBy('id_proceso', 'desc')->get();
        return $this->renderSection('proceso.listar', [
            'procesos' => $procesos,
            'seguimiento' => true
        ]);
    }

    public function setEtapa(Request $request)
    {
        $proceso = Proceso::find($request->get('id_proceso'));
        $data = $proceso->createFirstActuacion();
        if ($data) $proceso->update(['id_etapa_proceso' => $request->get('id_etapa_proceso')]);
        return response()->json(['proceso_etapa_actuacion' => $data]);
    }

    public function detalle($id)
    {
        $proceso = Proceso::get($id);
        if (empty($proceso)) {
            return response()->json(['redirect' => 'seguimiento-procesos']);
        }

        $etapas = TipoProceso::getEtapas($proceso->id_tipo_proceso)->get();

        foreach ($etapas as $key => $value) {
            $actuaciones = EtapaProceso::getActuaciones($value->id_etapa_proceso)->get();
            $value->actuaciones = $actuaciones;
            $etapas[$key] = $this->addProcesoEtapa($proceso->id_proceso, $value);
        }

        $comentarios = ProcesoBitacora::orderBy('fecha_creacion', 'desc')->get();

        return $this->renderSection('seguimiento_proceso.detalle', [
            'proceso' => $proceso,
            'comentarios' => $comentarios,
            'etapas' => $etapas
        ]);
    }

    private function addProcesoEtapa($id_proceso, $etapa)
    {

        $procesoEtapa = ProcesoEtapa::where([
            'id_proceso' => $id_proceso,
            'id_etapa_proceso' => $etapa->id_etapa_proceso
        ])->first();

        $actuaciones = $etapa->actuaciones;
        $idProcesoEtapa = false;

        if (!empty($procesoEtapa)) {
            $etapa->porcentaje = $procesoEtapa->porcentaje;
            $idProcesoEtapa = $procesoEtapa->id_proceso_etapa;
        }

        foreach ($actuaciones as $key => $actuacion) {
            $actuaciones[$key] = $this->addProcesoEtapaActuacion($idProcesoEtapa, $actuacion);
        }

        $etapa->id_proceso_etapa = $idProcesoEtapa;
        $etapa->actuaciones = $actuaciones;
        return $etapa;
    }

    private function addProcesoEtapaActuacion($id_proceso_etapa, $actuacion)
    {
        $actuacion->fechaInicio = 'Sin iniciar';
        $actuacion->fechaVencimiento = 'Sin iniciar';
        $actuacion->fechaFin = 'Sin iniciar';
        $actuacion->responsable = 'Sin asignar';
        $actuacion->estado = 'Pendiente';
        $actuacion->estadoColor = 'gris';
        $actuacion->tiempoMaximo = $actuacion->getTiempoMaximo();

        $procesoEtapaActuacion = ProcesoEtapaActuacion::where([
            'id_proceso_etapa' => $id_proceso_etapa,
            'id_actuacion' => $actuacion->id_actuacion
        ])->first();

        if (!empty($procesoEtapaActuacion)) {
            $actuacion->id_proceso_etapa_actuacion = $procesoEtapaActuacion->id_proceso_etapa_actuacion;
            $actuacion->responsable = $procesoEtapaActuacion->getResponsable();
            $actuacion->fechaInicio = $procesoEtapaActuacion->getFechaInicioString();
            $actuacion->fechaVencimiento = $procesoEtapaActuacion->getFechaVencimientoString();
            $actuacion->fechaFin = $procesoEtapaActuacion->getFechaFinString();
            $actuacion->estado = $procesoEtapaActuacion->getEstado();
            $actuacion->estadoColor = $procesoEtapaActuacion->getEstadoColor();
        }

        return $actuacion;
    }

    public function actuacion($id)
    {
        $procesoEtapa = ProcesoEtapaActuacion::leftjoin('proceso_etapa as pe', 'pe.id_proceso_etapa', 'proceso_etapa_actuacion.id_proceso_etapa')
            ->find($id);

        if (empty($procesoEtapa)) {
            return response()->json(['redirect' => 'seguimiento-procesos']);
        }

        $actuacion = Actuacion::find($procesoEtapa->id_actuacion);
        $list = ProcesoEtapaActuacionPlantillas::where('id_proceso_etapa_actuacion', $id)->get();

        $whereNotIn = [];

        foreach ($list as $item) {
            $whereNotIn[] = $item->id_plantilla_documento;
        }

        $plantillas = PlantillaDocumento::where(['eliminado' => 0, 'estado_plantilla_documento' => '1'])
            ->whereNotIn('id_plantilla_documento', $whereNotIn)
            ->get();

        return $this->renderSection('seguimiento_proceso.actuacion', [
            'procesoEtapa' => $procesoEtapa,
            'actuacion' => $actuacion,
            'plantillas' => $plantillas,
            'documentosGenerados' => $list
        ]);
    }

    public function crearActuacion($idProcesoEtapa, $id)
    {
        $actuacion = Actuacion::find($id);
        $procesoEtapa = ProcesoEtapa::find($idProcesoEtapa);
        $plantillas = PlantillaDocumento::where(['eliminado' => 0, 'estado_plantilla_documento' => '1'])->get();

        if (empty($procesoEtapa) || empty($actuacion)) {
            return response()->json(['redirect' => 'seguimiento-procesos']);
        }

        return $this->renderSection('seguimiento_proceso.actuacion', [
            'procesoEtapa' => $procesoEtapa,
            'actuacion' => $actuacion,
            'plantillas' => $plantillas
        ]);
    }

    public function actuacionPlantillaUpsert(Request $request)
    {

        if (empty($request->get('id_plantilla_documento'))) {
            return response()->json(['saved' => false]);
        }

        $id = $request->get('id_proceso_etapa_actuacion_plantillas');
        $added = ProcesoEtapaActuacionPlantillas::updateOrCreate(['id_proceso_etapa_actuacion_plantillas' => $id], $request->all());
        $url = $added->saveDocument();

        return response()->json(['saved' => $added, 'url' => $url]);
    }

    public function actuacionPlantillaDelete($id) {
        $procesoPlantilla = ProcesoEtapaActuacionPlantillas::with('plantillaDocumento')->find($id);
        $deleted = $procesoPlantilla->deleteDocument();
        return response()->json([ 'deleted' => $deleted, 'data' => $procesoPlantilla ]);
    }

}
