@extends('adminlte::page')
@section('content')
@include('errors.messages')
@include('admin.contabilidad.infosection')
    <div class="container">
        <div class="row">
            
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Moneda #{{ $moneda->id }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/moneda') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                            {!! Form::model($moneda, [
                            'method' => 'PATCH',
                            'url' => ['/admin/moneda', $moneda->id],
                            'class' => 'form-horizontal', 
                            'enctype'=>'multipart/form-data',
                            'files' => true,
                            'accept-charset'=>'UTF-8'
                            ]) !!}

                                                        {{ csrf_field() }}

                            @include ('admin.moneda.form', ['submitButtonText' => 'Actualizar'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
