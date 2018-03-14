@extends('adminlte::page')
@section('content')
@include('errors.messages')

@include('admin.contabilidad.infosection')
    <div class="container">
        <div class="row">

            <div class="col-md-10 col-lg-10 col-xs-12 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Entrega</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                        <a href="{{ url('/admin/entrega/create') }}" class="btn btn-success btn-sm" title="Nuevo Metodo Entrega">
                            <i class="fa fa-plus" aria-hidden="true"></i> Nuevo Metodo Entrega
                        </a>

                        <form method="GET" action="{{ url('/admin/entrega') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
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
                            </div>
                        <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Metodo</th><th>Detalle</th><th>Activo</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($entrega as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->metodo }}</td><td>{{ $item->detalle }}</td><td>
                                            @if(($item->activo)=='1')
                                        <small class="label label-success">Activo</small>
                                        @else
                                        <small class="label label-danger">Inactivo</small>
                                        @endif  
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/entrega/' . $item->id) }}" title="Ver Entrega"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                            <a href="{{ url('/admin/entrega/' . $item->id . '/edit') }}" title="Editar Entrega"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                            <form method="POST" action="{{ url('/admin/entrega' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar Entrega" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $entrega->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
