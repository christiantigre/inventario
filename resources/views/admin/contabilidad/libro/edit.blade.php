@extends('adminlte::page')
@section('content')
@include('errors.messages')
@include('admin.contabilidad.menucontable')
<div class="row">
  @include('admin.contabilidad.infosection')
  <section class="content">
    @include('admin.contabilidad.sidebar')
    <div class="col-md-10 col-lg-10 col-xs-12 col-sm-8">
      <div class="panel panel-default">
        <div class="panel-heading">Editar Asiento # {{ $num_asiento }}</div>
        <div class="panel-body">
          <a href="{{ url('/admin/libro') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
          <br />
          <br />


          @if ($errors->any())
          <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
          @endif


          {!! Form::model($asiento, [
            'method' => 'PATCH',
            'url' => ['/admin/libro', $asiento->id],
            'class' => 'form-horizontal', 
            'enctype'=>'multipart/form-data',
            'files' => true,
            'accept-charset'=>'UTF-8'
            ]) !!}

            @include ('admin.contabilidad.libro.formedit')

          </form>



          <section class="content">
            <div class="row">
              <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"> 
                DETALLE
                <fieldset>
                  <legend>
                  </legend>

                  <button class="btn btn-default btn-sm" title="Vaciar Previo Balance Inicial" id="trashitems" type="button" onClick="trashBalanceInicial({{ $asiento->id }});"><i class="fa fa-trash" aria-hidden="true"></i> Vaciar</button>

                  <!-- /.box-header -->
                  <div class="box-body no-padding">
                    <div class="table-responsive">
                      <div id="list-cart">




                      </div> 
                    </div> 

                    

                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"> 

                        <button class="btn btn-success btn-md" title="Actualizar balance inicial registrado" id="guardarBalanceInicialEdit" type="button" onClick="guardaBalanceInicialEdit();"><i class="fa fa-save" aria-hidden="true"></i> ACTUALIZAR ASIENTO</button>  

                        <div class="box-body">
                          <div class="" id="alertaBalance">
                            <h4>Asiento No se encuentra con igualdad de cuadre!</h4>

                            <p>Para que puedan guardar el asiento registrado actualmente, debe ajustar los valores del bede y haber para que sean cuadrados.</p>
                          </div>
                        </div> 


                      </div>          
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
  </div>
</section>


<!-- Edit Item Modal -->

@include('admin.contabilidad.balanceinicial.modalEditTransac')
@include('admin.contabilidad.balanceinicial.modalVerTransac')


