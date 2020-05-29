<?php

namespace App\Builder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Entities\TipoProceso;
use App\Entities\ProcesoEtapa;
use App\Entities\ProcesoEtapaActuacion;
use App\Entities\EtapaProceso;
use Illuminate\Support\Facades\Auth;

class ProcesoBuilder extends Builder
{

    private $values;

    public function __construct($builder, $values)
    {
        $this->values = $values;
        parent::__construct($builder);
    }

    public function createFirstActuacion()
    {
        if (!is_array($this->values)) {
            $etapa = TipoProceso::getEtapas($this->values->id_tipo_proceso)->first();
            if ($etapa) {
                $actuacion = EtapaProceso::getActuaciones($etapa->id_etapa_proceso)->first();

                return $this->createActuacion($etapa, $actuacion);
            }
        }
        return false;
    }

    public function createActuacion($etapa, $actuacion, $id_responsable = false, $id_usuario_asigna = false)
    {
        if (!empty($this->values) && !empty($etapa) && !empty($actuacion)) {

            if (!$id_responsable) {
                $id_responsable = Auth::id();
            }

            if (!$id_usuario_asigna) {
                $id_usuario_asigna = Auth::id();
            }

            $procesoEtapa = ProcesoEtapa::where([
                'id_etapa_proceso' => $etapa->id_etapa_proceso,
                'id_proceso' => $this->values->id_proceso
            ])->first();

            if (empty($procesoEtapa)) {
                $procesoEtapa = ProcesoEtapa::create([
                    'id_etapa_proceso' => $etapa->id_etapa_proceso,
                    'id_proceso' => $this->values->id_proceso,
                    'porcentaje' => 0
                ]);
            }

            if ($procesoEtapa) {

                $procesoEtapaActuacion = ProcesoEtapaActuacion::where([
                    'id_proceso_etapa' => $procesoEtapa->id_proceso_etapa,
                    'id_actuacion' => $actuacion->id_actuacion,
                ])->first();

                if (empty($procesoEtapaActuacion)) {
                    $date = date('Y-m-d h:i:s');
                    $procesoEtapaActuacion = ProcesoEtapaActuacion::create([
                        'id_proceso_etapa' => $procesoEtapa->id_proceso_etapa,
                        'id_actuacion' => $actuacion->id_actuacion,
                        'fecha_inicio' => $date,
                        'id_usuario_responsable' => $id_responsable,
                        'id_usuario_asigna' => $id_usuario_asigna
                    ]);
                }

                return $procesoEtapaActuacion;
            }
        }

        return false;
    }
}
