<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
// use Illuminate\Support\Facades\Event;
use App\Observers\BaseObserver;
use App\Entities\Accion;
use App\Entities\AccionPerfil;
use App\Entities\Actuacion;
use App\Entities\Cliente;
use App\Entities\Documento;
use App\Entities\EntidadDemandada;
use App\Entities\EntidadJusticia;
use App\Entities\EtapaProceso;
use App\Entities\Intermediario;
use App\Entities\Menu;
use App\Entities\MenuPerfil;
use App\Entities\Perfil;
use App\Entities\Persona;
use App\Entities\PlantillaDocumento;
use App\Entities\Proceso;
use App\Entities\ProcesoEtapa;
use App\Entities\ProcesoEtapaActuacion;
use App\Entities\SedeOperativa;
use App\Entities\TipoDocumento;
use App\Entities\TipoProceso;
use App\Entities\Usuario;
use App\Entities\UsuarioSedeOperativa;
use App\Entities\Cobro;
use App\Entities\Pago;
use App\Entities\Honorario;
use App\Entities\PagoHonorario;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Accion::observe(BaseObserver::class);
        AccionPerfil::observe(BaseObserver::class);
        Actuacion::observe(BaseObserver::class);
        Cliente::observe(BaseObserver::class);
        Documento::observe(BaseObserver::class);
        EntidadDemandada::observe(BaseObserver::class);
        EntidadJusticia::observe(BaseObserver::class);
        EtapaProceso::observe(BaseObserver::class);
        Intermediario::observe(BaseObserver::class);
        Menu::observe(BaseObserver::class);
        MenuPerfil::observe(BaseObserver::class);
        Perfil::observe(BaseObserver::class);
        Persona::observe(BaseObserver::class);
        PlantillaDocumento::observe(BaseObserver::class);
        Proceso::observe(BaseObserver::class);
        ProcesoEtapa::observe(BaseObserver::class);
        ProcesoEtapaActuacion::observe(BaseObserver::class);
        SedeOperativa::observe(BaseObserver::class);
        TipoDocumento::observe(BaseObserver::class);
        TipoProceso::observe(BaseObserver::class);
        Usuario::observe(BaseObserver::class);
        UsuarioSedeOperativa::observe(BaseObserver::class);
        Cobro::observe(BaseObserver::class);
        Pago::observe(BaseObserver::class);
        Honorario::observe(BaseObserver::class);
        PagoHonorario::observe(BaseObserver::class);
    }
}
