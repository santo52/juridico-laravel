<?php

namespace App\Collection;

use Illuminate\Database\Eloquent\Collection;

class MenuCollection extends Collection
{
    public function toHuman(){
        return $this->map(function($item){
            if($item['parent_id'] === 0){
                $item['parent_id'] = 'Ninguno';
                $item['ruta_menu'] = 'N/A';
            }
            return $item;
        });
    }
}
