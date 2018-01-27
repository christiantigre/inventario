@extends('adminlte::page')
@section('content')
@include('errors.messages')
@include('admin.contabilidad.menucontable')
@include('admin.contabilidad.infosection')
<style type="text/css">
.clase{ font-weight: 600; }
.grupo{ font-weight: 500; }
.cuenta{ font-weight: 400; }
.subcuenta{ font-weight: 300; }
.auxiliar{ font-weight: 200; }
.subauxiliar{ font-weight: 100; }
.td_clase{ margin-left: 0px; }
.td_grupo{ margin-left: 20px; }
.td_cuenta{ margin-left: 40px; }
.td_subcuenta{ margin-left: 60px; }
.td_auxiliar{ margin-left: 80px; }
.td_subauxiliar{ margin-left: 100px; }
</style>
<section class="content">
    <div class="row">
        @include('admin.tipocuenta.sidebar')
        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">PLAN CONTABLE</div>
                <div class="panel-body">

                    <a href="{{ URL::to('/admin/plan/downloadExcel/xls') }}">
                        <button class="btn btn-success btn-xs">Descargar Excel</button>
                    </a>

                    <form method="GET" action="{{ url('/admin/plan') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
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
                                    <th>#</th>
                                    <th>CÓDIGO</th>
                                    <th>CUENTA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cuentas as $item)
                                <?php 
                                $cadena = $item->cod.".";  
                                $puntos = substr_count($cadena,'.');  
                                ?>
                                @if($puntos=='1')
                                <tr>
                                    <td><label class="clase">{{ $loop->iteration }}</label></td>
                                    <td><label class="clase">{{ $item->cod }}.</label></td>
                                    <td><label class="clase td_clase">{{ $item->cuenta }}</label></td>
                                </tr>
                                @endif
                                @if($puntos=='2')
                                <tr>
                                    <td><label class="grupo">{{ $loop->iteration }}</label></td>
                                    <td><label class="grupo">{{ $item->cod }}.</label></td>
                                    <td><label class="grupo td_grupo">{{ $item->cuenta }}</label></td>
                                </tr>
                                @endif
                                @if($puntos=='3')
                                <tr>
                                    <td><label class="cuenta">{{ $loop->iteration }}</label></td>
                                    <td><label class="cuenta">{{ $item->cod }}.</label></td>
                                    <td><label class="cuenta td_cuenta">{{ $item->cuenta }}</label></td>
                                </tr>
                                @endif
                                @if($puntos=='4')
                                <tr>
                                    <td><label class="subcuenta">{{ $loop->iteration }}</label></td>
                                    <td><label class="subcuenta">{{ $item->cod }}.</label></td>
                                    <td><label class="subcuenta td_subcuenta">{{ $item->cuenta }}</label></td>
                                </tr>
                                @endif
                                @if($puntos=='5')
                                <tr>
                                    <td><label class="auxiliar">{{ $loop->iteration }}</label></td>
                                    <td><label class="auxiliar">{{ $item->cod }}.</label></td>
                                    <td><label class="auxiliar td_auxiliar">{{ $item->cuenta }}</label></td>
                                </tr>
                                @endif
                                @if($puntos=='6')
                                <tr>
                                    <td><label class="subauxiliar">{{ $loop->iteration }}</label></td>
                                    <td><label class="subauxiliar">{{ $item->cod }}.</label></td>
                                    <td><label class="subauxiliar td_subauxiliar">{{ $item->cuenta }}</label></td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
