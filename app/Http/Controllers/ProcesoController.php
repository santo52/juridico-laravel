<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Entities\Proceso;
use App\Entities\TipoProceso;
use App\Entities\EntidadDemandada;
use App\Entities\EtapasProcesoTipoProceso;
use App\Entities\ProcesoDocumento;
use App\Entities\ActuacionDocumento;
use App\Entities\EntidadJusticia;
use App\Entities\Actuacion;
use App\Entities\Pais;
use App\Entities\Departamento;
use App\Entities\Usuario;
use App\Entities\Municipio;
use App\Entities\Cliente;


class ProcesoController extends Controller
{
    public function index() {
        $procesos = Proceso::
            leftjoin('tipo_proceso as tp', 'tp.id_tipo_proceso', 'proceso.id_tipo_proceso')
            ->leftjoin('entidad_demandada as ed', 'ed.id_entidad_demandada', 'proceso.id_entidad_demandada')
            ->leftjoin('municipio as m', 'm.id_municipio', 'proceso.id_municipio')
            ->leftjoin('entidad_justicia as ej', 'ej.id_entidad_justicia', 'proceso.id_entidad_justicia')
            ->leftjoin('usuario as u', 'u.id_usuario', 'proceso.id_usuario_responsable')
            ->leftjoin('cliente as c', 'c.id_cliente', 'proceso.id_cliente')
            ->leftjoin('persona as p', 'p.id_persona', 'c.id_persona')
            ->where('proceso.eliminado', 0)
            ->get();

        return $this->renderSection('proceso.listar', [
            'procesos' => $procesos
        ]);
    }

    private function getDocumentos($id, $id_tipo_proceso) {
        $actuacion = EtapasProcesoTipoProceso::
            select('a.id_actuacion')
            ->leftjoin('etapa_proceso as ep', 'ep.id_etapa_proceso', 'etapas_proceso_tipo_proceso.id_etapa_proceso')
            ->leftjoin('actuacion_etapa_proceso as aep', 'aep.id_etapa_proceso', 'ep.id_etapa_proceso')
            ->leftjoin('actuacion as a', 'a.id_actuacion', 'aep.id_actuacion')
            ->where([
            'id_tipo_proceso' => $id_tipo_proceso,
            'ep.eliminado' => 0,
            'a.eliminado' => 0,
            'ep.estado_etapa_proceso' => '1',
            'a.estado_actuacion' => '1',
        ])
            ->whereNotNull('id_actuacion_etapa_proceso')
            ->orderBy('etapas_proceso_tipo_proceso.order')
            ->orderBy('aep.order')
            ->first();

        if (empty($actuacion)) {
            return [];
        }

        $actuacionDocumentos = ActuacionDocumento::
            leftjoin('documento as d', 'd.id_documento', 'actuacion_documento.id_documento')
            ->where([
            'id_actuacion' => $actuacion->id_actuacion,
            'eliminado' => 0,
            'estado_documento' => '1',
        ])->get();

        foreach ($actuacionDocumentos as $key => $value) {
            $idProceso = $id ? $id : 0;
            $procesoDocumento = ProcesoDocumento::
                where([
                'id_proceso' => $idProceso,
                'id_documento' => $value->id_documento,
            ])->first();

            if ($procesoDocumento) {
                $ext = $this->getExtention($procesoDocumento->nombre_archivo);
                $id = $procesoDocumento->id_proceso_documento;
                $fileRoute = Storage::disk('documentos')->url('proceso/' . $id . $ext);
                $actuacionDocumentos[$key]['filename'] = $fileRoute;
            }
        }


        return $actuacionDocumentos;
    }

