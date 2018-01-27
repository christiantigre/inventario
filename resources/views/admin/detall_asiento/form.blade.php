<div class="form-group {{ $errors->has('num_asiento') ? 'has-error' : ''}}">
    <label for="num_asiento" class="col-md-4 control-label">{{ 'Num Asiento' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="num_asiento" type="textarea" id="num_asiento" >{{ $detall_asiento->num_asiento or ''}}</textarea>
        {!! $errors->first('num_asiento', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cod_cuenta') ? 'has-error' : ''}}">
    <label for="cod_cuenta" class="col-md-4 control-label">{{ 'Cod Cuenta' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="cod_cuenta" type="textarea" id="cod_cuenta" >{{ $detall_asiento->cod_cuenta or ''}}</textarea>
        {!! $errors->first('cod_cuenta', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cuenta') ? 'has-error' : ''}}">
    <label for="cuenta" class="col-md-4 control-label">{{ 'Cuenta' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="cuenta" type="textarea" id="cuenta" >{{ $detall_asiento->cuenta or ''}}</textarea>
        {!! $errors->first('cuenta', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('periodo') ? 'has-error' : ''}}">
    <label for="periodo" class="col-md-4 control-label">{{ 'Periodo' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="periodo" type="textarea" id="periodo" >{{ $detall_asiento->periodo or ''}}</textarea>
        {!! $errors->first('periodo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('fecha') ? 'has-error' : ''}}">
    <label for="fecha" class="col-md-4 control-label">{{ 'Fecha' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="fecha" type="date" id="fecha" value="{{ $detall_asiento->fecha or ''}}" >
        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('saldo_debe') ? 'has-error' : ''}}">
    <label for="saldo_debe" class="col-md-4 control-label">{{ 'Saldo Debe' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="saldo_debe" type="number" id="saldo_debe" value="{{ $detall_asiento->saldo_debe or ''}}" >
        {!! $errors->first('saldo_debe', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('saldo_haber') ? 'has-error' : ''}}">
    <label for="saldo_haber" class="col-md-4 control-label">{{ 'Saldo Haber' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="saldo_haber" type="number" id="saldo_haber" value="{{ $detall_asiento->saldo_haber or ''}}" >
        {!! $errors->first('saldo_haber', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('almacen_id') ? 'has-error' : ''}}">
    <label for="almacen_id" class="col-md-4 control-label">{{ 'Almacen Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="almacen_id" type="number" id="almacen_id" value="{{ $detall_asiento->almacen_id or ''}}" >
        {!! $errors->first('almacen_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cuenta_id') ? 'has-error' : ''}}">
    <label for="cuenta_id" class="col-md-4 control-label">{{ 'Cuenta Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="cuenta_id" type="number" id="cuenta_id" value="{{ $detall_asiento->cuenta_id or ''}}" >
        {!! $errors->first('cuenta_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('asiento_id') ? 'has-error' : ''}}">
    <label for="asiento_id" class="col-md-4 control-label">{{ 'Asiento Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="asiento_id" type="number" id="asiento_id" value="{{ $detall_asiento->asiento_id or ''}}" >
        {!! $errors->first('asiento_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
