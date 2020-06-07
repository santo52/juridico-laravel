<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Cobro;
use App\Entities\Pago;
use App\Entities\EntidadFinanciera;

class CobroController extends Controller
{
    public function index() {

        $entidadesFinancieras = EntidadFinanciera::where('eliminado', 0)->get();
        $cobros = Cobro::with('pago', 'procesoEtapaActuacion.procesoEtapa.proceso.cliente')
        ->where('cobro.eliminado', 0)->get();
        return $this->renderSection('cobro.listar', [
            'cobros' => $cobros,
            'entidadesFinancieras' => $entidadesFinancieras
        ]);
    }

    public function getCobro($id) {
        $cobro = Cobro::with('procesoEtapaActuacion.actuacion', 'procesoEtapaActuacion.procesoEtapa.etapaProceso')
        ->find($id);
        return response()->json($cobro);
    }

    public function getPago($id) {
        $cobro = Pago::where('id_cobro', $id)->first();
        return response()->json($cobro);
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

        $id = $request->get('id_cobro');
        $pagado = $request->get('valor_pago');
        $data = $request->all();
        $cobro = Cobro::find($id);
        $closed = 0;
        if( floatval($pagado) >= $cobro->valor) {
            $data['valor_pago'] = $cobro->valor;
            $closed = 1;
        }

        $saved = Pago::updateOrCreate(['id_cobro' => $id], $data);
        if($saved) {
            $cobro->update(['cerrado' => $closed]);
        }

        return response()->json(['saved' => $saved]);
    }
}
