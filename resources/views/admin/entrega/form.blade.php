<div class="form-group {{ $errors->has('metodo') ? 'has-error' : ''}}">
    <label for="metodo" class="col-md-4 control-label">{{ 'Método' }}</label>
    <div class="col-md-6">
        {!! Form::text('metodo', null, ['id'=>'metodo','class' => 'form-control','autofocus'=>'autofocus','placeholder'=>'Método de entrega']), old('metodo') !!} 

        {!! $errors->first('metodo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('detalle') ? 'has-error' : ''}}">
    <label for="detalle" class="col-md-4 control-label">{{ 'Detalle' }}</label>
    <div class="col-md-6">
        {!! Form::text('detalle', null, ['id'=>'detalle','class' => 'form-control','autofocus'=>'autofocus','placeholder'=>'Detalles del metodo']), old('detalle') !!} 

        {!! $errors->first('detalle', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('activo') ? 'has-error' : ''}}">
    <label for="activo" class="col-md-4 control-label">{{ 'Estado' }}</label>
    <div class="col-md-6">
        <select name="activo" class="form-control" id="activo" >
    @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($entrega->activo) && $entrega->activo == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
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
