<div class="form-group {{ $errors->has('valor_descuento') ? 'has-error' : ''}}">
    <label for="valor_descuento" class="col-md-4 control-label">{{ 'Valor Descuento' }}</label>
    <div class="col-md-6">
        {!! Form::text('valor_descuento', null, ['id'=>'valor_descuento','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','placeholder'=>'15.99']), old('valor_descuento') !!}  
        {!! $errors->first('valor_descuento', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('estado') ? 'has-error' : ''}}">
    <label for="estado" class="col-md-4 control-label">{{ 'Estado' }}</label>
    <div class="col-md-6">
        <select name="estado" class="form-control" id="estado" >






    @foreach (json_decode('{"0":"INACTIVO","1":"ACTIVO"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($descuento->estado) && $descuento->estado == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
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
