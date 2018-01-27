<div class="form-group {{ $errors->has('clase') ? 'has-error' : ''}}">
    <label for="clase" class="col-md-4 control-label">{{ 'Clase' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="clase" type="text" id="clase" value="{{ $clase->clase or ''}}" >
        {!! $errors->first('clase', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('codigo') ? 'has-error' : ''}}">
    <label for="codigo" class="col-md-4 control-label">{{ 'Código' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="codigo" type="text" id="codigo" value="{{ $clase->codigo or ''}}" >
        {!! $errors->first('codigo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('detall') ? 'has-error' : ''}}">
    <label for="detall" class="col-md-4 control-label">{{ 'Detalle' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="detall" type="text" id="detall" value="{{ $clase->detall or ''}}" >
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
