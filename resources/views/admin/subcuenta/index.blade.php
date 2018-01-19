@extends('adminlte::page')
@section('content')
@include('errors.messages')
@include('admin.contabilidad.infosection')
<section class="content">
        <div class="row">
            @include('admin.tipocuenta.sidebar')
            <div class="col-md-10 col-lg-10 col-xs-10 col-sm-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Subcuenta</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/subcuenta/create') }}" class="btn btn-success btn-sm" title="Add New subcuentum">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/subcuenta') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
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
                                        <th>#</th><th>Subcuenta</th><th>Codigo</th><th>Detall</th><th>Activo</th><th>Cuenta Id</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($subcuenta as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->subcuenta }}</td><td>{{ $item->codigo }}</td><td>{{ $item->detall }}</td><td>{{ $item->activo }}</td><td>{{ $item->cuenta_id }}</td>
                                        <td>
                                            <a href="{{ url('/admin/subcuenta/' . $item->id) }}" title="View subcuentum"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/subcuenta/' . $item->id . '/edit') }}" title="Edit subcuentum"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/subcuenta' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete subcuentum" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $subcuenta->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
