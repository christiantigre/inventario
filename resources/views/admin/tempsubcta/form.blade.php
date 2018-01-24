
<div class="col-md-12">

    CLIENTE

    <fieldset>

        <legend>
        </legend>

        <div class="col-md-6">

            <div class="form-group {{ $errors->has('subcuenta') ? 'has-error' : ''}}">
                <label for="cuenta_id" class="col-md-4 control-label">{{ 'Cuenta' }}</label>
                <div class="col-md-8">
                    {!! Form::select('cuenta_id', $cuentas, null, ['class' => 'form-control','id'=>'cuenta_id','autofocus'=>'autofocus','onchange'=>'cuentaCuentas()']) !!}

                    {!! Form::hidden('cuenta', null, ['id'=>'cuenta','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('cuenta') !!}

                    {!! $errors->first('cuenta_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('subcuenta') ? 'has-error' : ''}}">
                <label for="secuencia" class="col-md-4 control-label">{{ 'Secuencia' }}</label>
                <div class="col-md-8">
                    {!! Form::text('secuencia', null, ['id'=>'secuencia','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('secuencia') !!}  
                    {!! $errors->first('secuencia', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group {{ $errors->has('subcuenta') ? 'has-error' : ''}}">
                <label for="subcuenta" class="col-md-4 control-label">{{ 'Subcuenta' }}</label>
                <div class="col-md-8">
                   {!! $errors->first('cliente', '<p class="help-block">:message</p>') !!}
                   {!! Form::text('subcuenta', null, ['id'=>'subcuenta','class' => 'form-control input-sm','autofocus'=>'autofocus','required'=>'required']), old('subcuenta') !!}
                   {!! $errors->first('subcuenta', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

           <div class="form-group {{ $errors->has('subcuenta') ? 'has-error' : ''}}">        
                <label for="codigo" class="col-md-4 control-label">{{ 'Codigo' }}</label>
                <div class="col-md-8">
                  {!! Form::text('codigo', null, ['id'=>'codigo','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('codigo') !!}
                  {!! $errors->first('codigo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

        </div>
        
</fieldset>
</div>



<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
