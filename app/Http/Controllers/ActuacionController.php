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
use App\Entities\TipoResultado;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActuacionExport;

class ActuacionController extends Controller
{

    private function getTiposResultados($id_actuacion) {

        $tiposResultado = TipoResultado::where('eliminado', 0)->get();
        foreach($tiposResultado as $key => $value) {
            if($value->unico_tipo_resultado === 1) {
                $used = Actuacion::where([
                    ['id_actuacion', '<>', $id_actuacion],
                    ['tipo_resultado', '=', $value->id_tipo_resultado]
                ])->exists();
                if($used) {
                    unset($tiposResultado[$key]);
                }
            }
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
        return response()->json(['savedsss' => $saved]);
    }

    private function upsert(Request $request, $id = false) {

        //Guardar en Actuación
        $actuacion = $this->prepareActuacion($request, $id);
        // $saved = $actuacion->save();

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
        return $actuacion;
    }

    private function prepareActuacion(Request $request, $id = false) {

        $data = $request->all();
        $data['nombre_actuacion'] = trim($request->get('nombreActuacion'));
        $data['actuacion_tiene_cobro'] =  empty($request->get('actuacionTieneCobro')) ? 2 : 1;
        $data['estado_actuacion'] =  empty($request->get('estado')) ? 2 : 1;

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
            'tiposResultado' => $this->getTiposResultados($id),
            // 'tiposResultado2' => $tiposResultado
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
