@extends('adminlte::page')
@section('content')
@include('errors.messages')
<div class="row">
    <section class="content-header">
      <h1>
        <small>Ventas</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Ventas</a></li>
        <li class="active">Registrar</li>
    </ol>
</section>
<section class="content">
 <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
        <div class="panel-heading">
            <a href="{{ url('/admin/venta') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
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
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <form method="POST" action="{{ url('/admin/venta') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include ('admin.venta.form')
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      No dudes en contactarte con el desarrollador de la aplicación, envíanos un mensaje con tu sugerencia o reparte de acciones defectuosas del sistema.
  </div>
</div>
<!-- /.box -->
</section>
</div>

@include('admin.venta.modalselec_cli')
@include('admin.venta.modalcrear_cli')
@include('admin.venta.modalselect_prod')

<script type="text/javascript">
    $(document).ready(function(){
        items_cart();
    });
</script>

@endsection
