<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\EtapaProceso;
use App\Entities\Actuacion;
use App\Entities\ActuacionEtapaProceso;
use Illuminate\Support\Facades\Auth;

use App\Exports\EtapaProcesoExport;
use Maatwebsite\Excel\Facades\Excel;

class EtapaProcesoController extends Controller
{

    public function index(Request $request)
    {
        $etapasProceso = EtapaProceso::select('id_etapa_proceso', 'nombre_etapa_proceso', 'estado_etapa_proceso')
        ->where('eliminado', 0)
        ->applyFilters('id_etapa_proceso', $request, function($query, $search, $searchBy) {
            if($search && in_array('estado_etapa_proceso', $searchBy)) {

                $estado = 10;
                if(strpos('activo', strtolower($search)) !== false) {
                    $estado = 1;
                } else if(strpos('inactivo', strtolower($search)) !== false) {
                    $estado = 2;
                }

                $query->orHavingRaw("estado_etapa_proceso = '{$estado}'");
            }
        })
        ->paginate(10)
        ->appends(request()->query())
        ->withPath('#etapas-de-proceso');
        return $this->renderSection('etapaproceso.listar', [
            'etapas' => $etapasProceso
        ]);
    }

    public function getActuaciones($id)
    {
        $actuaciones = EtapaProceso::getActuaciones($id)->get();
        return response()->json($actuaciones);
    }

    public function get($id)
    {
        $etapaProceso = EtapaProceso::find($id);

        $selectedActuaciones = ActuacionEtapaProceso::leftjoin('actuacion as a', 'a.id_actuacion', 'actuacion_etapa_proceso.id_actuacion')
            ->where(['id_etapa_proceso' => $id])
            ->orderBy('actuacion_etapa_proceso.order')
            ->get();

        $selectedActuacionesID = [];

        foreach ($selectedActuaciones as $value) {
            $selectedActuacionesID[] = $value->id_actuacion;
        }

        $actuaciones = Actuacion::whereNotIn('id_actuacion', $selectedActuacionesID)
            ->where('estado_actuacion', 1)->get();

        return response()->json([
            'etapaProceso' => $etapaProceso,
            'selectedActuaciones' => $selectedActuaciones,
            'actuaciones' => $actuaciones
        ]);
    }

    public function delete($id)
    {
        $etapaProceso = EtapaProceso::find($id);
        $deleted = $etapaProceso->update(['eliminado' => 1]);
        return response()->json(['deleted' => $deleted]);
    }

    private function getEtapa($id, $name)
    {
        if ($id) {
            $type = 'update';
            $etapas = EtapaProceso::where([
                ['id_etapa_proceso', '<>',  $id],
                ['nombre_etapa_proceso', '=', $name],
            ]);
        } else {
            $type = 'create';
            $etapas = EtapaProceso::where('nombre_etapa_proceso', $name);
        }

        return [
            'exists' => $etapas->exists(),
            'etapas' => $etapas->first(),
            'type' => $type
        ];
    }

    public function upsert(Request $request)
    {

        $id = $request->get('id_etapa_proceso');
        $name = $request->get('nombre_etapa_proceso');
        $etapa = $this->getEtapa($id, $name);
        $data = $request->all();
        $data['nombre_etapa_proceso'] = $name;
        $data['estado_etapa_proceso'] = empty($data['estado']) ? 2 : 1;

        if ($etapa['exists']) {

            $etapas = $etapa['etapas'];
            if ($etapa['type'] === 'update' || $etapas->estado_etapa_proceso === 1) {
                return response()->json(['exists' => true]);
            }

            $data['estado_etapa_proceso'] = 1;
            $data['id_etapa_proceso'] = $etapas->id_etapa_proceso;
            $id = $etapas->id_etapa_proceso;
        }

        $saved = EtapaProceso::updateOrCreate(['id_etapa_proceso' => $id], $data);
        return response()->json(['saved' => $saved]);
    }

    public function insertActuacion(Request $request)
    {
        $data = $request->all();
        $data['id_usuario_creacion'] = Auth::id();
        $id = $request->get('id_actuacion_etapa_proceso');

        if (isset($data['after'])) {

            $all = ActuacionEtapaProceso::where([
                'id_etapa_proceso' => $data['id_etapa_proceso'],
            ])->orderBy('order')->get();

            foreach ($all as $key => $value) {
                $found = ActuacionEtapaProceso::find($value->id_actuacion_etapa_proceso);
                $found->update(['order' => ($key + 1)]);
            }

            $after = ActuacionEtapaProceso::where([
                'id_actuacion' => $data['after'],
                'id_etapa_proceso' => $data['id_etapa_proceso'],
            ])->first();

            $data['order'] = $after->order;
        }

        $saved = ActuacionEtapaProceso::updateOrCreate(['id_actuacion_etapa_proceso' => $id], $data);
        return response()->json(['saved' => $saved, $data]);
    }

    public function deleteActuacion($id)
    {
        $deleted = ActuacionEtapaProceso::find($id)->delete();
        return response()->json(['deleted' => $deleted]);
    }

    public function getActuacion($id)
    {
        $actuacion = ActuacionEtapaProceso::leftjoin('actuacion as a', 'a.id_actuacion', 'actuacion_etapa_proceso.id_actuacion')
            ->find($id);
        return response()->json($actuacion);
    }

    public function updateOrderActuacion(Request $request)
    {
        $listEtapaProceso = explode(',', $request->get('orderedList'));
        $conditional['id_etapa_proceso'] = $request->get('id_etapa_proceso');
        if ($request->get('id_etapa_proceso') == 0) {
            $conditional['id_usuario_creacion'] = Auth::id();
        }

        $dataSaved = [];
        foreach ($listEtapaProceso as $position => $value) {
            $dataSaved[] = ActuacionEtapaProceso::where($conditional)
                ->where('id_actuacion_etapa_proceso', $value)
                ->update(['order' => ($position + 1)]);
        }

        return response()->json(['saved' => $dataSaved, $request->all(), $conditional]);
    }

    public function createExcel() {
        return Excel::download(new EtapaProcesoExport, 'etapasProceso.xlsx');
    }

    public function createPDF() {
        $etapas = EtapaProceso::where('eliminado', 0)->get();
        $pdf = \PDF::loadView('etapaproceso.pdf', ["etapas" => $etapas])->setPaper('a4', 'landscape');
        return $pdf->download('etapas.pdf');
    }
}
