<div class="form-group {{ $errors->has('path_certificado') ? 'has-error' : ''}}">
    <label for="path_certificado" class="col-md-4 control-label">{{ 'Path Certificado' }}</label>
    <div class="col-md-6">

        {!! Form::file('path_certificado', null,['id'=>'path_certificado','class'=>'form-control','autofocus'=>'autofocus']), old('path_certificado')    !!}

        {!! $errors->first('path_certificado', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('clave_certificado') ? 'has-error' : ''}}">
    <label for="clave_certificado" class="col-md-4 control-label">{{ 'Clave Certificado' }}</label>
    <div class="col-md-6">

        {!! Form::text('clave_certificado', null,['id'=>'clave_certificado','class'=>'form-control','autofocus'=>'autofocus','placeholder'=>'********']), old('clave_certificado')    !!}

        {!! $errors->first('clave_certificado', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('modo_ambiente') ? 'has-error' : ''}}">
    <label for="modo_ambiente" class="col-md-4 control-label">{{ 'Modo Ambiente' }}</label>
    <div class="col-md-6">
        {!! Form::select('modo_ambiente', array('1' => 'PRUEBAS', '2' => 'PRODUCCIÓN'), null,['class'=>'form-control'])    !!}
        
        {!! $errors->first('modo_ambiente', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('generar_facturas') ? 'has-error' : ''}}">
    <label for="generar_facturas" class="col-md-4 control-label">{{ 'Generar Facturas' }}</label>
    <div class="col-md-6">

        <select name="generar_facturas" class="form-control" id="generar_facturas" >
            @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($almacen->generar_facturas) && $almacen->generar_facturas == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>

        {!! $errors->first('generar_facturas', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('obligado_contabilidad') ? 'has-error' : ''}}">
    <label for="obligado_contabilidad" class="col-md-4 control-label">{{ 'Obligado Contabilidad' }}</label>
    <div class="col-md-6">

        <select name="obligado_contabilidad" class="form-control" id="obligado_contabilidad" >
            @foreach (json_decode('{"1":"SI","0":"NO"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($almacen->obligado_contabilidad) && $almacen->obligado_contabilidad == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>

        {!! $errors->first('obligado_contabilidad', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" title="Guardar" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
