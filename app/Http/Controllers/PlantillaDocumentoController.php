<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Entities\PlantillaDocumento;

class PlantillaDocumentoController extends Controller
{
    public function index(Request $request)
    {

        $plantillas = PlantillaDocumento::where('eliminado', 0)
        ->applyFilters('id_plantilla_documento', $request)
        ->paginate(10)
        ->appends(request()->query())
        ->withPath('#plantillas');
        return $this->renderSection('plantillas.listar', [
            'plantillas' => $plantillas
        ]);
    }

    public function get($id)
    {
        $plantilla = PlantillaDocumento::find($id);
        return $this->renderSection('plantillas.detalle', [
            'plantilla' => $plantilla
        ]);
    }

    private function plantillaExists($id, $nombre) {

        $conditional[] = ['nombre_plantilla_documento', $nombre];
        $conditional[] = ['eliminado', 0];
        if($id) {
            $conditional[] = ['id_plantilla_documento', '<>', $id];
        }

        $plantillaDocumento = PlantillaDocumento::where($conditional);

        return [
            'plantillaDocumento' => $plantillaDocumento->first(),
            'exists' => $plantillaDocumento->exists()
        ];
    }

    public function upsert(Request $request) {

        $data = $request->all();
        $id = $request->get('id_plantilla_documento');
        $nombre = $request->get('nombre_plantilla_documento');
        $found = $this->plantillaExists($id, $nombre);

        if($found['exists']) {
            $plantilla = $found['plantillaDocumento'];
            if(!empty($id) || (empty($id) && $plantilla->eliminado == 0)) {
                return response()->json([ 'plantillaExists' => true]);
            }
            $data['eliminado'] = 0;
            $id = $plantilla->id_plantilla_documento;
            $data['id_plantilla_documento'] = $id;
        }

        $data['estado_plantilla_documento'] = empty($request->get('estado')) ? 2 : 1;
        $saved = PlantillaDocumento::updateOrCreate(['id_plantilla_documento' => $id], $data);
        return response()->json([ 'saved' => $saved ]);
    }

    public function delete($id)
    {
        $plantilla = PlantillaDocumento::find($id);
        $deleted = $plantilla->update(['eliminado' => 1]);
        return response()->json(['deleted' => $deleted]);
    }
}
