@extends('person.page')
@section('content')
@include('errors.messages')
<div class="row">
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">Product {{ $product->id }}</div>
            <div class="panel-body">
                <a href="{{ url('/person/product') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                <a href="{{ url('/person/product/' . $product->id . '/edit') }}" title="Edit Product"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                <form method="POST" action="{{ url('person/product' . '/' . $product->id) }}" accept-charset="UTF-8" style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Product" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                </form>
                <br/>
                <br/>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th>ID</th><td>{{ $product->id }}</td>
                            </tr>
                            <tr>
                                <th> Producto </th><td> {{ $product->producto }} </td>
                            </tr>
                            <tr>
                                <th> Cod Barra </th><td> {{ $product->cod_barra }} </td>
                            </tr>
                            <tr>
                                <th> Pre Compra </th><td> {{ $product->pre_compra }} </td>
                            </tr>
                            <tr>
                                <th> Pre Venta </th><td> {{ $product->pre_venta }} </td>
                            </tr>
                            <tr>
                                <th> Cantidad </th><td> {{ $product->cantidad }} </td>
                            </tr>
                            <tr>
                                <th> Detalle </th><td> {{ $product->propaganda }} </td>
                            </tr>
                            <tr>
                                <th> Nuevo </th><td> 
                                    @if(($product->nuevo)=='1')
                                    <small class="label label-success">Activo</small>
                                    @else
                                    <small class="label label-danger">Inactivo</small>
                                    @endif
                                 </td>
                            </tr>
                            <tr>
                                <th> Promoción </th><td> 
                                @if(($product->promo)=='1')
                                    <small class="label label-success">Activo</small>
                                    @else
                                    <small class="label label-danger">Inactivo</small>
                                    @endif
                                     </td>
                            </tr>
                            <tr>
                                <th> Catalogo </th><td> 
                                @if(($product->catalogo)=='1')
                                    <small class="label label-success">Activo</small>
                                    @else
                                    <small class="label label-danger">Inactivo</small>
                                    @endif
                                     </td>
                            </tr>
                            <tr>
                                <th> Activo </th><td> 
                                @if(($product->activo)=='1')
                                    <small class="label label-success">Activo</small>
                                    @else
                                    <small class="label label-danger">Inactivo</small>
                                    @endif
                                     </td>
                            </tr>
                            <tr>
                                <th> Categoría </th><td> {{ $product->Category->category }} </td>
                            </tr>
                            <tr>
                                <th> Subcategoría </th><td> {{ $product->Subcategory->subcategory }} </td>
                            </tr>
                            <tr>
                                <th> Proveedor </th>
                                <td> 
                                    @if(empty($product->id_proveedor))
                                        <strong>Proveedor no seleccionado</strong>
                                    @else
                                    {{ $product->Proveedor->proveedor }} 
                                    <a href="{{ url('/person/proveedor/' . $product->id_proveedor) }}" title="Ver Proveedor"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver Proveedor</button></a>
                                    @endif

                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
