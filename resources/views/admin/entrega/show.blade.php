@extends('adminlte::page')
@section('content')
@include('errors.messages')
@include('admin.contabilidad.infosection')
        <div class="row">
            <section class="content">

            <div class="col-md-10 col-lg-10 col-xs-12 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Entrega {{ $entrega->metodo }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/entrega') }}" title="Atras"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <a href="{{ url('/admin/entrega/' . $entrega->id . '/edit') }}" title="Editar Entrega"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ url('admin/entrega' . '/' . $entrega->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar Entrega" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $entrega->id }}</td>
                                    </tr>
                                    <tr><th> Metodo </th><td> {{ $entrega->metodo }} </td></tr><tr><th> Detalle </th><td> {{ $entrega->detalle }} </td></tr><tr><th> Activo </th><td> 
                                    @if(($entrega->activo)=='1')
                                        <small class="label label-success">Activo</small>
                                        @else
                                        <small class="label label-danger">Inactivo</small>
                                        @endif 
                                         </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
