@extends('adminlte::page')

@section('content')
@include('errors.messages')
        <div class="row">

            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Proveedor {{ $proveedor->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/proveedor') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/proveedor/' . $proveedor->id . '/edit') }}" title="Edit Proveedor"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/proveedor' . '/' . $proveedor->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Proveedor" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $proveedor->id }}</td>
                                    </tr>
                                    <tr><th> Proveedor </th><td> {{ $proveedor->proveedor }} </td></tr><tr><th> Dir </th><td> {{ $proveedor->dir }} </td></tr><tr><th> Tlfn </th><td> {{ $proveedor->tlfn }} </td></tr><tr><th> Cel Movi </th><td> {{ $proveedor->cel_movi }} </td></tr><tr><th> Cel Claro </th><td> {{ $proveedor->cel_claro }} </td></tr><tr><th> Watsapp </th><td> {{ $proveedor->watsapp }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
