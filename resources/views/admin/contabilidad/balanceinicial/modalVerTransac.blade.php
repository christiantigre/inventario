<div class="modal fade" id="ver-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

        <center>

          <h4 class="modal-title" id="myModalLabel">Ver Transacción</h4>

        </center>


      </div>

      <div class="modal-body">



        <form data-toggle="validator" action="" method="put">

          <div class="form-group">

            <label class="control-label" for="title">Código :</label>

                {!! Form::text('view_cod_cuenta_modal', null, ['id'=>'view_cod_cuenta_modal','list'=>'cuentas','class' => 'form-control','autofocus'=>'autofocus','required'=>'required']), old('view_cod_cuenta_modal') !!}

            {!! Form::hidden('view_id_modal', null, ['id'=>'view_id_modal','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('view_id_modal') !!}

             {!! Form::hidden('view_almacen_id_modal', null, ['id'=>'view_almacen_id_modal','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('view_almacen_id_modal') !!}


                    {!! Form::hidden('view_periodo_modal', null, ['class' => 'form-control input-sm','id'=>'view_periodo_modal','readonly'=>'readonly','autofocus'=>'autofocus']), old('view_periodo_modal') !!}

                     {!! Form::hidden('view_responsable_modal', null, ['class' => 'form-control input-sm','id'=>'view_responsable_modal','readonly'=>'readonly','autofocus'=>'autofocus']), old('view_responsable_modal') !!}

                    {!! Form::hidden('view_fecha_modal', null, ['class' => 'form-control input-sm','id'=>'view_fecha_modal','readonly'=>'readonly','autofocus'=>'autofocus']), old('view_fecha_modal') !!}

                    {!! Form::hidden('view_num_asiento_modal', null, ['id'=>'view_num_asiento_modal','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('view_num_asiento_modal') !!}

            <div class="help-block with-errors"></div>

          </div>

          <div class="form-group">

            <label class="control-label" for="title">Cuenta :</label>

           {!! Form::text('view_cuenta_modal', null, ['id'=>'view_cuenta_modal','class' => 'form-control','autofocus'=>'autofocus','required'=>'required']), old('view_cuenta_modal') !!} 

            <div class="help-block with-errors"></div>

          </div>

          <div class="form-group">

            <label class="control-label" for="title">Saldo debe:</label>

            {!! Form::text('view_saldo_debe_modal', null, ['class' => 'form-control input-sm','id'=>'view_saldo_debe_modal','autofocus'=>'autofocus','placeholder'=>'15.99']), old('view_saldo_debe_modal') !!}

            <div class="help-block with-errors"></div>

          </div>

          <div class="form-group">

            <label class="control-label" for="title">Saldo haber :</label>

            {!! Form::text('view_saldo_haber_modal', null, ['class' => 'form-control input-sm','id'=>'view_saldo_haber_modal','autofocus'=>'autofocus','placeholder'=>'15.99']), old('view_saldo_haber_modal') !!}

            <div class="help-block with-errors"></div>

          </div>

          <div class="form-group">

            <label class="control-label" for="title">Concepto transacción:</label>

            {!! Form::textarea('view_concepto_detalle_modal',null,['class'=>'form-control', 'rows' => 2, 'cols' => 40,'id'=>'view_concepto_detalle_modal']),old('view_concepto_detalle_modal') !!}

            <div class="help-block with-errors"></div>

          </div>

         

        </form>


      </div>

    </div>

  </div>

</div>

