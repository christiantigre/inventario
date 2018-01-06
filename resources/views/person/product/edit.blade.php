@extends('person.page')

@section('content')
@include('errors.messages')
<div class="row">
    <section class="content-header">
      <h1>
        Registro de productos
        <small>Ingreso</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Productos</a></li>
        <li class="active">Editar</li>
    </ol>
</section>
<section class="content">

    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
        <div class="panel panel-default">
            <!-- SELECT2 EXAMPLE -->
            <div class="box box-default">
                <div class="panel-heading">Editar Product #{{ $product->id }}</div>
                <div class="panel-body">
                    <a href="{{ url('/person/product') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {!! Form::model($product, [
                        'method' => 'PATCH',
                        'url' => ['/person/product', $product->id],
                        'class' => 'form-horizontal', 
                        'enctype'=>'multipart/form-data',
                        'files' => true,
                        'accept-charset'=>'UTF-8'
                        ]) !!}

                        @include ('person.product.form', ['submitButtonText' => 'Actualizar'])

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

</div>
@endsection