    public function get($id) {

        $proceso = Proceso::
            leftjoin('municipio as mu', 'mu.id_municipio', 'proceso.id_municipio')
            ->leftjoin('departamento as de', 'de.id_departamento', 'mu.id_departamento')
            ->where('id_proceso', $id)
            ->first();

        $clientes = Cliente::
            leftjoin('persona as pe', 'pe.id_persona', 'cliente.id_persona')
            ->where([
            'cliente.eliminado' => 0,
            'estado_cliente' => '1'
        ])->get();

        $tiposProceso = TipoProceso::where([
            'eliminado' => 0,
            'estado_tipo_proceso' => '1'
        ])->get();

        $entidadesDemandadas = EntidadDemandada::where([
            'eliminado' => 0,
            'estado_entidad_demandada' => '1'
        ])->get();

        $entidadesJusticia = EntidadJusticia::where([
            'eliminado' => 0,
            'estado_entidad_justicia' => '1'
        ])->get();

        $actuaciones = Actuacion::where([
            'eliminado' => 0,
            'estado_actuacion' => '1'
        ])->get();

        $usuarios = Usuario::
            leftjoin('persona as p', 'p.id_persona', 'usuario.id_persona')
            ->where([
            'eliminado' => 0,
            'estado_usuario' => '1'
        ])->get();

        $documentos = $proceso ? $this->getDocumentos($id, $proceso->id_tipo_proceso) : [];
        $paises = Pais::all();
        $departamentos = Departamento::all();
        $municipios = $proceso ?Municipio::where('id_departamento', $proceso->id_departamento)->get() : [];

        return $this->renderSection('proceso.detalle', [
            'proceso' => $proceso,
            'tiposProceso' => $tiposProceso,
            'documentos' => $documentos,
            'entidadesDemandadas' => $entidadesDemandadas,
            'entidadesJusticia' => $entidadesJusticia,
            'actuaciones' => $actuaciones,
            'paises' => $paises,
            'departamentos' => $departamentos,
            'municipios' => $municipios,
            'usuarios' => $usuarios,
            'clientes' => $clientes
        ]);
    }

    private function procesoExists($id, $numero_proceso) {

        $conditional[] = ['numero_proceso', $numero_proceso];
        $conditional[] = ['eliminado', 0];
        if ($id) {
            $conditional[] = ['id_proceso', '<>', $id];
        }

        return Proceso::where($conditional)->exists();
    }

    private function folderExists($id, $id_carpeta) {

        $conditional[] = ['id_carpeta', $id_carpeta];
        $conditional[] = ['eliminado', 0];
        if ($id) {
            $conditional[] = ['id_proceso', '<>', $id];
        }

        return Proceso::where($conditional)->exists();
    }

    public function upsert(Request $request) {
        $id = $request->get('id_proceso');
        $numero_proceso = strtoupper($request->get('numero_proceso'));
        $id_carpeta = strtoupper($request->get('numero_proceso'));

        if ($this->procesoExists($id, $numero_proceso)) {
            return response()->json(['procesoExists' => true]);
        }

        // if($this->folderExists($id, $id_carpeta)){
        //     return response()->json([ 'folderExists' => true ]);
        // }

        $dataProceso = $request->all();
        $dataProceso['id_usuario_actualizacion'] = Auth::id();
        $dataProceso['numero_proceso'] = $numero_proceso;
        $dataProceso['id_carpeta'] = $id_carpeta;
        $dataProceso['dar_informacion_caso'] = !empty($request->get('dar_informacion_caso')) ? 1 : 0;
        if (empty($id)) {
            $dataProceso['id_usuario_creacion'] = Auth::id();
        }

        $saved = Proceso::updateOrCreate(['id_proceso' => $id], $dataProceso);
        return response()->json(['saved' => $saved, $request->all()]);
    }

    public function delete($id) {
        $client = Proceso::find($id);
        $client->update(['eliminado' => 1]);
        return response()->json(['deleted' => true]);
    }

    private function getExtention($filename) {
        $fileSplit = explode('.', $filename);
        $index = count($fileSplit) - 1;
        return '.' . $fileSplit[$index];
    }

    public function deleteFile(Request $request) {
        $procesoDocumento = ProcesoDocumento::where([
            'id_proceso' => $request->get('id'),
            'id_documento' => $request->get('file_id')
        ]);

        $file = $procesoDocumento->first();
        $deleted = $procesoDocumento->delete();
        if ($file) {
            $id = $file->id_proceso_documento;
            $ext = $this->getExtention($file->nombre_archivo);
            Storage::disk('documentos')->delete("proceso/{$id}{$ext}");
        }

        return response()->json(['deleted' => $deleted]);
    }

    public function uploadFile(Request $request) {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $procesoDocumento = ProcesoDocumento::updateOrCreate([
            'id_proceso' => $request->get('id'),
            'id_documento' => $request->get('file_id')
        ], [
            'id_proceso' => $request->get('id'),
            'id_documento' => $request->get('file_id'),
            'nombre_archivo' => $filename
        ]);

        $ext = $this->getExtention($filename);
        $saveAs = "{$procesoDocumento->id_proceso_documento}{$ext}";
        $path = Storage::disk('documentos')->putFileAs('proceso', $file, $saveAs);
        return response()->json(['filename' => $filename, 'path' => $path]);
    }
}
