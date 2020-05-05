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

        $usuario = Usuario::where('nombre_usuario', $request->get('user'))->first();
        if($usuario && empty($usuario->password)) {
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
