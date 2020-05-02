<?php

namespace App\Http\Controllers;

use App\Entities\Menu;

class HomeController extends Controller
{
    function index() {
        $menu = Menu::getMenuWithChildren();
        return view('index', ['menu' => $menu]);
    }
}
