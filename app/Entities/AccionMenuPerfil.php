<?php
namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class AccionMenuPerfil extends Model
{
    protected $table = 'accion_menu_perfil';

    protected $primaryKey = 'id_accion_menu';

    public $timestamps = false;

    protected $fillable = [
        "id_accion_menu", "id_menu_perfil", "id_accion"
    ];
}
