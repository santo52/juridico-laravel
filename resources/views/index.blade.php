@extends('layout')

@section('content')
<div class="contenedor-pendientes">
    <div class="item-pendientes">
        <span class="pendientes-titulo">Audiencias programadas</span>
        <table class="table" data-empty="Sin pendientes">
            <thead>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Cliente</th>
                <th>Entidad</th>
                <th>Ciudad</th>
                <th>Juzgado</th>
                <th></th>
            </thead>
        </table>
    </div>
    <div class="item-pendientes">
        <span class="pendientes-titulo">Vencimiento de acciones</span>
        <table class="table" data-empty="Sin pendientes">
            <thead>
                <th>Cliente</th>
                <th>Ciudad</th>
                <th>Etapa</th>
                <th>Acción</th>
                <th>Fecha de radicación</th>
                <th>Vencimiento</th>
                <th></th>
            </thead>
        </table>
    </div>
    <div class="item-pendientes">
        <span class="pendientes-titulo">Otras tareas programadas</span>
        <table class="table" data-empty="Sin pendientes">
            <thead>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Descripción actividad</th>
                <th>Usuario</th>
                <th>Cliente</th>
                <th>Etapa</th>
                <th></th>
            </thead>
        </table>
    </div>
    <div class="item-pendientes">
        <span class="pendientes-titulo">Contratos de trabajo próximos a vencer</span>
        <table class="table" data-empty="Sin pendientes">
            <thead>
                <th>Nombre del empleado</th>
                <th>Tipo de contrato</th>
                <th>Fecha de inicio</th>
                <th>Fecha fin</th>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="{!! asset('core/js/loguedFunctions.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/modules.js') !!}"></script>
@endsection
