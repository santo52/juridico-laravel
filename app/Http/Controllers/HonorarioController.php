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
    public function index(Request $request) {
        $entidadesFinancieras = EntidadFinanciera::where('eliminado', 0)->get();
        $clientes = Cliente::where(['eliminado' => 0, 'estado_cliente' => '1'])->get();
        $honorarios = Honorario::with('pagoHonorario', 'cliente.persona')->where('eliminado', 0)
            ->applyFilters('id_honorario', $request)
            ->paginate(10)
            ->appends(request()->query())
            ->withPath('#honorarios');

        foreach($honorarios as $honorario) {
            $honorario->proceso->addTiposResultadoToProceso();
        }
        $procesos = Proceso::select('id_proceso', 'numero_proceso')->where('eliminado', 0)->get();
        return $this->renderSection('honorarios.listar', [
            'honorarios' => $honorarios,
            'procesos' => $procesos,
            'clientes' => $clientes,
            'entidadesFinancieras' => $entidadesFinancieras
        ]);
    }

    public function delete($id) {
        $honorario = Honorario::find($id);
        $deleted = $honorario->update(['eliminado' => 1]);
        return response()->json(['deleted' => $deleted]);
    }

    public function get($id) {
        $honorario = Honorario::find($id);
        return response()->json($honorario);
    }

    public function getCobro($id) {
        $cobro = Cobro::with('procesoEtapaActuacion.actuacion', 'procesoEtapaActuacion.procesoEtapa.etapaProceso')
        ->find($id);
        return response()->json($cobro);
    }

    public function upsert(Request $request) {
        $id = $request->get('id_honorario');
        $saved = Honorario::updateOrCreate(['id_honorario' => $id], $request->all());
        return response()->json(['saved' => $saved, $request->all()]);
    }

    public function getPagos($id) {
        $cobro = PagoHonorario::where('id_honorario', $id)->get();
        return response()->json($cobro);
    }

    public function getPago($id) {
        $pago = PagoHonorario::find($id);
        return response()->json($pago);
    }

    public function upsertPago(Request $request) {

        $id = $request->get('id_pago');
        // $pagado = $request->get('valor_pago');
        $data = $request->all();
        // $honorario = Honorario::find($id);
        // $valorTotal = $honorario->getValorAPagar();
        // $closed = 0;

        // if( floatval($pagado) >= $valorTotal) {
        //     $data['valor_pago'] = $valorTotal;
        //     $closed = 1;
        // }

        $saved = PagoHonorario::updateOrCreate(['id_pago_honorario' => $id], $data);
        // if($saved) {
        //     $honorario->update(['cerrado' => $closed]);
        // }

        return response()->json(['savedsss' => $saved, $request->all()]);
    }

    public function getProceso($id) {
        $proceso = Proceso::with('cliente.persona', 'cliente.intermediario.persona')->find($id)->addTiposResultadoToProceso();
        return response()->json($proceso);
    }
}
