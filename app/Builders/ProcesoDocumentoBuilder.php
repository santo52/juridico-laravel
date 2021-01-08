<?php

namespace App\Builders;

use App\Builders\Builder;
use Illuminate\Support\Facades\Storage;

class ProcesoDocumentoBuilder extends Builder
{


    public function __construct($builder, $values)
    {
        $this->values = $values;
        parent::__construct($builder);
    }

    private function getExtention($filename)
    {
        $fileSplit = explode('.', $filename);
        $index = count($fileSplit) - 1;
        return '.' . $fileSplit[$index];
    }

    public function deleteFile()
    {
        $file = $this->first();
        $deleted = $this->delete();
        if ($file) {
            $id = $file->id_proceso_etapa_actuacion_documento;
            $ext = $this->getExtention($file->nombre_archivo);
            Storage::disk('documentos')->delete("proceso/{$id}{$ext}");
        }
        return $deleted;
    }
}
