<?php

namespace App\Http\Middleware;

use Closure;

use App\Entities\Menu;
use App\Entities\Accion;
use Illuminate\Support\Facades\Auth;

class Route
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->isMethod('post')) {
            $uri = $request->route()->uri;
            $uri = explode('/', $uri)[0];
            $idPerfil = Auth::user()->id_perfil;


            if ($idPerfil === env('PROFILE_ADMIN_ID', 1)) {

                $permissions = Accion::
                    select('accion.nombre_accion')
                    ->leftjoin('menu as m', 'accion.id_menu', 'm.id_menu')
                    ->where([
                    'm.inactivo' => '0',
                    'm.ruta_menu' => $uri,
                    'm.estado' => 1
                ])->orWhere('global', 1)
                    ->get();
            }
            else {

                //Verifica que los permisos de la ruta sean controlados desde la base de datos
                $routeExists = Menu::where('ruta_menu', $uri)->exists();
                if ($routeExists) {

                    //Verifica que tenga acceso a la ruta
                    $canShowModule = Menu::leftjoin('menu_perfil as p', 'p.id_menu', 'menu.id_menu')
                        ->where([
                        'menu.inactivo' => '0',
                        'menu.ruta_menu' => $uri,
                        'menu.estado' => 1,
                        'p.id_perfil' => $idPerfil,
                    ])->exists();

                    //Si no tiene permisos, redirecciona a la raiz
                    if (!$canShowModule) {
                        return response()->json(['redirect' => '']);
                    }
                }

                $permissions = Menu::
                    select('a.nombre_accion')
                    ->leftjoin('menu_perfil as p', 'p.id_menu', 'menu.id_menu')
                    ->leftjoin('accion_menu_perfil as amp', 'amp.id_menu_perfil', 'p.id_menu_perfil')
                    ->leftjoin('accion as a', 'a.id_accion', 'amp.id_accion')
                    ->where([
                    'menu.inactivo' => '0',
                    'menu.ruta_menu' => $uri,
                    'menu.estado' => 1,
                    'p.id_perfil' => $idPerfil,
                ])->whereNotNull('id_accion_menu')
                    ->get();
            }

            $list = new \stdClass();
            foreach ($permissions as $permission) {
                $key = str_replace(' ', '_', strtolower($permission->nombre_accion));
                $list->$key = true;
            }

            $request->route()->setParameter('permissions', json_encode($list));

        }
        return $next($request);
    }
}
