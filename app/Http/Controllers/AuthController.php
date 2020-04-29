<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Entities\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function login(Request $request) {

        $authenticated = Auth::attempt([
            'nombre_usuario' => $request->get('user'),
            'password' => $request->get('password')
        ]);

        return response()->json([ 'auth' => $authenticated]);
    }
}
