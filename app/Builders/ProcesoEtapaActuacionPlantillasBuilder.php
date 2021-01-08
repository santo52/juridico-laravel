<?php

namespace App\Builders;

use App\Builders\Builder;
use App\Entities\Variable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProcesoEtapaActuacionPlantillasBuilder extends Builder
{

    private $values;
    private $folder = 'actuacion-proceso';
    private $disk = 'plantillas';

    public function __construct($builder, $values)
    {
        $this->values = $values;
        parent::__construct($builder);
    }

    public function saveDocument()
    {

        $disk = Storage::disk('plantillas');

        $content = $this->getContent();
        $path = $disk->path($this->folder . '/');
        $fileName = $this->values->id_proceso_etapa_actuacion_plantillas . '.pdf';

        $pdf = \PDF::loadView('pdf_template', ["content" => $content])->setPaper('a4');
        $pdf->save($path . $fileName);

        return $disk->url($this->folder . '/' . $fileName);
    }

    public function deleteDocument()
    {
        $id = $this->values->id_proceso_etapa_actuacion_plantillas;
        $deleted = $this->find($id)->delete();
        if ($deleted) {
            Storage::disk('plantillas')->delete($this->folder . '/' . $id . '.pdf');
        }

        return $deleted;
    }

    public function getContent()
    {
        $html = $this->values->plantillaDocumento->contenido_plantilla_documento;

        preg_match_all('/({!!)(\w+)(!!})/', $html, $matches);
        $variableList = $matches[2];
        $variables = Variable::whereIn('valor_variable', $variableList)->get();
        $proceso = $this->values->proceso;

        foreach ($variables as $variable) {
            if (!empty($variable->function_variable)) {

                if ($variable->id_grupo_variable != 3) {

                    switch ($variable->id_grupo_variable) {
                        case 1:
                        case 4:
                            $model = $proceso->cliente;
                            break;
                        case 2:
                            $model = $proceso;
                            break;
                        case 5:
                            $model = $proceso->cliente->contacto;
                            break;
                        case 6:
                            $model = Auth::user();
                            break;
                        default:
                            $model = $proceso;
                            break;
                    }

                    if (empty($model)) {
                        continue;
                    }

                    $var = $model->{$variable->function_variable};
                    if (!empty($var) && is_callable($var)) {
                        $var = $var();
                    }

                    if ($var == '' || $var) {
                        $html = str_replace("{!!{$variable->valor_variable}!!}", $var, $html);
                    }
                } else { // Variables globales
                    $var = eval('return ' . $variable->function_variable . ';');
                    $html = str_replace("{!!{$variable->valor_variable}!!}", $var, $html);
                }
            }
        }

        return $html;
    }
}
