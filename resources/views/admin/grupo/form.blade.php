<div class="form-group {{ $errors->has('clase_id') ? 'has-error' : ''}}">
    <label for="clase_id" class="col-md-4 control-label">{{ 'Clase' }}</label>
    <div class="col-md-6">
        {!! Form::select('clase_id', $clases, null, ['class' => 'form-control','id'=>'clase_id','autofocus'=>'autofocus','onchange'=>'evento()']) !!}
        {{--, old('clase_id')--}}
        {!! $errors->first('clase_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('secuencia') ? 'has-error' : ''}}">
    <label for="secuencia" class="col-md-4 control-label">{{ 'Secuencia' }}</label>
    <div class="col-md-6">
        {!! Form::text('secuencia', null, ['id'=>'secuencia','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'']) !!}
        {!! $errors->first('secuencia', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('codigo') ? 'has-error' : ''}}">
    <label for="codigo" class="col-md-4 control-label">{{ 'Codigo' }}</label>
    <div class="col-md-6">
        {!! Form::text('codigo', null, ['id'=>'codigo','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'']) !!}
        {!! $errors->first('codigo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('grupo') ? 'has-error' : ''}}">
    <label for="grupo" class="col-md-4 control-label">{{ 'Grupo' }}</label>
    <div class="col-md-6">
        {!! Form::text('grupo', null, ['id'=>'grupo','class' => 'form-control','autofocus'=>'autofocus']) !!}
        {!! $errors->first('grupo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('detall') ? 'has-error' : ''}}">
    <label for="detall" class="col-md-4 control-label">{{ 'Detall' }}</label>
    <div class="col-md-6">
        {!! Form::text('detall', null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
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


    <!--la funcion de onchange en el selec esta en el js. modulocontabilidad
