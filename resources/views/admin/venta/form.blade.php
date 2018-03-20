
<div class="col-md-12">
    <a href="" data-toggle="modal" data-target="#modal-seleccionacliente" class="btn btn-default btn-sm" title="Buscar Cliente">
        <i class="fa fa-search" aria-hidden="true"></i> Buscar Cliente
    </a>
    <a href="" data-toggle="modal" class="btn btn-default btn-sm reset_cli" title="Reset Cliente">
        <i class="fa fa-circle-o-notch" aria-hidden="true"></i> Reset Cliente
    </a>
    <a href="" data-toggle="modal" data-target="#modal-registrocliente" class="btn btn-default btn-sm" title="Registrar Cliente">
        <i class="fa fa-plus" aria-hidden="true"></i> Crear Cliente
    </a>
    
    <a href="" data-toggle="modal" class="btn btn-default btn-sm cliente-final" title="Cliente Final">
        <i class="fa fa-plus" aria-hidden="true"></i> Cliente Final
    </a>
    
    <div class="form-group {{ $errors->has('num_venta') ? 'has-error' : ''}}">
        <label for="fecha" class="col-md-9 control-label">{{ 'N° Venta:' }}</label>
        <div class="col-md-3">            
            <input class="form-control input-sm" name="idventa" type="hidden" id="idventa" value="{{ $cant_incr}}">
            <input class="form-control input-sm" name="num_factura" type="hidden" id="num_factura" value="{{ $numero_venta}}">
            <label for="fecha" class="col-md-9 control-label">{{ $numero_venta }}</label>            
            {!! $errors->first('num_venta', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('fecha') ? 'has-error' : ''}}">
        <label for="fecha" class="col-md-9 control-label">{{ 'Fecha:' }}</label>
        <div class="col-md-3">
            <label for="fecha" class="col-md-9 control-label">{{ $fecha_venta }}</label>            
            <input class="form-control input-sm" name="fecha" type="hidden" id="fecha" value="{{ $fecha_venta or ''}}" >
            {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('vendedor') ? 'has-error' : ''}}">
        <label for="vendedor" class="col-md-9 control-label">{{ 'Vendedor:' }}</label>
        <div class="col-md-3">
            <label for="vendedor" class="col-md-9 control-label">{{ $username }}</label>            
            <label for="vendedor" class="col-md-9 control-label">{{ $useremail }}</label>            
            <input class="form-control input-sm" name="vendedor" type="hidden" id="vendedor" value="{{ $userid }}" >
        </div>
    </div>
</div>


