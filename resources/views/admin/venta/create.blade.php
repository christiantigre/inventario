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

    $('.select_cli').click(function(){
            reset_input();
    var dataId = this.id;
    var token = $("input[name=_token]").val();

    //var route = '/admin/extraerdatoscli/';

    //url:'{{ url("admin/sumSaldoAsiento") }}',
    var route = '{{ url("admin/extraerdatoscli") }}';
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

</script>

@endsection
