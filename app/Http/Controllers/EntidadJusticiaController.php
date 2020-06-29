<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Entities\EntidadJusticia;
use App\Entities\Municipio;
use App\Entities\Pais;
use App\Entities\Departamento;

class EntidadJusticiaController extends Controller
{

    public function index() {
        $entidades = EntidadJusticia::where('eliminado', 0)->get();
        $ciudades = Municipio::all();
        $paises = Pais::all();
        $departamentos = Departamento::all();
        return $this->renderSection('entidad_justicia.listar', [
            'entidades' => $entidades,
            'ciudades' => $ciudades,
            'paises' => $paises,
            'departamentos' => $departamentos,
        ]);
    }

    public function get($id) {
        $entidad = EntidadJusticia::find($id);
        return response()->json([ 'entidadJusticia' => $entidad ]);
    }

    public function delete($id) {
        $entidad = EntidadJusticia::find($id);
        $deleted = $entidad->update([ 'eliminado' => 1 ]);
        return response()->json([ 'deleted' => $deleted ]);
    }

    private function getEntidad($id, $name) {
        if($id) {
            $type = 'update';
            $entidades = EntidadJusticia::where([
                ['id_entidad_justicia', '<>',  $id],
                ['nombre_entidad_justicia', '=' ,$name],
            ]);
        } else {
            $type = 'create';
            $entidades = EntidadJusticia::where('nombre_entidad_justicia', $name);
        }

        return [
            'exists' => $entidades->exists(),
            'entidades' => $entidades->first(),
            'type' => $type
        ];
    }

    public function upsert(Request $request){

        $id = $request->get('id_entidad_justicia');
        $name = $request->get('nombre_entidad_justicia');
        $entidad = $this->getEntidad($id, $name);
        $data = $request->all();
        $data['nombre_entidad_justicia'] = $name;
        $data['estado_entidad_justicia'] = empty($data['estado']) ? 2 : 1;

        if ($entidad['exists']) {

            $entidades = $entidad['entidades'];
            if($entidad['type'] === 'update' || $entidades->estado_entidad_justicia === 1) {
                return response()->json(['exists' => true]);
            }

            $data['estado_entidad_justicia'] = 1;
            $data['id_entidad_justicia'] = $entidades->id_entidad_justicia;
            $id = $entidades->id_entidad_justicia;
        }

        $data['aplica_primera_instancia'] = empty($data['primera_instancia']) ? 2 : 1;
        $data['aplica_segunda_instancia'] = empty($data['segunda_instancia']) ? 2 : 1;

        $saved = EntidadJusticia::updateOrCreate(['id_entidad_justicia' => $id], $data);
        return response()->json([ 'saved' => $saved ]);
    }
}
