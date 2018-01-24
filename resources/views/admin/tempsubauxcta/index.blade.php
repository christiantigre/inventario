@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Tempsubauxcta</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/tempsubauxcta/create') }}" class="btn btn-success btn-sm" title="Add New Tempsubauxctum">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/tempsubauxcta') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
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
                                        <th>#</th><th>Subauxiliar</th><th>Secuencia</th><th>Codigo</th><th>Detall</th><th>Activo</th><th>Auxiliar</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($tempsubauxcta as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->subauxiliar }}</td><td>{{ $item->secuencia }}</td><td>{{ $item->codigo }}</td><td>{{ $item->detall }}</td><td>{{ $item->activo }}</td><td>{{ $item->auxiliar }}</td>
                                        <td>
                                            <a href="{{ url('/admin/tempsubauxcta/' . $item->id) }}" title="View Tempsubauxctum"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/tempsubauxcta/' . $item->id . '/edit') }}" title="Edit Tempsubauxctum"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/tempsubauxcta' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete Tempsubauxctum" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $tempsubauxcta->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
