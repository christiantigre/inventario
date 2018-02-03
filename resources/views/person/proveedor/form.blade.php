<div class="col-md-6">
<div class="form-group {{ $errors->has('proveedor') ? 'has-error' : ''}}">
    <label for="proveedor" class="col-md-4 col-lg-2 control-label">{{ 'Proveedor' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::text('proveedor', null, ['class' => 'form-control','id'=>'proveedor','autofocus'=>'autofocus']) !!}
        {!! $errors->first('proveedor', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('dir') ? 'has-error' : ''}}">
    <label for="dir" class="col-md-4 col-lg-2 control-label">{{ 'Dirección' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::text('dir', null, ['class' => 'form-control','id'=>'dir','autofocus'=>'autofocus']) !!}
        {!! $errors->first('dir', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('tlfn') ? 'has-error' : ''}}">
    <label for="tlfn" class="col-md-4 col-lg-2 control-label">{{ 'Teléfono' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::text('tlfn', null, ['class' => 'form-control','id'=>'tlfn','autofocus'=>'autofocus']) !!}
        {!! $errors->first('tlfn', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cel_movi') ? 'has-error' : ''}}">
    <label for="cel_movi" class="col-md-4 col-lg-2 control-label">{{ 'Celular Movistar' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::text('cel_movi', null, ['class' => 'form-control','id'=>'cel_movi','autofocus'=>'autofocus']) !!}
        {!! $errors->first('cel_movi', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cel_claro') ? 'has-error' : ''}}">
    <label for="cel_claro" class="col-md-4 col-lg-2 control-label">{{ 'Celular Claro' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::text('cel_claro', null, ['class' => 'form-control','id'=>'cel_claro','autofocus'=>'autofocus']) !!}
        {!! $errors->first('cel_claro', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('watsapp') ? 'has-error' : ''}}">
    <label for="watsapp" class="col-md-4 col-lg-2 control-label">{{ 'Watsapp' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::text('watsapp', null, ['class' => 'form-control','id'=>'watsapp','autofocus'=>'autofocus']) !!}
        {!! $errors->first('watsapp', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('fax') ? 'has-error' : ''}}">
    <label for="fax" class="col-md-4 col-lg-2 control-label">{{ 'Fax' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::text('fax', null, ['class' => 'form-control','id'=>'fax','autofocus'=>'autofocus']) !!}
        {!! $errors->first('fax', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('mail') ? 'has-error' : ''}}">
    <label for="mail" class="col-md-4 col-lg-2 control-label">{{ 'Mail' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::text('mail', null, ['class' => 'form-control','id'=>'mail','autofocus'=>'autofocus']) !!}
        {!! $errors->first('mail', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('web') ? 'has-error' : ''}}">
    <label for="web" class="col-md-4 col-lg-2 control-label">{{ 'Web' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::text('web', null, ['class' => 'form-control','id'=>'web','autofocus'=>'autofocus']) !!}
        {!! $errors->first('web', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('ruc') ? 'has-error' : ''}}">
    <label for="ruc" class="col-md-4 col-lg-2 control-label">{{ 'Ruc' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::text('ruc', null, ['class' => 'form-control','id'=>'ruc','autofocus'=>'autofocus']) !!}
        {!! $errors->first('ruc', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('representante') ? 'has-error' : ''}}">
    <label for="representante" class="col-md-4 col-lg-2 control-label">{{ 'Representante' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::text('representante', null, ['class' => 'form-control','id'=>'representante','autofocus'=>'autofocus']) !!}
        {!! $errors->first('representante', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('actividad') ? 'has-error' : ''}}">
    <label for="actividad" class="col-md-4 col-lg-2 control-label">{{ 'Actividad' }}</label>
    <div class="col-md-6 col-lg-8">
        <textarea class="form-control" rows="5" name="actividad" type="textarea" id="actividad" >{{ $proveedor->actividad or ''}}</textarea>
        {!! $errors->first('actividad', '<p class="help-block">:message</p>') !!}
    </div>
</div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('logo') ? 'has-error' : ''}}">
    <label for="logo" class="col-md-4 col-lg-2 control-label">{{ 'Logo' }}</label>
    <div class="col-md-6 col-lg-8">
        <input class="form-control" name="logo" type="file" id="logo" value="{{ $almacen->logo or ''}}" >
        {!! $errors->first('logo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('id_pais') ? 'has-error' : ''}}">
    <label for="id_pais" class="col-md-4 col-lg-2 control-label">{{ 'Pais' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::select('id_pais', $paises, null, ['class' => 'form-control','id'=>'id_pais']) !!}
        {!! $errors->first('id_pais', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('id_provincia') ? 'has-error' : ''}}">
    <label for="id_provincia" class="col-md-4 col-lg-2 control-label">{{ 'Provincia' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::select('id_provincia', $provincias, null, ['class' => 'form-control','id'=>'id_provincia']) !!}
        {!! $errors->first('id_provincia', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('id_canton') ? 'has-error' : ''}}">
    <label for="id_canton" class="col-md-4 col-lg-2 control-label">{{ 'Cantón' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::select('id_canton', $cantones, null, ['class' => 'form-control','id'=>'id_canton']) !!}
        {!! $errors->first('id_canton', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('empresa') ? 'has-error' : ''}}">
    <label for="empresa" class="col-md-4 col-lg-2 control-label">{{ 'Empresa' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::text('empresa', null, ['class' => 'form-control','id'=>'empresa','autofocus'=>'autofocus']) !!}
        {!! $errors->first('empresa', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('ubicacion') ? 'has-error' : ''}}">
    <label for="ubicacion" class="col-md-4 col-lg-2 control-label">{{ 'Ubicación' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::text('ubicacion', null, ['class' => 'form-control','id'=>'ubicacion','autofocus'=>'autofocus']) !!}
        {!! $errors->first('ubicacion', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('latitud') ? 'has-error' : ''}}">
    <label for="latitud" class="col-md-4 col-lg-2 control-label">{{ 'Latitud' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::text('latitud', null, ['class' => 'form-control','id'=>'latitud','autofocus'=>'autofocus']) !!}
        {!! $errors->first('latitud', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('longitud') ? 'has-error' : ''}}">
    <label for="longitud" class="col-md-4 col-lg-2 control-label">{{ 'Longitud' }}</label>
    <div class="col-md-6 col-lg-8">
        {!! Form::text('longitud', null, ['class' => 'form-control','id'=>'longitud','autofocus'=>'autofocus']) !!}
        {!! $errors->first('longitud', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('activo') ? 'has-error' : ''}}">
    <label for="activo" class="col-md-4 col-lg-2 control-label">{{ 'Activo' }}</label>
    <div class="col-md-6 col-lg-8">
        <select name="status" class="form-control" id="status" >
            @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($almacen->activo) && $almacen->activo == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('activo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-8 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
</div>
