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
        <div class="panel-heading">Crear Varias Ctas Sub-Auxiliares</div>
        <div class="panel-body">
          <a href="{{ url('/admin/subauxiliar') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
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
              @include ('admin.tempsubauxcta.form')
            </form>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->

        <section class="content">
          <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"> 
              CUENTAS SUB-AUXILIARES
              <fieldset>
                <legend>
                </legend>

                <button class="btn btn-default btn-sm" title="Eliminar Todas Subcuentas" id="trashitems" type="button" onClick="trashSubAuxCuentasAdmin(this.id);"><i class="fa fa-trash" aria-hidden="true"></i> Vaciar</button>

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
    list_Subauxcuentas_Admin();
  });

  function list_Subauxcuentas_Admin(){
  console.log('loading items cuentas sub auxiliar');
  $.ajax({
    type:'get',
    //url:'/admin/listsubauxcuentas/',
    url:'{{ url("admin/listsubauxcuentas") }}',
    success: function(data){
      $('#list-cart').empty().html(data);
    }
  });
}

function cuentaSubAuxCuentasAdmin(){
  var token = $("input[name=_token]").val();
  var auxiliar_id= $("#auxiliar_id").val();
  //var route = '/admin/extraercontadorsubauxcuentas/';
  var route = '{{ url("admin/extraercontadorsubauxcuentas") }}';
  var parametros = {
    "id" :auxiliar_id
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
      document.getElementById("auxiliar").value = data.cuenta_codigo;
      console.log("copy data succefull");
    },
    error:function(data)
    {
      console.log('Error '+data);
    }  
  });
}




$('.guarda_subauxiliar_admin').click(function(){
  var auxiliar_id= $("#auxiliar_id").val();
  var auxiliar= $("#auxiliar").val();
  var secuencia= $("#secuencia").val();
  var subauxiliar= $("#subauxiliar").val();
  var codigo= $("#codigo").val();
  var token = $("input[name=_token]").val();
  //var route = '/admin/savesubauxcuenta/';
  var route = '{{ url("admin/savesubauxcuenta") }}';

  var parametros = {
    "auxiliar_id" :auxiliar_id,
    "auxiliar" :auxiliar,
    "secuencia" :secuencia,
    "subauxiliar" :subauxiliar,
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
      list_Subauxcuentas_Admin();
      reset_input_subauxcuentas();
    },
    error:function(data)
    {
      console.log('Error '+data);
    }  
  });
});

function trashSubAuxCuentasAdmin(id){
  console.log(id);
  var token = $("input[name=_token]").val();
  //var route = '/admin/trashSubAuxcuentas/'; 
  var route = '{{ url("admin/trashSubAuxcuentas") }}'; 
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
      list_Subauxcuentas_Admin(); 
    },
    error:function(data)
    {
      console.log('Error '+data);
    }  
  });
}


</script>
@endsection
