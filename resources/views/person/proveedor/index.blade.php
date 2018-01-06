@extends('person.page')
@section('content')
@include('errors.messages')
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Proveedor</div>
            <div class="panel-body">                      
                <a href="{{ url('/person/proveedor/create') }}" class="btn btn-success btn-sm" title="Nuevo Proveedor">
                    <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                </a>                          
                <a href="{{ URL::to('/person/proveedor/downloadExcel/xls') }}">
                    <button class="btn btn-success btn-sm">Descargar Excel xls</button>
                </a>
                <a href="{{ URL::to('/person/proveedor/downloadExcel/xlsx') }}">
                    <button class="btn btn-success btn-sm">Descargar Excel xlsx</button>
                </a>
                <a href="{{ URL::to('/person/proveedor/downloadExcel/csv') }}">
                    <button class="btn btn-success btn-sm">Descargar CSV</button>
                </a>
                <div class="container">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <form action="{{ URL::to('/person/proveedor/importexcelProveedor') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" name="file" />
                            <button class="btn btn-primary btn-sm">Subir</button>
                        </form>
                    </div>
                </div>
                <form method="GET" action="{{ url('/person/proveedor') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
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
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Proveedor</th>
                                <th>Correo</th>
                                <th>Ruc</th>
                                <th>Dir</th>
                                <th>Contactos</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proveedor as $item)
                            <tr>
                                <td>{{ $loop->iteration or $item->id }}</td>
                                <td>{{ $item->proveedor }}</td>
                                <td>{{ $item->mail }}</td>
                                <td>{{ $item->ruc }}</td>
                                <td>{{ $item->dir }}</td>
                                <td>{{ $item->tlfn }} / {{ $item->watsapp }}</td>
                                <td>
                                    <a href="{{ url('/person/proveedor/' . $item->id) }}" title="Ver Proveedor"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                    <a href="{{ url('/person/proveedor/' . $item->id . '/edit') }}" title="Editar Proveedor"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                    <form method="POST" action="{{ url('/person/proveedor' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Proveedor" onclick="return confirm(&quot;Desea eliminar?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper"> {!! $proveedor->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
