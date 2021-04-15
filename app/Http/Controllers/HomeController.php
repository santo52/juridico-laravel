<?php

namespace App\Http\Controllers;

use App\Entities\Menu;
use Illuminate\Http\Request;
use App\Http\Middleware\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Entities\Usuario;

class HomeController extends Controller
{
    function index() {
        $menu = Menu::getMenuWithChildren('orden_menu', true);
        return view('index', ['menu' => $menu]);
    }

    function changePassword() {
        return $this->renderSection('change_password.index', [
            'menu' => []
        ]);
    }

    function changePasswordUpsert(Request $request) {

        if(!Hash::check($request->get('old_password'), Auth::user()->password)) {
            return response()->json([ 'invalid' => true ]);
        }

        if($request->get('password') !== $request->get('confirm-password')) {
            return response()->json([ 'notconfirmed' => true ]);
        }

        $user = Usuario::find(Auth::id());
        if($user) {
            $user->update(['password' => Hash::make($request->get('password'))]);
            return response()->json(['saved' => true ]);
        }

        return response()->json([]);
    }
}
