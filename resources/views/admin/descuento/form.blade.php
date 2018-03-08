<div class="form-group {{ $errors->has('valor_descuento') ? 'has-error' : ''}}">
    <label for="valor_descuento" class="col-md-4 control-label">{{ 'Valor Descuento' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="valor_descuento" type="textarea" id="valor_descuento" >{{ $descuento->valor_descuento or ''}}</textarea>
        {!! $errors->first('valor_descuento', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('estado') ? 'has-error' : ''}}">
    <label for="estado" class="col-md-4 control-label">{{ 'Estado' }}</label>
    <div class="col-md-6">
        <div class="radio">
    <label><input name="{{ estado }}" type="radio" value="1" {{ (isset($descuento) && 1 == $descuento->estado) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="{{ estado }}" type="radio" value="0" @if (isset($descuento)) {{ (0 == $descuento->estado) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
        {!! $errors->first('estado', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
