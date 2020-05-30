<?php
namespace App\Entities;

use \App\BaseModel;

class AccionMenuPerfil extends BaseModel
{
    protected $table = 'accion_menu_perfil';

    protected $primaryKey = 'id_accion_menu';

    public $timestamps = false;

    protected $fillable = [
        "id_accion_menu", "id_menu_perfil", "id_accion"
    ];
}
