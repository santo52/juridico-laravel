<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\GrupoVariable;
use App\Entities\Variable;

class VariableController extends Controller
{
    public function getAll()
    {
        $gruposVariables = GrupoVariable::where('estado_grupo_variable', 1)
            ->orderBy('orden')
            ->get();
        foreach ($gruposVariables as $key => $grupoVariables) {
            $children = Variable::where([
                'estado_variable' => 1,
                'id_grupo_variable' => $grupoVariables->id_grupo_variable
            ])->orderBy('orden')
                ->get();
            $gruposVariables[$key]['children'] = $children;
        }

        return response()->json($gruposVariables);
    }
}