<script type="text/javascript">


  $(document).ready(function(){
    list_trs_admin_edit_asiento();
  });

  function list_trs_admin_edit_asiento(){
    var num_asiento= $("#num_asiento").val();
    console.log(num_asiento);
    console.log('loading items transacciónes admin.');
    var parametros = {
      "num_asiento" :num_asiento,
    }
    $.ajax({
      type:'get',
      //url:'/admin/listtrs/',
      url:'{{ url("admin/Edit_detall") }}',
      data:parametros,
      success: function(data){
        console.log(data);
        $('#list-cart').empty().html(data);
        SumarColumnas(num_asiento);
      }
    });
  }  

  function SumarColumnas(num_asiento) { 
    console.log('Sumando columnas debe y haber.');
    var parametros = {
      "num_asiento" :num_asiento,
    }
    $.ajax({
      type:'get',
      url:'{{ url("admin/DetsumAs") }}',
      data:parametros,
      success: function(data){
        console.log(data[0]['saldo_debe']);
        console.log(data[0]['saldo_haber']);
        debe_float = data[0]['saldo_debe'];
        haber_float = data[0]['saldo_haber'];
        debe = number_format(debe_float,2);
        haber = number_format(haber_float,2);
        document.getElementById("debe").value = debe;
        document.getElementById("haber").value = haber;

        if(debe == haber){
          console.log("cuadrado");
          $('#guardarBalanceInicialEdit').attr("disabled", false);
          $('#alertaBalance').attr("class", "callout callout-danger hidden");
        }else{
          console.log("descuadrado");
          toastr.warning("!!! Alerta, Asiento descuadrado");
          $('#guardarBalanceInicialEdit').attr("disabled", true);
          $('#alertaBalance').attr("class", "callout callout-danger");
        }
      //$('#list-cart').empty().html(data);
    }
  });
  }

  
  function guardaBalanceInicialEdit(){
    console.log('Actualizando Balance Inicial.');

    if (confirm("Desea aplicar todos los cambios ?...")) {
      var debe= $("#debe").val();
      var haber= $("#haber").val();
      var num_asiento= $("#num_asiento").val();
      var concepto= $("#concepto").val();
      var periodo= $("#periodo").val();
      var fecha= $("#fecha").val();
      var saldo_debe= $("#debe").val();
      var saldo_haber= $("#haber").val();
      var responsable= $("#responsable").val();
      var almacen_id= $("#almacen_id").val();
      var id= $("#id").val();

      if(debe==haber){
        var token = $("input[name=_token]").val();

        var route = '{{ url("admin/saveUpAsiento") }}';

        var parametros = {
          "num_asiento" :num_asiento,
          "concepto" :concepto,
          "periodo" :periodo,
          "fecha" :fecha,
          "saldo_debe" :debe,
          "saldo_haber" :haber,
          "responsable" :responsable,
          "almacen_id" :almacen_id,
          "id" :id,
        }

        $.ajax({
          url:route,
          headers:{'X-CSRF-TOKEN':token},
          type:'get',
          dataType: 'json',
          data:parametros,
          success:function(data)
          {
            console.log(data);
            console.log("Update succefull");
            toastr.success("Transacciòn exitosa");
            window.location.href = "{{URL::to('admin/libro')}}"
            list_trs_admin_edit_asiento();
          },
          error:function(data)
          {
            console.log('Error '+data);
            toastr.error("!!! Error al realizar transacción...");
          }  
        });

      }else{
        alert("El asiento que desea guardar no se encuentra cuadrado");
      }
    }
  }
  
  function consulta_cuenta_admin(){
    var token = $("input[name=_token]").val();
    var cod_cuenta= $("#cod_cuenta").val();
    var route = '{{ url("admin/vercuentas") }}';
    traer_grupo(cod_cuenta);
    document.getElementById("cod_cuenta").value = "";
    var parametros = {
      "id" :cod_cuenta
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
        document.getElementById("cuenta").value = data.cuenta;
        document.getElementById("cod_cuenta").value = data.cod;
        console.log("copy data succefull");
      },
      error:function(data)
      {
        console.log('Error '+data);
      }  
    });
  }

  function traer_grupo(cod){
    console.log("Consulta grupo");
    var token = $("input[name=_token]").val();
    var cod_cuenta= cod;
    var route = '{{ url("admin/extraergrupo") }}';
    var parametros = {
      "id" :cod_cuenta
    }
    $.ajax({
      url:route,
      headers:{'X-CSRF-TOKEN':token},
      type:'get',
      dataType: 'json',
      data:parametros,
      success:function(data)
      {
        console.log(data);
        document.getElementById("codaux_clase").value = data.cod_clase;
        document.getElementById("codaux_grupo").value = data.cod_grupo;
        document.getElementById("codaux_cuenta").value = data.cod_cuenta;
        document.getElementById("codaux_subcuenta").value = data.cod_subcuenta;
        document.getElementById("codaux_auxiliar").value = data.cod_auxiliar;
        document.getElementById("codaux_subauxiliar").value = data.cod_subauxiliar;
        console.log("copy data succefull");
      },
      error:function(data)
      {
        console.log('Error '+data);
      }  
    });
  }

  $('.busca_cuenta').click(function(){
    console.log("busqueda por boton");
    var token = $("input[name=_token]").val();
    var cod_cuenta= $("#cod_cuenta").val();
    traer_grupo(cod_cuenta);
    var route = '{{ url("admin/vercuentas") }}';
    document.getElementById("cod_cuenta").value = "";
    var parametros = {
      "id" :cod_cuenta
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
        document.getElementById("cuenta").value = data.cuenta;
        document.getElementById("cod_cuenta").value = data.cod;
        console.log("copy data succefull");
      },
      error:function(data)
      {
        console.log('Error '+data);
      }  
    });
  });

  $('#guarda_trs_admin').click(function(){
    var num_asiento = $("#num_asiento").val();
    var cod_cuenta = $("#cod_cuenta").val();
    var cuenta = $("#cuenta").val();
    var periodo = $("#periodo").val();
    var fecha = $("#fecha").val();
    var concepto_detalle = $("#concepto_detalle").val();
    var almacen_id = $("#almacen_id").val();
    var asiento_id = $("#id").val();
    var codaux_clase = $("#codaux_clase").val();
    var codaux_grupo = $("#codaux_grupo").val();
    var codaux_cuenta = $("#codaux_cuenta").val();
    var codaux_subcuenta = $("#codaux_subcuenta").val();
    var codaux_auxiliar = $("#codaux_auxiliar").val();
    var codaux_subauxiliar = $("#codaux_subauxiliar").val();

    var valorconvertir =$("#valor").val();

    if(valorconvertir=="") {
      toastr.warning("!!! Ingresar un valor 0.00.");
      $("#valor").focus();
      return true;
    }

    var valor =number_format(valorconvertir,2);
    var tipo = $("#tipo").val();

    if(cod_cuenta=="") {
      toastr.warning("!!! Ingrese un código de cuenta.");
      $("#cod_cuenta" ).focus();
      return true;
    }

    if(cuenta=="") {
      toastr.warning("!!! Buscar cuenta.");
      $("#cuenta" ).focus();
      return true;
    }

    if(valor=="") {
      toastr.warning("!!! Ingresar un valor 0.00.");
      return true;
    }

    if(tipo=="1"){
      saldo_debe = valor;
      saldo_haber = "0.00";
    }
    if(tipo=="2"){
      saldo_debe = "0.00";
      saldo_haber = valor;
    }

    var token = $("input[name=_token]").val();

  //var route = '/admin/saveAsiento/';
  var route = '{{ url("admin/saveAsientoAdd") }}';
  
  var parametros = {
    "num_asiento" :num_asiento,
    "cod_cuenta" :cod_cuenta,
    "cuenta" :cuenta,
    "periodo" :periodo,
    "fecha" :fecha,
    "concepto_detalle" :concepto_detalle,
    "saldo_debe" :saldo_debe,
    "saldo_haber" :saldo_haber,
    "almacen_id" :almacen_id,
    "asiento_id" :asiento_id,
    "codaux_clase" : codaux_clase,
    "codaux_grupo" : codaux_grupo,
    "codaux_cuenta" : codaux_cuenta,
    "codaux_subcuenta" : codaux_subcuenta,
    "codaux_auxiliar" : codaux_auxiliar,
    "codaux_subauxiliar" : codaux_subauxiliar,
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
      toastr.success("Transacciòn exitosa");
      list_trs_admin_edit_asiento();
      reset_input_trs_admin();
    },
    error:function(data)
    {
      toastr.error("!!! Error al realizar transacción");
      console.log('Error '+data);
    }  
  });
});

  function trashBalanceInicial(id){
    console.log(id);
    if (confirm("Esta seguro que desea eliminar el detalle registrado ?...")) {
      var token = $("input[name=_token]").val();
    //var route = '/admin/trashSubAuxcuentas/'; 
    var route = '{{ url("admin/trashBalanceInicial") }}'; 
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
        toastr.success("Transaccion exitosa.");
        console.log('correcto '+data.data);
        list_trs_admin_edit_asiento();
      },
      error:function(data)
      {
        toastr.error("!!! Error al realizar esta acción.");
        console.log('Error '+data);
      }  
    });
  }
}

function eliminar_trs_blini(id){
  var confirma = confirm("Esta seguro que desea eliminar esta transacción?...");

  if(confirma){

    console.log(id);

    var token = $("input[name=_token]").val();
    var route = '{{ url("admin/delete_trs_blinidetall") }}'; 
    var parametros = {
      "id" :id
    }
    $.ajax({
      url:route,
      headers:{'X-CSRF-TOKEN':token},
      type:'post',
      dataType: 'json',
      data:parametros,
      success:function(data)
      {
        list_trs_admin_edit_asiento();
        toastr.success("Transaccion exitosa.");
        console.log('correcto '+data.data);
      },
      error:function(data)
      {
        toastr.error("!!! Error al realizar esta transacción.");
        console.log('Error '+data);
      }  
    });
  }
}

function reset_input_trs_admin(){
  console.log('reseting');
  document.getElementById("cod_cuenta").value = "";
  document.getElementById("cuenta").value = "";
  document.getElementById("concepto_detalle").value = "";
  document.getElementById("valor").value = "";
}


function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
      return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
    regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
      amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
  }


</script>
@endsection
