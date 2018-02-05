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
        <div class="panel-heading">Crear Varias Ctas Auxiliares</div>
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
              @include ('admin.tempauxcta.form')
            </form>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->

        <section class="content">
          <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"> 
              CUENTAS AUXILIARES
              <fieldset>
                <legend>
                </legend>

                <button class="btn btn-default btn-sm" title="Eliminar Todas Subcuentas" id="trashitems" type="button" onClick="trashAuxCuentasAdmin(this.id);"><i class="fa fa-trash" aria-hidden="true"></i> Vaciar</button>

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
    list_auxcuentas_admin();
  });

  function list_auxcuentas_admin(){
  console.log('loading items cuentas auxiliar');
  $.ajax({
    type:'get',
    //url:'/admin/listauxcuentas/',
    url:'{{ url("admin/listauxcuentas") }}',
    success: function(data){
      $('#list-cart').empty().html(data);
    }
  });
}

function cuentaSubCuentasVariasAdmin(){
  var token = $("input[name=_token]").val();
  var subcuenta_id= $("#subcuenta_id").val();
  //var route = '/admin/extraercontadorsubcuentasvarias/';
  var route = '{{ url("admin/extraercontadorsubcuentasvarias") }}';
  var parametros = {
    "id" :subcuenta_id
  }
  console.log(parametros);
  $.ajax({
    url:route,
    headers:{'X-CSRF-TOKEN':token},
    type:'get',
    dataType: 'json',
    data:parametros,
    success:function(data)
    {
      console.log(data);
      document.getElementById("secuencia").value = data.cantidad;
      document.getElementById("codigo").value = data.cuenta_codigo+'.'+data.cantidad;
      document.getElementById("subcuenta").value = data.cuenta_codigo;
      console.log("copy data succefull");
    },
    error:function(data)
    {
      console.log('Error '+data);
    }  
  });
}


$('.guarda_auxiliar_admin').click(function(){
  var subcuenta_id= $("#subcuenta_id").val();
  var subcuenta= $("#subcuenta").val();
  var secuencia= $("#secuencia").val();
  var auxiliar= $("#auxiliar").val();
  var codigo= $("#codigo").val();
  var token = $("input[name=_token]").val();
  //var route = '/admin/saveauxcuenta/';
  var route = '{{ url("admin/saveauxcuenta") }}';

  var parametros = {
    "subcuenta_id" :subcuenta_id,
    "subcuenta" :subcuenta,
    "auxiliar" :auxiliar,
    "secuencia" :secuencia,
    "codigo" :codigo
  }
  console.log(parametros);
  $.ajax({
    url:route,
    headers:{'X-CSRF-TOKEN':token},
    type:'post',
    dataType: 'json',
    data:parametros,
    success:function(data)
    {
      console.log(data);
      console.log("copy data succefull");
      list_auxcuentas_admin();
      reset_input_auxcuentas();
    },
    error:function(data)
    {
      console.log('Error '+data);
    }  
  });
});


function trashAuxCuentasAdmin(id){
  console.log(id);
  var token = $("input[name=_token]").val();
  //var route = '/admin/trashAuxcuentas/';  
  var route = '{{ url("admin/trashAuxcuentas") }}';  
  var parametros = {
    "id" :'0'
  }
  $.ajax({
    url:route,
    headers:{'X-CSRF-TOKEN':token},
    type:'post',
    dataType: 'json',
    data:parametros,
    success:function(data)
    {
      console.log('correcto '+data.data);
      list_auxcuentas_admin();  
    },
    error:function(data)
    {
      console.log('Error '+data);
    }  
  });
}
</script>
@endsection
