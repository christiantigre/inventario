<div class="form-group {{ $errors->has('parrroquia') ? 'has-error' : ''}}">
    <label for="parrroquia" class="col-md-4 control-label">{{ 'Parrroquia' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="parrroquia" type="text" id="parrroquia" value="{{ $parroquium->parrroquia or ''}}" >
        {!! $errors->first('parrroquia', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cod_postal') ? 'has-error' : ''}}">
    <label for="cod_postal" class="col-md-4 control-label">{{ 'Cod Postal' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="cod_postal" type="text" id="cod_postal" value="{{ $parroquium->cod_postal or ''}}" >
        {!! $errors->first('cod_postal', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('latitud') ? 'has-error' : ''}}">
    <label for="latitud" class="col-md-4 control-label">{{ 'Latitud' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="latitud" type="text" id="latitud" value="{{ $parroquium->latitud or ''}}" >
        {!! $errors->first('latitud', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('longitud') ? 'has-error' : ''}}">
    <label for="longitud" class="col-md-4 control-label">{{ 'Longitud' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="longitud" type="text" id="longitud" value="{{ $parroquium->longitud or ''}}" >
        {!! $errors->first('longitud', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('parroquia_id') ? 'has-error' : ''}}">
    <label for="parroquia_id" class="col-md-4 control-label">{{ 'Parroquia Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="parroquia_id" type="text" id="parroquia_id" value="{{ $parroquium->parroquia_id or ''}}" >
        {!! $errors->first('parroquia_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
