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

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActuacionExport;

class ActuacionController extends Controller
{

    private function getTiposResultados($id_actuacion) {
        $idTiposResultadoProhibidos = [3,4,5,6,7,8];
        $actuaciones = Actuacion::
        where([['id_actuacion', '<>', $id_actuacion]])
        ->whereIn('tipo_resultado', $idTiposResultadoProhibidos)->get();

        $tiposResultado = Actuacion::getTiposResultado();
        foreach($actuaciones as $actuacion) {
            unset($tiposResultado[$actuacion->tipo_resultado]);
        }

        return $tiposResultado;
    }

    public function create() {

        $documentos = Documento::where('estado_documento', 1)->get();
        $plantillasDocumento = PlantillaDocumento::where('estado_plantilla_documento', 1)->get();

        return $this->renderSection('actuacion.detalle', [
            'documentos' => $documentos,
            'plantillasDocumento' => $plantillasDocumento,
            'tiposResultado' => $this->getTiposResultados(0)
        ]);
    }

    public function insert(Request $request) {

        //@TODO verificar si existe con diferente ID
        //consultar si existe en la base de datos ese nombre

        $nombreActuacion = $request->get('nombreActuacion');
        $actuacion = Actuacion::where([
            'eliminado' => 0,
            'nombre_actuacion' => trim($nombreActuacion)
        ]);

        if ($actuacion->exists()) {
            return response()->json(['exists' => true]);
        }

        $saved = $this->upsert($request);
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
        // $templates = explode(',', $request->get('templates'));

        if ($id) {
            ActuacionDocumento::where('id_actuacion', $actuacion->id_actuacion)->delete();
            // ActuacionPlantillaDocumento::where('id_actuacion', $actuacion->id_actuacion)->delete();
        }

        //Relacion con Actuacion documento
        foreach ($documents as $document) {
            if($document) {
                ActuacionDocumento::create([
                    'id_actuacion' => $actuacion->id_actuacion,
                    'id_documento' => $document
                ])->save();
            }
        }

        // //Relacion con Actuacion plantilla documento
        // foreach ($templates as $template) {
        //     if($template) {
        //         ActuacionPlantillaDocumento::create([
        //             'id_actuacion' => $actuacion->id_actuacion,
        //             'id_plantilla_documento' => $template
        //         ])->save();
        //     }
        // }

        return true;
    }

    private function prepareActuacion(Request $request, $id = false) {

        $data = $request->all();
        $data['nombre_actuacion'] = trim($request->get('nombreActuacion'));
        $data['actuacion_tiene_cobro'] =  empty($request->get('actuacionTieneCobro')) ? 2 : 1;
        $data['estado_actuacion'] =  empty($request->get('estado')) ? 2 : 1;

        // $data = [
        //     'nombre_actuacion' => trim($request->get('nombreActuacion')),
        //     'genera_alertas' => empty($request->get('generaAlertas')) ? 2 : 1,
        //     'aplica_control_vencimiento' => empty($request->get('aplicaControlVencimiento')) ? 2 : 1,
        //     'dias_vencimiento' => $request->get('diasVencimiento'),
        //     'requiere_estudio_favorabilidad' => empty($request->get('requiereEstudioFavorabilidad')) ? 2 : 1,
        //     'actuacion_tiene_cobro' => empty($request->get('actuacionTieneCobro')) ? 2 : 1,
        //     'actuacion_creacion_cliente' => empty($request->get('actuacionCreacionCliente')) ? 2 : 1,
        //     'mostrar_datos_radicado' => empty($request->get('mostrarDatosRadicado')) ? 2 : 1,
        //     'mostrar_datos_juzgado' => empty($request->get('mostrarDatosJuzgado')) ? 2 : 1,
        //     'mostrar_datos_respuesta' => empty($request->get('mostrarDatosRespuesta')) ? 2 : 1,
        //     'mostrar_datos_apelacion' => empty($request->get('mostrarDatosApelacion')) ? 2 : 1,
        //     'mostrar_datos_cobros' => empty($request->get('mostrarDatosCobros')) ? 2 : 1,
        //     'programar_audiencia' => empty($request->get('programarAudiencia')) ? 2 : 1,
        //     'control_entrega_documentos' => empty($request->get('controlEntregaDocumentos')) ? 2 : 1,
        //     'generar_documentos' => empty($request->get('generarDocumentos')) ? 2 : 1,
        //     'estado_actuacion' => empty($request->get('estado')) ? 2 : 1,
        //     'dias_vencimiento_unidad' => $request->get('dias_vencimiento_unidad'),
        //     'dias_vencimiento_tipo' => $request->get('dias_vencimiento_unidad')
        // ];

        if (!$id) {
            $data['eliminado'] = 0;
        }

        return Actuacion::updateOrCreate(['id_actuacion' => $id], $data);

    }

