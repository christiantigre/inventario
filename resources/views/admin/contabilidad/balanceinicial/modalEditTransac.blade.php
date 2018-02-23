<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

        <center>

          <h4 class="modal-title" id="myModalLabel">Editar Transacción</h4>

        </center>


      </div>

      <div class="modal-body">



        <form data-toggle="validator" action="" method="put">

          <div class="form-group">

            <label class="control-label" for="title">Código :</label>

            <div class="input-group input-group-md">
                {!! Form::text('cod_cuenta_modal', null, ['id'=>'cod_cuenta_modal','list'=>'cuentas','class' => 'form-control','autofocus'=>'autofocus','onSelect'=>'consulta_cuenta_admin_modal()','required'=>'required']), old('cod_cuenta_modal') !!}
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-flat busca_cuenta_modal">Buscar</button>
                    </span>
              </div>

            <datalist id="cuentas">
              @foreach($cuentas as $cuenta)
              <option class="form-control" onSelect="consulta_cuenta_admin_admin()" id="{{ $cuenta->cod }}" value="{{ $cuenta->cod }}">{{ $cuenta->cuenta }}</option>
              @endforeach
            </datalist>

            {!! Form::hidden('id_modal', null, ['id'=>'id_modal','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('id_modal') !!}

             {!! Form::hidden('almacen_id_modal', null, ['id'=>'almacen_id_modal','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('almacen_id_modal') !!}


                    {!! Form::hidden('periodo_modal', null, ['class' => 'form-control input-sm','id'=>'periodo_modal','readonly'=>'readonly','autofocus'=>'autofocus']), old('periodo_modal') !!}

                     {!! Form::hidden('responsable_modal', null, ['class' => 'form-control input-sm','id'=>'responsable_modal','readonly'=>'readonly','autofocus'=>'autofocus']), old('responsable_modal') !!}

                    {!! Form::hidden('fecha_modal', null, ['class' => 'form-control input-sm','id'=>'fecha_modal','readonly'=>'readonly','autofocus'=>'autofocus']), old('fecha_modal') !!}

                    {!! Form::hidden('num_asiento_modal', null, ['id'=>'num_asiento_modal','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('num_asiento_modal') !!}

                    {!! Form::hidden('codaux_clase_modal', null, ['id'=>'codaux_clase_modal','class' => 'form-control']), old('codaux_clase') !!}
                    {!! Form::hidden('codaux_grupo_modal', null, ['id'=>'codaux_grupo_modal','class' => 'form-control']), old('codaux_grupo') !!}
                    {!! Form::hidden('codaux_cuenta_modal', null, ['id'=>'codaux_cuenta_modal','class' => 'form-control']), old('codaux_cuenta') !!}
                    {!! Form::hidden('codaux_subcuenta_modal', null, ['id'=>'codaux_subcuenta_modal','class' => 'form-control']), old('codaux_subcuenta') !!}
                    {!! Form::hidden('codaux_auxiliar_modal', null, ['id'=>'codaux_auxiliar_modal','class' => 'form-control']), old('codaux_auxiliar') !!}
                    {!! Form::hidden('codaux_subauxiliar_modal', null, ['id'=>'codaux_subauxiliar_modal','class' => 'form-control']), old('codaux_subauxiliar') !!}

            <div class="help-block with-errors"></div>

          </div>

          <div class="form-group">

            <label class="control-label" for="title">Cuenta :</label>

           {!! Form::text('cuenta_modal', null, ['id'=>'cuenta_modal','class' => 'form-control','autofocus'=>'autofocus','required'=>'required']), old('cuenta_modal') !!} 

            <div class="help-block with-errors"></div>

          </div>

          <div class="form-group">

            <label class="control-label" for="title">Saldo debe:</label>

            {!! Form::text('saldo_debe_modal', null, ['class' => 'form-control input-sm','id'=>'saldo_debe_modal','autofocus'=>'autofocus','placeholder'=>'15.99']), old('saldo_Debe') !!}

            <div class="help-block with-errors"></div>

          </div>

          <div class="form-group">

            <label class="control-label" for="title">Saldo haber :</label>

            {!! Form::text('saldo_haber_modal', null, ['class' => 'form-control input-sm','id'=>'saldo_haber_modal','autofocus'=>'autofocus','placeholder'=>'15.99']), old('saldo_haber') !!}

            <div class="help-block with-errors"></div>

          </div>

          <div class="form-group">

            <label class="control-label" for="title">Concepto transacción:</label>

            {!! Form::textarea('concepto_detalle_modal',null,['class'=>'form-control', 'rows' => 2, 'cols' => 40,'id'=>'concepto_detalle_modal']),old('concepto_detalle_modal') !!}

            <div class="help-block with-errors"></div>

          </div>

          <div class="form-group">

            <button type="button" class="btn btn-success submit-edit-trs">Actualizar</button>

          </div>

        </form>



      </div>

    </div>

  </div>

</div>

