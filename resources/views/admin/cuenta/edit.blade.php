@extends('adminlte::page')
@section('content')
@include('errors.messages')
        <div class="row">
@include('admin.contabilidad.infosection')
<section class="content">
            @include('admin.tipocuenta.sidebar')
            <div class="col-md-10 col-lg-10 col-xs-12 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Cuenta #{{ $cuentum->cuenta }}({{ $cuentum->codigo }})</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/cuenta') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                       <!-- <form method="POST" action="{{ url('/admin/cuenta/' . $cuentum->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">-->

                            {!! Form::model($cuentum, [
                            'method' => 'PATCH',
                            'url' => ['/admin/cuenta', $cuentum->id],
                            'class' => 'form-horizontal', 
                            'enctype'=>'multipart/form-data',
                            'files' => true,
                            'accept-charset'=>'UTF-8'
                            ]) !!}

                            {{ csrf_field() }}

                            @include ('admin.cuenta.form', ['submitButtonText' => 'Actualizar'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
