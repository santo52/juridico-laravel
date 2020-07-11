<?php

namespace App\Http\Controllers;

use App\Entities\TipoResultado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipoResultadoController extends Controller
{
    public function index() {
        $tiposResultado = TipoResultado::where('eliminado', 0)->get();
        return $this->renderSection('tiporesultado.listar', [
            'tiposResultado' => $tiposResultado
        ]);
    }

    private function getTipoResultado($id, $name)
    {
        if ($id) {
            $type = 'update';
            $tipos = TipoResultado::where([
                ['id_tipo_resultado', '<>',  $id],
                ['nombre_tipo_resultado', '=', $name],
            ]);
        } else {
            $type = 'create';
            $tipos = TipoResultado::where('nombre_tipo_resultado', $name);
        }

        return [
            'exists' => $tipos->exists(),
            'tipos' => $tipos->first(),
            'type' => $type
        ];
    }

    public function upsert(Request $request) {

        $id = $request->get('id_tipo_resultado');
        $name = $request->get('nombre_tipo_resultado');
        $tipo = $this->getTipoResultado($id, $name);
        $data = $request->all();
        $data['nombre_tipo_resultado'] = $name;
        $data['unico_tipo_resultado'] = empty($data['estado']) ? 2 : 1;

        if ($tipo['exists']) {

            $tipos = $tipo['tipos'];
            if ($tipo['type'] === 'update' || $tipos->eliminado === 0) {
                return response()->json(['exists' => true]);
            }

            $data['eliminado'] = 0;
            $data['id_tipo_resultado'] = $tipos->id_tipo_resultado;
            $id = $tipos->id_tipo_resultado;
        }

        $saved = TipoResultado::updateOrCreate(['id_tipo_resultado' => $id], $data);
        return response()->json(['saved' => $saved, $request->all()]);
    }

    public function delete($id)
    {
        $tipoResultado = TipoResultado::find($id);
        $deleted = $tipoResultado->update(['eliminado' => 1]);
        return response()->json(['deleted', $deleted]);
    }

    public function get($id)
    {
        $tipoResultado = TipoResultado::find($id);
        return response()->json([
            'tipoResultado' => $tipoResultado
        ]);
    }
}
