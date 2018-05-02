@extends('person.page')
@section('content')
@include('errors.messages')
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Venta</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-10 col-lg-12 col-xs-12 col-sm-8">
                        <a href="{{ url('/person/venta/create') }}" class="btn btn-success btn-sm" title="Nueva Venta">
                            <i class="fa fa-plus" aria-hidden="true"></i> Nueva Venta
                        </a>

                        <form method="GET" action="{{ url('/person/facturacion') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                        
                        </div>
                        </div>


                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Actions</th>
                                        <th>#</th>
                                        <th>Factura</th>
                                        <th>Clave Acceso</th>
                                        <th>XML Generado</th>
                                        <th>XML Firmado</th>
                                        <th>Enviado Autorizar</th>
                                        <th>Autorizado</th>
                                        <th>RIDE Generado</th>
                                        <th>RIDE Enviado</th>
                                        <th>XML Enviado</th>
                                        <th>Estado</th>
                                        <th>Mensaje</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($comprobantes as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ url('/person/facturacion/' . $item->id) }}" title="Ver Venta"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                        </td>
                                        
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->numfactura }}</td>
                                        <td>{{ $item->claveacceso }}</td>
                                        <td>
                                            @if(($item->gen_xml)=='1')
                                            <small class="label pull-left bg-green">GENERADO</small>
                                        @else
                                            <small class="label pull-left bg-red">NO GENERADO</small>
                                            <a href="{{ url('/person/f_generafactura/' . $item->id_venta) }}" title="Generar XML"><button class="btn btn-info btn-xs"><i class="fa fa-refresh" aria-hidden="true"></i> GENERAR</button></a>
                                        @endif
                                        </td>
                                        <td>
                                        @if(($item->fir_xml)=='1')
                                            <small class="label pull-left bg-green">FIRMADO</small>
                                        @else
                                            <small class="label pull-left bg-red">NO FIRMADO</small>
                                            <a href="{{ url('/person/f_firmarfactura/' . $item->id_venta) }}" title="Generar XML"><button class="btn btn-info btn-xs"><i class="fa fa-refresh" aria-hidden="true"></i> FIRMAR</button></a>
                                        @endif
                                    </td>
                                        <td>
                                        @if(($item->env_xml)=='1')
                                            <small class="label pull-left bg-green">ENVIADO</small>
                                        @else
                                            <small class="label pull-left bg-red">NO ENVIADO</small>
                                            <a href="{{ url('/person/f_autorizarfactura/' . $item->id_venta) }}" title="Generar XML"><button class="btn btn-info btn-xs"><i class="fa fa-refresh" aria-hidden="true"></i> ENVIAR</button></a>
                                        @endif</td>
                                        <td>
                                        @if(($item->aut_xml)=='1')
                                            <small class="label pull-left bg-green">AUTORIZADO</small>
                                        @else
                                            <small class="label pull-left bg-red">NO AUTORIZADO</small>
                                            <a href="{{ url('/person/f_firmarfactura/' . $item->id_venta) }}" title="Generar XML"><button class="btn btn-info btn-xs"><i class="fa fa-refresh" aria-hidden="true"></i> AUTORIZAR</button></a>
                                        @endif</td>
                                        <td>
                                         @if(($item->convrt_ride)=='1')
                                            <small class="label pull-left bg-green">GENERADO</small>
                                        @else
                                            <small class="label pull-left bg-red">NO GENERADO</small>
                                            <a href="{{ url('/person/f_generarpdf/' . $item->id_venta) }}" title="Generar XML"><button class="btn btn-info btn-xs"><i class="fa fa-refresh" aria-hidden="true"></i> GENERAR</button></a>
                                        @endif</td>
                                        <td>
                                        @if(($item->send_ride)=='1')
                                            <small class="label pull-left bg-green">ENVIADO</small>
                                        @else
                                            <small class="label pull-left bg-red">NO ENVIADO</small>
                                            <a href="{{ url('/person/f_enviarcomprobantes/' . $item->id_venta) }}" title="Generar XML"><button class="btn btn-info btn-xs"><i class="fa fa-refresh" aria-hidden="true"></i> ENVIAR</button></a>
                                        @endif</td>
                                        <td>
                                            @if(($item->send_xml)=='1')
                                            <small class="label pull-left bg-green">ENVIADO</small>
                                        @else
                                            <small class="label pull-left bg-red">NO ENVIADO</small>
                                            <a href="{{ url('/person/f_enviarcomprobantes/' . $item->id_venta) }}" title="Generar XML"><button class="btn btn-info btn-xs"><i class="fa fa-refresh" aria-hidden="true"></i> ENVIAR</button></a>
                                        @endif</td>
                                        <td>{{ $item->estado_aprobacion }}</td>
                                        <td>{{ str_limit($item->mensaje,8) }}</td>

                                        
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $comprobantes->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
