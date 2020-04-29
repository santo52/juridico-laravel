<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Entities\ErrorLog;
use Illuminate\Support\Facades\Auth;

class ErrorLogController extends Controller
{
    function submit(Request $request) {

        $userId = Auth::check() ? Auth::id() : 0;
        $errorLog = ErrorLog::create([
            'user_id' => $userId,
            'xhr' => $request->get('xhr'),
            'status' => $request->get('status'),
            'error' => $request->get('error'),
        ]);

        $errorLog->save();
        return response()->json([ 'saved' => true ]);
    }
}
