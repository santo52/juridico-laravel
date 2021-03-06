<?php

namespace App\Builders;

use App\Builders\Builder;
use App\Entities\TipoProceso;
use App\Entities\ProcesoEtapa;
use App\Entities\ProcesoEtapaActuacion;
use App\Entities\ProcesoTipoResultado;
use App\Entities\EtapaProceso;
use App\Entities\Proceso;
use Illuminate\Support\Facades\Auth;

class ProcesoBuilder extends Builder
{

    private $values;

    public function __construct($builder, $values)
    {
        $this->values = $values;
        parent::__construct($builder);
    }

    public function addTiposResultadoToProceso(){
        $tiposResultadoProceso = ProcesoTipoResultado::with('tipoResultado')
            ->where('id_proceso', $this->values->id_proceso)
            ->whereRaw('id_tipo_resultado in (12, 14)')
            ->get();

        foreach($tiposResultadoProceso as $tipo) {
            if($tipo->id_tipo_resultado === 12) {
                $this->values->fecha_pago = $tipo->valor_proceso_tipo_resultado;
            } else if($tipo->id_tipo_resultado === 14) {
                $this->values->valor_final_sentencia = $tipo->valor_proceso_tipo_resultado;
            }
        }

        return $this->values;
    }

    public function createFirstActuacion()
    {
        if (!is_array($this->values)) {
            $etapa = TipoProceso::getEtapas($this->values->id_tipo_proceso)->first();
            if ($etapa) {
                $actuacion = EtapaProceso::getActuaciones($etapa->id_etapa_proceso)->first();
                return $this->createActuacion($etapa->id_etapa_proceso, $actuacion);
            }
        }
        return false;
    }

    public function createActuacion($id_etapa_proceso, $actuacion, $id_responsable = false, $id_usuario_asigna = false)
    {
        if (!empty($this->values) && !empty($id_etapa_proceso) && !empty($actuacion)) {

            if (!$id_responsable) {
                $id_responsable = Auth::id();
            }

            if (!$id_usuario_asigna) {
                $id_usuario_asigna = Auth::id();
            }

            $procesoEtapa = ProcesoEtapa::where([
                'id_etapa_proceso' => $id_etapa_proceso,
                'id_proceso' => $this->values->id_proceso
            ])->first();

            if (empty($procesoEtapa)) {
                $procesoEtapa = ProcesoEtapa::create([
                    'id_etapa_proceso' => $id_etapa_proceso,
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
                } else {
                    $procesoEtapaActuacion->update([
                        'id_usuario_responsable' => $id_responsable,
                        'id_usuario_asigna' => $id_usuario_asigna
                    ]);
                }

                $proceso = Proceso::find($this->values->id_proceso);
                if($proceso) {
                    $proceso->update(['id_etapa_proceso' => $procesoEtapa->id_etapa_proceso]);
                }

                return $procesoEtapaActuacion;
            }
        }

        return false;
    }


    public function changeActuacion($ignore = false)
    {

        $cond = "a.id_actuacion <> {$ignore}";
        $etapas = EtapaProceso::getActuaciones($this->values->id_etapa_proceso, $cond)->first();

        return [
            'proceso' => $this->values,
            '$etapas' => $etapas
        ];
    }
}
