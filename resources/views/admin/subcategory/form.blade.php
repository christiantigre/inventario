<div class="form-group {{ $errors->has('subcategory') ? 'has-error' : ''}}">
    <label for="subcategory" class="col-md-4 control-label">{{ 'Sub-Categoría' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="subcategory" id="subcategory" value="{{ $subcategory->subcategory or ''}}">
        {!! $errors->first('subcategory', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    <label for="content" class="col-md-4 control-label">{{ 'Descripción' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="content" id="content" value="{{ $subcategory->content or ''}}">
        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('active') ? 'has-error' : ''}}">
    <label for="activo" class="col-md-4 control-label">{{ 'Estado' }}</label>
    <div class="col-md-6">
        <select name="active" class="form-control" id="active" >
    @foreach (json_decode('{"1":"Activo","0":"Inactivo"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($almacen->activo) && $almacen->activo == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('activo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
    <label for="category_id" class="col-md-4 control-label">{{ 'Categoría' }}</label>
    <div class="col-md-6">
        {!! Form::select('category_id', $category, null, ['class' => 'form-control','id'=>'category_id']) !!}
        {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
