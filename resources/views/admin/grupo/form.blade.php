<div class="form-group {{ $errors->has('grupo') ? 'has-error' : ''}}">
    <label for="grupo" class="col-md-4 control-label">{{ 'Grupo' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="grupo" type="textarea" id="grupo" >{{ $grupo->grupo or ''}}</textarea>
        {!! $errors->first('grupo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('codigo') ? 'has-error' : ''}}">
    <label for="codigo" class="col-md-4 control-label">{{ 'Codigo' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="codigo" type="textarea" id="codigo" >{{ $grupo->codigo or ''}}</textarea>
        {!! $errors->first('codigo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('detall') ? 'has-error' : ''}}">
    <label for="detall" class="col-md-4 control-label">{{ 'Detall' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="detall" type="textarea" id="detall" >{{ $grupo->detall or ''}}</textarea>
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
</div><div class="form-group {{ $errors->has('clase_id') ? 'has-error' : ''}}">
    <label for="clase_id" class="col-md-4 control-label">{{ 'Clase Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="clase_id" type="number" id="clase_id" value="{{ $grupo->clase_id or ''}}" >
        {!! $errors->first('clase_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
