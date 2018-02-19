
<div class="col-md-12">

    BALANCE INICIAL
    <div class="row">

        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-6">
                    <label class="control-label">{{ $nombre_almacen }}</label>                
                </div>
                <div class="col-md-6">
                    <label class="control-label">Asiento # : </label>
                    <label class="control-label">{{ $asiento->num_asiento }}</label>                
                </div>
                <div class="col-md-6">
                    <label class="control-label">Fecha : </label>
                    <label class="control-label">{{ $fecha }}</label>                
                </div>
                <div class="col-md-6">
                    <label class="control-label">Período : </label>
                    <label class="control-label">{{ $year }}</label>                
                </div>
                <div class="col-md-6">
                    <label class="control-label">Responsable : </label>
                    <label class="control-label">{{ $responsable }}</label>                
                </div>
            </div>
        </div>
    </div>

    <fieldset>

        <legend>
        </legend>

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('cod_cuenta') ? 'has-error' : ''}}">
                <label for="cod_cuenta" class="col-md-4 control-label">{{ 'Cuenta' }}</label>
                <div class="col-md-8">

                    <div class="input-group input-group-md">
                {!! Form::text('cod_cuenta', null, ['id'=>'cod_cuenta','list'=>'cuentas','class' => 'form-control','autofocus'=>'autofocus','onSelect'=>'consulta_cuenta_admin()','required'=>'required']), old('cod_cuenta') !!}
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-flat busca_cuenta">Buscar</button>
                    </span>
              </div>
              <!-- /input-group -->
              {{--
                    {!! Form::text('cod_cuenta', null, ['id'=>'cod_cuenta','list'=>'cuentas','class' => 'form-control','autofocus'=>'autofocus','onSelect'=>'consulta_cuenta_admin()','required'=>'required']), old('cod_cuenta') !!}
                --}}
                    <datalist id="cuentas">
                        @foreach($cuentas as $cuenta)
                        <option class="form-control" onSelect="consulta_cuenta_admin()" id="{{ $cuenta->cod }}" value="{{ $cuenta->cod }}">{{ $cuenta->cuenta }}</option>
                        @endforeach
                    </datalist>

                    {!! Form::hidden('almacen_id', $almacen_id, ['id'=>'almacen_id','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('almacen_id') !!}


                    {!! Form::hidden('periodo', $year, ['class' => 'form-control input-sm','id'=>'periodo','readonly'=>'readonly','autofocus'=>'autofocus']), old('periodo') !!}

                     {!! Form::hidden('responsable', $responsable, ['class' => 'form-control input-sm','id'=>'responsable','readonly'=>'readonly','autofocus'=>'autofocus']), old('responsable') !!}

                    {!! Form::hidden('fecha', $fecha, ['class' => 'form-control input-sm','id'=>'fecha','readonly'=>'readonly','autofocus'=>'autofocus']), old('periodo') !!}

                    {!! Form::hidden('num_asiento', null, ['id'=>'num_asiento','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('num_asiento') !!} 

                    {!! Form::hidden('id', null, ['id'=>'id','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('asiento_id') !!}  

                    {!! $errors->first('cod_cuenta', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('periodo') ? 'has-error' : ''}}">
                <label for="periodo" class="col-md-4 control-label">{{ 'Transacción' }}</label>
                <div class="col-md-6">

                    {{ Form::select('tipo', ['1' => 'DEBE', '2' => 'HABER'], 1 , ['id' =>'tipo','class' => 'form-control tipo']) }}

                    {!! $errors->first('periodo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group {{ $errors->has('num_asiento') ? 'has-error' : ''}}">
                <label for="num_asiento" class="col-md-4 control-label">{{ 'Cuenta' }}</label>
                <div class="col-md-8">
                    {!! Form::text('cuenta', null, ['id'=>'cuenta','class' => 'form-control','autofocus'=>'autofocus','required'=>'required']), old('cuenta') !!}        
                    {!! $errors->first('cuenta', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('valor') ? 'has-error' : ''}}">
                <label for="valor" class="col-md-4 control-label">{{ 'Valor' }}</label>
                <div class="col-md-6">
                    {!! Form::text('valor', null, ['class' => 'form-control input-sm','id'=>'valor','autofocus'=>'autofocus','placeholder'=>'15.99']), old('valor') !!}
                    {!! $errors->first('valor', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>


        <div class="col-md-10">
            <div class="form-group {{ $errors->has('concepto_detalle') ? 'has-error' : ''}}">
                <label for="concepto_detall" class="col-md-2 control-label">{{ 'Descripción' }}</label>
                <div class="col-md-8">

                    {!! Form::textarea('concepto_detalle',null,['class'=>'form-control', 'rows' => 2, 'cols' => 40,'id'=>'concepto_detalle']),old('concepto_detalle') !!}

                    {!! $errors->first('concepto_detalle', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>

        <div class="col-md-10">
            <div class="form-group {{ $errors->has('concepto') ? 'has-error' : ''}}">
                <label for="concepto" class="col-md-2 control-label">{{ 'Glosa Asiento' }}</label>
                <div class="col-md-8">

                    {!! Form::textarea('concepto',null,['class'=>'form-control','id'=>'concepto', 'rows' => 2, 'cols' => 40]),old('concepto') !!}

                    {!! $errors->first('concepto', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-md-offset-9 col-xs-offset-8 col-md-4">

                    <button type='button' id="guarda_trs_admin_edit" title="Agregar transacción" class="btn btn-success btn-md guarda_trs_admin_edit" data-dismiss='modal'> Agregar</button>

                </div>
            </div>
        </div>

    </fieldset>
</div>


