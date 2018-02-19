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
        <div class="panel-heading">Editar Balance Inicial</div>
        <div class="panel-body">
          <a href="{{ url('/admin/balanceinicial') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
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
            'url' => ['/admin/contabilidad', $asiento->id],
            'class' => 'form-horizontal', 
            'enctype'=>'multipart/form-data',
            'files' => true,
            'accept-charset'=>'UTF-8'
            ]) !!}

            @include ('admin.contabilidad.balanceinicial.formedit')

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
                    <div id="list-cart">




                    </div> 

                    

                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"> 

                        <button class="btn btn-success btn-md" title="Actualizar balance inicial registrado" id="guardarBalanceInicialEdit" type="button" onClick="guardaBalanceInicialEdit();"><i class="fa fa-save" aria-hidden="true"></i> ACTUALIZAR BALANCE INICIAL</button>  

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
    list_trs_admin_edit();
  });

  function list_trs_admin_edit(){
    console.log('loading items transacciónes admin.');
    $.ajax({
      type:'get',
      //url:'/admin/listtrs/',
      url:'{{ url("admin/listtrsEdit") }}',
      success: function(data){
        console.log(data);
        $('#list-cart').empty().html(data);
        SumarColumnas();
      }
    });
  }  

  function SumarColumnas() { 
    console.log('Sumando columnas debe y haber.');
    $.ajax({
      type:'get',
      url:'{{ url("admin/DetsumBIni") }}',
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

      var route = '{{ url("admin/saveBInicialEdit") }}';

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
          list_trs_admin_edit();

          toastr.success("Transacciòn exitosa");
      /*$('#alert').show();
      $('#alert').html(data.message);*/
    },
    error:function(data)
    {
      console.log('Error '+data);
      /*$('#alert').show();
      $('#alert').html(data.message);*/      
      toastr.error("!!! Error al realizar transacción...");
    }  
  });

    }else{
      alert("El asiento que desea guardar no se encuentra cuadrado");
    }

  }

</script>
<script type="text/javascript">

  function consulta_cuenta_admin(){
    var token = $("input[name=_token]").val();
    var cod_cuenta= $("#cod_cuenta").val();
  //var route = '/admin/vercuentas/';
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
}


$('.busca_cuenta').click(function(){
  console.log("busqueda por boton");
  var token = $("input[name=_token]").val();
  var cod_cuenta= $("#cod_cuenta").val();
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

$('#guarda_trs_admin_edit').click(function(){
  var num_asiento = $("#num_asiento").val();
  var cod_cuenta = $("#cod_cuenta").val();
  var cuenta = $("#cuenta").val();
  var periodo = $("#periodo").val();
  var fecha = $("#fecha").val();
  var concepto_detalle = $("#concepto_detalle").val();
  var almacen_id = $("#almacen_id").val();
  var asiento_id = $("#id").val();

  var valorconvertir =$("#valor").val();

  if(valorconvertir=="") {
    toastr.warning("!!! Ingresar un valor 0.00.");
    return true;
  }

  var valor =number_format(valorconvertir,2);
  var tipo = $("#tipo").val();

  if(cod_cuenta=="") {
    toastr.warning("!!! Ingrese un código de cuenta.");
    return true;
  }

  if(cuenta=="") {
    toastr.warning("!!! Buscar cuenta.");
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
      list_trs_admin_edit();
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
  if (confirm("Desea eliminar el detalle del balance inicial?")) {
    console.log(id);
    var token = $("input[name=_token]").val();
  //var route = '/admin/trashSubAuxcuentas/'; 
  var route = '{{ url("admin/trashBalanceInicialDetall") }}'; 
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
      console.log(data);
      console.log('correcto '+data.data);
      toastr.success("Transacciòn exitosa");
      list_trs_admin_edit();
    },
    error:function(data)
    {
      toastr.error("!!! Error al realizar transacción");
      console.log('Error '+data);
    }  
  });
}
}


function eliminarTrs(id){
  if (confirm("Desea eliminar esta transacción?")) {
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
        toastr.success(data.mensaje);
        list_trs_admin_edit();
        console.log('correcto '+data.data);
      },
      error:function(data)
      {
        toastr.error(data.mensaje);
        console.log('Error '+data);
      }  
    });
  } 
}


