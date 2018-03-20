@extends('adminlte::page')
@section('content')
@include('errors.messages')
@include('admin.contabilidad.infosection')
    <div class="container">
        <div class="row">
            
            <div class="col-md-11">
                <div class="panel panel-default">
                    <div class="panel-heading">CONFIGURACIÓN FACTURA ELECTRÓNICA</div>
                    <div class="panel-body">
                        @if(count($facturacionelectronica)<"1")
                        <a href="{{ url('/admin/facturacion-electronica/create') }}" class="btn btn-success btn-sm" title="Add New FacturacionElectronica">
                            <i class="fa fa-plus" aria-hidden="true"></i> Configuración
                        </a>
                        @endif

                        <form method="GET" action="{{ url('/admin/facturacion-electronica') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
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
                                        <th>#</th><th>Generar Facturas</th><th>Obligado Contabilidad</th><th>Path Certificado</th><th>Modo Ambiente</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($facturacionelectronica as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>
                                            
                                            @if($item->generar_facturas=="1")
                                                ACTIVADO 
                                            @else
                                                DESACTIVADO
                                            @endif

                                        </td>
                                        <td>

                                            @if($item->obligado_contabilidad=="1")
                                                OBLIGADO A LLEVAR CONTABILIDAD 
                                            @else
                                                NO OBLIGADO A LLEVAR CONTABILIDAD
                                            @endif

                                        </td>
                                        <td>{{ $item->path_certificado }}</td>
                                        <td>
                                            @if($item->modo_ambiente=="1")
                                                PRUEBAS 
                                            @else
                                                PRODUCCIÓN
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/facturacion-electronica/' . $item->id) }}" title="Ver FacturacionElectronica"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                            <a href="{{ url('/admin/facturacion-electronica/' . $item->id . '/edit') }}" title="Editar FacturacionElectronica"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                            <form method="POST" action="{{ url('/admin/facturacion-electronica' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Eliminar FacturacionElectronica" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $facturacionelectronica->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
