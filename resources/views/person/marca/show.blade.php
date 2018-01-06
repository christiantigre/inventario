@extends('person.page')

@section('content')
@include('errors.messages')
        <div class="row">

            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Marca {{ $marca->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/person/marca') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <a href="{{ url('/person/marca/' . $marca->id . '/edit') }}" title="Editar Marca"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ url('person/marca' . '/' . $marca->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Marca" onclick="return confirm(&quot;Confirmar eliminar?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $marca->id }}</td>
                                    </tr>
                                    <tr><th> Marca </th><td> {{ $marca->marca }} </td></tr><tr><th> Detall </th><td> {{ $marca->detall }} </td></tr><tr><th> Img </th><td> 
                                        @if(empty($marca->img))
                                    <center>-</center>
                                    @else
                                    <a href="{{ asset($marca->img) }}" target="_blanck">
                                        <img src="{{ asset($marca->img) }}" style="max-width: 25%;" class="img-responsive brand-centered">
                                    </a>
                                    @endif
                                     </td></tr><tr><th> Name Img </th><td> {{ $marca->name_img }} </td></tr><tr><th> Activo </th><td> 
                                        @if(($marca->activo)=='1')
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
@endsection
