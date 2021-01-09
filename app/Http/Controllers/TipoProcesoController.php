<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\TipoProceso;
use App\Entities\EtapaProceso;
use App\Entities\EtapasProcesoTipoProceso;
use Illuminate\Support\Facades\Auth;
use App\Exports\TipoProcesoExport;
use Maatwebsite\Excel\Facades\Excel;


class TipoProcesoController extends Controller
{
    public function index(Request $request)
    {
        $tiposProceso = TipoProceso::select('id_tipo_proceso', 'nombre_tipo_proceso', 'estado_tipo_proceso')
        ->where([
            'eliminado' => 0,
            'estado_tipo_proceso' => 1
        ])
        ->applyFilters('id_tipo_proceso', $request, function($query, $search, $searchBy) {
            if($search && in_array('estado_tipo_proceso', $searchBy)) {
                $estado = 10000;
                if(strpos('activo', strtolower($search)) !== false) {
                    $estado = 1;
                } else if(strpos('inactivo', strtolower($search)) !== false) {
                    $estado = 2;
                }

                $query->orHavingRaw("estado_tipo_proceso = '{$estado}'");
            }
        })
        ->paginate(10)
        ->appends(request()->query())
        ->withPath('#tipos-de-proceso');
        return $this->renderSection('tipoproceso.listar', [
            'tiposProceso' => $tiposProceso
        ]);
    }

    private function getTipoProceso($id, $name)
    {
        if ($id) {
            $type = 'update';
            $tipos = TipoProceso::where([
                ['id_tipo_proceso', '<>',  $id],
                ['nombre_tipo_proceso', '=', $name],
            ]);
        } else {
            $type = 'create';
            $tipos = TipoProceso::where('nombre_tipo_proceso', $name);
        }

        return [
            'exists' => $tipos->exists(),
            'tipos' => $tipos->first(),
            'type' => $type
        ];
    }

    public function upsert(Request $request)
    {
        $id = $request->get('id_tipo_proceso');
        $name = $request->get('nombre_tipo_proceso');
        $tipo = $this->getTipoProceso($id, $name);
        $data = $request->all();
        $data['nombre_tipo_proceso'] = $name;
        $data['estado_tipo_proceso'] = empty($data['estado']) ? 2 : 1;

        if ($tipo['exists']) {

            $tipos = $tipo['tipos'];
            if ($tipo['type'] === 'update' || $tipos->estado_tipo_proceso === 1) {
                return response()->json(['exists' => true]);
            }

            $data['estado_tipo_proceso'] = 1;
            $data['id_tipo_proceso'] = $tipos->id_tipo_proceso;
            $id = $tipos->id_tipo_proceso;
        }

        $saved = TipoProceso::updateOrCreate(['id_tipo_proceso' => $id], $data);

        if (empty($id)) {
            EtapasProcesoTipoProceso::where([
                'id_tipo_proceso' => 0,
                'id_usuario_creacion' => Auth::id()
            ])->update(['id_tipo_proceso' => $saved->id_tipo_proceso]);
        }

        return response()->json(['saved' => $saved, $request->all()]);
    }



    public function delete($id)
    {
        $tipoProceso = TipoProceso::find($id);
        $deleted = $tipoProceso->update(['eliminado' => 1]);
        return response()->json(['deleted', $deleted]);
    }

    public function get($id)
    {

        $tipoProceso = TipoProceso::find($id);
        $idTipo = !empty($tipoProceso) ? $tipoProceso->id_tipo_proceso : 0;

        $conditional['id_tipo_proceso'] = $idTipo;
        $conditional['eliminado'] = 0;
        $conditional['estado_etapa_proceso'] = 1;
        if ($idTipo == 0) {
            $conditional['eptp.id_usuario_creacion'] = Auth::id();
        }

        $selectedEtapas = EtapaProceso::select('etapa_proceso.*')
            ->leftjoin('etapas_proceso_tipo_proceso as eptp', 'eptp.id_etapa_proceso', 'etapa_proceso.id_etapa_proceso')
            ->where($conditional)
            ->orderBy('eptp.order')
            ->get();

        $selectedIdEtapas = [];
        foreach ($selectedEtapas as $etapa) {
            $selectedIdEtapas[] = $etapa->id_etapa_proceso;
        }

        $etapas = EtapaProceso::where(['eliminado' => 0, 'estado_etapa_proceso' => 1])
            ->whereNotIn('id_etapa_proceso', $selectedIdEtapas)->get();

        return response()->json([
            'tipoProceso' => $tipoProceso,
            'etapas' => $etapas,
            'selectedEtapas' => $selectedEtapas
        ]);
    }

    public function insertEtapa(Request $request)
    {
        $data = $request->all();
        $data['id_usuario_creacion'] = Auth::id();
        $data = EtapasProcesoTipoProceso::create($data);
        $saved = $data->save();
        return response()->json(['saved' => $saved]);
    }

    public function updateEtapa(Request $request)
    {

        $listEtapaProceso = explode(',', $request->get('orderedList'));
        $conditional['id_tipo_proceso'] = $request->get('id_tipo_proceso');
        if ($request->get('id_tipo_proceso') == 0) {
            $conditional['id_usuario_creacion'] = Auth::id();
        }

        $dataSaved = [];
        foreach ($listEtapaProceso as $position => $value) {
            $dataSaved[] = EtapasProcesoTipoProceso::where($conditional)
                ->where('id_etapa_proceso', $value)
                ->update(['order' => ($position + 1)]);
        }

        return response()->json(['saved' => $dataSaved, $request->all()]);
    }

    public function deleteEtapa(Request $request)
    {
        $conditionals['id_tipo_proceso'] = $request->get('id_tipo_proceso');
        $conditionals['id_etapa_proceso'] = $request->get('id_etapa_proceso');
        if ($request->get('id_tipo_proceso') == 0) {
            $conditionals['id_usuario_creacion'] = Auth::id();
        }

        $deleted = EtapasProcesoTipoProceso::where($conditionals)->delete();
        return response()->json(['deleted' => $deleted]);
    }

    public function createExcel() {
        return Excel::download(new TipoProcesoExport, 'tiposproceso.xlsx');
    }

    public function createPDF() {
        $tiposproceso = TipoProceso::where('eliminado', 0)->get();
        $pdf = \PDF::loadView('tipoproceso.pdf', ["tiposproceso" => $tiposproceso])->setPaper('a4', 'landscape');
        return $pdf->download('tiposproceso.pdf');
    }
}
