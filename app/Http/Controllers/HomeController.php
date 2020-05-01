<?php

namespace App\Http\Controllers;

use App\Entities\Menu;

class HomeController extends Controller
{
    function index() {

        $menu = Menu::where([
            ['inactivo', '0'],
            ['parent_id', '0']
        ])->orderBy('orden_menu')->get();

        foreach($menu as $key => $parent){
            $children = Menu::where([
                ['inactivo', '0'],
                ['parent_id', $parent->id_menu]
            ])->orderBy('orden_menu')->get();

            $menu[$key]['children'] = $children;
        }

        return view('index', ['menu' => $menu]);
    }
}
