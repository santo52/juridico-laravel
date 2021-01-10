<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\EntidadJusticia;
use App\Entities\Municipio;
use App\Entities\Pais;
use App\Entities\Departamento;
use App\Exports\EntidadJusticiaExport;
use Maatwebsite\Excel\Facades\Excel;

class EntidadJusticiaController extends Controller
{

    public function index(Request $request) {
        $entidades = EntidadJusticia::select(
            'id_entidad_justicia', 'nombre_entidad_justicia', 'email_entidad_justicia',
            'nombre_pais', 'nombre_departamento', 'nombre_municipio'
        )
        ->leftjoin('municipio as m', 'm.id_municipio', 'entidad_justicia.id_municipio')
        ->leftjoin('departamento as d', 'd.id_departamento', 'm.id_departamento')
        ->leftjoin('pais as p', 'p.id_pais', 'd.id_pais')
        ->where('eliminado', 0)
        ->applyFilters('id_entidad_justicia', $request)
        ->paginate(10)
        ->appends(request()->query())
        ->withPath('#entidades-de-justicia');
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
        $entidad = EntidadJusticia::with(['municipio','municipio.departamento'])->find($id);
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
        $email = strtolower($request->get('email_entidad_justicia'));
        $entidad = $this->getEntidad($id, $name);
        $data = $request->all();
        $data['nombre_entidad_justicia'] = $name;
        $data['estado_entidad_justicia'] = empty($data['estado']) ? 2 : 1;
        $data['email_entidad_justicia'] = $email;

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

    public function createExcel() {
        return Excel::download(new EntidadJusticiaExport, 'entidades_justicia.xlsx');
    }

    public function createPDF() {
        $entidades = EntidadJusticia::where('eliminado', 0)->get();
        $pdf = \PDF::loadView('entidad_justicia.pdf', ["entidades" => $entidades])->setPaper('a4', 'landscape');
        return $pdf->download('entidades_justicia.pdf');
    }
}
