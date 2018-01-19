@extends('adminlte::page')
@section('content')
@include('errors.messages')
        <div class="row">
            
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Nivel de cuenta : {{ $tipocuentum->nombre }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/tipocuenta') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <a href="{{ url('/admin/tipocuenta/' . $tipocuentum->id . '/edit') }}" title="Editar nivel"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ url('admin/tipocuenta' . '/' . $tipocuentum->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Eliminar nivel" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $tipocuentum->id }}</td>
                                    </tr>
                                    <tr><th> Tipocuenta </th><td> {{ $tipocuentum->tipocuenta }} </td></tr><tr><th> Codigo </th><td> {{ $tipocuentum->codigo }} </td></tr><tr><th> Nombre </th><td> {{ $tipocuentum->nombre }} </td></tr><tr><th> Detall </th><td> {{ $tipocuentum->detall }} </td></tr><tr><th> Activo </th><td> {{ $tipocuentum->activo }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
