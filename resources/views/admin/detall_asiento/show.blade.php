@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">detall_asiento {{ $detall_asiento->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/detall_asiento') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/detall_asiento/' . $detall_asiento->id . '/edit') }}" title="Edit detall_asiento"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/detall_asiento' . '/' . $detall_asiento->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete detall_asiento" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $detall_asiento->id }}</td>
                                    </tr>
                                    <tr><th> Num Asiento </th><td> {{ $detall_asiento->num_asiento }} </td></tr><tr><th> Cod Cuenta </th><td> {{ $detall_asiento->cod_cuenta }} </td></tr><tr><th> Cuenta </th><td> {{ $detall_asiento->cuenta }} </td></tr><tr><th> Periodo </th><td> {{ $detall_asiento->periodo }} </td></tr><tr><th> Fecha </th><td> {{ $detall_asiento->fecha }} </td></tr><tr><th> Saldo Debe </th><td> {{ $detall_asiento->saldo_debe }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
