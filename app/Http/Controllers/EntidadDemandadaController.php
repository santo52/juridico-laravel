<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\EntidadDemandada;
use App\Exports\EntidadDemandadaExport;
use Maatwebsite\Excel\Facades\Excel;

class EntidadDemandadaController extends Controller
{

    public function index(Request $request) {
        $entidades = EntidadDemandada::select('id_entidad_demandada', 'nombre_entidad_demandada', 'email_entidad_demandada', 'estado_entidad_demandada')
        ->where('eliminado', 0)
        ->applyFilters('id_entidad_demandada', $request, function($query, $search, $searchBy) {
            if($search && in_array('estado_entidad_demandada', $searchBy)) {
                $estado = 10000;
                if(strpos('activo', strtolower($search)) !== false) {
                    $estado = 1;
                } else if(strpos('inactivo', strtolower($search)) !== false) {
                    $estado = 2;
                }

                $query->orHavingRaw("estado_entidad_demandada = '{$estado}'");
            }
        })
        ->paginate(10)
        ->appends(request()->query())
        ->withPath('#entidades-demandadas');
        return $this->renderSection('entidad_demandada.listar', [
            'entidades' => $entidades
        ]);
    }

    public function get($id) {
        $entidad = EntidadDemandada::with(['municipio','municipio.departamento'])->find($id);
        return response()->json([ 'entidadDemandada' => $entidad ]);
    }

    public function delete($id) {
        $entidad = EntidadDemandada::find($id);
        $deleted = $entidad->update([ 'eliminado' => 1 ]);
        return response()->json([ 'deleted' => $deleted ]);
    }

    private function getEntidad($id, $name) {
        if($id) {
            $type = 'update';
            $entidades = EntidadDemandada::where([
                ['id_entidad_demandada', '<>',  $id],
                ['nombre_entidad_demandada', '=' ,$name],
            ]);
        } else {
            $type = 'create';
            $entidades = EntidadDemandada::where('nombre_entidad_demandada', $name);
        }

        return [
            'exists' => $entidades->exists(),
            'entidades' => $entidades->first(),
            'type' => $type
        ];
    }

    public function upsert(Request $request){

        $id = $request->get('id_entidad_demandada');
        $name = $request->get('nombre_entidad_demandada');
        $email = strtolower($request->get('email_entidad_demandada'));
        $entidad = $this->getEntidad($id, $name);
        $data = $request->all();
        $data['nombre_entidad_demandada'] = $name;
        $data['estado_entidad_demandada'] = empty($data['estado']) ? 2 : 1;
        $data['email_entidad_demandada'] = $email;

        if ($entidad['exists']) {

            $entidades = $entidad['entidades'];
            if($entidad['type'] === 'update' || $entidades->estado_entidad_demandada === 1) {
                return response()->json(['exists' => true]);
            }

            $data['estado_entidad_demandada'] = 1;
            $data['id_entidad_demandada'] = $entidades->id_entidad_demandada;
            $id = $entidades->id_entidad_demandada;
        }

        $saved = EntidadDemandada::updateOrCreate(['id_entidad_demandada' => $id], $data);
        return response()->json([ 'saved' => $saved ]);
    }

    public function createExcel() {
        return Excel::download(new EntidadDemandadaExport, 'entidades_demandadas.xlsx');
    }

    public function createPDF() {
        $entidades = EntidadDemandada::where('eliminado', 0)->get();
        $pdf = \PDF::loadView('entidad_demandada.pdf', ["entidades" => $entidades])->setPaper('a4', 'landscape');
        return $pdf->download('entidades_demandadas.pdf');
    }
}
