@extends('person.page')

@section('content')
@include('errors.messages')
        <div class="row">

            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Proveedor #{{ $proveedor->proveedor }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/person/proveedor') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif


                             {!! Form::model($proveedor, [
                            'method' => 'PATCH',
                            'url' => ['/admin/proveedor', $proveedor->id],
                            'class' => 'form-horizontal', 
                            'enctype'=>'multipart/form-data',
                            'files' => true,
                            'accept-charset'=>'UTF-8'
                        ]) !!}


                            {{ csrf_field() }}

                            @include ('person.proveedor.form', ['submitButtonText' => 'Actualizar'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection
