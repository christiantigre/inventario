@extends('person.page')
@section('content')
@include('errors.messages')
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Venta</div>
                    <div class="panel-body">
                        <a href="{{ url('/person/venta/create') }}" class="btn btn-success btn-sm" title="Nueva Venta">
                            <i class="fa fa-plus" aria-hidden="true"></i> Nueva Venta
                        </a>

                        <form method="GET" action="{{ url('/person/venta') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
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
                                        <th>#</th><th>Fecha</th><th>Cliente</th><th>Cel Cli</th><th>Ruc Cli</th><th>Dir Cli</th><th>Mail Cli</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($venta as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->fecha }}</td><td>{{ $item->cliente }}</td><td>{{ $item->cel_cli }}</td><td>{{ $item->ruc_cli }}</td><td>{{ $item->dir_cli }}</td><td>{{ $item->mail_cli }}</td>
                                        <td>
                                            <a href="{{ url('/person/venta/' . $item->id) }}" title="Ver Venta"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                            <a href="{{ url('/person/venta/' . $item->id . '/edit') }}" title="Editar Venta"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                            <form method="POST" action="{{ url('/person/venta' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Eliminar venta" onclick="return confirm(&quot;Desea eliminar?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $venta->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
