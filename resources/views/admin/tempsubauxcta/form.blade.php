<div class="col-md-12">

    REGISTRO

    <fieldset>

        <legend>
        </legend>

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('subcuenta_id') ? 'has-error' : ''}}">
                <label for="subcuenta_id" class="col-md-4 control-label">{{ 'Subcuenta' }}</label>
                <div class="col-md-6">
                    {!! Form::select('auxiliar_id', $auxiliares, null, ['class' => 'form-control','id'=>'auxiliar_id','autofocus'=>'autofocus','onchange'=>'cuentaSubAuxCuentas()']) !!}

                    {!! Form::hidden('auxiliar', null, ['id'=>'auxiliar','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('auxiliar') !!}

                    {!! $errors->first('auxiliar_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('secuencia') ? 'has-error' : ''}}">
                <label for="secuencia" class="col-md-4 control-label">{{ 'Secuencia' }}</label>
                <div class="col-md-6">
                    {!! Form::text('secuencia', null, ['id'=>'secuencia','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('secuencia') !!}        
                    {!! $errors->first('secuencia', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('subauxiliar') ? 'has-error' : ''}}">
                <label for="subauxiliar" class="col-md-4 control-label">{{ 'Sub - Auxiliar' }}</label>
                <div class="col-md-6">
                    {!! Form::text('subauxiliar', null, ['class' => 'form-control input-sm','id'=>'subauxiliar','autofocus'=>'autofocus','onmouseout'=>'cuentaSubAuxCuentas()']), old('subauxiliar') !!}
                    {!! $errors->first('subauxiliar', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('codigo') ? 'has-error' : ''}}">
                <label for="codigo" class="col-md-4 control-label">{{ 'Codigo' }}</label>
                <div class="col-md-6">
                    {!! Form::text('codigo', null, ['class' => 'form-control input-sm','id'=>'codigo','autofocus'=>'autofocus','readonly'=>'readonly']), old('codigo') !!}
                    {!! $errors->first('codigo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-4 col-md-4">

                    <button type='button' id="guarda_subauxiliar" title="Agregar Cuenta Sub - Auxiliar" class="btn btn-primary btn-sm guarda_subauxiliar" data-dismiss='modal'> Guardar</button>

                </div>
            </div>
        </div>
    </fieldset>
</div>
