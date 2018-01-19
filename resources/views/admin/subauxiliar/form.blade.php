<div class="form-group {{ $errors->has('subauxiliar') ? 'has-error' : ''}}">
    <label for="subauxiliar" class="col-md-4 control-label">{{ 'Subauxiliar' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="subauxiliar" type="textarea" id="subauxiliar" required>{{ $subauxiliar->subauxiliar or ''}}</textarea>
        {!! $errors->first('subauxiliar', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('codigo') ? 'has-error' : ''}}">
    <label for="codigo" class="col-md-4 control-label">{{ 'Codigo' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="codigo" type="textarea" id="codigo" >{{ $subauxiliar->codigo or ''}}</textarea>
        {!! $errors->first('codigo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('detall') ? 'has-error' : ''}}">
    <label for="detall" class="col-md-4 control-label">{{ 'Detall' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="detall" type="textarea" id="detall" >{{ $subauxiliar->detall or ''}}</textarea>
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
</div><div class="form-group {{ $errors->has('auxiliar_id') ? 'has-error' : ''}}">
    <label for="auxiliar_id" class="col-md-4 control-label">{{ 'Auxiliar Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="auxiliar_id" type="number" id="auxiliar_id" value="{{ $subauxiliar->auxiliar_id or ''}}" >
        {!! $errors->first('auxiliar_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
