<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function renderSection($template, $data = []) {
        $view = view($template, $data)->renderSections();
        return response()->json([
            'content' => !empty($view['content']) ? $view['content'] : '',
            'title' => !empty($view['title']) ? $view['title'] : ''
        ]);
    }

    protected function getHash($cadena)
	{
		$hash = hash_init('sha256');
		hash_update($hash, $cadena);
		return hash_final($hash);
	}
}
