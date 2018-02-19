@extends('person.page')

@section('content')
@include('errors.messages')

<div class="row">
<section class="content-header">
      <h1>
        Registro de productos
        <small>Ingreso</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Productos</a></li>
        <li class="active">Registrar</li>
    </ol>
</section>
<section class="content">
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="panel-heading">
                <a href="{{ url('/person/product') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
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
            <form method="POST" action="{{ url('/person/product') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include ('person.product.form')
            </form>
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
@include('person.product.modalselect_prov')
<script type="text/javascript">

    $(document).ready(function(){
        items_prov();
    });

    //llena de datos tabla productos en la modal listcartitems
function items_prov(){
    console.log('loading prov');
    var route = "{{ url('person/listprovtitems') }}";
    $.ajax({
        type:'get',
        url:route,
        success: function(data){
            $('#list-prov').empty().html(data);
        }
    });
}

    function select_prov(id){
        console.log("select proveedor");
            reset_input_prov();
    var dataId = this.id;
    var token = $("input[name=_token]").val();
    var route = '{{ url("person/extraerdatosprov") }}';
    var parametros = {
        "id" :id
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
            console.log(data);
            console.log("copy data selected");
            document.getElementById("id_proveedor").value = data.id;
            document.getElementById("nom_pro").value = data.proveedor;
            document.getElementById("mail").value = data.mail;
            document.getElementById("empresa").value = data.empresa;
            document.getElementById("contactos").value = data.tlfn+' '+data.cel_movi;
            
            console.log("copy data succefull");
        },
        error:function(data)
        {
            console.log('Error '+data);
        }  
    });
}

function reset_input_prov(){
            console.log("Cleared");

    document.getElementById("id_proveedor").value = "";
            document.getElementById("nom_pro").value = "";
            document.getElementById("mail").value = "";
            document.getElementById("empresa").value = "";
            document.getElementById("contactos").value = "";
}
</script>
@endsection
