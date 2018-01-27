<div class="form-group {{ $errors->has('generar_contabilidad') ? 'has-error' : ''}}">
    <label for="generar_contabilidad" class="col-md-4 control-label">{{ 'CONTABILIDAD AUTOMATICA' }}</label>
    <div class="col-md-6">
        <select name="generar_contabilidad" class="form-control" id="generar_contabilidad" >
            @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($config->generar_contabilidad) && $config->generar_contabilidad == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('generar_contabilidad', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('assauto_compras') ? 'has-error' : ''}}">
    <label for="assauto_compras" class="col-md-4 control-label">{{ 'AUTOMATICO COMPRAS' }}</label>
    <div class="col-md-6">
        <select name="assauto_compras" class="form-control" id="assauto_compras" >
            @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($config->assauto_compras) && $config->assauto_compras == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('assauto_compras', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assauto_ventas') ? 'has-error' : ''}}">
    <label for="assauto_ventas" class="col-md-4 control-label">{{ 'AUTOMATICO VENTAS' }}</label>
    <div class="col-md-6">
        <select name="assauto_ventas" class="form-control" id="assauto_ventas" >
            @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($config->assauto_ventas) && $config->assauto_ventas == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('assauto_ventas', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assauto_pagos') ? 'has-error' : ''}}">
    <label for="assauto_pagos" class="col-md-4 control-label">{{ 'AUTOMATICO PAGOS' }}</label>
    <div class="col-md-6">
        <select name="assauto_pagos" class="form-control" id="assauto_pagos" >
            @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($config->assauto_pagos) && $config->assauto_pagos == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('assauto_pagos', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assauto_gastos') ? 'has-error' : ''}}">
    <label for="assauto_gastos" class="col-md-4 control-label">{{ 'AUTOMATICO PAGOS' }}</label>
    <div class="col-md-6">
        <select name="assauto_gastos" class="form-control" id="assauto_gastos" >
            @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($config->assauto_gastos) && $config->assauto_gastos == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('assauto_gastos', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assauto_gastos') ? 'has-error' : ''}}">
    <label for="assauto_gastos" class="col-md-4 control-label">{{ 'AUTOMATICO GASTOS' }}</label>
    <div class="col-md-6">
        <select name="assauto_gastos" class="form-control" id="assauto_gastos" >
            @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($config->assauto_gastos) && $config->assauto_gastos == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('assauto_gastos', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assauto_costos') ? 'has-error' : ''}}">
    <label for="assauto_costos" class="col-md-4 control-label">{{ 'AUTOMATICO COSTOS' }}</label>
    <div class="col-md-6">
        <select name="assauto_costos" class="form-control" id="assauto_costos" >
            @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($config->assauto_costos) && $config->assauto_costos == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('assauto_costos', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assauto_inversiones') ? 'has-error' : ''}}">
    <label for="assauto_inversiones" class="col-md-4 control-label">{{ 'AUTOMATICO INVERSIONES' }}</label>
    <div class="col-md-6">
        <select name="assauto_inversiones" class="form-control" id="assauto_inversiones" >
            @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($config->assauto_inversiones) && $config->assauto_inversiones == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('assauto_inversiones', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assauto_cobros') ? 'has-error' : ''}}">
    <label for="assauto_cobros" class="col-md-4 control-label">{{ 'AUTOMATICO COBROS' }}</label>
    <div class="col-md-6">
        <select name="assauto_cobros" class="form-control" id="assauto_cobros" >
            @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($config->assauto_cobros) && $config->assauto_cobros == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('assauto_cobros', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assauto_sueldos') ? 'has-error' : ''}}">
    <label for="assauto_sueldos" class="col-md-4 control-label">{{ 'AUTOMATICO SUELDOS' }}</label>
    <div class="col-md-6">
        <select name="assauto_sueldos" class="form-control" id="assauto_sueldos" >
            @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($config->assauto_sueldos) && $config->assauto_sueldos == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('assauto_sueldos', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assauto_obligaciones') ? 'has-error' : ''}}">
    <label for="assauto_obligaciones" class="col-md-4 control-label">{{ 'AUTOMATICO OBLIGACIONES' }}</label>
    <div class="col-md-6">
        <select name="assauto_obligaciones" class="form-control" id="assauto_obligaciones" >
            @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($config->assauto_obligaciones) && $config->assauto_obligaciones == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('assauto_obligaciones', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assauto_impuestos') ? 'has-error' : ''}}">
    <label for="assauto_impuestos" class="col-md-4 control-label">{{ 'AUTOMATICO IMPUESTOS' }}</label>
    <div class="col-md-6">
        <select name="assauto_impuestos" class="form-control" id="assauto_impuestos" >
            @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($config->assauto_impuestos) && $config->assauto_impuestos == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('assauto_impuestos', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assauto_servicios') ? 'has-error' : ''}}">
    <label for="assauto_servicios" class="col-md-4 control-label">{{ 'AUTOMATICO SERVICIOS' }}</label>
    <div class="col-md-6">
        <select name="assauto_servicios" class="form-control" id="assauto_servicios" >
            @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($config->assauto_servicios) && $config->assauto_servicios == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('assauto_servicios', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('assauto_creditos') ? 'has-error' : ''}}">
    <label for="assauto_creditos" class="col-md-4 control-label">{{ 'AUTOMATICO CREDITOS' }}</label>
    <div class="col-md-6">
        <select name="assauto_creditos" class="form-control" id="assauto_creditos" >
            @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($config->assauto_creditos) && $config->assauto_creditos == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('assauto_creditos', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary btn-sm" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
