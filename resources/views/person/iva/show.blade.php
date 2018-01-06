@extends('person.page')
@section('content')
@include('errors.messages')
<div class="row">
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">Iva {{ $iva->id }}</div>
            <div class="panel-body">
                <a href="{{ url('/person/iva') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                <a href="{{ url('/person/iva/' . $iva->id . '/edit') }}" title="Editar Iva"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                <form method="POST" action="{{ url('person/iva' . '/' . $iva->id) }}" accept-charset="UTF-8" style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger btn-xs" title="Delete Iva" onclick="return confirm(&quot;Desea eliminar?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                </form>
                <br/>
                <br/>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th>ID</th><td>{{ $iva->id }}</td>
                            </tr>
                            <tr>
                                <th> Iva </th><td> {{ $iva->iva }} </td>
                            </tr>
                            <tr>
                                <th> Activo </th><td> @if(($iva->activo)=='1')
                                            <small class="label pull-left bg-green">Activado</small>
                                        @else
                                            <small class="label pull-left bg-red">Desactivado</small>
                                        @endif </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
