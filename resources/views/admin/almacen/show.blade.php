@extends('adminlte::page')

@section('content')
@include('errors.messages')
    <div class="container">
        <div class="row">

            <div class="col-md-11">
                <div class="panel panel-default">
                    <div class="panel-heading">Almacen {{ $almacen->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/almacen') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/almacen/' . $almacen->id . '/edit') }}" title="Edit Almacen"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/almacen' . '/' . $almacen->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Almacen" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $almacen->id }}</td>
                                    </tr>
                                    <tr><th> Almacen </th><td> {{ $almacen->almacen }} </td></tr><tr><th> Propietario </th><td> {{ $almacen->propietario }} </td></tr><tr><th> Gerente </th><td> {{ $almacen->gerente }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
