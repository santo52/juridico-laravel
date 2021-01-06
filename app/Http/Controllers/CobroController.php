<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Cobro;
use App\Entities\Proceso;
use App\Entities\Pago;
use App\Entities\EntidadFinanciera;

class CobroController extends Controller
{
    public function index() {

        $procesos = Proceso::getAll()->orderBy('id_proceso', 'desc')
        ->paginate(10)->withPath('#cobros-y-pagos');

        return $this->renderSection('proceso.listar', [
            'procesos' => $procesos,
            'cobros' => true
        ]);
    }

    public function get($id) {
        $entidadesFinancieras = EntidadFinanciera::where('eliminado', 0)->get();
        $cobros = Cobro::whereHas('procesoEtapaActuacion.procesoEtapa.proceso', function($q) use($id){
            $q->where('id_proceso', $id);
        })
        ->with('pago', 'procesoEtapaActuacion', 'procesoEtapaActuacion.procesoEtapa.proceso.cliente')
        ->where('cobro.eliminado', 0)->get();

        $totalCobrado = 0;
        $totalPagado = 0;

        foreach($cobros as $cobro) {
            $totalCobrado += $cobro->valor;
            if($cobro->pago) {
                $totalPagado += $cobro->getPagado();
            }
        }


        return $this->renderSection('cobro.detalle', [
            'cobros' => $cobros,
            'entidadesFinancieras' => $entidadesFinancieras,
            'totalCobrado' => $totalCobrado,
            'totalPagado' => $totalPagado,
        ]);


    }

    public function getCobro($id) {
        $cobro = Cobro::with('procesoEtapaActuacion.actuacion', 'procesoEtapaActuacion.procesoEtapa.etapaProceso')
        ->find($id);
        return response()->json($cobro);
    }

    public function getPagos($id) {
        $cobro = Pago::where('id_cobro', $id)->get();
        return response()->json($cobro);
    }

    public function getPago($id) {
        $pago = Pago::find($id);
        return response()->json($pago);
    }

    public function upsert(Request $request) {
        $id = $request->get('id_cobro');
        if(empty($id)) {
            return response()->json(['saved' => false]);
        }

        $data = $request->all();

        if(floatval($data['valor']) <= 0) {
            unset($data['valor']);
        }

        $saved = Cobro::updateOrCreate(['id_cobro' => $id], $data);
        return response()->json(['saved' => $saved]);
    }

    public function upsertPago(Request $request) {

        $id = $request->get('id_pago');
        // $idCobro = $request->get('id_cobro');
        // $pagado = $request->get('valor_pago');
        $data = $request->all();
        // $cobro = Cobro::find($id);
        // $closed = 0;

        // return response()->json(['cobro' => $cobro, $id]);
        // if( floatval($pagado) >= $cobro->valor) {
        //     $data['valor_pago'] = $cobro->valor;
        //     $closed = 1;
        // }

        $saved = Pago::updateOrCreate(['id_pago' => $id], $data);
        // if($saved) {
        //     $cobro->update(['cerrado' => $closed]);
        // }

        return response()->json(['saved' => $saved, $request->all()]);
    }
}
