<div class="col-md-12">

    REGISTRO

    <fieldset>

        <legend>
        </legend>

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('subcuenta_id') ? 'has-error' : ''}}">
                <label for="subcuenta_id" class="col-md-4 control-label">{{ 'Subcuenta' }}</label>
                <div class="col-md-6">
                    {!! Form::select('subcuenta_id', $subcuentas, null, ['class' => 'form-control','id'=>'subcuenta_id','autofocus'=>'autofocus','onchange'=>'cuentaSubCuentasVariasAdmin()']) !!}

                    {!! Form::hidden('subcuenta', null, ['id'=>'subcuenta','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('subcuenta') !!}

                    {!! $errors->first('subcuenta_id', '<p class="help-block">:message</p>') !!}
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
            <div class="form-group {{ $errors->has('auxiliar') ? 'has-error' : ''}}">
                <label for="auxiliar" class="col-md-4 control-label">{{ 'Auxiliar' }}</label>
                <div class="col-md-6">
                    {!! Form::text('auxiliar', null, ['class' => 'form-control input-sm','id'=>'auxiliar','autofocus'=>'autofocus','onmouseout'=>'cuentaSubCuentasVariasAdmin()']), old('auxiliar') !!}
                    {!! $errors->first('auxiliar', '<p class="help-block">:message</p>') !!}
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

                    <button type='button' id="guarda_auxiliar_admin" title="Agregar Cuenta Auxiliar" class="btn btn-primary btn-sm guarda_auxiliar_admin" data-dismiss='modal'> Guardar</button>

                </div>
            </div>
        </div>
    </fieldset>
</div>
