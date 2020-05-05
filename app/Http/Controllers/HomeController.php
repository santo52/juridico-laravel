<?php

namespace App\Http\Controllers;

use App\Entities\Menu;
use Illuminate\Http\Request;
use App\Http\Middleware\Route;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    function index() {
        $menu = Menu::getMenuWithChildren('orden_menu', true);
        return view('index', ['menu' => $menu]);
    }
}
