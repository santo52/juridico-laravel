<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Entities\Usuario;
use App\Entities\TipoDocumento;
use App\Entities\Perfil;
use App\Entities\Persona;
use App\Entities\Municipio;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    public function index() {
        $usuarios = Usuario::
        leftjoin('persona as p', 'p.id_persona', 'usuario.id_persona')
        ->leftjoin('tipo_documento as td', 'p.id_tipo_documento', 'td.id_tipo_documento')
        ->leftjoin('municipio as mu', 'mu.id_municipio', 'p.id_municipio')
        // ->leftjoin('departamento as de', 'de.id_departamento', 'mu.id_departamento')
        // ->leftjoin('pais as pa', 'pa.id_pais', 'de.id_pais')
        ->where('usuario.eliminado', 0)->get();

        $municipios = Municipio::all();

        $tiposDocumento = TipoDocumento::where('eliminado', 0)->get();

        $perfiles = Perfil::where([
            'eliminado' => 0,
            'inactivo' => '0'
        ])->get();

        return $this->renderSection('usuario.listar', [
            'usuarios' => $usuarios,
            'tiposDocumento' => $tiposDocumento,
            'municipios' => $municipios,
            'perfiles' => $perfiles
        ]);
    }

    public function getMunicipio($id) {
        $municipio = Municipio::find($id);
        return response()->json($municipio);
    }

    public function get($id) {

        $usuario = Usuario::
        leftjoin('persona as p', 'p.id_persona', 'usuario.id_persona')
        ->leftjoin('municipio as mu', 'mu.id_municipio', 'p.id_municipio')
        ->where('id_usuario', $id)
        ->first();

        return response()->json([ 'usuario' => $usuario ]);
    }

    public function delete($id) {
        $usuario = Usuario::find($id);
        $deleted = $usuario->update([ 'eliminado' => 1 ]);
        return response()->json([ 'deleted' => $deleted ]);
    }

    private function usuarioExists($id, $numero_documento, $nombre_usuario) {


        $conditional[] = ['nombre_usuario', $nombre_usuario];
        $conditional[] = ['eliminado', 0];
        if($id) {
            $conditional[] = ['id_usuario', '<>', $id];
        }

        return Usuario::
            leftjoin('persona as p', 'p.id_persona', 'usuario.id_persona')
            ->where($conditional)
            ->exists();
    }

    private function isValidPassword($password) {
        return strlen($password) >= 6;
    }

    public function upsert(Request $request){

        $id = $request->get('id_usuario');
        $nombre_usuario = strtolower(trim($request->get('nombre_usuario')));
        preg_match_all('/([0-9])/', $request->get('numero_documento'), $matches);
        $documento = implode('', $matches[0]);
        $password = trim($request->get('password_value'));

        if(empty($documento)){
            return response()->json([ 'invalidDocument' => true ]);
        }

        $exists = $this->usuarioExists($id, $documento, $nombre_usuario);
        if($exists) {
            return response()->json([ 'userExists' => true ]);
        }

        $dataPersona = $request->all();
        $dataPersona['numero_documento'] = $documento;
        if(empty($dataPersona['id_tipo_documento'])) {
            $dataPersona['id_tipo_documento'] = 1;
        }

        $persona = Persona::updateOrCreate(['numero_documento' => $documento ], $dataPersona);
        $datausuario = $dataPersona;

        if(!empty($password)) {
            if(!$this->isValidPassword($password)){
                return response()->json([ 'invalidPassword' => true ]);
            }
            $datausuario['password'] = Hash::make($password);
        } else if(empty($id)) {
            $datausuario['password'] = Hash::make('Juridico' . date('Y'));
        }

        $datausuario['id_persona'] = $persona->id_persona;
        $datausuario['nombre_usuario'] = $nombre_usuario;
        $datausuario['estado_usuario'] = !empty($request->get('estado')) ? 1 : 2;
        $saved = Usuario::updateOrCreate(['id_usuario' => $id], $datausuario);

        if($saved) {
            $request->firma->storeAs('firmas', $saved->id_usuario . '.png', 'uploads');
        }

        return response()->json([ 'saved' => $saved ]);
    }
}
