@extends('person.page')

@section('content')
@include('errors.messages')
        <div class="row">

            <div class="col-md-11">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Iva #{{ $iva->iva }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/person/iva') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/person/iva/' . $iva->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('person.iva.form', ['submitButtonText' => 'Actualizar'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection
