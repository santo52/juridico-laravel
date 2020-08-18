<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Cobro;
use App\Entities\Proceso;
use App\Entities\Honorario;
use App\Entities\PagoHonorario;
use App\Entities\Pago;
use App\Entities\Cliente;
use App\Entities\EntidadFinanciera;
use App\Entities\ProcesoTipoResultado;

class HonorarioController extends Controller
{
    public function index() {

        $clientes = Cliente::where(['eliminado' => 0, 'estado_cliente' => '1'])->get();
        $honorarios = Honorario::with('pagoHonorario', 'cliente.persona')->where('eliminado', 0)->get();
        foreach($honorarios as $honorario) {
            $honorario->proceso->addTiposResultadoToProceso();
        }
        $procesos = Proceso::select('id_proceso', 'numero_proceso')->where('eliminado', 0)->get();
        return $this->renderSection('honorarios.listar', [
            'honorarios' => $honorarios,
            'procesos' => $procesos,
            'clientes' => $clientes
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

    public function getPago($id) {
        $cobro = Pago::where('id_cobro', $id)->first();
        return response()->json($cobro);
    }

    public function upsert(Request $request) {
        $id = $request->get('id_honorario');
        $saved = Honorario::updateOrCreate(['id_honorario' => $id], $request->all());
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

    public function getProceso($id) {
        $proceso = Proceso::with('cliente.persona', 'cliente.intermediario.persona')->find($id)->addTiposResultadoToProceso();
        return response()->json($proceso);
    }
}