    public function index() {

        $actuacion = new Actuacion;
        $list = $actuacion
            ->where('eliminado', 0)
            ->orderBy('id_actuacion', 'desc')
            ->get();

        return $this->renderSection('actuacion.listar', [
            'actuaciones' => $list,
            'listaActuaciones' => $list,
        ]);
    }


    public function edit($id) {

        $actuacion = Actuacion::find($id);
        if (empty($actuacion)) {
            return response()->json(['redirect' => 'actuacion/crear']);
        }

        $documentos = Documento::where('estado_documento', 1)->get();
        $plantillasDocumento = PlantillaDocumento::where('estado_plantilla_documento', 1)->get();

        $actuacionDocumentos = DB::Table('actuacion as a')->select('d.*')
            ->leftJoin('actuacion_documento as ad', 'a.id_actuacion', '=', 'ad.id_actuacion')
            ->leftJoin('documento as d', 'd.id_documento', '=', 'ad.id_documento')
            ->where([['a.id_actuacion', $id], ['d.estado_documento', 1]])
            ->get();

        $actuacionPlantillasDocumento = DB::Table('actuacion as a')->select('pd.*')
            ->leftJoin('actuacion_plantilla_documento as apd', 'a.id_actuacion', '=', 'apd.id_actuacion')
            ->leftJoin('plantilla_documento as pd', 'pd.id_plantilla_documento', '=', 'apd.id_plantilla_documento')
            ->where([['a.id_actuacion', $id], ['pd.estado_plantilla_documento', 1]])
            ->get();

        return $this->renderSection('actuacion.detalle', [
            'documentos' => $documentos,
            'plantillasDocumento' => $plantillasDocumento,
            'actuacion' => $actuacion,
            'actuacionDocumentos' => $actuacionDocumentos,
            'actuacionPlantillasDocumento' => $actuacionPlantillasDocumento,
            'tiposResultado' => $this->getTiposResultados($id)
        ]);
    }

    public function update(Request $request, $id) {

        $nombreActuacion = $request->get('nombreActuacion');
        $actuacion = Actuacion::where([
            ['eliminado', 0],
            ['nombre_actuacion', trim($nombreActuacion)],
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
        $actuacion->eliminado = 1;
        $deleted = $actuacion->save();
        return response()->json(['deleted' => $deleted]);
    }

    public function restore($id) {
        $actuacion = Actuacion::find($id);
        $actuacion->eliminado = 0;
        $undeleted = $actuacion->save();
        return response()->json(['undeleted' => $undeleted]);
    }

    public function createExcel() {
        return Excel::download(new ActuacionExport, 'actuaciones.xlsx');
    }

    public function createPDF() {
        //    return Excel::download(new ActuacionExport, 'actuaciones.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        $actuaciones = Actuacion::where('eliminado', 0)->get();
        $pdf = \PDF::loadView('actuacion.pdf', ["actuaciones" => $actuaciones])->setPaper('a4', 'landscape');
        return $pdf->download('archivo.pdf');
    }
}
