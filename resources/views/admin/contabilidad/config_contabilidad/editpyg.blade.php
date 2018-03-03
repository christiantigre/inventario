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
                    <div class="panel-heading">Editar Configuración </div>
                    <div class="panel-body">
                        <a href="{{ url('/admin/confcontbl') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                            {!! Form::model($perdidasyganancias, [
                            'method' => 'POST',
                            'url' => ['/admin/upcreaperdidadyganancias', $perdidasyganancias->id],
                            'class' => 'form-horizontal', 
                            'enctype'=>'multipart/form-data',
                            'files' => true,
                            'accept-charset'=>'UTF-8'
                            ]) !!}

                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('cod_cuenta') ? 'has-error' : ''}}">
                            <label for="cod_cuenta" class="col-md-4 control-label">{{ 'Cod Cuenta' }}</label>
                            <div class="col-md-8">

                                <div class="input-group input-group-md">
                                    {!! Form::text('cod_cuenta', null, ['id'=>'cod_cuenta','list'=>'cuentas','class' => 'form-control','autofocus'=>'autofocus','onSelect'=>'consulta_cuenta_admin()','required'=>'required']), old('cod_cuenta') !!}
                                    <span class="input-group-btn">
                                      <button type="button" class="btn btn-default btn-flat busca_cuenta">Buscar</button>
                                  </span>
                              </div>
                              <datalist id="cuentas">
                                @foreach($cuentas as $cuenta)
                                <option class="form-control" onSelect="consulta_cuenta_admin()" id="{{ $cuenta->cod }}" value="{{ $cuenta->cod }}">{{ $cuenta->cuenta }}</option>
                                @endforeach
                            </datalist>

                            {!! $errors->first('cod_cuenta', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('num_asiento') ? 'has-error' : ''}}">
                        <label for="num_asiento" class="col-md-4 control-label">{{ 'Cuenta' }}</label>
                        <div class="col-md-8">
                            {!! Form::text('cuenta', null, ['id'=>'cuenta','class' => 'form-control','autofocus'=>'autofocus','required'=>'required']), old('cuenta') !!}        
                            {!! $errors->first('cuenta', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            <input class="btn btn-primary btn-sm" type="submit" value="{{ $submitButtonText or 'Actualizar' }}">
                        </div>
                    </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
    function consulta_cuenta_admin(){
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
</script>
@endsection
