<div class="form-group {{ $errors->has('canton') ? 'has-error' : ''}}">
    <label for="canton" class="col-md-4 control-label">{{ 'Canton' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="canton" type="text" id="canton" value="{{ $canton->canton or ''}}" >
        {!! $errors->first('canton', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cod_postal') ? 'has-error' : ''}}">
    <label for="cod_postal" class="col-md-4 control-label">{{ 'Cod Postal' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="cod_postal" type="text" id="cod_postal" value="{{ $canton->cod_postal or ''}}" >
        {!! $errors->first('cod_postal', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('latitud') ? 'has-error' : ''}}">
    <label for="latitud" class="col-md-4 control-label">{{ 'Latitud' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="latitud" type="text" id="latitud" value="{{ $canton->latitud or ''}}" >
        {!! $errors->first('latitud', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('longitud') ? 'has-error' : ''}}">
    <label for="longitud" class="col-md-4 control-label">{{ 'Longitud' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="longitud" type="text" id="longitud" value="{{ $canton->longitud or ''}}" >
        {!! $errors->first('longitud', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('provincia_id') ? 'has-error' : ''}}">
    <label for="provincia_id" class="col-md-4 control-label">{{ 'Provincia Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="provincia_id" type="text" id="provincia_id" value="{{ $canton->provincia_id or ''}}" >
        {!! $errors->first('provincia_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
