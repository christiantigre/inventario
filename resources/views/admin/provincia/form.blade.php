<div class="form-group {{ $errors->has('provincia') ? 'has-error' : ''}}">
    <label for="provincia" class="col-md-4 control-label">{{ 'Provincia' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="provincia" type="text" id="provincia" value="{{ $provincium->provincia or ''}}" >
        {!! $errors->first('provincia', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cod_postal') ? 'has-error' : ''}}">
    <label for="cod_postal" class="col-md-4 control-label">{{ 'Cod Postal' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="cod_postal" type="text" id="cod_postal" value="{{ $provincium->cod_postal or ''}}" >
        {!! $errors->first('cod_postal', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('latitud') ? 'has-error' : ''}}">
    <label for="latitud" class="col-md-4 control-label">{{ 'Latitud' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="latitud" type="text" id="latitud" value="{{ $provincium->latitud or ''}}" >
        {!! $errors->first('latitud', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('longitud') ? 'has-error' : ''}}">
    <label for="longitud" class="col-md-4 control-label">{{ 'Longitud' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="longitud" type="text" id="longitud" value="{{ $provincium->longitud or ''}}" >
        {!! $errors->first('longitud', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('pais_id') ? 'has-error' : ''}}">
    <label for="pais_id" class="col-md-4 control-label">{{ 'Pais Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="pais_id" type="text" id="pais_id" value="{{ $provincium->pais_id or ''}}" >
        {!! $errors->first('pais_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
