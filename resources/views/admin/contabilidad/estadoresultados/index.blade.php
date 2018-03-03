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
                <div class="panel-heading">ESTADO DE RESULTADOS</div>
                <div class="panel-body">

                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"> 

                        Estado de resultados del periodo actual

                    </div>
                </div>

                <br/>
                <br/>
                
                <div class="table-responsive">
                    @if(!empty($estadoresultados))
                    <table class="table table-borderless" id="tempBInicial">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>CODCUENTA</th>
                                <th>CUENTA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estadoresultados as $item)
                            <tr>
                                <td>{{ $loop->iteration or $item->id }}</td>
                                <td>{{ $item->cod_cuenta }}.</td>                    
                                <td>{{ $item->cuenta }}</td>             
                                <?Php
                                $count_doots = substr_count($item->cod_cuenta, '.');
                                ?>
                                @if($count_doots=="0")
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    @if(($item->saldo_debe)>($item->saldo_haber))
                                    {{ number_format(( $item->saldo_debe-$item->saldo_haber ),2) }}
                                    @else
                                    {{ number_format(( $item->saldo_haber-$item->saldo_debe ),2) }}
                                    @endif
                            </td>
                            
                                @endif 
                                @if($count_doots=="1")
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    
                                    @if(($item->saldo_debe)>($item->saldo_haber))
                                    {{ number_format(( $item->saldo_debe-$item->saldo_haber ),2) }}
                                    @else
                                    {{ number_format(( $item->saldo_haber-$item->saldo_debe ),2) }}
                                    @endif
                            </td>
                                <td></td>
                                @endif 
                                @if($count_doots=="2")   
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    
                                    @if(($item->saldo_debe)>($item->saldo_haber))
                                    {{ number_format(( $item->saldo_debe-$item->saldo_haber ),2) }}
                                    @else
                                    {{ number_format(( $item->saldo_haber-$item->saldo_debe ),2) }}
                                    @endif
                                </td>
                                <td></td>
                                <td></td>
                                @endif 
                                @if($count_doots=="3")   
                                <td></td>
                                <td></td>
                                <td></td>
                                <td> 
                                    
                                    @if(($item->saldo_debe)>($item->saldo_haber))
                                    {{ number_format(( $item->saldo_debe-$item->saldo_haber ),2) }}
                                    @else
                                    {{ number_format(( $item->saldo_haber-$item->saldo_debe ),2) }}
                                    @endif
                              </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @endif
                                @if($count_doots=="4")   
                                <td></td>
                                <td></td>
                                <td>
                                    
                                    @if(($item->saldo_debe)>($item->saldo_haber))
                                    {{ number_format(( $item->saldo_debe-$item->saldo_haber ),2) }}
                                    @else
                                    {{ number_format(( $item->saldo_haber-$item->saldo_debe ),2) }}
                                    @endif
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @endif 
                                @if($count_doots=="5") 
                                <td></td>
                                <td>
                                    
                                    @if(($item->saldo_debe)>($item->saldo_haber))
                                    {{ number_format(( $item->saldo_debe-$item->saldo_haber ),2) }}
                                    @else
                                    {{ number_format(( $item->saldo_haber-$item->saldo_debe ),2) }}
                                    @endif
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @endif                                 
                                @if($count_doots=="6") 
                                <td>
                                    
                                    @if(($item->saldo_debe)>($item->saldo_haber))
                                    {{ number_format(( $item->saldo_debe-$item->saldo_haber ),2) }}
                                    @else
                                    {{ number_format(( $item->saldo_haber-$item->saldo_debe ),2) }}
                                    @endif
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @endif 
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