<div class="col-md-12">
    CLIENTE
    <fieldset>
        <legend>
        </legend>
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('cliente') ? 'has-error' : ''}}">
                <label for="cliente" class="col-md-4 control-label">{{ 'NOMBRE' }}</label>
                <div class="col-md-8">
                 <input class="form-control input-sm" name="id_cliente" type="hidden" id="id_cliente" value="{{ $ventum->id_cliente or ''}}" >
                 <input class="form-control input-sm" name="cliente" type="text" id="cliente" value="{{ $ventum->cliente or ''}}" >
                 {!! $errors->first('cliente', '<p class="help-block">:message</p>') !!}
             </div>
         </div>
         <div class="form-group {{ $errors->has('documento') ? 'has-error' : ''}}">
            <label for="documento" class="col-md-4 control-label">{{ 'DOCUMENTO' }}</label>
            <div class="col-xs-4">
                <input class="form-control input-sm" name="ruc_cli" type="text" id="ruc_cli" value="{{ $ventum->ruc_cli or ''}}" placeholder="RUC">
                {!! $errors->first('ruc_cli', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-xs-4">
                <input class="form-control input-sm" name="ced_cli" type="text" id="ced_cli" value="{{ $ventum->ced_cli or ''}}" placeholder="CC">
                {!! $errors->first('ced_cli', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('mail_cli') ? 'has-error' : ''}}">
            <label for="mail_cli" class="col-md-4 control-label">{{ 'CORREO' }}</label>
            <div class="col-md-8">
                <input class="form-control input-sm" name="mail_cli" type="text" id="mail_cli" value="{{ $ventum->mail_cli or ''}}" >
                {!! $errors->first('mail_cli', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>

    <div class="col-md-6">

        <div class="form-group {{ $errors->has('cel_cli') ? 'has-error' : ''}}">
            <label for="cel_cli" class="col-md-4 control-label">{{ 'CONTACTO' }}</label>
            <div class="col-md-6">
                <input class="form-control input-sm" name="cel_cli" type="text" id="cel_cli" value="{{ $ventum->cel_cli or ''}}" >
                {!! $errors->first('cel_cli', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('dir_cli') ? 'has-error' : ''}}">
            <label for="dir_cli" class="col-md-4 control-label">{{ 'DIRECCIÓN' }}</label>
            <div class="col-md-8">
                <input class="form-control input-sm" name="dir_cli" type="text" id="dir_cli" value="{{ $ventum->dir_cli or ''}}" >
                {!! $errors->first('dir_cli', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('id_typepay') ? 'has-error' : ''}}">
            <label for="id_typepay" class="col-md-4 control-label">{{ 'Pago' }}</label>
            <div class="col-md-6">
                {!! Form::select('id_typepay', $tipospagos, null, ['class' => 'form-control','id'=>'id_typepay']) !!}
                {!! $errors->first('id_typepay', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('id_entrega') ? 'has-error' : ''}}">
            <label for="identregay" class="col-md-4 control-label">{{ 'Entrega' }}</label>
            <div class="col-md-6">
                {!! Form::select('id_entrega', $entregas, null, ['class' => 'form-control','id'=>'id_entrega']) !!}
                {!! $errors->first('id_entrega', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

    </div>
</fieldset>
</div>
<div class="col-md-6">


    <!--<div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
        <label for="total" class="col-md-4 control-label">{{ 'Total' }}</label>
        <div class="col-md-6">
            <input class="form-control input-sm" name="total" type="number" id="total" value="{{ $ventum->total or ''}}" >
            {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('subtotal') ? 'has-error' : ''}}">
        <label for="subtotal" class="col-md-4 control-label">{{ 'Subtotal' }}</label>
        <div class="col-md-6">
            <input class="form-control input-sm" name="subtotal" type="number" id="subtotal" value="{{ $ventum->subtotal or ''}}" >
            {!! $errors->first('subtotal', '<p class="help-block">:message</p>') !!}
        </div>
    </div>-->

</div>
<div class="col-md-6">

    <!--<div class="form-group {{ $errors->has('iva_cero') ? 'has-error' : ''}}">
        <label for="iva_cero" class="col-md-4 control-label">{{ 'Iva Cero' }}</label>
        <div class="col-md-6">
            <input class="form-control input-sm" name="iva_cero" type="number" id="iva_cero" value="{{ $ventum->iva_cero or ''}}" >
            {!! $errors->first('iva_cero', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('iva_calculado') ? 'has-error' : ''}}">
        <label for="iva_calculado" class="col-md-4 control-label">{{ 'Iva Calculado' }}</label>
        <div class="col-md-6">
            <input class="form-control input-sm" name="iva_calculado" type="number" id="iva_calculado" value="{{ $ventum->iva_calculado or ''}}" >
            {!! $errors->first('iva_calculado', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('porcentaje_iva') ? 'has-error' : ''}}">
        <label for="porcentaje_iva" class="col-md-4 control-label">{{ 'Porcentaje Iva' }}</label>
        <div class="col-md-6">
            <input class="form-control input-sm" name="porcentaje_iva" type="number" id="porcentaje_iva" value="{{ $ventum->porcentaje_iva or ''}}" >
            {!! $errors->first('porcentaje_iva', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('can_items') ? 'has-error' : ''}}">
        <label for="can_items" class="col-md-4 control-label">{{ 'Can Items' }}</label>
        <div class="col-md-6">
            <input class="form-control input-sm" name="can_items" type="number" id="can_items" value="{{ $ventum->can_items or ''}}" >
            {!! $errors->first('can_items', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('vendedor') ? 'has-error' : ''}}">
        <label for="vendedor" class="col-md-4 control-label">{{ 'Vendedor' }}</label>
        <div class="col-md-6">
            <input class="form-control input-sm" name="vendedor" type="text" id="vendedor" value="{{ $ventum->vendedor or ''}}" >
            {!! $errors->first('vendedor', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('id_personal') ? 'has-error' : ''}}">
        <label for="id_personal" class="col-md-4 control-label">{{ 'Id Personal' }}</label>
        <div class="col-md-6">
            <input class="form-control input-sm" name="id_personal" type="number" id="id_personal" value="{{ $ventum->id_personal or ''}}" >
            {!! $errors->first('id_personal', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('id_iva') ? 'has-error' : ''}}">
        <label for="id_iva" class="col-md-4 control-label">{{ 'Id Iva' }}</label>
        <div class="col-md-6">
            <input class="form-control input-sm" name="id_iva" type="number" id="id_iva" value="{{ $ventum->id_iva or ''}}" >
            {!! $errors->first('id_iva', '<p class="help-block">:message</p>') !!}
        </div>
    </div>-->
</div>


<div class="col-md-12"> 
    PRODUCTO
    <fieldset>
        <legend>
        </legend>
        <!--boton id=buscarproducto abre modal id=modal-seleccionaproductos(archivo admin/venta/modalselect_prod) llamado por data-target=modal-seleccionaproductos -->
        <button class="btn btn-default btn-sm" id="buscarproducto" type="button" data-toggle="modal" data-target="#modal-seleccionaproductos"><i class="fa fa-search" aria-hidden="true"></i> Buscar Producto</button>
        
        <button class="btn btn-default btn-sm" id="trashitems" type="button" onClick="trash(this.id);"><i class="fa fa-trash" aria-hidden="true"></i> Vaciar</button>
        
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div id="list-cart">
          </div>             
      </div>
      <!-- /.box-body -->
      <!-- /.box -->
  </fieldset>
</div>
<!-- /.col -->



<div class="form-group">
    <div class="col-lg-offset-10 col-md-offset-10 col-sm-offset-8 col-xs-offset-8 col-md-4 col-lg-4 col-sm-12 col-xs-12">
        <input class="btn btn-success" type="submit" value="{{ $submitButtonText or 'Guardar Venta' }}">
    </div>
</div>

