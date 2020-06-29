@section('content')
<div class="flex items-center" style="margin-top: 45px">
    <div class="row col-xs-12">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="thumbnail">
                <div class="caption">
                    <h3 class="text-center">Cambiar contraseña</h3>
                    <form onsubmit="changePassword.upsert(event)">
                        @csrf
                        <div class="form-group">
                            <label class="control-label" for="user">Contraseña Anterior</label>
                            <input type="password" class="form-control required" id="old-password" name="old_password"
                                placeholder="Escriba la contraseña anterior">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password">Nueva Contraseña</label>
                            <input type="password" class="form-control required" id="password" name="password"
                                placeholder="Escriba la nueva contraseña">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password">Confirmar nueva Contraseña</label>
                            <input type="password" class="form-control required" id="confirm-password" name="confirm-password"
                                placeholder="Confirme la nueva contraseña">
                        </div>
                        <div class="form-group">
                            <label></label>
                            <input type="submit" class="form-control btn btn-success" value="Cambiar contraseña" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