$('.busca_cuenta_modal').click(function(){
  console.log("busqueda por boton desde modal");
  var token = $("input[name=_token]").val();
  var cod_cuenta_modal= $("#cod_cuenta_modal").val();
  //var route = '/admin/vercuentas/';
  var route = '{{ url("admin/vercuentas") }}';
  document.getElementById("cod_cuenta_modal").value = "";
  var parametros = {
    "id" :cod_cuenta_modal
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
      document.getElementById("cuenta_modal").value = data.cuenta;
      document.getElementById("cod_cuenta_modal").value = data.cod;
      console.log("copy data succefull");
    },
    error:function(data)
    {
      console.log('Error '+data);
    }  
  });
});

function ver_trs(id){  
  console.log("buscar datos para modal por "+id);
  var token = $("input[name=_token]").val();
  var route = '{{ url("admin/vertrs") }}';
  var parametros = {
    "id" :id
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
      document.getElementById("view_id_modal").value = data.id;
      document.getElementById("view_cuenta_modal").value = data.cuenta;
      document.getElementById("view_almacen_id_modal").value = data.almacen_id;
      document.getElementById("view_periodo_modal").value = data.periodo;
      document.getElementById("view_responsable_modal").value = data.responsable;
      document.getElementById("view_fecha_modal").value = data.fecha;
      document.getElementById("view_num_asiento_modal").value = data.num_asiento;
      document.getElementById("view_cod_cuenta_modal").value = data.cod_cuenta;
      document.getElementById("view_saldo_debe_modal").value = data.saldo_debe;
      document.getElementById("view_saldo_haber_modal").value = data.saldo_haber;
      document.getElementById("view_concepto_detalle_modal").value = data.concepto_detalle;
      console.log("copy data succefull");
    },
    error:function(data)
    {
      console.log('Error '+data);
    }  
  });
}

function ver_trs_edit(id){  
  console.log("buscar datos para modal por "+id);
  var token = $("input[name=_token]").val();
  var route = '{{ url("admin/vertrs") }}';
  var parametros = {
    "id" :id
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
      document.getElementById("id_modal").value = data.id;
      document.getElementById("cuenta_modal").value = data.cuenta;
      document.getElementById("almacen_id_modal").value = data.almacen_id;
      document.getElementById("periodo_modal").value = data.periodo;
      document.getElementById("responsable_modal").value = data.responsable;
      document.getElementById("fecha_modal").value = data.fecha;
      document.getElementById("num_asiento_modal").value = data.num_asiento;
      document.getElementById("cod_cuenta_modal").value = data.cod_cuenta;
      document.getElementById("saldo_debe_modal").value = data.saldo_debe;
      document.getElementById("saldo_haber_modal").value = data.saldo_haber;
      document.getElementById("concepto_detalle_modal").value = data.concepto_detalle;
      console.log("copy data succefull");
    },
    error:function(data)
    {
      console.log('Error '+data);
    }  
  });
}


$('.submit-edit-trs').click(function(){
  console.log("Actualizar datos desde modal");
  var token = $("input[name=_token]").val();
  var cod_cuenta_modal= $("#cod_cuenta_modal").val();
  var periodo_modal= $("#periodo_modal").val();
  var responsable_modal= $("#responsable_modal").val();
  var fecha_modal= $("#fecha_modal").val();
  var num_asiento_modal= $("#num_asiento_modal").val();
  var cuenta_modal= $("#cuenta_modal").val();
  var saldo_debe_modal= $("#saldo_debe_modal").val();
  var saldo_haber_modal= $("#saldo_haber_modal").val();
  var concepto_detalle_modal= $("#concepto_detalle_modal").val();
  var id_modal= $("#id_modal").val();
  //var route = '/admin/vercuentas/';
  var route = '{{ url("admin/saveAsientoEdit") }}';
  
  var parametros = {
    "num_asiento" :num_asiento_modal,
    "cod_cuenta" :cod_cuenta_modal,
    "cuenta" :cuenta_modal,
    "periodo" :periodo_modal,
    "fecha" :fecha_modal,
    "concepto_detalle" :concepto_detalle_modal,
    "saldo_debe" :saldo_debe_modal,
    "saldo_haber" :saldo_haber_modal,
    "id" :id_modal,
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
      list_trs_admin_edit();
      reset_input_trs_admin();
      toastr.success("Transacciòn exitosa");
    },
    error:function(data)
    {
      console.log('Error '+data);
      toastr.error("!!! Error al realizar transacción...");
    }  
  });
});

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
