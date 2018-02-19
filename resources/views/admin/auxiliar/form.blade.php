<div class="form-group {{ $errors->has('subcuenta_id') ? 'has-error' : ''}}">
    <label for="subcuenta_id" class="col-md-4 control-label">{{ 'Cuenta' }}</label>
    <div class="col-md-6">
        {!! Form::select('subcuenta_id', $subcuentas, null, ['class' => 'form-control','id'=>'subcuenta_id','autofocus'=>'autofocus','onchange'=>'cuentaSubCuentasAdmin()']) !!}

        {!! Form::hidden('subcuenta', null, ['id'=>'subcuenta','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('subcuenta') !!}

        {!! $errors->first('subcuenta_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('secuencia') ? 'has-error' : ''}}">
    <label for="secuencia" class="col-md-4 control-label">{{ 'secuencia' }}</label>
    <div class="col-md-6">
        {!! Form::text('secuencia', null, ['id'=>'secuencia','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('secuencia') !!}        
        {!! $errors->first('secuencia', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('codigo') ? 'has-error' : ''}}">
    <label for="codigo" class="col-md-4 control-label">{{ 'Codigo' }}</label>
    <div class="col-md-6">
        {!! Form::text('codigo', null, ['class' => 'form-control input-sm','id'=>'codigo','autofocus'=>'autofocus','readonly'=>'readonly']), old('codigo') !!}
        {!! $errors->first('codigo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('auxiliar') ? 'has-error' : ''}}">
    <label for="auxiliar" class="col-md-4 control-label">{{ 'Auxiliar' }}</label>
    <div class="col-md-6">
        {!! Form::text('auxiliar', null, ['class' => 'form-control input-sm','id'=>'auxiliar','autofocus'=>'autofocus','onmouseout'=>'cuentaSubCuentasAdmin()']), old('auxiliar') !!}
        {!! $errors->first('auxiliar', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('detall') ? 'has-error' : ''}}">
    <label for="detall" class="col-md-4 control-label">{{ 'Detall' }}</label>
    <div class="col-md-6">
        {!! Form::text('detall', null, ['class' => 'form-control input-sm','id'=>'detall','autofocus'=>'autofocus']), old('detall') !!}
        {!! $errors->first('detall', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('activo') ? 'has-error' : ''}}">
    <label for="activo" class="col-md-4 control-label">{{ 'Estado' }}</label>
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
