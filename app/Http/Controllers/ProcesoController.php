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
use App\Entities\EtapaProceso;
use App\Entities\ProcesoEtapa;
use App\Entities\ProcesoEtapaActuacion;
use App\Entities\ProcesoTipoResultado;
use App\Entities\TipoResultado;

class ProcesoController extends Controller
{
    public function index()
    {
        $procesos = Proceso::getAll()->orderBy('id_proceso', 'desc')->get();
        return $this->renderSection('proceso.listar', [
            'procesos' => $procesos,
            'creacion' => true
        ]);
    }

    public function getDocumentosTipoProceso(Request $request)
    {
        $id_proceso = $request->get('id_proceso');
        $id_tipo_proceso = $request->get('id_tipo_proceso');
        if (empty($id_tipo_proceso)) {
            return response()->json([]);
        }
        return response()->json($this->getDocumentos($id_proceso, $id_tipo_proceso));
    }

    private function getDocumentos($id, $id_tipo_proceso)
    {
        $actuacion = EtapasProcesoTipoProceso::select('a.id_actuacion')
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

        $actuacionDocumentos = ActuacionDocumento::leftjoin('documento as d', 'd.id_documento', 'actuacion_documento.id_documento')
            ->where([
                'id_actuacion' => $actuacion->id_actuacion,
                'eliminado' => 0,
                'estado_documento' => '1',
            ])->get();

        foreach ($actuacionDocumentos as $key => $value) {
            $idProceso = $id ? $id : 0;
            $procesoDocumento = ProcesoDocumento::where([
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

    public function get($id)
    {
        $proceso = Proceso::get($id);
        $clientes = Cliente::leftjoin('persona as pe', 'pe.id_persona', 'cliente.id_persona')
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

        $usuarios = Usuario::leftjoin('persona as p', 'p.id_persona', 'usuario.id_persona')
            ->where([
                'eliminado' => 0,
                'estado_usuario' => '1'
            ])->get();

        // $documentos = $proceso ? $this->getDocumentos($id, $proceso->id_tipo_proceso) : [];
        $paises = Pais::all();
        $departamentos = Departamento::all();
        $municipios = $proceso ? Municipio::where('id_departamento', $proceso->municipio->id_departamento)->get() : [];

        $tiposResultado = TipoResultado::where(['eliminado' => 0, ['id_tipo_resultado', '>', 4]])->get();
        foreach($tiposResultado as $key => $value) {
            $procesoTipoResultado = ProcesoTipoResultado::where(['id_proceso' => $id, 'id_tipo_resultado' => $value->id_tipo_resultado])->first();
            if($procesoTipoResultado) {
                $tiposResultado[$key]->value = $procesoTipoResultado->valor_proceso_tipo_resultado;
            }
        }

        return $this->renderSection('proceso.detalle', [
            'proceso' => $proceso,
            'tiposProceso' => $tiposProceso,
            'tiposResultado' => $tiposResultado,
            // 'documentos' => $documentos,
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

    private function procesoExists($id, $numero_proceso)
    {

        $conditional[] = ['numero_proceso', $numero_proceso];
        $conditional[] = ['numero_proceso', '<>' , ''];
        $conditional[] = ['eliminado', 0];
        if ($id) {
            $conditional[] = ['id_proceso', '<>', $id];
        }

        return Proceso::where($conditional)->exists();
    }

    public function upsert(Request $request)
    {
        $id = $request->get('id_proceso');
        $numero_proceso = strtoupper($request->get('numero_proceso'));
        $id_carpeta = strtoupper($request->get('id_carpeta'));

        if ($this->procesoExists($id, $numero_proceso)) {
            return response()->json(['procesoExists' => true]);
        }

        $dataProceso = $request->all();
        $dataProceso['numero_proceso'] = $numero_proceso;
        $dataProceso['id_carpeta'] = $id_carpeta;
        $dataProceso['dar_informacion_caso'] = !empty($request->get('dar_informacion_caso')) ? 1 : 0;
        $dataProceso['caducidad'] = !empty($request->get('caducidad')) ? 1 : 0;
        if (empty($id)) {
            $dataProceso['id_usuario_creacion'] = Auth::id();
            $dataProceso['id_usuario_responsable'] = Auth::id();
        }

        if (empty($request->get('valor_estudio'))) {
            $dataProceso['valor_estudio'] = 0;
        }

        $saved = Proceso::updateOrCreate(['id_proceso' => $id], $dataProceso);
        // return response()->json([$saved->getAttribute('id_proceso'), get_class_methods($saved)]);
        if ($saved) {
            if (empty($id)) {
                ProcesoDocumento::where([
                    'id_proceso' => 0,
                    'id_usuario_creacion' => Auth::id()
                ])->update(['id_proceso' => $saved->id_proceso]);
            }

            $saved->createFirstActuacion();
        }

        return response()->json(['saved' => $saved, $request->all(), Auth::id(), $id]);
    }

    public function delete($id)
    {
        $client = Proceso::find($id);
        $client->update(['eliminado' => 1]);
        return response()->json(['deleted' => true]);
    }
}
