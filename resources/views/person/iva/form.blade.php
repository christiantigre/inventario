<div class="form-group {{ $errors->has('iva') ? 'has-error' : ''}}">
    <label for="iva" class="col-md-4 control-label">{{ 'Iva' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="iva" type="text" id="iva" value="{{ $iva->iva or ''}}" autocomplete="off" placeholder="12.15">
        {!! $errors->first('iva', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('activo') ? 'has-error' : ''}}">
    <label for="activo" class="col-md-4 control-label">{{ 'Activo' }}</label>
    <div class="col-md-6">
        <select name="activo" class="form-control" id="activo" >
    @foreach (json_decode('{"0":"Inactivo","1":"Activo"}', true) as $optionKey => $optionValue)
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
