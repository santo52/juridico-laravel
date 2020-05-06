<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Entities\Documento;
use App\Entities\PlantillaDocumento;
use App\Entities\Actuacion;
use App\Entities\ActuacionDocumento;
use App\Entities\ActuacionPlantillaDocumento;
use App\Entities\ActuacionEtapaProceso;
use App\Entities\EtapaProceso;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActuacionExport;

class ActuacionController extends Controller
{

    public function getEtapas($id){

        $actuacion = ActuacionEtapaProceso::find($id);
        $etapasProceso = EtapaProceso::where([
            'eliminado' => 0,
            'estado_etapa_proceso' => 1
        ])->whereNotIn('id_etapa_proceso', [])->get();

        return response()->json([
            'etapasProceso' => $etapasProceso,
            'actuacionEtapaProceso' => $actuacion
        ]);
    }

    public function deleteEtapa($id) {
        $actuacion = ActuacionEtapaProceso::find($id);
        $deleted = $actuacion->delete();
        return response()->json([ 'deleted' => $deleted ]);
    }

    public function upsertEtapas(Request $request){

        $data = $request->all();
        $data['id_usuario_creacion'] = Auth::id();
        if(!$request->get('id_etapa_proceso')){
            return response()->json([ 'id_etapa_proceso' => false ]);
        }
        $id = intval($request->get('id_actuacion_etapa_proceso'));
        $saved = ActuacionEtapaProceso::updateOrCreate(['id_actuacion_etapa_proceso' => $id], $data);
        return response()->json([ 'saved' => $saved ]);
    }

    public function create() {

        /* @TODO Permisos para acceder a cada una de las opciones */

        $documentos = Documento::where('estado_documento', 1)->get();
        $plantillasDocumento = PlantillaDocumento::where('estado_plantilla_documento', 1)->get();

        $etapasProceso = ActuacionEtapaProceso::
            leftjoin('etapa_proceso as ep', 'ep.id_etapa_proceso', 'actuacion_etapa_proceso.id_etapa_proceso')
            ->where([
                'id_actuacion' => 0,
                'ep.eliminado' => 0,
                'actuacion_etapa_proceso.id_usuario_creacion' => Auth::id()
            ])->orderBy('order')->get();


        return $this->renderSection('actuacion.detalle', [
            'documentos' => $documentos,
            'plantillasDocumento' => $plantillasDocumento,
            'etapasProceso' => $etapasProceso
        ]);
    }

    public function reorderEtapas(Request $request){

        $listEtapaProceso = explode(',', $request->get('orderedList'));
        $conditional['id_actuacion'] = $request->get('id_actuacion');
        if($request->get('id_actuacion') == 0) {
            $conditional['id_usuario_creacion'] = Auth::id();
        }

        $dataSaved = [];
        foreach ($listEtapaProceso as $position => $value) {
            $conditional['id_actuacion_etapa_proceso'] = $value;
            $dataSaved[] = ActuacionEtapaProceso::where($conditional)
                ->update([ 'order' => ($position + 1) ]);
        }

        return response()->json([$dataSaved, $conditional]);
    }

    public function insert(Request $request) {

        //@TODO verificar si existe con diferente ID
        //consultar si existe en la base de datos ese nombre

        $nombreActuacion = $request->get('nombreActuacion');
        $actuacion = Actuacion::where([
            'estado_actuacion' => 1,
            'nombre_actuacion' => trim(strtoupper($nombreActuacion))
        ]);

        if ($actuacion->exists()) {
            return response()->json(['exists' => true]);
        }

        $saved = $this->upsert($request);

        $etapasProceso = ActuacionEtapaProceso::
            leftjoin('etapa_proceso as ep', 'ep.id_etapa_proceso', 'actuacion_etapa_proceso.id_etapa_proceso')
            ->where([
                'id_actuacion' => 0,
                'ep.eliminado' => 0,
                'actuacion_etapa_proceso.id_usuario_creacion' => Auth::id()
            ])->update([ 'id_actuacion' => $saved->id_actuacion ]);

        return response()->json(['saved' => $saved]);
    }

    private function upsert(Request $request, $id = false) {

        //Guardar en Actuación
        $actuacion = $this->prepareActuacion($request, $id);
        $saved = $actuacion->save();

        if (!$saved) {
            return false;
        }

        $documents = explode(',', $request->get('documents'));
        $templates = explode(',', $request->get('templates'));

        if ($id) {
            ActuacionDocumento::where('id_actuacion', $actuacion->id_actuacion)->delete();
            ActuacionPlantillaDocumento::where('id_actuacion', $actuacion->id_actuacion)->delete();
        }

        //Relacion con Actuacion documento
        foreach ($documents as $document) {
            ActuacionDocumento::create([
                'id_actuacion' => $actuacion->id_actuacion,
                'id_documento' => $document
            ])->save();
        }

        //Relacion con Actuacion plantilla documento
        foreach ($templates as $template) {
            ActuacionPlantillaDocumento::create([
                'id_actuacion' => $actuacion->id_actuacion,
                'id_plantilla_documento' => $template
            ])->save();
        }

        return $actuacion;
    }

