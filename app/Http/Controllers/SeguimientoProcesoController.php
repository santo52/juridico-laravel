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
use App\Entities\Cobro;
use App\Entities\EntidadJusticia;
use App\Entities\PlantillaDocumento;
use App\Entities\ProcesoEtapaActuacionDocumento;
use App\Entities\ProcesoTipoResultado;
use App\Entities\Usuario;
use App\Entities\TipoResultado;


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

    public function getEtapasDisponibles($id)
    {
        return response()->json(['etapas' => []]);
    }

    public function setEtapa(Request $request)
    {
        $procesoEtapa = ProcesoEtapa::create($request->all());
        return response()->json($procesoEtapa);
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

        $comentarios = ProcesoBitacora::where('id_proceso', $id)->orderBy('fecha_creacion', 'desc')->get();
        $historico = ProcesoEtapaActuacion::leftjoin('proceso_etapa as pe', 'proceso_etapa_actuacion.id_proceso_etapa', 'pe.id_proceso_etapa')
        ->where(['historico' => 1, 'finalizado' => 1, 'id_proceso' => $id])
        ->orderBy('fecha_resultado', 'desc')
        ->get();

        $tiposResultado = TipoResultado::where(['eliminado' => 0, ['id_tipo_resultado', '>', 4]])->get();
        foreach($tiposResultado as $key => $value) {
            $procesoTipoResultado = ProcesoTipoResultado::where(['id_proceso' => $id, 'id_tipo_resultado' => $value->id_tipo_resultado])->first();
            if($procesoTipoResultado) {
                $tiposResultado[$key]->value = $procesoTipoResultado->valor_proceso_tipo_resultado;
            }
        }

        return $this->renderSection('seguimiento_proceso.detalle', [
            'proceso' => $proceso,
            'historico' => $historico,
            'comentarios' => $comentarios,
            'tiposResultado' => $tiposResultado,
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



        foreach($etapas as $key => $etapa) {
            $array = [
                'id_proceso' => $procesoEtapa->id_proceso,
                'id_proceso_etapa' => $procesoEtapa->id_proceso_etapa,
                'id_actuacion' => $procesoEtapa->id_actuacion,
                'id_etapa_proceso' => $etapa->id_etapa_proceso
            ];
            $actuaciones = $this->getActuaacionesPorEtapa($array);
            if(count($actuaciones) == 0) {
                unset($etapas[$key]);
            }
        }


        $usuarios = Usuario::where([
            'estado_usuario' => '1',
            'eliminado' => 0
        ])->get();

        $entidadesJusticia = $this->getEntidadesJusticia($actuacion->tipoResultado->id_tipo_resultado);

        return $this->renderSection('seguimiento_proceso.actuacion', [
            'procesoEtapa' => $procesoEtapa,
            'actuacion' => $actuacion,
            'plantillas' => $plantillas,
            'documentosGenerados' => $list,
            'documentos' => $documentos,
            'etapas' => $etapas,
            'usuarios' => $usuarios,
            'entidadesJusticia' => $entidadesJusticia
        ]);
    }

    private function getEntidadesJusticia($type) {

        if(!in_array($type, [ 7, 8 ])) {
            return [];
        }

        $conditional['eliminado'] = 0;
        $conditional['estado_entidad_justicia'] = '1';
        if($type === 6) {
            $conditional['aplica_primera_instancia'] = '1';
        } else {
            $conditional['aplica_segunda_instancia'] = '1';
        }

        return EntidadJusticia::where($conditional)->get();
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

        $entidadesJusticia = $this->getEntidadesJusticia($actuacion->tipoResultado->id_tipo_resultado);
        return $this->renderSection('seguimiento_proceso.actuacion', [
            'procesoEtapa' => $procesoEtapa,
            'actuacion' => $actuacion,
            'plantillas' => $plantillas,
            'etapas' => $etapas,
            'usuarios' => $usuarios,
            'entidadesJusticia' => $entidadesJusticia
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
            if ($data['tipo_resultado'] == 5) {
                $data['historico'] = 1;
            } else if ($data['tipo_resultado'] == 6) {
                $data['numero_radicado'] = $data['resultado_actuacion'];
                $proceso->update(['numero_proceso' => $data['resultado_actuacion']]);
            } else if ($data['tipo_resultado'] == 7) {
                $proceso->update(['entidad_justicia_primera_instancia' => $data['resultado_actuacion']]);
            } else if ($data['tipo_resultado'] == 8) {
                $proceso->update(['entidad_justicia_segunda_instancia' => $data['resultado_actuacion']]);
            } else {
                ProcesoTipoResultado::updateOrCreate(['id_proceso' => $data['id_proceso'], 'id_tipo_resultado' => $data['tipo_resultado']], [
                    'id_proceso' => $data['id_proceso'],
                    'id_tipo_resultado' => $data['tipo_resultado'],
                    'valor_proceso_tipo_resultado' => $request->has('resultado_actuacion') ? $data['resultado_actuacion'] : '',
                ]);
            }
        }

        if($procesoEtapaActuacion){
            if ($procesoEtapaActuacion->finalizado == 0 && !empty($data['valor_pago'])) {
                $cobro = Cobro::where('id_proceso_etapa_actuacion', $id)->first();
                if(!$cobro) {
                    $id_cliente = $procesoEtapaActuacion->procesoEtapa->proceso->id_cliente;
                    $nombreActuacion = $procesoEtapaActuacion->actuacion->nombre_actuacion;

                    $dataCobro['fecha_cobro'] = date('Y-m-d');
                    $dataCobro['id_cliente'] = $id_cliente;
                    $dataCobro['concepto'] = $nombreActuacion;
                }

                $dataCobro['valor'] = $data['valor_pago'];
                Cobro::updateOrCreate(['id_proceso_etapa_actuacion' => $id], $dataCobro);
            } else {
                unset($data['valor_pago']);
            }
        }

        if ($data['all_fields'] == 'true') {
            $data['fecha_fin'] = date('Y-m-d h:i:s');
            if (empty($procesoEtapaActuacion) || $procesoEtapaActuacion->finalizado == 0) {
                $cerrarActuacion = true;
                $data['finalizado'] = 1;
                $proceso->update(['id_etapa_proceso' => $request->get('id_siguiente_etapa_actuacion')]);
            }
        }

        $saved = ProcesoEtapaActuacion::updateOrCreate(['id_proceso_etapa_actuacion' => $id], $data);

        if(isset($data['finalizar_proceso'])){
            $proceso->update(['estado_proceso' => 2]);
        } else if ($saved && $proceso && $cerrarActuacion) {

            //Crear una nueva actuación
            $idEtapa = $request->get('id_siguiente_etapa_actuacion');
            $actuacion = Actuacion::find($request->get('id_siguiente_actuacion'));
            $responsable = $request->get('id_usuario_siguiente_actuacion');
            $proceso->createActuacion($idEtapa, $actuacion, $responsable);
        }

        return response()->json(['saved' => $saved, $request->all()]);
    }

    private function getActuaacionesPorEtapa($array) {
        $discard = [];
        $procesoEtapaActuaciones = ProcesoEtapa::where([
            'id_proceso' => $array['id_proceso'],
            'id_etapa_proceso' => $array['id_etapa_proceso'],
        ])->first();
        if ($procesoEtapaActuaciones) {
            $discardList = $procesoEtapaActuaciones
                ->procesoEtapaActuaciones()
                ->where('finalizado', 1)
                ->get();

            foreach ($discardList as $item) {
                $discard[] = "'{$item->id_actuacion}'";
            }
        }

        $etapaActual = ProcesoEtapa::find($array['id_proceso_etapa']);
        if($etapaActual) {
            $cond = " not (a.id_actuacion = '{$array['id_actuacion']}' and aep.id_etapa_proceso = '{$etapaActual->id_etapa_proceso}') ";
        } else {
            $cond = " 1 = 1 ";
        }

        if (count($discard)) {
            $cond .= "and a.id_actuacion not in (" .  implode(',', $discard) . ")";
        }
        return EtapaProceso::getActuaciones($array['id_etapa_proceso'], $cond)->get();
    }

    public function getActuacionesEtapa(Request $request, $idEtapa)
    {
        $array = [
            'id_proceso' => $request->get('id_proceso'),
            'id_etapa_proceso' => $request->get('id_etapa_proceso'),
            'id_proceso_etapa' => $request->get('id_proceso_etapa'),
            'id_actuacion' => $request->get('id_actuacion'),
            'id_etapa_proceso' => $idEtapa
        ];
        $actuaciones = $this->getActuaacionesPorEtapa($array);
        return response()->json($actuaciones);
    }

    public function uploadFileResultado(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $ext = $this->getExtention($filename);

        $id = $request->get('id');
        $filename = $id . '.actuacion';
        $saveAs = "{$filename}{$ext}";

        $path = Storage::disk('documentos')->putFileAs('proceso', $file, $saveAs);

        $procesoEtapaActuacion = ProcesoEtapaActuacion::find($id);
        $procesoEtapaActuacion->update(['resultado_actuacion' => $path]);

        return response()->json(['filename' => $filename, 'path' => $path]);
    }

    public function deleteFileResultado(Request $request)
    {
        $id = $request->get('id');
        $procesoEtapaActuacion = ProcesoEtapaActuacion::find($id);
        $procesoEtapaActuacion->update(['resultado_actuacion' => '']);
        return response()->json(['deleted' => true]);
    }
}
