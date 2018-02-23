@extends('adminlte::page')
@section('content')
@include('errors.messages')
@include('admin.contabilidad.menucontable')
@include('admin.contabilidad.infosection')
<section class="content">
    <div class="row">
        @include('admin.contabilidad.sidebar')
        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">LIBRO CONTABLE</div>
                <div class="panel-body">

                    <div class="row">
                      <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"> 
                            
                            <a href="{{ url('/admin/libro/createAsiento') }}" class="btn btn-success btn-md" title="Registrar Asiento">
                                <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                            </a>
                           
                        </div>
                    </div>

                <br/>
                <br/>
                
                <div class="table-responsive">
                    @if(!empty($asientos))
                    <table class="table table-borderless" id="tempBInicial">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>FECHA</th>
                                <th>ASIENTO</th>
                                <th>CONCEPTO</th>
                                <th>DEBE</th>
                                <th>HABER</th>
                                <th>ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asientos as $item)
                            <tr class="suma">
                                <td>{{ $loop->iteration or $item->id }}</td>
                                <td>{{ $item->fecha }}</td>                    
                                <td>{{ $item->num_asiento }}</td>                                        
                                <td>{{ $item->concepto }}</td>                    
                                <td>{{ number_format($item->saldo_debe,2) }}</td>                    
                                <td>{{ number_format($item->saldo_haber,2) }}</td> 
                                <td>
                                  <a href="{{ url('/admin/libro/verAsiento/' . $item->id) }}" class="ver-item" title="Ver asiento # {{ $item->num_asiento }}"><button class="btn btn-default btn-xs" id="ver_trs" onclick="ver_asiento({{ $item->id }});"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>

                                    <a data-toggle="modal" data-target="#ver-item" class="ver-item" title="Ver detalle"><button class="btn btn-info btn-xs" id="ver_trs" onclick="ver_asiento({{ $item->id }});"><i class="fa fa-eye" aria-hidden="true"></i> Detalle</button></a>

                                    <a href="{{ url('/admin/libro/editarAsiento/' . $item->id) }}" class="edit-item" title="Editar Asiento # {{ $item->num_asiento }}"><button class="btn btn-primary btn-xs"  id="editar_asiento" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                </td>               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
</section>

<!-- Item Modal -->

@include('admin.contabilidad.libro.modalEditTransac')
@include('admin.contabilidad.libro.modalVerTransac')


<script type="text/javascript">
    function vvvver_asiento(id){  
  console.log("buscar datos para modal por "+id);
  var token = $("input[name=_token]").val();
  var route = '{{ url("admin/verAsiento") }}';
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
      /*document.getElementById("view_id_modal").value = data.id;
      document.getElementById("view_cuenta_modal").value = data.cuenta;
      document.getElementById("view_almacen_id_modal").value = data.almacen_id;
      document.getElementById("view_periodo_modal").value = data.periodo;
      document.getElementById("view_responsable_modal").value = data.responsable;
      document.getElementById("view_fecha_modal").value = data.fecha;
      document.getElementById("view_num_asiento_modal").value = data.num_asiento;
      document.getElementById("view_cod_cuenta_modal").value = data.cod_cuenta;
      document.getElementById("view_saldo_debe_modal").value = data.saldo_debe;
      document.getElementById("view_saldo_haber_modal").value = data.saldo_haber;
      document.getElementById("view_concepto_detalle_modal").value = data.concepto_detalle;*/
      console.log("copy data succefull");
    },
    error:function(data)
    {
      console.log('Error '+data);
    }  
  });
}


function ver_asiento(id){
    console.log('loading items transacciónes admin.');
    var parametros = {
    "id" :id
  }
    $.ajax({
        type:'get',
        data:parametros,
      //url:'/admin/listtrs/',
      url:'{{ url("admin/verDetallAsiento") }}',
      success: function(data){
        $('#list-cart').empty().html(data);
        SumarColumnas(id);
      }
    });
  }  

  function SumarColumnas(id) { 
    console.log('Sumando columnas debe y haber.');
    var parametros = {
    "num_asiento" :id,
  }
    $.ajax({
      type:'get',
      url:'{{ url("admin/sumSaldoAsientoDetall") }}',
      data:parametros,
      success: function(data){    
      console.log(parametros);    
        debe_float = data[0]['saldo_debe'];
        haber_float = data[0]['saldo_haber'];
        debe = number_format(debe_float,2);
        haber = number_format(haber_float,2);

        document.getElementById("debe").value = debe;
        document.getElementById("haber").value = haber;

        if(debe == haber){
          console.log("cuadrado");
        }else{
          console.log("descuadrado");
          toastr.warning("!!! Alerta, Asiento descuadrado");
        }

    }
  });
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
