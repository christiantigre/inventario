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
                            
                            Mayorización del periodo actual contable
                           
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
                                <th>INTERVENCIóNES</th>
                                <th>CODCUENTA</th>
                                <th>CUENTA</th>
                                <th>SALDO DEBE</th>
                                <th>SALDO HABER</th>
                                <th>ACREEDOR</th>
                                <th>DEUDOR</th>
                                <th>ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mayor as $item)
                            <tr class="suma">
                                <td>{{ $loop->iteration or $item->id }}</td>
                                <td><center>{{ $item->count }}</center></td> 
                                <td>{{ $item->cod_cuenta }}.</td>                    
                                <td>{{ $item->cuenta }}</td>                                        
                                <td>{{ number_format($item->debe,2) }}</td>                    
                                <td>{{ number_format($item->haber,2) }}</td> 
                                  @if(($item->debe)>($item->haber))
                                <td>
                                    {{ number_format(( $item->debe-$item->haber ),2) }}
                                </td>
                                <td>0.00</td>
                                  @endif
                                  @if(($item->haber)>($item->debe))
                                <td>0.00</td>
                                <td>
                                    {{ number_format(( $item->haber-$item->debe ),2) }}
                                </td>
                                  @endif
                                <td>

                                  <a href="{{ url('/admin/mayor/detallecuenta/' . $item->cod_cuenta) }}" class="ver-item" title="Detalle Mayor Cta. # {{ $item->cod_cuenta }}"><button class="btn btn-default btn-xs" id="ver_trs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>

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
                                    <td>{{ number_format($sumas_saldo['sumas_acreedor'],2) }}</td>
                                    <td>{{ number_format($sumas_saldo['sumas_deudor'],2) }}</td>
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
