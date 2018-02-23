@extends('adminlte::page')
@section('content')
@include('errors.messages')
@include('admin.contabilidad.menucontable')
@include('admin.contabilidad.infosection')
<section class="content">
    <div class="row">
        @include('admin.contabilidad.sidebar')
        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">DETALLE POR CUENTA</div>
                <div class="panel-body">

                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"> 
                            
                            Detalle de mayorización por cuenta : {{ $cuenta_name }}
                           
                        </div>
                    </div>

                <br/>
                <br/>
                
                <div class="table-responsive">
                    @if(!empty($detalle))
                    <table class="table table-borderless" id="tempBInicial">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ASIENTO</th>
                                <th>CODCUENTA</th>
                                <th>CUENTA</th>
                                <th>SALDO DEBE</th>
                                <th>SALDO HABER</th>
                                <th>ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detalle as $item)
                            <tr class="suma">
                                <td>{{ $loop->iteration or $item->id }}</td>
                                <td>{{ $item->num_asiento }}</td>                    
                                <td>{{ $item->cod_cuenta }}.</td>                    
                                <td>{{ $item->cuenta }}</td>                                        
                                <td>{{ number_format($item->saldo_debe,2) }}</td>                    
                                <td>{{ number_format($item->saldo_haber,2) }}</td> 
                                <td>
                                  <a href="{{ url('/admin/libro/verAsiento/' . $item->num_asiento) }}" class="ver-item" title="Detalle Mayor Cta. # {{ $item->cod_cuenta }}"><button class="btn btn-default btn-xs" id="ver_trs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                </td>               
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                @foreach($sumas as $itemsuma)
                                    <td>{{ number_format($itemsuma->saldo_debe,2) }}</td>
                                    <td>{{ number_format($itemsuma->saldo_haber,2) }}</td>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
</section>


@endsection
