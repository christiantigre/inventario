@extends('person.page')
@section('content')
@include('errors.messages')
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Ingresos Inventario</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">


                        <h3>Inventario ingreso periodo {{ $year }}
                            @if(!empty($mensaje))
                            {{ ($mes) }}
                            @endif
                            @if(!empty($mensajerangos))
                            {{ ($mensajerangos) }}
                            @endif
                        </h3>
                        <a href="{{ url('/person/inventario/ingresos','1') }}" class="btn btn-success btn-sm" title="Add New Almacen">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i> INGRESOS INVENTARIO
                        </a>
                        <a href="{{ url('/person/inventario/egresos','2') }}" class="btn btn-success btn-sm" title="Add New Almacen">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> EGRESOS INVENTARIO
                        </a>
                         <a href="{{ url('/person/inventario') }}" class="btn btn-success btn-sm" title="Add New Almacen">
                            <i class="fa fa-arrows-h" aria-hidden="true"></i> INGRESOS / EGRESOS
                        </a>

                        

                    </div>
                </div>

                <br/>
                <!--Sección para botones de exportar y descarga-->
                 <div class="row">
                    <div class="col-lg-12 col-md-12">
                         <a href="{{ URL::to('/person/inventario/downloadExcelingresos/xls',['year'=>$year,'month'=>$mensaje,'randostart'=>$rangostart,'rangofinish'=>$rangofinish]) }}">
                            <button class="btn btn-success btn-sm">Descargar Excel xls</button>
                        </a>
                        <a href="{{ URL::to('/person/inventario/downloadExcelingresos/xlsx',['year'=>$year,'month'=>$mensaje,'randostart'=>$rangostart,'rangofinish'=>$rangofinish]) }}">
                            <button class="btn btn-success btn-sm">Descargar Excel xlsx</button>
                        </a>
                        <a href="{{ URL::to('/person/inventario/downloadExcelingresos/csv',['year'=>$year,'month'=>$mensaje,'randostart'=>$rangostart,'rangofinish'=>$rangofinish]) }}">
                            <button class="btn btn-success btn-sm">Descargar CSV</button>
                        </a>
                    </div>
                </div>
                <!--Seccion de botones para filtrar inventario-->
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <form method="POST" action="{{ URL::to('/person/inventario/bymonthingre') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">  
                                <div class="panel-heading">                          
                            Busqueda por periodos mensuales
                        </div>
                        </div>
                            <div class="form-group {{ $errors->has('mes') ? 'has-error' : ''}}">
                                {{ csrf_field() }}
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
                    <div class="col-lg-4 col-md-4">
                        <form method="POST" action="{{ URL::to('/person/inventario/byrangoingre') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                         {{ csrf_field() }}
                                <div class="form-group">    
                                <div class="panel-heading">                     
                         Busque entre rango de fechas
                     </div>
                     </div>
                         <div class="form-group {{ $errors->has('fecha_inicio') ? 'has-error' : ''}}">
                            <label for="fecha_inicio" class="col-md-4 col-lg-2 control-label ">{{ 'Fecha inicio' }}</label>
                            <div class="col-md-6 col-lg-8">
                                {!! Form::text('fecha_inicio', null, ['class' => 'form-control datepicker input-sm', 'id'=>'fecha_inicio']) !!}
                                {!! $errors->first('fecha_inicio', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('fecha_fin') ? 'has-error' : ''}}">
                            <label for="fecha_fin" class="col-md-4 col-lg-2 control-label">{{ 'Fecha fin' }}</label>
                            <div class="col-md-6 col-lg-8">
                                {!! Form::text('fecha_fin', null, ['class' => 'form-control datepicker input-sm', 'id'=>'fecha_fin']) !!}
                                {!! $errors->first('fecha_fin', '<p class="help-block">:message</p>') !!}
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

            <br/>
            <br/>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><center>CÓDIGO</center></th>
                            <th><center>PRODUCTO</center></th>
                            <th><center>FECHA</center></th>
                            <th><center>INGRESO</center></th>
                            <th><center>STOCK</center></th>
                            <th><center>PVP Compra</center></th>
                            <th><center>PVP Compra x Cant</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $item)
                        <tr>
                            <td>{{ $loop->iteration or $item->id }}</td>
                            <td>{{ $item->cod_barra }}</td>
                            <td>{{ $item->producto }}</td>
                            <td><center>{{ $item->fecha_ingreso }}</center></td>
                            <td><center>{{ $item->compras }}</center></td>
                            <td><center>{{ $item->cantidad }}</center></td>
                            <td><center>{{ $item->pre_compra }}</center></td>
                            <td><center>{{ $item->pre_compra * $item->compras }}</center></td>
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
<script>
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        language: "es",
        autoclose: true
    });
</script>
@endsection
