@extends('adminlte::page')
@section('content')
@include('errors.messages')
        <div class="row">

            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Iva</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/iva/create') }}" class="btn btn-success btn-sm" title="Nuevo Iva">
                            <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                        </a>

                        <form method="GET" action="{{ url('/admin/iva') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
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
                                        <th>#</th><th>Iva</th><th>Activo</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($iva as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->iva }}</td><td>{{ $item->activo }}</td>
                                        <td>
                                            <a href="{{ url('/admin/iva/' . $item->id) }}" title="Ver Iva"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                            <a href="{{ url('/admin/iva/' . $item->id . '/edit') }}" title="Editar Iva"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                            <form method="POST" action="{{ url('/admin/iva' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Iva" onclick="return confirm(&quot;Desea elominar?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $iva->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
