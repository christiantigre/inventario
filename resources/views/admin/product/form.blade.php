<div class="col-md-6">
    <div class="form-group {{ $errors->has('producto') ? 'has-error' : ''}}">
        <label for="producto" class="col-md-4 col-lg-2 control-label">{{ 'Producto' }}</label>
        <div class="col-md-6 col-lg-8">
            {!! Form::text('producto', null, ['class' => 'form-control', 'required' => 'required','id'=>'producto','autofocus'=>'autofocus']) !!}
            {!! $errors->first('producto', '<p class="help-block">:message</p>') !!}
        </div>
    </div><div class="form-group {{ $errors->has('cod_barra') ? 'has-error' : ''}}">
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
    </div><div class="form-group {{ $errors->has('cantidad') ? 'has-error' : ''}}">
        <label for="cantidad" class="col-md-4 col-lg-2 control-label">{{ 'Cantidad' }}</label>
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
            <input class="form-control" name="id_proveedor" type="number" id="id_proveedor" value="{{ $product->id_proveedor or ''}}" >
            {!! $errors->first('id_proveedor', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-8 col-md-4">
            <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
        </div>
    </div>
</div>