    private function prepareActuacion(Request $request, $id = false) {

        $data = [
            'nombre_actuacion' => trim(strtoupper($request->get('nombreActuacion'))),
            'genera_alertas' => empty($request->get('generaAlertas')) ? 2 : 1,
            'aplica_control_vencimiento' => empty($request->get('aplicaControlVencimiento')) ? 2 : 1,
            'dias_vencimiento' => $request->get('diasVencimiento'),
            'requiere_estudio_favorabilidad' => empty($request->get('requiereEstudioFavorabilidad')) ? 2 : 1,
            'actuacion_tiene_cobro' => empty($request->get('actuacionTieneCobro')) ? 2 : 1,
            'valor_actuacion' => $request->get('valorActuacion'),
            'actuacion_creacion_cliente' => empty($request->get('actuacionCreacionCliente')) ? 2 : 1,
            'mostrar_datos_radicado' => empty($request->get('mostrarDatosRadicado')) ? 2 : 1,
            'mostrar_datos_juzgado' => empty($request->get('mostrarDatosJuzgado')) ? 2 : 1,
            'mostrar_datos_respuesta' => empty($request->get('mostrarDatosRespuesta')) ? 2 : 1,
            'mostrar_datos_apelacion' => empty($request->get('mostrarDatosApelacion')) ? 2 : 1,
            'mostrar_datos_cobros' => empty($request->get('mostrarDatosCobros')) ? 2 : 1,
            'programar_audiencia' => empty($request->get('programarAudiencia')) ? 2 : 1,
            'control_entrega_documentos' => empty($request->get('controlEntregaDocumentos')) ? 2 : 1,
            'generar_documentos' => empty($request->get('generarDocumentos')) ? 2 : 1,
            'id_usuario_actualizacion' => Auth::id()
        ];

        if (!$id) {
            $data['estado_actuacion'] = 1;
            $data['id_usuario_creacion'] = Auth::id();
        }

        return Actuacion::updateOrCreate(['id_actuacion' => $id], $data);

    }

    public function index() {

        $actuacion = new Actuacion;
        $list = $actuacion
            ->where('estado_actuacion', 1)
            ->orderBy('id_actuacion', 'desc')
            ->get()
            ->toHuman();

        return $this->renderSection('actuacion.listar', [
            'actuaciones' => $list,
            'listaActuaciones' => $list,
        ]);
    }


    public function edit(Request $request, $id) {

        $actuacion = Actuacion::find($id);
        if (empty($actuacion)) {
            return response()->json(['redirect' => 'actuacion/crear']);
        }

        $table = DB::Table('actuacion as a');
        $documentos = Documento::where('estado_documento', 1)->get();
        $plantillasDocumento = PlantillaDocumento::where('estado_plantilla_documento', 1)->get();

        $actuacionDocumentos = $table->select('d.*')
            ->leftJoin('actuacion_documento as ad', 'a.id_actuacion', '=', 'ad.id_actuacion')
            ->leftJoin('documento as d', 'd.id_documento', '=', 'ad.id_documento')
            ->where([['a.id_actuacion', $id], ['d.estado_documento', 1]])
            ->get();

        $actuacionPlantillasDocumento = $table->select('pd.*')
            ->leftJoin('actuacion_plantilla_documento as apd', 'a.id_actuacion', '=', 'apd.id_actuacion')
            ->leftJoin('plantilla_documento as pd', 'pd.id_plantilla_documento', '=', 'apd.id_plantilla_documento')
            ->where([['a.id_actuacion', $id], ['pd.estado_plantilla_documento', 1]])
            ->get();

        $etapasProceso = ActuacionEtapaProceso::
            leftjoin('etapa_proceso as ep', 'ep.id_etapa_proceso', 'actuacion_etapa_proceso.id_etapa_proceso')
            ->where([
                'id_actuacion' => $id,
                'ep.eliminado' => 0
            ])->orderBy('order')->get();

        return $this->renderSection('actuacion.detalle', [
            'documentos' => $documentos,
            'plantillasDocumento' => $plantillasDocumento,
            'actuacion' => $actuacion,
            'etapasProceso' => $etapasProceso,
            'actuacionDocumentos' => $actuacionDocumentos,
            'actuacionPlantillasDocumento' => $actuacionPlantillasDocumento,
        ]);
    }

    public function update(Request $request, $id) {

        $nombreActuacion = $request->get('nombreActuacion');
        $actuacion = Actuacion::where([
            ['estado_actuacion', 1],
            ['nombre_actuacion', trim(strtoupper($nombreActuacion))],
            ['id_actuacion', '<>', $id]
        ]);

        if ($actuacion->exists()) {
            return response()->json(['exists' => true]);
        }

        $saved = $this->upsert($request, $id);
        return response()->json(['saved' => $saved]);
    }

    public function delete($id) {
        $actuacion = Actuacion::find($id);
        $actuacion->estado_actuacion = 2;
        $deleted = $actuacion->save();
        return response()->json(['deleted' => $deleted]);
    }

    public function restore($id) {
        $actuacion = Actuacion::find($id);
        $actuacion->estado_actuacion = 1;
        $undeleted = $actuacion->save();
        return response()->json(['undeleted' => $undeleted]);
    }

    public function createExcel() {
        return Excel::download(new ActuacionExport, 'actuaciones.xlsx');
    }

    public function createPDF() {
        //    return Excel::download(new ActuacionExport, 'actuaciones.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        $actuaciones = Actuacion::where('estado_actuacion', 1)->get()->toHuman();
        $pdf = \PDF::loadView('actuacion.pdf', ["actuaciones" => $actuaciones])->setPaper('a4', 'landscape');
        return $pdf->download('archivo.pdf');
    }
}
