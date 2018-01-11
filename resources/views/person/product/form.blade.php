<div class="col-md-6">
    <div class="form-group {{ $errors->has('fecha_ingreso') ? 'has-error' : ''}}">
        <label for="fecha_ingreso" class="col-md-4 col-lg-2 control-label">{{ 'Fecha Ingreso' }}</label>
        <div class="col-md-6 col-lg-8">
            {!! Form::text('fecha_ingreso', $fecha, ['class' => 'form-control datepicker', 'id'=>'fecha_ingreso']) !!}
            {!! $errors->first('fecha_ingreso', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('producto') ? 'has-error' : ''}}">
        <label for="producto" class="col-md-4 col-lg-2 control-label">{{ 'Producto' }}</label>
        <div class="col-md-6 col-lg-8">
            {!! Form::text('producto', null, ['class' => 'form-control', 'required' => 'required','id'=>'producto','autofocus'=>'autofocus']) !!}
            {!! $errors->first('producto', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('cod_barra') ? 'has-error' : ''}}">
        <label for="cod_barra" class="col-md-4 col-lg-2 control-label">{{ 'Código Barra' }}</label>
        <div class="col-md-6 col-lg-8">
            {!! Form::text('cod_barra', null, ['class' => 'form-control', 'id'=>'cod_barra']) !!}
            {!! $errors->first('cod_barra', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('pre_compra') ? 'has-error' : ''}}">
        <label for="pre_compra" class="col-md-4 col-lg-2 control-label">{{ 'Precio Compra' }}</label>
        <div class="col-md-6 col-lg-8">
            {!! Form::text('pre_compra', null, ['class' => 'form-control', 'id'=>'pre_compra']) !!}
            {!! $errors->first('pre_compra', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('pre_venta') ? 'has-error' : ''}}">
        <label for="pre_venta" class="col-md-4 col-lg-2 control-label">{{ 'Precio Venta' }}</label>
        <div class="col-md-6 col-lg-8">
            {!! Form::text('pre_venta', null, ['class' => 'form-control', 'id'=>'pre_venta']) !!}
            {!! $errors->first('pre_venta', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('compras') ? 'has-error' : ''}}">
        <label for="compras" class="col-md-4 col-lg-2 control-label">{{ 'Cant. Ingreso' }}</label>
        <div class="col-md-6 col-lg-8">
            {!! Form::text('compras', null, ['class' => 'form-control', 'id'=>'compras','placeholder'=>'Cantidad de ingreso']) !!}
            {!! $errors->first('compras', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('cantidad') ? 'has-error' : ''}}">
        <label for="cantidad" class="col-md-4 col-lg-2 control-label">{{ 'Stock' }}</label>
        <div class="col-md-6 col-lg-8">
            {!! Form::text('cantidad', null, ['class' => 'form-control', 'id'=>'cantidad']) !!}
            {!! $errors->first('cantidad', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('imagen') ? 'has-error' : ''}}">
        <label for="imagen" class="col-md-4 col-lg-2 control-label">{{ 'Imagen' }}</label>
        <div class="col-md-6 col-lg-8">
            {!! Form::file('imagen', null, ['class' => 'form-control', 'id'=>'imagen']) !!}
            {!! $errors->first('imagen', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('nuevo') ? 'has-error' : ''}}">
        <label for="nuevo" class="col-md-4 col-lg-2 control-label">{{ 'Nuevo' }}</label>
        <div class="col-md-6 col-lg-8">
            <select name="nuevo" class="form-control" id="nuevo" >
                @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($almacen->activo) && $almacen->activo == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                @endforeach
            </select>
            {!! $errors->first('nuevo', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('id_marca') ? 'has-error' : ''}}">
        <label for="id_marca" class="col-md-4 col-lg-2 control-label">{{ 'Marca' }}</label>
        <div class="col-md-6 col-lg-8">
            {!! Form::select('id_marca', $marca, null, ['class' => 'form-control','id'=>'id_category']) !!}
            {!! $errors->first('id_marca', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group {{ $errors->has('promo') ? 'has-error' : ''}}">
        <label for="promo" class="col-md-4 col-lg-2 control-label">{{ 'Promoción' }}</label>
        <div class="col-md-6 col-lg-8">
            <select name="promo" class="form-control" id="promo" >
                @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($almacen->activo) && $almacen->activo == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                @endforeach
            </select>
            {!! $errors->first('promo', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('catalogo') ? 'has-error' : ''}}">
        <label for="catalogo" class="col-md-4 col-lg-2 control-label">{{ 'Catalogo' }}</label>
        <div class="col-md-6 col-lg-8">
            <select name="catalogo" class="form-control" id="catalogo" >
                @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($almacen->activo) && $almacen->activo == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                @endforeach
            </select>
            {!! $errors->first('catalogo', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('activo') ? 'has-error' : ''}}">
        <label for="activo" class="col-md-4 col-lg-2 control-label">{{ 'Activo' }}</label>
        <div class="col-md-6 col-lg-8">
            <select name="activo" class="form-control" id="activo" >
                @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($almacen->activo) && $almacen->activo == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                @endforeach
            </select>
            {!! $errors->first('activo', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('propaganda') ? 'has-error' : ''}}">
        <label for="propaganda" class="col-md-4 col-lg-2 control-label">{{ 'Propaganda' }}</label>
        <div class="col-md-6 col-lg-8">
            {!! Form::textarea('propaganda', null, ['class' => 'form-control', 'id'=>'propaganda','rows'=>'3']) !!} 
            <!--<textarea class="form-control" rows="5" name="propaganda" type="textarea" id="propaganda" >{{ $product->propaganda or ''}}</textarea>-->
            {!! $errors->first('propaganda', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('id_category') ? 'has-error' : ''}}">
        <label for="id_category" class="col-md-4 col-lg-2 control-label">{{ 'Categoría' }}</label>
        <div class="col-md-6 col-lg-8">
            {!! Form::select('id_category', $category, null, ['class' => 'form-control','id'=>'id_category']) !!}
            {!! $errors->first('id_category', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('id_subcategory') ? 'has-error' : ''}}">
        <label for="id_subcategory" class="col-md-4 col-lg-2 control-label">{{ 'Subcategoría' }}</label>
        <div class="col-md-6 col-lg-8">
            {!! Form::select('id_subcategory', $subcategory, null, ['class' => 'form-control','id'=>'id_subcategory']) !!}
            {!! $errors->first('id_subcategory', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('id_proveedor') ? 'has-error' : ''}}">
        <label for="id_proveedor" class="col-md-4 col-lg-2 control-label">{{ 'Proveedor' }}</label>
        <div class="col-md-6 col-lg-8">

        <button class="btn btn-default" id="buscarcliente" type="button" data-toggle="modal" data-target="#modal-proveedor"><i class="fa fa-search" aria-hidden="true"></i> Buscar Proveedor</button>

        <button class="btn btn-default" id="resetproveedor" type="button"><i class="fa fa-trash-o" aria-hidden="true"></i> Reset Proveedor</button>
        <br/>
        <br/>
        {!! $errors->first('marca_id', '<p class="help-block">:message</p>') !!}

        {!! Form::hidden('id_proveedor', null, ['id'=>'id_proveedor','class' => 'form-control', 'required' => 'required','placeholder'=>'Proveedor Id']) !!}
        {!! Form::text('nom_pro', null, ['id'=>'nom_pro','class' => 'form-control', 'required' => 'required','placeholder'=>'Nombre proveedor','readonly'=>'readonly']) !!}

        {!! Form::text('mail', null, ['id'=>'mail','class' => 'form-control', 'required' => 'required','placeholder'=>'Proveedor Mail','readonly'=>'readonly']) !!}

        {!! Form::text('empresa', null, ['id'=>'empresa','class' => 'form-control', 'required' => 'required','placeholder'=>'Empresa','readonly'=>'readonly']) !!}

        {!! Form::text('contactos', null, ['id'=>'contactos','class' => 'form-control', 'required' => 'required','placeholder'=>'Cantactos movil','readonly'=>'readonly']) !!}

            <!--<input class="form-control" name="id_proveedor" type="number" id="id_proveedor" value="{{ $product->id_proveedor or ''}}" >-->
            {!! $errors->first('id_proveedor', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-8 col-md-4">
            <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
        </div>
    </div>
</div>


<style>
  .example-modal .modal {
    position: relative;
    top: auto;
    bottom: auto;
    right: auto;
    left: auto;
    display: block;
    z-index: 1;
  }

  .example-modal .modal {
    background: transparent !important;
  }
</style>

<div class="modal fade" id="modal-proveedor">
  <div class="modal-dialog">
    <div class="modal-content">
      {!! Form::open(['id'=>'myForm'])  !!}
      {{ csrf_field() }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <?Php
          if (empty($tittle_modal)) {
            ?>
            <h4 class="modal-title">Default Modal</h4>
            <?php
          }else{
            ?>
            <h4 class="modal-title"><?Php echo $tittle_modal ?></h4>
            <?php
          }
          ?>

        </div>
        <div class="modal-body">
          <div class="col-lg-12">
            <div class="input-group">
              <input type="text" class="form-control" id="rucprv" placeholder="Ingrese numero de ruc">
              <span class="input-group-btn">
                <button class="btn btn-default" id="proveedorrucchbuton" type="button">BUSCAR</button>
              </span>
            </div><!-- /input-group -->


            <!--nom cliente-->    
            <div class="input-group">
              <input type="text" class="form-control" id="nompro" placeholder="Ingrese nombre empresa">
              <span class="input-group-btn">
                <button class="btn btn-default" id="proveedorempchbuton" type="button">BUSCAR</button>
              </span>
            </div><!-- /input-group -->

            <!-- /.form-group -->
            <!--Mail cliente-->     
            <div class="input-group">
              <input type="text" class="form-control" id="mailpro" placeholder="Ingrese correo proveedor">
              <span class="input-group-btn">
                <button class="btn btn-default" id="proveedormailchbuton" type="button">BUSCAR</button>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
          <!-- /.form-group -->
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Datos Proveedor</h3>

                  <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover" id="tabla_proveedor">
                    <tr>
                      <th>Proveedor</th>
                      <th>Contactos</th>
                      <th>Mail</th>
                      <th>Empresa</th>
                      <th></th>
                    </tr>
                    <tbody>
                                            
                    </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <!--{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}-->
        </div>
        {!! Form::close() !!}
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

<script>
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        language: "es",
        autoclose: true
    });
</script>