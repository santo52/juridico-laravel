<?php

namespace App\Collection;

use App\Entities\ProcesoTipoResultado;
use Illuminate\Database\Eloquent\Collection;

class ProcesoCollection extends Collection
{
    public function addTiposResultadoToProceso()
    {
        return $this->map(function ($item) {
            $item->addTiposResultadoToProceso();
            return $item;
        });
    }
}
