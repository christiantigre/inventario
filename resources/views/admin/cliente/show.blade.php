@extends('adminlte::page')

@section('content')
@include('errors.messages')
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Cliente {{ $cliente->ced_cli }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/cliente') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <a href="{{ url('/admin/cliente/' . $cliente->id . '/edit') }}" title="Editar Cliente"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ url('admin/cliente' . '/' . $cliente->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Cliente" onclick="return confirm(&quot;Desea Eliminar?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $cliente->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Cliente </th>
                                        <td> {{ $cliente->nom_cli }} {{ $cliente->app_cli }} </td>
                                    </tr>
                                    <tr>
                                        <th> Cedula </th>
                                        <td> {{ $cliente->ced_cli }} </td>
                                    </tr>
                                    <tr>
                                        <th> Ruc </th>
                                        <td> {{ $cliente->ruc_cli }} </td>
                                    </tr>
                                    <tr>
                                        <th> Dirección </th>
                                        <td> {{ $cliente->dir_cli }} </td>
                                    </tr>
                                    <tr>
                                        <th> Correo </th>
                                        <td> {{ $cliente->mail_cli }} </td>
                                    </tr>
                                    <tr>
                                        <th> Teléfono </th>
                                        <td> {{ $cliente->tlf_cli }} </td>
                                    </tr>
                                    <tr>
                                        <th> Cel Movistar </th>
                                        <td> {{ $cliente->clmovi_cli }} </td>
                                    </tr>
                                    <tr>
                                        <th> Cel Claro </th>
                                        <td> {{ $cliente->clclr_cli }} </td>
                                    </tr>
                                    <tr>
                                        <th> Watsapp </th>
                                        <td> {{ $cliente->wts_cli }} </td>
                                    </tr>
                                    <tr>
                                        <th> Activo </th>
                                        <td> {{ $cliente->activo }} </td>
                                    </tr>
                                    <tr>
                                        <th> Pais </th>
                                        <td> {{ $cliente->id_pais }} / {{ $cliente->id_provincia }} / {{ $cliente->id_canton }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
    </div>
@endsection
