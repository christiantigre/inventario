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
                <div class="panel-heading">MAYORIZACIÒN</div>
                <div class="panel-body">

                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"> 
                            
                            <a href="{{ url('/admin/libro/createAsiento') }}" class="btn btn-success btn-md" title="Registrar Asiento">
                                <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                            </a>
                           
                        </div>
                    </div>

                <br/>
                <br/>
                
                <div class="table-responsive">
                    @if(!empty($mayor))
                    <table class="table table-borderless" id="tempBInicial">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>CODCUENTA</th>
                                <th>CUENTA</th>
                                <th>SALDO DEBE</th>
                                <th>SALDO HABER</th>
                                <th>INTERVENCIóNES</th>
                                <th>ACREEDOR</th>
                                <th>DEUDOR</th>
                                <th>ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mayor as $item)
                            <tr class="suma">
                                <td>{{ $loop->iteration or $item->id }}</td>
                                <td>{{ $item->cod_cuenta }}.</td>                    
                                <td>{{ $item->cuenta }}</td>                                        
                                <td>{{ number_format($item->debe,2) }}</td>                    
                                <td>{{ number_format($item->haber,2) }}</td> 
                                <td>{{ $item->count }}</td> 
                                <td>
                                  @if(($item->debe)>($item->haber))
                                    {{ number_format(( $item->debe-$item->haber ),2) }}
                                  @endif
                                </td>
                                <td>
                                  @if(($item->haber)>($item->debe))
                                    {{ number_format(( $item->haber-$item->debe ),2) }}
                                  @endif
                                </td>
                                <td>
                                  <a href="{{ url('/admin/libro/verAsiento/' . $item->cod_cuenta) }}" class="ver-item" title="Detalle Cta. # {{ $item->cod_cuenta }}"><button class="btn btn-default btn-xs" id="ver_trs" onclick="ver_asiento({{ $item->cod_cuenta }});"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>

                                </td>               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
</section>


@endsection
