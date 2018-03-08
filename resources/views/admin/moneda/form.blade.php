<div class="form-group {{ $errors->has('moneda') ? 'has-error' : ''}}">
    <label for="moneda" class="col-md-4 control-label">{{ 'Moneda' }}</label>
    <div class="col-md-6">
        {!! Form::text('moneda', null, ['id'=>'moneda','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','placeholder'=>'DOLAR']), old('moneda') !!}    
        {!! $errors->first('moneda', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('estado') ? 'has-error' : ''}}">
    <label for="estado" class="col-md-4 control-label">{{ 'Estado' }}</label>
    <div class="col-md-6">
        <select name="estado" class="form-control" id="estado" >
    @foreach (json_decode('{"1":"ACTIVO","0":"INACTIVO"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($moneda->estado) && $moneda->estado == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('estado', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
