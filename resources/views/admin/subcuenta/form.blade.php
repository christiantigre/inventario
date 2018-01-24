<div class="form-group {{ $errors->has('cuenta_id') ? 'has-error' : ''}}">
    <label for="cuenta_id" class="col-md-4 control-label">{{ 'Cuenta' }}</label>
    <div class="col-md-6">
        {!! Form::select('cuenta_id', $cuentas, null, ['class' => 'form-control','id'=>'cuenta_id','autofocus'=>'autofocus','onchange'=>'cuentaCuentas()']) !!}

        {!! Form::hidden('cuenta', null, ['id'=>'cuenta','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('cuenta') !!}

        {!! $errors->first('cuenta_id', '<p class="help-block">:message</p>') !!}
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
        {!! Form::text('codigo', null, ['id'=>'codigo','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('codigo') !!} 
        {!! $errors->first('codigo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('subcuenta') ? 'has-error' : ''}}">
    <label for="subcuenta" class="col-md-4 control-label">{{ 'Subcuenta' }}</label>
    <div class="col-md-6">
        {!! Form::text('subcuenta', null, ['id'=>'subcuenta','class' => 'form-control','autofocus'=>'autofocus','required'=>'required']), old('subcuenta') !!}  
        {!! $errors->first('subcuenta', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('detall') ? 'has-error' : ''}}">
    <label for="detall" class="col-md-4 control-label">{{ 'Detall' }}</label>
    <div class="col-md-6">        
        {!! Form::text('detall', null, ['id'=>'detall','class' => 'form-control','autofocus'=>'autofocus','required'=>'required']), old('detall') !!} 
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
