@extends('adminlte::page')

@section('content')
@include('errors.messages')
        <div class="row">
            <div class="ol-md-12 col-lg-12 col-xs-12 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Categoría {{ $category->category }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/category') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <a href="{{ url('/admin/category/' . $category->id . '/edit') }}" title="Editar Categoría"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ url('admin/category' . '/' . $category->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Categoría" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $category->id }}</td>
                                    </tr>
                                    <tr><th> Categoría </th><td> {{ $category->category }} </td></tr><tr><th> Detalle </th><td> {{ $category->detall }} </td></tr><tr><th> Estado </th><td> @if(($category->activo)=='1')
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
