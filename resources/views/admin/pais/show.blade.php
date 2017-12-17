@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Pai {{ $pai->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/pais') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/pais/' . $pai->id . '/edit') }}" title="Edit Pai"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/pais' . '/' . $pai->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Pai" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $pai->id }}</td>
                                    </tr>
                                    <tr><th> Pais </th><td> {{ $pai->pais }} </td></tr><tr><th> Cod Postal </th><td> {{ $pai->cod_postal }} </td></tr><tr><th> Latitud </th><td> {{ $pai->latitud }} </td></tr><tr><th> Longitud </th><td> {{ $pai->longitud }} </td></tr><tr><th> Status </th><td> {{ $pai->status }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
