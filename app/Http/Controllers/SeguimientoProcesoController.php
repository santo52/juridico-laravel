<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Entities\Proceso;
use App\Entities\ProcesoEtapa;
use App\Entities\ProcesoEtapaActuacion;
use App\Entities\TipoProceso;
use App\Entities\EtapaProceso;
use App\Entities\ProcesoBitacora;
use App\Entities\ProcesoEtapaActuacionPlantillas;
use App\Entities\Actuacion;
use App\Entities\ActuacionDocumento;
use App\Entities\PlantillaDocumento;
use App\Entities\ProcesoEtapaActuacionDocumento;
use App\Entities\Usuario;

class SeguimientoProcesoController extends Controller
{

    private function getDocumentos($id, $id_actuacion)
    {
        $actuacionDocumentos = ActuacionDocumento::leftjoin('documento as d', 'd.id_documento', 'actuacion_documento.id_documento')
            ->where([
                'id_actuacion' => $id_actuacion,
                'eliminado' => 0,
                'estado_documento' => '1',
            ])->get();

        foreach ($actuacionDocumentos as $key => $value) {
            $id = $id ? $id : 0;
            $procesoDocumento = ProcesoEtapaActuacionDocumento::where([
                'id_proceso_etapa_actuacion' => $id,
                'id_documento' => $value->id_documento,
            ])->first();

            if ($procesoDocumento) {
                $ext = $this->getExtention($procesoDocumento->nombre_archivo);
                $fileRoute = Storage::disk('documentos')->url('proceso/' . $procesoDocumento->id_proceso_etapa_actuacion_documento . $ext);
                $actuacionDocumentos[$key]['filename'] = $fileRoute;
            }
        }


        return $actuacionDocumentos;
    }

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
        if ($proceso) $proceso->update(['id_etapa_proceso' => $request->get('id_etapa_proceso')]);
        return response()->json(['proceso' => $proceso]);
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
            ->leftjoin('proceso as p', 'p.id_proceso', 'pe.id_proceso')
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

        $documentos = $this->getDocumentos($procesoEtapa->id_proceso_etapa_actuacion, $procesoEtapa->id_actuacion);

        $etapas = TipoProceso::getEtapas($procesoEtapa->id_tipo_proceso)->get();
        $usuarios = Usuario::where([
            'estado_usuario' => '1',
            'eliminado' => 0
        ])->get();

