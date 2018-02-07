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
        <div class="panel-heading">Crear Balance Inicial</div>
        <div class="panel-body">
          <a href="{{ url('/admin/balanceinicial') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
          <br />
          <br />


          <div class="alert alert-info text-center animated fadeIn" id="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>
            
        </strong>
    </div>

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

                        <button class="btn btn-success btn-md" title="Guardar balance inicial registrado" id="guardarBalanceInicial" type="button" onClick="guardaBalanceInicial();"><i class="fa fa-save" aria-hidden="true"></i> GUARDAR BALANCE INICIAL</button>  

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

<script type="text/javascript">


$(document).ready(function(){
    $('#alert').hide();     
  });


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
        debe = data[0]['saldo_debe'];
        haber = data[0]['saldo_haber'];
        document.getElementById("debe").value = debe;
        document.getElementById("haber").value = haber;

        if(debe == haber){
          console.log("cuadrado");
          $('#guardarBalanceInicial').attr("disabled", false);
          $('#alertaBalance').attr("class", "callout callout-danger hidden");
        }else{
          console.log("descuadrado");
          $('#guardarBalanceInicial').attr("disabled", true);
          $('#alertaBalance').attr("class", "callout callout-danger");
        }
      //$('#list-cart').empty().html(data);
    }
  });
  }

  
  function guardaBalanceInicial(){
    console.log('Guardando Balance Inicial.');
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

    if(debe==haber){
      var token = $("input[name=_token]").val();

  //var route = '/admin/saveAsiento/';
  var route = '{{ url("admin/saveBInicial") }}';
  
  var parametros = {
    "num_asiento" :num_asiento,
    "concepto" :concepto,
    "periodo" :periodo,
    "fecha" :fecha,
    "saldo_debe" :debe,
    "saldo_haber" :haber,
    "responsable" :responsable,
    "almacen_id" :almacen_id,
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
      console.log("copy data succefull");
      list_trs_admin();
      $('#alert').show();
      $('#alert').html(data.message);
    },
    error:function(data)
    {
      console.log('Error '+data);
      $('#alert').show();
      $('#alert').html(data.message);
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

  var tipo = $("#tipo").val();

  if(tipo=="1"){
    saldo_debe = $("#valor").val();
    saldo_haber = "0.00";
  }
  if(tipo=="2"){
    saldo_debe = "0.00";
    saldo_haber = $("#valor").val();
  }

  var token = $("input[name=_token]").val();

  //var route = '/admin/saveAsiento/';
  var route = '{{ url("admin/saveAsiento") }}';
  
  var parametros = {
    "num_asiento" :num_asiento,
    "cod_cuenta" :cod_cuenta,
    "cuenta" :cuenta,
    "periodo" :periodo,
    "fecha" :fecha,
    "concepto_detalle" :concepto_detalle,
    "saldo_debe" :saldo_debe,
    "saldo_haber" :saldo_haber,
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
      list_trs_admin();
      reset_input_trs();
    },
    error:function(data)
    {
      console.log('Error '+data);
    }  
  });
});

function trashBalanceInicial(id){
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
      list_trs_admin_edit();
    },
    error:function(data)
    {
      console.log('Error '+data);
    }  
  });
}

function eliminar_trs_blini(id){
  var confirma = confirm("Esta seguro que desea eliminar esta transacción?...");

  if(confirma){

    console.log(id);

    var token = $("input[name=_token]").val();
    var route = '{{ url("admin/delete_trs_blini") }}'; 
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
        list_trs_admin();
        console.log('correcto '+data.data);
      },
      error:function(data)
      {
        console.log('Error '+data);
      }  
    });
  }
}

function eliminarTrs(id){
    if (confirm("Desea eliminar esta transacción")) {
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
        list_trs_admin_edit();
        console.log('correcto '+data.data);
      },
      error:function(data)
      {
        console.log('Error '+data);
      }  
    });
    } 
}

$('.deleteTransaccion').on('click', function(e) {
    console.log("alerta eliminar");
    var inputData = $('#formDeleteTransac').serialize();

    var dataId = $('#btnDeleteTransaccion').attr('data-id');

    $.ajax({
        url: '{{ url('/admin/products') }}' + '/' + dataId,
        type: 'POST',
        data: inputData,
        success: function( msg ) {
            if ( msg.status === 'success' ) {
                toastr.success( msg.msg );
                setInterval(function() {
                    window.location.reload();
                }, 5900);
            }
        },
        error: function( data ) {
            if ( data.status === 422 ) {
                toastr.error('Cannot delete the category');
            }
        }
    });

    return false;
});


</script>
@endsection
