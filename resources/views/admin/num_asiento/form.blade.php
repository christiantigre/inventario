<div class="form-group {{ $errors->has('num_asiento') ? 'has-error' : ''}}">
    <label for="num_asiento" class="col-md-4 control-label">{{ 'Num Asiento' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="num_asiento" type="number" id="num_asiento" value="{{ $num_asiento->num_asiento or ''}}" required>
        {!! $errors->first('num_asiento', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('concepto') ? 'has-error' : ''}}">
    <label for="concepto" class="col-md-4 control-label">{{ 'Concepto' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="concepto" type="textarea" id="concepto" >{{ $num_asiento->concepto or ''}}</textarea>
        {!! $errors->first('concepto', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('periodo') ? 'has-error' : ''}}">
    <label for="periodo" class="col-md-4 control-label">{{ 'Periodo' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="periodo" type="textarea" id="periodo" >{{ $num_asiento->periodo or ''}}</textarea>
        {!! $errors->first('periodo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('fecha') ? 'has-error' : ''}}">
    <label for="fecha" class="col-md-4 control-label">{{ 'Fecha' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="fecha" type="date" id="fecha" value="{{ $num_asiento->fecha or ''}}" >
        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('saldo_debe') ? 'has-error' : ''}}">
    <label for="saldo_debe" class="col-md-4 control-label">{{ 'Saldo Debe' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="saldo_debe" type="number" id="saldo_debe" value="{{ $num_asiento->saldo_debe or ''}}" >
        {!! $errors->first('saldo_debe', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('saldo_haber') ? 'has-error' : ''}}">
    <label for="saldo_haber" class="col-md-4 control-label">{{ 'Saldo Haber' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="saldo_haber" type="number" id="saldo_haber" value="{{ $num_asiento->saldo_haber or ''}}" >
        {!! $errors->first('saldo_haber', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('almacen_id') ? 'has-error' : ''}}">
    <label for="almacen_id" class="col-md-4 control-label">{{ 'Almacen Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="almacen_id" type="number" id="almacen_id" value="{{ $num_asiento->almacen_id or ''}}" >
        {!! $errors->first('almacen_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
