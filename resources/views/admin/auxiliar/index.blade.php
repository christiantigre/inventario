@extends('adminlte::page')
@section('content')
@include('errors.messages')
@include('admin.contabilidad.infosection')
<section class="content">
        <div class="row">

            @include('admin.tipocuenta.sidebar')

            <div class="col-md-10 col-lg-10 col-xs-12 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Auxiliar</div>
                    <div class="panel-body">
                        <div class="row">
            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-6">

                        <a href="{{ url('/admin/auxiliar/create') }}" class="btn btn-success btn-sm" title="Nueva cuenta auxiliar">
                            <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                        </a>

                        <a href="{{ URL::to('/admin/variasaux') }}" class="btn btn-success btn-sm" title="Registrar Varias Auxiliares">
                            <i class="fa fa-plus" aria-hidden="true"></i> Varios
                        </a>

                        </div>
            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-6">

                        <form method="GET" action="{{ url('/admin/auxiliar') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    </div>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Codigo</th>
                                        <th>Auxiliar</th>
                                        <th>Detalle</th>
                                        <th>Subcuenta</th>
                                        <th>Activo</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($auxiliar as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->codigo }}.</td>
                                        <td>{{ $item->auxiliar }}</td>
                                        <td>{{ $item->detall }}</td>
                                        <td>{{ $item->Subcuenta->subcuenta }}</td>
                                        <td>
                                            @if(($item->activo)=='1')
                                    <small class="label label-success">Activo</small>
                                    @else
                                    <small class="label label-danger">Inactivo</small>
                                    @endif  
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/auxiliar/' . $item->id) }}" title="Ver cuenta auxiliar"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                            <a href="{{ url('/admin/auxiliar/' . $item->id . '/edit') }}" title="Editar cuenta auxiliar"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                            <form method="POST" action="{{ url('/admin/auxiliar' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Eliminar auxiliar" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $auxiliar->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
