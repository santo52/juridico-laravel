<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Entities\Menu;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $permissions;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->permissions = json_decode($request->route('permissions'));
            return $next($request);
        });
    }

    protected function getPermissions() {
        return $this->permissions;
    }

    protected function renderSection($template, $data = []) {

        $data['permissions'] = $this->permissions;
        $view = view($template, $data)->renderSections();
        $response['content'] = isset($view['content']) ? $view['content'] : '';
        $response['javascript'] = isset($view['javascript']) ? $view['javascript'] : '';
        $response['title'] = isset($view['title']) ? $view['title'] : '';
        $response = array_merge($response, $data);
        $response['breadcrumb'] = isset($data['breadcrumb']) ? $data['breadcrumb'] : $this->getBreadcrumb();
        return response()->json($response);
    }

    private function getBreadcrumb() : array{
        $uri = '';
        $breadcrumb = [['name' => getenv('APP_NAME'), 'link' => '']];

        if(isset($_SERVER['REQUEST_URI'])) {
            $uri = $_SERVER['REQUEST_URI'];
        } else if(isset($_SERVER['REDIRECT_URL'])) {
            $uri = $_SERVER['REDIRECT_URL'];
        }

        $currentPosition = 0;
        $uri = explode('?', $uri)[0];
        foreach(explode('/', $uri) as $value ){

            $values = trim($value);
            $regex = '/(\?)([A-Za-z0-9].+)/';
            $value = preg_replace($regex, '', $values);

            if(!empty($value)){
                 $lastLink = str_replace(['#', '#/'], '', $breadcrumb[$currentPosition]['link']);
                 $breadcrumb[] = ['name' => $value, 'link' => "#{$lastLink}/{$value}"];
                 $currentPosition++;
            }
        }

        return $breadcrumb;
    }

    protected function getHash($cadena)
	{
		$hash = hash_init('sha256');
		hash_update($hash, $cadena);
		return hash_final($hash);
    }
}
