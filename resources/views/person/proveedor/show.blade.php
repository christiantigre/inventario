@extends('person.page')

@section('content')
@include('errors.messages')
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Proveedor {{ $proveedor->id }}</div>
            <div class="panel-body">
                <a href="{{ url('/person/proveedor') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                <a href="{{ url('/person/proveedor/' . $proveedor->id . '/edit') }}" title="Editar Proveedor"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                <form method="POST" action="{{ url('person/proveedor' . '/' . $proveedor->id) }}" accept-charset="UTF-8" style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Proveedor" onclick="return confirm(&quot;Desea eliminar?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                </form>
                <br/>
                <br/>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th>ID</th><td>{{ $proveedor->id }}</td>
                            </tr>
                            <tr>
                                <th> Proveedor </th><td> {{ $proveedor->proveedor }} </td>
                            </tr>
                            <tr>
                                <th> Dir </th><td> {{ $proveedor->dir }} </td>
                            </tr>
                            <tr>
                                <th> Tlfn </th><td> {{ $proveedor->tlfn }} </td>
                            </tr>
                            <tr>
                                <th> Cel Movi </th><td> {{ $proveedor->cel_movi }} </td>
                            </tr>
                            <tr>
                                <th> Cel Claro </th><td> {{ $proveedor->cel_claro }} </td>
                            </tr>
                            <tr>
                                <th> Watsapp </th><td> {{ $proveedor->watsapp }} </td>
                            </tr>
                            <tr>
                                <th> Correo </th><td> <a href="mailto:{{ $proveedor->mail }}">{{ $proveedor->mail }} </a></td>
                            </tr>
                            <tr>
                                <th> Página web </th><td> <a href="{{ $proveedor->web }}">{{ $proveedor->web }} </a></td>
                            </tr>                            
                            <tr>
                                <th> Ruc </th><td> {{ $proveedor->ruc }} </td>
                            </tr>
                            <tr>
                                <th> Representante </th><td> {{ $proveedor->representante }} </td>
                            </tr>                            
                            <tr>
                                <th> Actividad </th><td> {{ $proveedor->actividad }} </td>
                            </tr>
                            <tr>
                                <th> Estado </th>
                                <td> 
                                    @if(($proveedor->status)=='1')
                                    <small class="label label-success">Activo</small>
                                    @else
                                    <small class="label label-danger">Inactivo</small>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th> Empresa </th><td> {{ $proveedor->empresa }} </td>
                            </tr>
                            <tr>
                                <th> Ubicación </th><td> {{ $proveedor->ubicacion }} </td>
                            </tr>                            
                            <tr>
                                <th> Logo </th><td> {{ $proveedor->logo }} </td>
                            </tr>
                            <tr>
                                <th> Localizado </th><td> 
                                    @if(empty($proveedor->id_pais))
                                        <strong>Pais no seleccionado</strong>
                                        <a href="{{ url('/person/proveedor/' . $proveedor->id . '/edit') }}" title="Editar Proveedor"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                                    @else
                                    {{ $proveedor->Pais->pais }} 
                                    @endif
                                     /
                                     @if(empty($proveedor->id_provincia))
                                        <strong>Provincia no seleccionado</strong>
                                        <a href="{{ url('/person/proveedor/' . $proveedor->id . '/edit') }}" title="Editar Proveedor"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                                    @else
                                    {{ $proveedor->Provincia->provincia }} 
                                    @endif
                                     / 
                                     @if(empty($proveedor->id_canton))
                                        <strong>Cantón no seleccionado</strong>
                                        <a href="{{ url('/person/proveedor/' . $proveedor->id . '/edit') }}" title="Editar Proveedor"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                                    @else
                                    {{ $proveedor->Canton->canton }} 
                                    @endif
                                 </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
