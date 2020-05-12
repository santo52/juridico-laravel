<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Intermediario;
use App\Entities\TipoDocumento;
use App\Entities\Persona;
use App\Entities\Municipio;
use Illuminate\Support\Facades\Auth;

class IntermediarioController extends Controller
{
    public function index() {
        $intermediarios = Intermediario::
        leftjoin('persona as p', 'p.id_persona', 'intermediario.id_persona')
        ->leftjoin('tipo_documento as td', 'p.id_tipo_documento', 'td.id_tipo_documento')
        ->leftjoin('municipio as mu', 'mu.id_municipio', 'p.id_municipio')
        // ->leftjoin('departamento as de', 'de.id_departamento', 'mu.id_departamento')
        // ->leftjoin('pais as pa', 'pa.id_pais', 'de.id_pais')
        ->where('intermediario.eliminado', 0)->get();

        $municipios = Municipio::all();


        $tiposDocumento = TipoDocumento::where('eliminado', 0)->get();
        return $this->renderSection('intermediario.listar', [
            'intermediarios' => $intermediarios,
            'tiposDocumento' => $tiposDocumento,
            'municipios' => $municipios
        ]);
    }

    public function getMunicipio($id) {
        $municipio = Municipio::find($id);
        return response()->json($municipio);
    }

    public function get($id) {

        $intermediario = Intermediario::
        leftjoin('persona as p', 'p.id_persona', 'intermediario.id_persona')
        ->leftjoin('municipio as mu', 'mu.id_municipio', 'p.id_municipio')
        ->where('id_intermediario', $id)
        ->first();

        return response()->json([ 'intermediario' => $intermediario ]);
    }

    public function delete($id) {
        $intermediario = Intermediario::find($id);
        $deleted = $intermediario->update([ 'eliminado' => 1 ]);
        return response()->json([ 'deleted' => $deleted ]);
    }

    private function intermediarioExists($id, $numero_documento) {

        $conditional[] = ['numero_documento', $numero_documento];
        $conditional[] = ['eliminado', 0];
        if($id) {
            $conditional[] = ['id_intermediario', '<>', $id];
        }

        return Intermediario::
            leftjoin('persona as p', 'p.id_persona', 'intermediario.id_persona')
            ->where($conditional)
            ->exists();
    }

    public function upsert(Request $request){

        $id = $request->get('id_intermediario');
        preg_match_all('/([0-9])/', $request->get('numero_documento'), $matches);
        $documento = implode('', $matches[0]);

        if(empty($documento)){
            return response()->json([ 'invalidDocument' => true ]);
        }

        $exists = $this->intermediarioExists($id, $documento);
        if($exists) {
            return response()->json([ 'documentExists' => true ]);
        }

        $intermediario = Intermediario::find($id);

        $dataPersona = $request->all();
        $dataPersona['numero_documento'] = $documento;
        $dataPersona['id_usuario_actualizacion'] = Auth::id();
        if(empty($id)) {
            $dataPersona['id_usuario_creacion'] = Auth::id();
        }

        $persona = Persona::updateOrCreate(['numero_documento' => $documento ], $dataPersona);

        $dataIntermediario = $dataPersona;
        $dataIntermediario['id_persona'] = $persona->id_persona;
        $dataIntermediario['estado_intermediario'] = !empty($request->get('estado')) ? 1 : 2;
        $saved = Intermediario::updateOrCreate(['id_intermediario' => $id], $dataIntermediario);

        return response()->json([ 'saved' => $saved ]);
    }
}
