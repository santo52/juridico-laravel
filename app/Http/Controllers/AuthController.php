<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Entities\Usuario;

class AuthController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function login(Request $request) {

        //Se busca un usuario que este activo y que su perfil esté activo
        $usuario = Usuario::
            leftjoin('perfil as p', 'p.id_perfil', 'usuario.id_perfil')
            ->where([
            'nombre_usuario' => $request->get('user'),
            'estado_usuario' => 1,
            'usuario.eliminado' => 0,
            'p.eliminado' => 0,
            'p.inactivo' => '0'
        ])->first();

        if(empty($usuario)) {
            return response()->json(['auth' => false]);
        }

        if (empty($usuario->password)) {
            Usuario::where('nombre_usuario', $request->get('user'))->update(['password' => Hash::make($request->get('password'))]);
        }

        $authenticated = Auth::attempt([
            'nombre_usuario' => $request->get('user'),
            'password' => $request->get('password')
        ]);

        return response()->json(['auth' => $authenticated]);
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
