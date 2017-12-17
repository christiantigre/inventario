@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Parroquium {{ $parroquium->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/parroquia') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/parroquia/' . $parroquium->id . '/edit') }}" title="Edit Parroquium"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/parroquia' . '/' . $parroquium->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Parroquium" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $parroquium->id }}</td>
                                    </tr>
                                    <tr><th> Parrroquia </th><td> {{ $parroquium->parrroquia }} </td></tr><tr><th> Cod Postal </th><td> {{ $parroquium->cod_postal }} </td></tr><tr><th> Latitud </th><td> {{ $parroquium->latitud }} </td></tr><tr><th> Longitud </th><td> {{ $parroquium->longitud }} </td></tr><tr><th> Parroquia Id </th><td> {{ $parroquium->parroquia_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
