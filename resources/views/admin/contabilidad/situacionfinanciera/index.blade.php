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
                <div class="panel-heading">SITUACIÓN FINANCIERA</div>
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
                    @if(!empty($situaciofinanciera))
                    <table class="table table-borderless" id="tempBInicial">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>CODCUENTA</th>
                                <th>CUENTA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($situaciofinanciera as $item)
                            <tr>
                                <td>{{ $loop->iteration or $item->id }}</td>
                                <td>{{ $item->cod_cuenta }}.</td>                    
                                <td>{{ $item->cuenta }}</td>             
                                <?Php
                                $count_doots = substr_count($item->cod_cuenta, '.');
                                ?>
                                @if($count_doots=="1")
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    {{ number_format(( $item->debe-$item->haber ),2) }}
                            </td>
                                @endif 
                                @if($count_doots=="2")   
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    {{ number_format(( $item->debe-$item->haber ),2) }}
                                </td>
                                <td></td>
                                @endif 
                                @if($count_doots=="3")   
                                <td></td>
                                <td></td>
                                <td></td>
                                <td> 
                                    {{ number_format(( $item->debe-$item->haber ),2) }}
                              </td>
                                <td></td>
                                <td></td>
                                @endif
                                @if($count_doots=="4")   
                                <td></td>
                                <td></td>
                                <td>
                                    {{ number_format(( $item->debe-$item->haber ),2) }}
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @endif 
                                @if($count_doots=="5") 
                                <td></td>
                                <td>
                                    {{ number_format(( $item->debe-$item->haber ),2) }}
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @endif                                 
                                @if($count_doots=="6") 
                                <td>
                                    {{ number_format(( $item->debe-$item->haber ),2) }}
                                </td>
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
