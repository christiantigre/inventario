@extends('adminlte::page')

@section('content')
@include('errors.messages')

        <div class="row">

            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Proveedor</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/proveedor/create') }}" class="btn btn-success btn-sm" title="Nuevo Proveedor">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/proveedor') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
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
                                        <th>#</th><th>Proveedor</th><th>Dir</th><th>Tlfn</th><th>Cel Movi</th><th>Cel Claro</th><th>Watsapp</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($proveedor as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->proveedor }}</td><td>{{ $item->dir }}</td><td>{{ $item->tlfn }}</td><td>{{ $item->cel_movi }}</td><td>{{ $item->cel_claro }}</td><td>{{ $item->watsapp }}</td>
                                        <td>
                                            <a href="{{ url('/admin/proveedor/' . $item->id) }}" title="View Proveedor"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/proveedor/' . $item->id . '/edit') }}" title="Edit Proveedor"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/proveedor' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete Proveedor" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
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
