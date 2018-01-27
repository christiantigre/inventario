<div class="form-group {{ $errors->has('grupo_id') ? 'has-error' : ''}}">
    <label for="grupo_id" class="col-md-4 control-label">{{ 'Grupo' }}</label>
    <div class="col-md-6">
        {!! Form::select('grupo_id', $grupos, null, ['class' => 'form-control','id'=>'grupo_id','autofocus'=>'autofocus','onchange'=>'cuentaGrupos()']) !!}

        {!! Form::hidden('grupo', null, ['id'=>'grupo','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('grupo') !!}  
        
        {!! $errors->first('grupo_id', '<p class="help-block">:message</p>') !!}
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
    <label for="codigo" class="col-md-4 control-label">{{ 'Código' }}</label>
    <div class="col-md-6">
        {!! Form::text('codigo', null, ['id'=>'codigo','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('codigo') !!} 
        {!! $errors->first('codigo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('cuenta') ? 'has-error' : ''}}">
    <label for="cuenta" class="col-md-4 control-label">{{ 'Cuenta' }}</label>
    <div class="col-md-6">
        {!! Form::text('cuenta', null, ['id'=>'cuenta','class' => 'form-control','autofocus'=>'autofocus','required'=>'required']), old('cuenta') !!}        
        {!! $errors->first('cuenta', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('detall') ? 'has-error' : ''}}">
    <label for="detall" class="col-md-4 control-label">{{ 'Detalle' }}</label>
    <div class="col-md-6">
        {!! Form::text('detall', null, ['id'=>'detall','class' => 'form-control','autofocus'=>'autofocus']), old('detall') !!}         
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
