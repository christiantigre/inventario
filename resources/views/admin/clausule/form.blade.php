<div class="form-group {{ $errors->has('documento') ? 'has-error' : ''}}">
    <label for="documento" class="col-md-4 control-label">{{ 'Documento' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="documento" type="text" id="documento" value="{{ $clausule->documento or ''}}" >
        {!! $errors->first('documento', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('pre_clausula') ? 'has-error' : ''}}">
    <label for="pre_clausula" class="col-md-4 control-label">{{ 'Pre Clausula' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="pre_clausula" type="textarea" id="pre_clausula" >{{ $clausule->pre_clausula or ''}}</textarea>
        {!! $errors->first('pre_clausula', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('clausula') ? 'has-error' : ''}}">
    <label for="clausula" class="col-md-4 control-label">{{ 'Clausula' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="clausula" type="textarea" id="clausula" >{{ $clausule->clausula or ''}}</textarea>
        {!! $errors->first('clausula', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('activo') ? 'has-error' : ''}}">
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
