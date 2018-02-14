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
        <div class="panel-heading">Visualizar Asiento # {{ $num_asiento }}</div>
        <div class="panel-body">

          <a href="{{ url('/admin/libro') }}" title="Atras">
            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button>
          </a>

          <a href="{{ url('/admin/libro/editarAsiento/' . $asiento->id) }}" class="edit-item" title="Editar Asiento # {{ $asiento->id }}">
            <button class="btn btn-primary btn-xs"  id="editar_asiento" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button>
          </a>

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

            
<div class="col-md-12">

    Asiento Contable
    <div class="row">

        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-6">
                    <label class="control-label">{{ $nombre_almacen }}</label>                
                </div>
                <div class="col-md-6">
                    <label class="control-label">Asiento # : </label>
                    <label class="control-label">{{ $num_asiento }}</label>                
                </div>
                <div class="col-md-6">
                    <label class="control-label">Fecha : </label>
                    <label class="control-label">{{ $fecha }}</label>                
                </div>
                <div class="col-md-6">
                    <label class="control-label">Período : </label>
                    <label class="control-label">{{ $year }}</label>                
                </div>
                <div class="col-md-6">
                    <label class="control-label">Responsable : </label>
                    <label class="control-label">{{ $responsable }}</label>                
                </div>
            </div>
        </div>
    </div>

    <fieldset>

        <legend>
        </legend>

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('cod_cuenta') ? 'has-error' : ''}}">
                <div class="col-md-8">

                    {!! Form::hidden('almacen_id', $almacen_id, ['id'=>'almacen_id','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('auxiliar') !!}


                    {!! Form::hidden('periodo', $year, ['class' => 'form-control input-sm','id'=>'periodo','readonly'=>'readonly','autofocus'=>'autofocus']), old('periodo') !!}

                     {!! Form::hidden('responsable', $responsable, ['class' => 'form-control input-sm','id'=>'responsable','readonly'=>'readonly','autofocus'=>'autofocus']), old('responsable') !!}

                    {!! Form::hidden('fecha', $fecha, ['class' => 'form-control input-sm','id'=>'fecha','readonly'=>'readonly','autofocus'=>'autofocus']), old('periodo') !!}

                    {!! Form::hidden('num_asiento', $num_asiento, ['id'=>'num_asiento','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('num_asiento') !!} 

                    {!! Form::hidden('id', null, ['id'=>'id','class' => 'form-control','autofocus'=>'autofocus','required'=>'required','readonly'=>'readonly']), old('asiento_id') !!}  

                    {!! $errors->first('cod_cuenta', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>


        

        

        

    </fieldset>
</div>




          </form>



          <section class="content">
            <div class="row">
              <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"> 
                DETALLE
                <fieldset>
                  <legend>
                  </legend>

                  <!-- /.box-header -->
                  <div class="box-body no-padding">
                    <div class="table-responsive">
                      <div id="list-cart">




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
    list_trs_admin_ver_asiento();
  });

  function list_trs_admin_ver_asiento(){
    var num_asiento= $("#num_asiento").val();
    console.log(num_asiento);
    console.log('loading items transacciónes admin.');
    var parametros = {
        "num_asiento" :num_asiento,
      }
    $.ajax({
      type:'get',
      //url:'/admin/listtrs/',
      url:'{{ url("admin/ver_detall") }}',
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
          list_trs_admin_edit_asiento();

          toastr.success("Transacciòn exitosa");
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
