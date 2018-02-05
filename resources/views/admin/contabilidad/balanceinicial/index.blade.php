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

                        <a href="{{ url('/admin/balanceinicial/createBalanceInicial') }}" class="btn btn-success btn-xs" title="Registrar Cuenta">
                            <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                        </a>

                        <form method="GET" action="{{ url('/admin/cuenta') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
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
                    @if(!empty($detalles))
                        <table class="table table-borderless" id="tempBInicial">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ASIENTO</th>
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
                                <td>{{ $item->num_asiento }}</td>
                                <td>{{ $item->cod_cuenta }}</td>                                        
                                <td>{{ $item->cuenta }}</td>                                        
                                <td>{{ $item->saldo_debe }}</td>
                                <td>{{ $item->saldo_haber }}</td>
                                <td>
                                    <button type="button" id="delete_trasacc_blini" class="btn btn-danger btn-xs" title="Eliminar transacción" onclick="eliminar_trs_blini({{ $item->id }});"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
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
