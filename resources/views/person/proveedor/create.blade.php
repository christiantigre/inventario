@extends('person.page')

@section('content')
@include('errors.messages')
<div class="row">
    <section class="content-header">
      <h1>
        Registro de proveedores
        <small>Ingreso</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Proveedor</a></li>
        <li class="active">Registrar</li>
    </ol>
</section>
<section class="content">
   <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
        <div class="panel-heading">
            <a href="{{ url('/person/proveedor') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
            <br />
            <br />
            @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

        </div>
        <div class="box-header with-border">
            <h3 class="box-title">Información del Producto</h3>



            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <!--<form method="POST" action="{{ url('/person/proveedor') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">-->
                {!! Form::open(['url' => '/person/proveedor','method'=>'POST', 'class' => 'form-horizontal', 'files' => true,'enctype'=>'multipart/form-data']) !!}

                @include ('person.proveedor.form')
            <!--</form>-->
             {!! Form::close() !!}
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      No dudes en contactarte con el desarrollador de la aplicación, envianos un mensaje con tu sugerencia o reparte de acciónes defectuosas del sistema.
  </div>
</div>
<!-- /.box -->
</section>
</div>
<script type="text/javascript">
    $("#id_provincia").change(function(event){
    var url = '{{ url("getcanton") }}';
    $.get(url+"/"+event.target.value+"",function(response, state){
        $("#id_canton").empty();
        for(i=0; i<response.length; i++){
            $("#id_canton").append("<option value='"+response[i].id+"'> "+response[i].canton+"</option>");
        }
    });
});
</script>
@endsection
