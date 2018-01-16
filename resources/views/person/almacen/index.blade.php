@extends('person.page')
@section('content')
@include('errors.messages')
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Almacen</div>
                    <div class="panel-body">
                        {{--
                        <a href="{{ url('/person/almacen/create') }}" class="btn btn-success btn-sm" title="Add New Almacen">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        --}}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Almacen</th><th>Propietario</th><th>Gerente</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($almacen as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->almacen }}</td><td>{{ $item->propietario }}</td><td>{{ $item->gerente }}</td>
                                        <td>
                                            <a href="{{ url('/person/almacen/' . $item->id) }}" title="Ver Almacen"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                            <a href="{{ url('/person/almacen/' . $item->id . '/edit') }}" title="Editar Almacen"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                                            {{--
                                            <form method="POST" action="{{ url('/person/almacen' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete Almacen" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                            --}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $almacen->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
