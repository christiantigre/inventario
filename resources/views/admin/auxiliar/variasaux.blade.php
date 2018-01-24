@extends('adminlte::page')
@section('content')
@include('errors.messages')
<div class="row">
  @include('admin.contabilidad.infosection')
  <section class="content">
    @include('admin.tipocuenta.sidebar')
    <div class="col-md-10 col-lg-10 col-xs-12 col-sm-8">
      <div class="panel panel-default">
        <div class="panel-heading">Crear Subcuenta</div>
        <div class="panel-body">
          <a href="{{ url('/admin/subcuenta') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
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

        <div class="box-body">
          <div class="row">
            <form method="POST" action="{{ url('/admin/venta') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
              {{ csrf_field() }}
              @include ('admin.tempsubcta.form')
            </form>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->

        <section class="content">
          <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"> 
              SUB-CUENTAS
              <fieldset>
                <legend>
                </legend>

                <button class="btn btn-default btn-sm" title="Eliminar Todas Subcuentas" id="trashitems" type="button" onClick="trashSubCuentas(this.id);"><i class="fa fa-trash" aria-hidden="true"></i> Vaciar</button>

                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <div id="list-cart">
                  </div>             
                </div>
                <!-- /.box-body -->
                <!-- /.box -->
              </fieldset>
            </div>
            <!-- /.col -->
          </div>
        </section>
      </div>
    </div>



  </div>




</section>

<script type="text/javascript">
  $(document).ready(function(){
    //list_subcuentas();
  });
</script>
@endsection
