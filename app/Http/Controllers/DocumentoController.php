<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Documento;
use Illuminate\Support\Facades\Auth;

class DocumentoController extends Controller
{
    public function index() {
        $documentos = Documento::where('eliminado', 0)->get();
        return $this->renderSection('documento.listar', [
            'documentos' => $documentos
        ]);
    }

    public function get($id) {
        $documento = Documento::find($id);
        return response()->json([ 'documento' => $documento ]);
    }

    public function delete($id) {
        $documento = Documento::find($id);
        $deleted = $documento->update([ 'eliminado' => 1 ]);
        return response()->json([ 'deleted' => $deleted ]);
    }

    private function getDocumento($id, $name) {
        if($id) {
            $type = 'update';
            $documentos = Documento::where([
                ['id_documento', '<>',  $id],
                ['nombre_documento', '=' ,$name],
            ]);
        } else {
            $type = 'create';
            $documentos = Documento::where('nombre_documento', $name);
        }

        return [
            'exists' => $documentos->exists(),
            'documentos' => $documentos->first(),
            'type' => $type
        ];
    }

    public function upsert(Request $request){

        $id = $request->get('id_documento');
        $name = $request->get('nombre_documento');
        $documento = $this->getDocumento($id, $name);
        $data = $request->all();
        $data['nombre_documento'] = $name;
        $data['estado_documento'] = empty($data['estado']) ? 2 : 1;
        $data['obligatoriedad_documento'] = empty($data['obligatorio']) ? 2 : 1;

        if ($documento['exists']) {

            $documentos = $documento['documentos'];
            if($documento['type'] === 'update' || $documentos->estado_documento === 1) {
                return response()->json(['exists' => true]);
            }

            $data['estado_documento'] = 1;
            $data['id_documento'] = $documentos->id_documento;
            $id = $documentos->id_documento;
        }

        $saved = Documento::updateOrCreate(['id_documento' => $id], $data);
        return response()->json([ 'saved' => $saved ]);
    }
}
