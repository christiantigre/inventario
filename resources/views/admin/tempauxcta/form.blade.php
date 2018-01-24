<div class="form-group {{ $errors->has('auxiliar') ? 'has-error' : ''}}">
    <label for="auxiliar" class="col-md-4 control-label">{{ 'Auxiliar' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="auxiliar" type="textarea" id="auxiliar" >{{ $tempauxctum->auxiliar or ''}}</textarea>
        {!! $errors->first('auxiliar', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('secuencia') ? 'has-error' : ''}}">
    <label for="secuencia" class="col-md-4 control-label">{{ 'Secuencia' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="secuencia" type="textarea" id="secuencia" >{{ $tempauxctum->secuencia or ''}}</textarea>
        {!! $errors->first('secuencia', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('codigo') ? 'has-error' : ''}}">
    <label for="codigo" class="col-md-4 control-label">{{ 'Codigo' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="codigo" type="textarea" id="codigo" >{{ $tempauxctum->codigo or ''}}</textarea>
        {!! $errors->first('codigo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('detall') ? 'has-error' : ''}}">
    <label for="detall" class="col-md-4 control-label">{{ 'Detall' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="detall" type="textarea" id="detall" >{{ $tempauxctum->detall or ''}}</textarea>
        {!! $errors->first('detall', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('activo') ? 'has-error' : ''}}">
    <label for="activo" class="col-md-4 control-label">{{ 'Activo' }}</label>
    <div class="col-md-6">
        <div class="radio">
    <label><input name="{{ activo }}" type="radio" value="1" {{ (isset($tempauxctum) && 1 == $tempauxctum->activo) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="{{ activo }}" type="radio" value="0" @if (isset($tempauxctum)) {{ (0 == $tempauxctum->activo) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
        {!! $errors->first('activo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cuenta') ? 'has-error' : ''}}">
    <label for="cuenta" class="col-md-4 control-label">{{ 'Cuenta' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="cuenta" type="textarea" id="cuenta" >{{ $tempauxctum->cuenta or ''}}</textarea>
        {!! $errors->first('cuenta', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('subcuenta_id') ? 'has-error' : ''}}">
    <label for="subcuenta_id" class="col-md-4 control-label">{{ 'Subcuenta Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="subcuenta_id" type="number" id="subcuenta_id" value="{{ $tempauxctum->subcuenta_id or ''}}" >
        {!! $errors->first('subcuenta_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
