@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Provincium {{ $provincium->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/provincia') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/provincia/' . $provincium->id . '/edit') }}" title="Edit Provincium"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/provincia' . '/' . $provincium->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Provincium" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $provincium->id }}</td>
                                    </tr>
                                    <tr><th> Provincia </th><td> {{ $provincium->provincia }} </td></tr><tr><th> Cod Postal </th><td> {{ $provincium->cod_postal }} </td></tr><tr><th> Latitud </th><td> {{ $provincium->latitud }} </td></tr><tr><th> Longitud </th><td> {{ $provincium->longitud }} </td></tr><tr><th> Pais Id </th><td> {{ $provincium->pais_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
