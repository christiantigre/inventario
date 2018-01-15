@extends('adminlte::page')
@section('content')
@include('errors.messages')
<style type="text/css">
.colred{background-color: #ffa7a7; }
.colblue{background-color: #88b5ff;}
.colgreen{background-color: #b3ffa8;}
label.tab{color: #000000;}
.label-danger{color: red;background-color: #88b5ff;}
</style>
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Inventario</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <h3>Inventario Ingresos/Egresos {{ $year }}
                            @if(!empty($mensaje))
                            {{ ($mes) }}
                            @endif
                            @if(!empty($mensajerangos))
                            {{ ($mensajerangos) }}
                            @endif
                        </h3>

                        <input type="hidden" class="form-control" name="prm_year" value="{{ $year }}">
                        <input type="hidden" class="form-control" name="prm_month" value="{{ $mensaje }}">
                        
                        <a href="{{ url('/admin/inventario/ingresos','1') }}" class="btn btn-success btn-sm" title="Add New Almacen">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i> INGRESOS INVENTARIO
                        </a>
                        <a href="{{ url('/admin/inventario/egresos','2') }}" class="btn btn-success btn-sm" title="Add New Almacen">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> EGRESOS INVENTARIO
                        </a>
                        <a href="{{ url('/admin/inventario') }}" class="btn btn-success btn-sm" title="Add New Almacen">
                            <i class="fa fa-arrows-h" aria-hidden="true"></i> INGRESOS / EGRESOS
                        </a>

                        <form method="GET" action="{{ url('/admin/inventario') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
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
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <a href="{{ URL::to('/admin/inventario/downloadExcel/xls',['year'=>$year,'month'=>$mensaje]) }}">
                            <button class="btn btn-success btn-sm">Descargar Excel xls</button>
                        </a>
                        <a href="{{ URL::to('/admin/inventario/downloadExcel/xlsx',['year'=>$year,'month'=>$mensaje]) }}">
                            <button class="btn btn-success btn-sm">Descargar Excel xlsx</button>
                        </a>
                        <a href="{{ URL::to('/admin/inventario/downloadExcel/csv',['year'=>$year,'month'=>$mensaje]) }}">
                            <button class="btn btn-success btn-sm">Descargar CSV</button>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="col-lg-4 col-md-4">
                            <form method="POST" action="{{ URL::to('/admin/inventario/bymonthinv') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="panel-heading">
                                        Busqueda por periodos mensuales
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('mes') ? 'has-error' : ''}}">
                                    <label for="mes" class="col-md-4 control-label">{{ 'Mes' }}</label>
                                    <div class="col-md-6">
                                        <select class="form-control input-sm" name="month" id="month">
                                            <option value="1">Enero</option>
                                            <option value="2">Febrero</option>
                                            <option value="3">Marzo</option>
                                            <option value="4">Abril</option>
                                            <option value="5">Mayo</option>
                                            <option value="6">Junio</option>
                                            <option value="7">Julio</option>
                                            <option value="8">Agosto</option>
                                            <option value="9">Septiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                        </select>
                                        {!! $errors->first('mes', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-2">
                                        <input class="btn btn-primary btn-sm" type="submit" value="{{ $submitButtonText or 'BUSCAR' }}">
                                    </div>
                                </div>
                            </form>                                
                        </div>
                    </div>
                </div>

                <br/>
                <br/>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><center>CÓDIGO</center></th>
                                <th><center>PRODUCTO</center></th>
                                <th><center>FECHA INGRESO</center></th>
                                <th><center>INGRESO</center></th>
                                <th><center>STOCK</center></th>
                                <th class="colred"><center><label class="tab">PVP Compra </label></center></th>
                                <th class="colred"><center><label class="tab">PVP Compra x Ingr </label></center></th>
                                <th class="colgreen"><center><label class="tab">PVP Venta </label></center></th>
                                <th class="colgreen"><center><label class="tab">PVP Venta x Cant </label></center></th>
                                <th><center>GANANCIA FUTURA</center></th>
                                <th><center>ORD. VENTAS</center></th>
                                <th><center>VENDIDOS</center></th>
                                <th class="colblue"><center>TOT VENDIDO</center></th>
                                <th class="colblue"><center>MOV GANANCIA $</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $item)
                            <tr>
                                <td>{{ $loop->iteration or $item->id }}</td>
                                <td>{{ $item->cod_barra }}</td>
                                <td>{{ $item->producto }}</td>
                                <td>{{ $item->fecha_ingreso }}</td>
                                <td><center>{{ $item->compras }}</center></td>
                                <td><center>{{ $item->cantidad }}</center></td>
                                <td class="colred"><center><label class="tab">$ {{ $item->pre_compra }}</label></center></td>
                                <td class="colred"><center><label class="tab">$ {{ $item->pre_compra * $item->compras }}</label></center></td>
                                <td class="colgreen"><center><label class="tab">$ {{ $item->pre_venta }}</label></center></td>
                                <td class="colgreen"><center><label class="tab">$ {{ $item->pre_venta * $item->compras }}</label></center></td>
                                <td><center>$ {{ ($item->pre_venta * $item->compras) - ($item->pre_compra * $item->compras) }}</center></td>
                                <td><center>{{ $item->cantidadventas }}</center></td>
                                <td><center>{{ $item->totalventa }}</center></td>
                                <td class="colblue"><center>{{ ($item->pre_venta * $item->totalventa) }}</center></td>
                                <td class="colblue"><center> $ 
                                    @if((($item->pre_venta * $item->totalventa)-($item->pre_compra * $item->compras))<'0')
                                    <label class="label-danger">
                                        {{
                                            ($item->pre_venta * $item->totalventa)-
                                            ($item->pre_compra * $item->compras) 
                                        }}
                                    </label>
                                    @else
                                    <label>
                                        {{
                                            ($item->pre_venta * $item->totalventa)-
                                            ($item->pre_compra * $item->compras) 
                                        }}
                                    </label>
                                    @endif
                                </center></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="pagination-wrapper"> {!! $product->appends(['search' => Request::get('search')])->render() !!} </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
