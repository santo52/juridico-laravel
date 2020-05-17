<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Entities\Proceso;
use App\Entities\TipoProceso;
use App\Entities\EntidadDemandada;
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

    public function get($id){

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

        $paises = Pais::all();
        $departamentos = Departamento::all();
        $municipios = $proceso ? Municipio::where('id_departamento', $proceso->id_departamento)->get() : [];




        return $this->renderSection('proceso.detalle', [
            'proceso' => $proceso,
            'tiposProceso' => $tiposProceso,
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
        if($id) {
            $conditional[] = ['id_proceso', '<>', $id];
        }

        return Proceso::where($conditional)->exists();
    }

    private function folderExists($id, $id_carpeta) {

        $conditional[] = ['id_carpeta', $id_carpeta];
        $conditional[] = ['eliminado', 0];
        if($id) {
            $conditional[] = ['id_proceso', '<>', $id];
        }

        return Proceso::where($conditional)->exists();
    }

    public function upsert(Request $request) {
        $id = $request->get('id_proceso');
        $numero_proceso = strtoupper($request->get('numero_proceso'));
        $id_carpeta = strtoupper($request->get('numero_proceso'));

        if($this->procesoExists($id, $numero_proceso)){
            return response()->json([ 'procesoExists' => true ]);
        }

        // if($this->folderExists($id, $id_carpeta)){
        //     return response()->json([ 'folderExists' => true ]);
        // }

        $dataProceso = $request->all();
        $dataProceso['id_usuario_actualizacion'] = Auth::id();
        $dataProceso['numero_proceso'] = $numero_proceso;
        $dataProceso['id_carpeta'] = $id_carpeta;
        $dataProceso['dar_informacion_caso'] = !empty($request->get('dar_informacion_caso')) ? 1 : 0;
        if(empty($id)){
            $dataProceso['id_usuario_creacion'] = Auth::id();
        }

        $saved = Proceso::updateOrCreate(['id_proceso' => $id], $dataProceso);
        return response()->json([ 'saved' => $saved, $request->all() ]);
    }

    public function delete($id) {
        $client = Proceso::find($id);
        $client->update(['eliminado' => 1]);
        return response()->json(['deleted' => true]);
    }
}
