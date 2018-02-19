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
                    <div class="panel-heading">Crear Nueva Cuenta Auxiliar</div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/auxiliar') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/auxiliar') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.auxiliar.form')

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        

function cuentaSubCuentasAdmin(){
    var token = $("input[name=_token]").val();
    var subcuenta_id= $("#subcuenta_id").val();
    //var route = '/admin/extraercontadorsubcuentas/';
    var route = '{{ url("admin/extraercontadorsubcuentas") }}';
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
    </script>
@endsection
