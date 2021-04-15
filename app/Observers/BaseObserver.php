<?php

namespace App\Observers;
use Illuminate\Support\Facades\Auth;

class BaseObserver
{
    public function creating($model){
        $model->id_usuario_creacion = Auth::id();
        return true;
    }

    public function saving($model){
        $model->id_usuario_actualizacion = Auth::id();
        return true;
    }
}
