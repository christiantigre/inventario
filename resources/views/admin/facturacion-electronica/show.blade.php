@extends('adminlte::page')
@section('content')
@include('errors.messages')
@include('admin.contabilidad.infosection')
    <div class="container">
        <div class="row">

            <div class="col-md-11">
                <div class="panel panel-default">
                    <div class="panel-heading">FacturacionElectronica {{ $facturacionelectronica->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/facturacion-electronica') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <a href="{{ url('/admin/facturacion-electronica/' . $facturacionelectronica->id . '/edit') }}" title="Editar FacturacionElectronica"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ url('admin/facturacionelectronica' . '/' . $facturacionelectronica->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Eliminar FacturacionElectronica" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $facturacionelectronica->id }}</td>
                                    </tr>
                                    <tr><th> Generar Facturas </th><td>  @if($facturacionelectronica->generar_facturas=="1")
                                                ACTIVADO 
                                            @else
                                                DESACTIVADO
                                            @endif </td></tr><tr><th> Obligado Contabilidad </th><td> 
                                            @if($facturacionelectronica->obligado_contabilidad=="1")
                                                OBLIGADO A LLEVAR CONTABILIDAD 
                                            @else
                                                NO OBLIGADO A LLEVAR CONTABILIDAD
                                            @endif
                                             </td></tr><tr><th> Path Certificado </th><td> {{ $facturacionelectronica->path_certificado }} </td></tr>
                                             <tr>
                                                <th> Modo Ambiente </th>
                                                <td> 
                                             @if($facturacionelectronica->modo_ambiente=="1")
                                                PRUEBAS 
                                            @else
                                                PRODUCCIÓN
                                            @endif
                                             </td>
                                         </tr>
                                         <tr>
                                                <th> Clave Certificado </th>
                                                <td> 
                                            {{  $facturacionelectronica->clave_certificado }}
                                                
                                             </td>
                                         </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
