@extends('adminlte::page')
@section('content')
@include('errors.messages')
@include('admin.contabilidad.menucontable')
        <div class="row">
@include('admin.contabilidad.infosection')
<section class="content">
            @include('admin.tipocuenta.sidebar')
            <div class="col-md-10 col-lg-10 col-xs-12 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear Nueva Subauxiliar</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/subauxiliar') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/subauxiliar') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.subauxiliar.form')

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
