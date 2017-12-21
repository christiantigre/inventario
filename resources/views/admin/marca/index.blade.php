@extends('adminlte::page')
@section('content')
@include('errors.messages')
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Marca</div>
            <div class="panel-body">
                <a href="{{ url('/admin/marca/create') }}" class="btn btn-success btn-sm" title="Nueva Marca">
                    <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                </a>
                <form method="GET" action="{{ url('/admin/marca') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
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
                                <th>#</th><th>Marca</th><th>Detalle</th><th>Imagen</th><th>Activo</th><th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($marca as $item)
                            <tr>
                                <td>{{ $loop->iteration or $item->id }}</td>
                                <td>{{ $item->marca }}</td><td>{{ $item->detall }}</td><td>@if(empty($item->img))
                                    <center>-</center>
                                    @else
                                    <a href="{{ asset($item->img) }}" target="_blanck">
                                        <img src="{{ asset($item->img) }}" style="max-width: 25%;" class="img-responsive brand-centered">
                                    </a>
                                    @endif
                                </td><td>
                                     @if(($item->activo)=='1')
                                    <small class="label label-success">Activo</small>
                                    @else
                                    <small class="label label-danger">Inactivo</small>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('/admin/marca/' . $item->id) }}" title="Ver Marca"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                    <a href="{{ url('/admin/marca/' . $item->id . '/edit') }}" title="Editar Marca"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                    <form method="POST" action="{{ url('/admin/marca' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Marca" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper"> {!! $marca->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