        return $this->renderSection('seguimiento_proceso.actuacion', [
            'procesoEtapa' => $procesoEtapa,
            'actuacion' => $actuacion,
            'plantillas' => $plantillas,
            'documentosGenerados' => $list,
            'documentos' => $documentos,
            'etapas' => $etapas,
            'usuarios' => $usuarios
        ]);
    }

    public function crearActuacion($idProcesoEtapa, $id)
    {
        $actuacion = Actuacion::find($id);
        $procesoEtapa = ProcesoEtapa::leftjoin('proceso as p', 'p.id_proceso', 'proceso_etapa.id_proceso')
            ->find($idProcesoEtapa);
        $plantillas = PlantillaDocumento::where(['eliminado' => 0, 'estado_plantilla_documento' => '1'])->get();

        if (empty($procesoEtapa) || empty($actuacion)) {
            return response()->json(['redirect' => 'seguimiento-procesos']);
        }

        $etapas = TipoProceso::getEtapas($procesoEtapa->id_tipo_proceso)->get();
        $usuarios = Usuario::where([
            'estado_usuario' => '1',
            'eliminado' => 0
        ])->get();

        return $this->renderSection('seguimiento_proceso.actuacion', [
            'procesoEtapa' => $procesoEtapa,
            'actuacion' => $actuacion,
            'plantillas' => $plantillas,
            'etapas' => $etapas,
            'usuarios' => $usuarios
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

    public function actuacionPlantillaDelete($id)
    {
        $procesoPlantilla = ProcesoEtapaActuacionPlantillas::with('plantillaDocumento')->find($id);
        $deleted = $procesoPlantilla->deleteDocument();
        return response()->json(['deleted' => $deleted, 'data' => $procesoPlantilla]);
    }

    private function getExtention($filename)
    {
        $fileSplit = explode('.', $filename);
        $index = count($fileSplit) - 1;
        return '.' . $fileSplit[$index];
    }

    public function deleteFile(Request $request)
    {
        $deleted = ProcesoEtapaActuacionDocumento::where([
            'id_proceso_etapa_actuacion' => $request->get('id'),
            'id_documento' => $request->get('file_id')
        ])->deleteFile();
        return response()->json(['deleted' => $deleted]);
    }

    public function uploadFile(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $procesoDocumento = ProcesoEtapaActuacionDocumento::updateOrCreate([
            'id_proceso_etapa_actuacion' => $request->get('id'),
            'id_documento' => $request->get('file_id')
        ], [
            'id_proceso_etapa_actuacion' => $request->get('id'),
            'id_documento' => $request->get('file_id'),
            'nombre_archivo' => $filename,
            'id_usuario_creacion' => Auth::id()
        ]);

        $ext = $this->getExtention($filename);
        $saveAs = "{$procesoDocumento->id_proceso_etapa_actuacion_documento}{$ext}";
        $path = Storage::disk('documentos')->putFileAs('proceso', $file, $saveAs);
        return response()->json(['filename' => $filename, 'path' => $path]);
    }

    public function actuacionUpsert(Request $request)
    {

        $cerrarActuacion = false;
        $data = $request->all();
        $id = $data['id_proceso_etapa_actuacion'];
        $procesoEtapaActuacion = ProcesoEtapaActuacion::find($id);
        if (empty($procesoEtapaActuacion)) {
            $data['fecha_inicio'] = date('Y-m-d h:i:s');
        }

        $proceso = Proceso::find($data['id_proceso']);
        if ($proceso) {
            if ($data['tipo_resultado'] == 3) {
                $data['numero_radicado'] = $data['resultado_actuacion'];
                $proceso->update(['numero_proceso' => $data['resultado_actuacion']]);
            } else if ($data['tipo_resultado'] == 4) {
                $proceso->update(['entidad_justicia_primera_instancia' => $data['resultado_actuacion']]);
            } else if ($data['tipo_resultado'] == 5) {
                $proceso->update(['entidad_justicia_segunda_instancia' => $data['resultado_actuacion']]);
            } else if ($data['tipo_resultado'] == 6) {
                $proceso->update(['cuantia_demandada' => $data['resultado_actuacion']]);
            } else if ($data['tipo_resultado'] == 7) {
                $proceso->update(['estimacion_pretenciones' => $data['resultado_actuacion']]);
            }
        }

        if ($data['all_fields'] == 'true') {
            $data['fecha_fin'] = date('Y-m-d h:i:s');
            $procesoEtapaActuacion = ProcesoEtapaActuacion::find($id);
            if (empty($procesoEtapaActuacion) || $procesoEtapaActuacion->finalizado == 0) {
                $cerrarActuacion = true;
                $data['finalizado'] = 1;
            }
        }

        $saved = ProcesoEtapaActuacion::updateOrCreate(['id_proceso_etapa_actuacion' => $id], $data);
        if ($saved && $proceso && $cerrarActuacion) {

            //Crear una nueva actuación
            $idEtapa = $request->get('id_siguiente_etapa_actuacion');
            $actuacion = Actuacion::find($request->get('id_siguiente_actuacion'));
            $responsable = $request->get('id_usuario_siguiente_actuacion');
            $proceso->createActuacion($idEtapa, $actuacion, $responsable);
        }

        return response()->json(['saved' => $saved]);
    }

    public function getActuacionesEtapa(Request $request, $idEtapa)
    {
        $discard = [];
        $procesoEtapaActuaciones = ProcesoEtapa::find($request->get('id_proceso_etapa'));
        if ($procesoEtapaActuaciones) {
            $discardList = $procesoEtapaActuaciones
                ->procesoEtapaActuaciones()
                ->where('finalizado', 1)
                ->get();

            foreach($discardList as $item) {
                $discard[] = "'{$item->id_actuacion}'";
            }
        }

        $cond = " a.id_actuacion <> '{$request->get('id_actuacion')}' ";
        if(count($discard)) {
            $cond .= "and a.id_actuacion not in (" .  implode(',', $discard) . ")";
        }
        $actuaciones = EtapaProceso::getActuaciones($idEtapa, $cond)->get();
        return response()->json($actuaciones);
    }
}
