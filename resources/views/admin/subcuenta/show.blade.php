@extends('adminlte::page')
@section('content')
@include('errors.messages')
        <div class="row">
@include('admin.contabilidad.infosection')
<section class="content">
            @include('admin.tipocuenta.sidebar')
            <div class="col-md-10 col-lg-10 col-xs-12 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Subcuenta {{ $subcuentum->subcuenta }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/subcuenta') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <a href="{{ url('/admin/subcuenta/' . $subcuentum->id . '/edit') }}" title="Editar subcuenta"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ url('admin/subcuenta' . '/' . $subcuentum->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Eliminar subcuentum" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $subcuentum->id }}</td>
                                    </tr>
                                    <tr><th> Subcuenta </th><td> {{ $subcuentum->subcuenta }} </td></tr><tr><th> Código </th><td> {{ $subcuentum->codigo }} </td></tr><tr><th> Detalle </th><td> {{ $subcuentum->detall }} </td></tr>
                                    <tr><th> Cuenta Id </th><td> {{ $subcuentum->Cuenta->cuenta }} </td></tr>
                                    <tr><th> Activo </th><td> @if(($subcuentum->activo)=='1')
                                        <small class="label label-success">Activo</small>
                                        @else
                                        <small class="label label-danger">Inactivo</small>
                                        @endif </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
