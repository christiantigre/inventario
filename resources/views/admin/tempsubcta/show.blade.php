@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Tempsubctum {{ $tempsubctum->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/tempsubcta') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/tempsubcta/' . $tempsubctum->id . '/edit') }}" title="Edit Tempsubctum"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/tempsubcta' . '/' . $tempsubctum->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Tempsubctum" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $tempsubctum->id }}</td>
                                    </tr>
                                    <tr><th> Subcuenta </th><td> {{ $tempsubctum->subcuenta }} </td></tr><tr><th> Secuencia </th><td> {{ $tempsubctum->secuencia }} </td></tr><tr><th> Codigo </th><td> {{ $tempsubctum->codigo }} </td></tr><tr><th> Detall </th><td> {{ $tempsubctum->detall }} </td></tr><tr><th> Activo </th><td> {{ $tempsubctum->activo }} </td></tr><tr><th> Cuenta </th><td> {{ $tempsubctum->cuenta }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
