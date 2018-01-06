<div class="form-group {{ $errors->has('marca') ? 'has-error' : ''}}">
    <label for="marca" class="col-md-4 control-label">{{ 'Marca' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="marca" type="text" id="marca" value="{{ $marca->marca or ''}}" >
        {!! $errors->first('marca', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('detall') ? 'has-error' : ''}}">
    <label for="detall" class="col-md-4 control-label">{{ 'Detall' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="detall" type="text" id="detall" value="{{ $marca->detall or ''}}" >
        {!! $errors->first('detall', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('img') ? 'has-error' : ''}}">
    <label for="img" class="col-md-4 control-label">{{ 'Img' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="img" type="file" id="img" value="{{ $marca->img or ''}}" >
        {!! $errors->first('img', '<p class="help-block">:message</p>') !!}
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
