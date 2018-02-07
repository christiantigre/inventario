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
                <div class="panel-heading">BALANCE INICIAL</div>
                <div class="panel-body">

                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"> 
                    @if(empty($asiento))
                        <a href="{{ url('/admin/balanceinicial/createBalanceInicial') }}" class="btn btn-success btn-xs" title="Registrar Cuenta">
                            <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                        </a>
                        @else

                        <a href="{{ url('/admin/balanceinicial/editBalanceInicial/' . $asiento->id . '/edit') }}" title="Editar Balance Inicial"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                        @endif
                    </div>
                </div>

                <br/>
                <br/>
                @if(!empty($asiento))
                <div class="row">

        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-6">
                    <label class="control-label">Balance Inicial</label>                
                </div>
                <div class="col-md-6">
                    <label class="control-label">Asiento # : </label>
                    <label class="control-label">{{ $asiento->num_asiento }}</label>                
                </div>
                <div class="col-md-6">
                    <label class="control-label">Fecha : </label>
                    <label class="control-label">{{ $asiento->fecha }}</label>                
                </div>
                <div class="col-md-6">
                    <label class="control-label">Período : </label>
                    <label class="control-label">{{ $asiento->periodo }}</label>                
                </div>
                <div class="col-md-6">
                    <label class="control-label">Responsable : </label>
                    <label class="control-label">{{ $asiento->responsable }}</label>                
                </div>
                <div class="col-md-6">
                    <label class="control-label">Concepto : </label>
                    <label class="control-label">{{ $asiento->concepto }}</label>                
                </div>
            </div>
        </div>
    </div>
@endif
                <div class="table-responsive">
                    @if(!empty($detalles))
                        <table class="table table-borderless" id="tempBInicial">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>CÓD</th>
                                <th>CUENTA</th>
                                <th>DEBE</th>
                                <th>HABER</th>
                                <th>ACCIÓNES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detalles as $item)
                            <tr class="suma">
                                <td>{{ $loop->iteration or $item->id }}</td>
                                <td>{{ $item->cod_cuenta }}</td>                                        
                                <td>{{ $item->cuenta }}</td>                                        
                                <td>{{ number_format($item->saldo_debe,2) }}</td>
                                <td>{{ number_format($item->saldo_haber,2) }}</td>
                                <td>
                                    <button type="button" id="delete_trasacc_blini" class="btn btn-danger btn-xs" title="Eliminar transacción" onclick="eliminar_trs_blini({{ $item->id }});"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td>TOTAL</td>
                                <td>{{ number_format($asiento->saldo_debe,2) }}</td>
                                <td>{{ number_format($asiento->saldo_haber,2) }}</td>
                            </tr>
                            
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
