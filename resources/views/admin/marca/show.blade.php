@extends('adminlte::page')

@section('content')
@include('errors.messages')
        <div class="row">

            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Marca {{ $marca->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/marca') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/marca/' . $marca->id . '/edit') }}" title="Edit Marca"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/marca' . '/' . $marca->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Marca" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $marca->id }}</td>
                                    </tr>
                                    <tr><th> Marca </th><td> {{ $marca->marca }} </td></tr><tr><th> Detall </th><td> {{ $marca->detall }} </td></tr><tr><th> Img </th><td> {{ $marca->img }} </td></tr><tr><th> Name Img </th><td> {{ $marca->name_img }} </td></tr><tr><th> Activo </th><td> {{ $marca->activo }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
