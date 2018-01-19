@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">subauxiliar {{ $subauxiliar->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/subauxiliar') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/subauxiliar/' . $subauxiliar->id . '/edit') }}" title="Edit subauxiliar"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/subauxiliar' . '/' . $subauxiliar->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete subauxiliar" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $subauxiliar->id }}</td>
                                    </tr>
                                    <tr><th> Subauxiliar </th><td> {{ $subauxiliar->subauxiliar }} </td></tr><tr><th> Codigo </th><td> {{ $subauxiliar->codigo }} </td></tr><tr><th> Detall </th><td> {{ $subauxiliar->detall }} </td></tr><tr><th> Activo </th><td> {{ $subauxiliar->activo }} </td></tr><tr><th> Auxiliar Id </th><td> {{ $subauxiliar->auxiliar_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
