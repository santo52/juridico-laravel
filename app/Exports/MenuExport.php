<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use App\Entities\Menu;

class MenuExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Menu::select(
            "m.id_menu",
            "menu.nombre_menu as padre",
            'm.nombre_menu',
            "m.ruta_menu",
            DB::raw("IF(m.inactivo, 'Activo', 'Inactivo') as estado")
        )->leftJoin('menu as m', 'm.parent_id', '=', 'menu.id_menu')
            ->where('menu.parent_id', 0)
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Padre',
            'Nombre',
            'Ruta menú',
            'Estado'
        ];
    }
}
