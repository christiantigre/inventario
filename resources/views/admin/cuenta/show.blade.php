@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Cuentum {{ $cuentum->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/cuenta') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/cuenta/' . $cuentum->id . '/edit') }}" title="Edit Cuentum"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/cuenta' . '/' . $cuentum->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Cuentum" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $cuentum->id }}</td>
                                    </tr>
                                    <tr><th> Cuenta </th><td> {{ $cuentum->cuenta }} </td></tr><tr><th> Codigo </th><td> {{ $cuentum->codigo }} </td></tr><tr><th> Detall </th><td> {{ $cuentum->detall }} </td></tr><tr><th> Activo </th><td> {{ $cuentum->activo }} </td></tr><tr><th> Grupo Id </th><td> {{ $cuentum->grupo_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
