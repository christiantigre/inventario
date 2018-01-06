@extends('person.page')
@section('content')
@include('errors.messages')
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Producto</div>
            <div class="panel-body">
                <a href="{{ url('/person/product/create') }}" class="btn btn-success btn-sm" title="Nuevo Product">
                    <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                </a>                           
                <a href="{{ URL::to('/person/product/downloadExcel/xls') }}">
                    <button class="btn btn-success btn-sm">Descargar Excel xls</button>
                </a>
                <a href="{{ URL::to('/person/product/downloadExcel/xlsx') }}">
                    <button class="btn btn-success btn-sm">Descargar Excel xlsx</button>
                </a>
                <a href="{{ URL::to('/person/product/downloadExcel/csv') }}">
                    <button class="btn btn-success btn-sm">Descargar CSV</button>
                </a>
                <div class="container">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <form action="{{ URL::to('/person/product/importexcelProducts') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" name="file" />
                            <button class="btn btn-primary btn-sm">Subir</button>
                        </form>
                    </div>
                </div>
                <form method="GET" action="{{ url('/person/product') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <br/>
                <br/>
                <div class="table-responsive">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>#</th><th>Producto</th><th>Cod Barra</th><th>Pre Compra</th><th>Pre Venta</th><th>Cantidad</th><th>Imagen</th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->producto }}</td><td>{{ $item->cod_barra }}</td><td>{{ $item->pre_compra }}</td><td>{{ $item->pre_venta }}</td><td>{{ $item->cantidad }}</td>
                                    <td>
                                     @if(empty($item->imagen))
                                     <center>-</center>
                                     @else
                                     <a href="{{ asset($item->imagen) }}" target="_blanck">
                                        <img src="{{ asset($item->imagen) }}" class="navbar-brand navbar-brand-logo brand-centered">
                                    </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('/person/product/' . $item->id) }}" title="View Product"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                    <a href="{{ url('/person/product/' . $item->id . '/edit') }}" title="Edit Product"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                                    <form method="POST" action="{{ url('/person/product' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-xs" title="Delete Product" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrapper"> {!! $product->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection
