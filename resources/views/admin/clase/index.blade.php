@extends('adminlte::page')
@section('content')
@include('errors.messages')
        <div class="row">
@include('admin.contabilidad.infosection')
<section class="content">
            @include('admin.tipocuenta.sidebar')

            <div class="col-md-10 col-lg-10 col-xs-10 col-sm-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Clase</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/clase/create') }}" class="btn btn-success btn-sm" title="Registrar Clase">
                            <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                        </a>

                        <form method="GET" action="{{ url('/admin/clase') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
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
                                        <th>#</th><th>Codigo</th><th>Clase</th><th>Detall</th><th>Activo</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($clase as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td><td>{{ $item->codigo }}</td>
                                        <td>{{ $item->clase }}</td><td>{{ $item->detall }}</td>
                                        <td>
                                            @if(($item->activo)=='1')
                                    <small class="label label-success">Activo</small>
                                    @else
                                    <small class="label label-danger">Inactivo</small>
                                    @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/clase/' . $item->id) }}" title="Ver clase"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                            <a href="{{ url('/admin/clase/' . $item->id . '/edit') }}" title="Editar clase"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                            <form method="POST" action="{{ url('/admin/clase' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Eliminar clase" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $clase->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        </div>
@endsection
