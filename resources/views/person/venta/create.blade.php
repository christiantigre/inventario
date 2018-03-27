@extends('person.page')
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
            <a href="{{ url('/person/venta') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
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
            <form method="POST" action="{{ url('/person/venta') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include ('person.venta.form')
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
@include('person.venta.modalselec_cli')
@include('person.venta.modalcrear_cli')
@include('person.venta.modalselect_prod')
@include('person.venta.modal_test')
{{--
    --}}

<script type="text/javascript">
    $(document).ready(function(){
        items_cart_person();
    });

    //llena de datos tabla productos en la modal listcartitems
function items_cart_person(){
    console.log('loading items cart');
    var route = "{{ url('person/listcartitems') }}";
    $.ajax({
        type:'get',
        //url:'/person/listcartitems/',
        url:route,
        success: function(data){
            $('#list-cart').empty().html(data);
        }
    });
}

</script>
<script type="text/javascript">
    $(".cliente-final-person").click(function(event){
            event.preventDefault();
            reset_input();
            var dataId= "1";
            var token = $("input[name=_token]").val();
            //var route = '/person/getClienteId/';
            var route = '{{ url("person/getClienteId") }}';
            var parametros = {
                "id" :dataId
            }
            $.ajax({
                url:route,
                headers:{'X-CSRF-TOKEN':token},
                type:'post',
                dataType: 'json',
                data:parametros,
                success:function(data)
                {
                    console.log('loading ... cliente final');
                    document.getElementById("cliente").value = data.nom_cli;
                    document.getElementById("ruc_cli").value = data.ruc_cli;
                    document.getElementById("ced_cli").value = data.ced_cli;
                    document.getElementById("cel_cli").value = data.tlf_cli;
                    document.getElementById("dir_cli").value = data.dir_cli;
                    document.getElementById("mail_cli").value = data.mail_cli;
                    document.getElementById("id_cliente").value = data.id;
                },
                error:function(data)
                {
                    console.log('Error '+data);
                }  
            });
        });


    function delete_item_person(id){
    var token = $("input[name=_token]").val();
    //var route = '/admin/deleteItem/';   
    var route = '{{ url("person/deleteItem") }}';   
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
            console.log('correcto '+data.data);
            items_cart_person();   
        },
        error:function(data)
        {
            console.log('Error '+data);
        }  
    });
}

function trashPerson(id){
    console.log(id);
    var token = $("input[name=_token]").val();
    //var route = '/admin/trashItem/';    
    var route = '{{ url("person/trashItem") }}';    
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
            items_cart_person();   
        },
        error:function(data)
        {
            console.log('Error '+data);
        }  
    });
}

//Selecciona cliente en el modal y envia datos a los campos midleware:person
$('.select_cli_person').click(function(){
            reset_input();
    var dataId = this.id;
    var token = $("input[name=_token]").val();
    //var route = '/person/extraerdatoscli/';
    var route = '{{ url("person/extraerdatoscli") }}';
    var parametros = {
        "id" :dataId
    }
    $.ajax({
        url:route,
        headers:{'X-CSRF-TOKEN':token},
        type:'get',
        dataType: 'json',
        data:parametros,
        success:function(data)
        {
            //data.cel_movi
            console.log(data.id);
            console.log("copy data selected");
            document.getElementById("cliente").value = data.nom_cli+' '+data.app_cli;
            document.getElementById("ruc_cli").value = data.ruc_cli;
            document.getElementById("ced_cli").value = data.ced_cli;
            document.getElementById("cel_cli").value = data.tlf_cli+' '+data.wts_cli;
            document.getElementById("dir_cli").value = data.dir_cli;
            document.getElementById("mail_cli").value = data.mail_cli;
            document.getElementById("id_cliente").value = data.id;
            console.log("copy data succefull");
        },
        error:function(data)
        {
            console.log('Error '+data);
        }  
    });
});

$(".save_cli_person").click(function(event){
    console.log("operacion guardar cliente");
            event.preventDefault();
            reset_input();
            var nom_cli= $("#nom_cli_modal").val();
            var app_cli= $("#app_cli_modal").val();
            var ced_cli= $("#ced_cli_modal").val();
            var ruc_cli= $("#ruc_cli_modal").val();
            var dir_cli= $("#dir_cli_modal").val();
            var mail_cli= $("#mail_cli_modal").val();
            var tlf_cli= $("#tlf_cli_modal").val();
            var token = $("input[name=_token]").val();
            //var route = '/person/savecli/';
            var route = '{{ url("person/savecli") }}';
            var parametros = {
                "nom_cli" :nom_cli,
                "app_cli" :app_cli,
                "ced_cli" :ced_cli,
                "ruc_cli" :ruc_cli,
                "dir_cli" :dir_cli,
                "mail_cli" :mail_cli,
                "tlf_cli" :tlf_cli
            }
            $.ajax({
                url:route,
                headers:{'X-CSRF-TOKEN':token},
                type:'post',
                dataType: 'json',
                data:parametros,
                success:function(data)
                {
                    console.log('loading ... cliente final');
                    document.getElementById("cliente").value = data.nom_cli;
                    document.getElementById("ruc_cli").value = data.ruc_cli;
                    document.getElementById("ced_cli").value = data.ced_cli;
                    document.getElementById("cel_cli").value = data.tlf_cli;
                    document.getElementById("dir_cli").value = data.dir_cli;
                    document.getElementById("mail_cli").value = data.mail_cli;
                    document.getElementById("id_cliente").value = data.id;
                    reset_input_modal();
                },
                error:function(data)
                {
                    console.log('Error '+data);
                }  
            });
        });

function reset_input_modal(){
            console.log('reseting');
            document.getElementById("nom_cli_modal").value = "";
            document.getElementById("app_cli_modal").value = "";
            document.getElementById("ruc_cli_modal").value = "";
            document.getElementById("ced_cli_modal").value = "";
            document.getElementById("dir_cli_modal").value = "";
            document.getElementById("mail_cli_modal").value = "";
            document.getElementById("tlf_cli_modal").value = "";
        }
</script>


<script type="text/javascript">
  $(document).ready(function(){
   /* $('#example1').DataTable();*/
  });

  

    //llena de datos tabla productos en la modal listcartitems


</script>

@endsection
