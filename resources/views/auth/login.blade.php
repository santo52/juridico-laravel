@extends('layout')

@section('content')
<div class="flex items-center" style="margin-top: 45px">
    <div class="row col-xs-12">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="thumbnail">
                <div class="caption">
                    <h3 class="text-center">Login</h3>
                    <form onsubmit="login.send(event)">
                        @csrf
                        <div class="form-group">
                            <label class="control-label" for="user">Usuario</label>
                            <input type="text" class="form-control required" id="user" name="user"
                                placeholder="Escriba el usuario">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password">Contraseña</label>
                            <input type="password" class="form-control required" id="password" name="password"
                                placeholder="Escriba la contraseña">
                        </div>
                        <div class="form-group">
                            <label></label>
                            <input type="submit" class="form-control btn btn-success" value="Ingresar" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{!! asset('/js/login.js') !!}"></script>
@endsection
