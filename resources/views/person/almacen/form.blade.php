<div class="col-md-12">
    SUCURSAL
    <fieldset>
        <legend>
        </legend>

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('almacen') ? 'has-error' : ''}}">
                <label for="almacen" class="col-md-4 control-label">{{ 'Almacen' }}</label>
                <div class="col-md-6">
                    <input class="form-control" name="almacen" type="text" id="almacen" value="{{ $almacen->almacen or ''}}" >
                    {!! $errors->first('almacen', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('propietario') ? 'has-error' : ''}}">
                <label for="propietario" class="col-md-4 control-label">{{ 'Propietario' }}</label>
                <div class="col-md-6">
                    <input class="form-control" name="propietario" type="text" id="propietario" value="{{ $almacen->propietario or ''}}" >
                    {!! $errors->first('propietario', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('gerente') ? 'has-error' : ''}}">
                <label for="gerente" class="col-md-4 control-label">{{ 'Gerente' }}</label>
                <div class="col-md-6">
                    <input class="form-control" name="gerente" type="text" id="gerente" value="{{ $almacen->gerente or ''}}" >
                    {!! $errors->first('gerente', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('pag_web') ? 'has-error' : ''}}">
                <label for="pag_web" class="col-md-4 control-label">{{ 'Pag Web' }}</label>
                <div class="col-md-6">
                    <input class="form-control" name="pag_web" type="text" id="pag_web" value="{{ $almacen->pag_web or ''}}" >
                    {!! $errors->first('pag_web', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('razon_social') ? 'has-error' : ''}}">
                <label for="razon_social" class="col-md-4 control-label">{{ 'Razón Social' }}</label>
                <div class="col-md-6">
                    <input class="form-control" name="razon_social" type="text" id="razon_social" value="{{ $almacen->razon_social or ''}}" >
                    {!! $errors->first('razon_social', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('ruc') ? 'has-error' : ''}}">
                <label for="ruc" class="col-md-4 control-label">{{ 'Ruc' }}</label>
                <div class="col-md-6">
                    <input class="form-control" name="ruc" type="text" id="ruc" value="{{ $almacen->ruc or ''}}" >
                    {!! $errors->first('ruc', '<p class="help-block">:message</p>') !!}
                </div>
            </div>



            <div class="form-group {{ $errors->has('codestablecimiento') ? 'has-error' : ''}}">
                <label for="codestablecimiento" class="col-md-4 control-label">{{ 'Cod: Establecimiento' }}</label>
                <div class="col-md-6">
                    <input class="form-control" name="codestablecimiento" type="text" id="codestablecimiento" value="{{ $almacen->codestablecimiento or ''}}" >
                    {!! $errors->first('codestablecimiento', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('codpntemision') ? 'has-error' : ''}}">
                <label for="codpntemision" class="col-md-4 control-label">{{ 'Cod: Punto Emisión' }}</label>
                <div class="col-md-6">
                    <input class="form-control" name="codpntemision" type="text" id="codpntemision" value="{{ $almacen->codpntemision or ''}}" >
                    {!! $errors->first('codpntemision', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('auth_sri') ? 'has-error' : ''}}">
                <label for="auth_sri" class="col-md-4 control-label">{{ 'Autorización SRI' }}</label>
                <div class="col-md-6">
                    <input class="form-control" name="auth_sri" type="text" id="auth_sri" value="{{ $almacen->auth_sri or ''}}" >
                    {!! $errors->first('auth_sri', '<p class="help-block">:message</p>') !!}
                </div>
            </div>



            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                <label for="email" class="col-md-4 control-label">{{ 'Email' }}</label>
                <div class="col-md-6">
                    <input class="form-control" name="email" type="email" id="email" value="{{ $almacen->email or ''}}" >
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div><div class="form-group {{ $errors->has('fecha_inicio') ? 'has-error' : ''}}">
                <label for="fecha_inicio" class="col-md-4 control-label">{{ 'Fecha Inicio' }}</label>
                <div class="col-md-6">
                    <input class="form-control datepicker" name="fecha_inicio" type="text" id="fecha_inicio" value="{{ $almacen->fecha_inicio or ''}}" >
                    {!! $errors->first('fecha_inicio', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('logo') ? 'has-error' : ''}}">
                <label for="logo" class="col-md-4 control-label">{{ 'Logo' }}</label>
                <div class="col-md-6">
                    <input class="form-control" name="logo" type="file" id="logo" value="{{ $almacen->logo or ''}}" >
                    {!! $errors->first('logo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
                <label for="telefono" class="col-md-4 control-label">{{ 'Telefono' }}</label>
                <div class="col-md-6">
                    <input class="form-control" name="telefono" type="text" id="telefono" value="{{ $almacen->telefono or ''}}" >
                    {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('cel_movi') ? 'has-error' : ''}}">
                <label for="cel_movi" class="col-md-4 control-label">{{ 'Cel Movi' }}</label>
                <div class="col-md-6">
                    <input class="form-control" name="cel_movi" type="text" id="cel_movi" value="{{ $almacen->cel_movi or ''}}" >
                    {!! $errors->first('cel_movi', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('cel_claro') ? 'has-error' : ''}}">
                <label for="cel_claro" class="col-md-4 control-label">{{ 'Cel Claro' }}</label>
                <div class="col-md-6">
                    <input class="form-control" name="cel_claro" type="text" id="cel_claro" value="{{ $almacen->cel_claro or ''}}" >
                    {!! $errors->first('cel_claro', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


           


            <div class="form-group {{ $errors->has('watsapp') ? 'has-error' : ''}}">
                <label for="watsapp" class="col-md-4 control-label">{{ 'Watsapp' }}</label>
                <div class="col-md-6">
                    <input class="form-control" name="watsapp" type="text" id="watsapp" value="{{ $almacen->watsapp or ''}}" >
                    {!! $errors->first('watsapp', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


             


            <div class="form-group {{ $errors->has('fb') ? 'has-error' : ''}}">
                <label for="fb" class="col-md-4 control-label">{{ 'Facebook' }}</label>
                <div class="col-md-6">
                    <textarea class="form-control" rows="5" name="fb" type="textarea" id="fb" >{{ $almacen->fb or ''}}</textarea>
                    {!! $errors->first('fb', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('tw') ? 'has-error' : ''}}">
                <label for="tw" class="col-md-4 control-label">{{ 'Twitter' }}</label>
                <div class="col-md-6">
                    <textarea class="form-control" rows="5" name="tw" type="textarea" id="tw" >{{ $almacen->tw or ''}}</textarea>
                    {!! $errors->first('tw', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            </div>
        <div class="col-md-6">

            
            <div class="form-group {{ $errors->has('ins') ? 'has-error' : ''}}">
                <label for="ins" class="col-md-4 control-label">{{ 'Instagram' }}</label>
                <div class="col-md-6">
                    <textarea class="form-control" rows="5" name="ins" type="textarea" id="ins" >{{ $almacen->ins or ''}}</textarea>
                    {!! $errors->first('ins', '<p class="help-block">:message</p>') !!}
                </div>
            </div>



            <div class="form-group {{ $errors->has('gg') ? 'has-error' : ''}}">
                <label for="gg" class="col-md-4 control-label">{{ 'Google' }}</label>
                <div class="col-md-6">
                    <textarea class="form-control" rows="5" name="gg" type="textarea" id="gg" >{{ $almacen->gg or ''}}</textarea>
                    {!! $errors->first('gg', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('funcion_empresa') ? 'has-error' : ''}}">
                <label for="funcion_empresa" class="col-md-4 control-label">{{ 'Función Empresa' }}</label>
                <div class="col-md-6">
                    <textarea class="form-control" rows="5" name="funcion_empresa" type="textarea" id="funcion_empresa" >{{ $almacen->funcion_empresa or ''}}</textarea>
                    {!! $errors->first('funcion_empresa', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('slogan') ? 'has-error' : ''}}">
                <label for="slogan" class="col-md-4 control-label">{{ 'Slogan' }}</label>
                <div class="col-md-6">
                    <textarea class="form-control" rows="5" name="slogan" type="textarea" id="slogan" >{{ $almacen->slogan or ''}}</textarea>
                    {!! $errors->first('slogan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('dirMatriz') ? 'has-error' : ''}}">
    <label for="dirMatriz" class="col-md-4 control-label">{{ 'dir Matriz' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="dirMatriz" type="text" id="dirMatriz" value="{{ $almacen->dirMatriz or ''}}" >
        {!! $errors->first('dirMatriz', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('dirSucursal') ? 'has-error' : ''}}">
    <label for="dirSucursal" class="col-md-4 control-label">{{ 'dir Sucursal' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="dirSucursal" type="text" id="dirSucursal" value="{{ $almacen->dirSucursal or ''}}" >
        {!! $errors->first('dirSucursal', '<p class="help-block">:message</p>') !!}
    </div>
</div>
            <div class="form-group {{ $errors->has('latitud') ? 'has-error' : ''}}">
                <label for="latitud" class="col-md-4 control-label">{{ 'Latitud' }}</label>
                <div class="col-md-6">
                    <input class="form-control" name="latitud" type="text" id="latitud" value="{{ $almacen->latitud or ''}}" >
                    {!! $errors->first('latitud', '<p class="help-block">:message</p>') !!}
                </div>
            </div><div class="form-group {{ $errors->has('longitud') ? 'has-error' : ''}}">
                <label for="longitud" class="col-md-4 control-label">{{ 'Longitud' }}</label>
                <div class="col-md-6">
                    <input class="form-control" name="longitud" type="text" id="longitud" value="{{ $almacen->longitud or ''}}" >
                    {!! $errors->first('longitud', '<p class="help-block">:message</p>') !!}
                </div>
            </div><div class="form-group {{ $errors->has('pais_id') ? 'has-error' : ''}}">
                <label for="pais_id" class="col-md-4 control-label">{{ 'Pais' }}</label>
                <div class="col-md-6">
                    {!! Form::select('pais_id', $paises, null, ['class' => 'form-control','id'=>'pais_id']) !!}
                    {!! $errors->first('pais_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('provincia_id') ? 'has-error' : ''}}">
                <label for="provincia_id" class="col-md-4 control-label">{{ 'Provincia' }}</label>
                <div class="col-md-6">
                    {!! Form::select('provincia_id', $provincias, null, ['class' => 'form-control','id'=>'provincia_id']) !!}
                    {!! $errors->first('provincia_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('canton_id') ? 'has-error' : ''}}">
                <label for="canton_id" class="col-md-4 control-label">{{ 'Canton' }}</label>
                <div class="col-md-6">
                    {!! Form::select('canton_id', $cantones, null, ['class' => 'form-control','id'=>'canton_id']) !!}
                    {!! $errors->first('canton_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('activo') ? 'has-error' : ''}}">
                <label for="activo" class="col-md-4 control-label">{{ 'Activo' }}</label>
                <div class="col-md-6">
                    <select name="activo" class="form-control" id="activo" >
                        @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
                        <option value="{{ $optionKey }}" {{ (isset($almacen->activo) && $almacen->activo == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('activo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-4 col-md-4">
                    <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
                </div>
            </div>
        </div>
    </fieldset>
</div>


<script type="text/javascript">
    $('.datepicker').datepicker({
        format: "yyyy/mm/dd",
        language: "es",
        autoclose: true
    });
</script>