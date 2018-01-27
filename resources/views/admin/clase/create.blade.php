@extends('adminlte::page')
@section('content')
@include('errors.messages')

@include('admin.contabilidad.menucontable')
@include('admin.contabilidad.infosection')
<section class="content">
        <div class="row">
            @include('admin.tipocuenta.sidebar')
            <div class="col-md-10 col-lg-10 col-xs-10 col-sm-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Registrar Nueva Clase</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/clase') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/clase') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.clase.form')

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
