
<style>
.example-modal .modal {
  position: relative;
  top: auto;
  bottom: auto;
  right: auto;
  left: auto;
  display: block;
  z-index: 1;
}

.example-modal .modal {
  background: transparent !important;
}
</style>

<div class="modal fade" id="modal-seleccionaproductos">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			{!! Form::open(['id'=>'myForm'])  !!}
			{{ csrf_field() }}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>

					<h4 class="modal-title">Seleccione producto</h4>           

				</div>
				<div class="modal-body">
          <div class="table-responsive">

          <table id="productos_tab" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <!--<table id="example1" class="table table-bordered table-striped">-->
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Imagen</th>
                  <th>Producto</th>
                  <th>Detalle</th>
                  <th>Cod</th>
                  <th>PVP</th>
                  <th>Stock</th>
                  <th>Cantidad</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($products as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td>
                    <a href="{{ asset($item->imagen) }}" target="_blanck">
                      <img src="{{ asset($item->imagen) }}" class="navbar-brand navbar-brand-logo brand-centered">
                    </a>
                  </td>
                  <td>{{ $item->producto }}</td>
                  <td>{{ $item->propaganda }}</td>
                  <td>{{ $item->cod_barra }}</td>
                  <td>{{ $item->pre_venta }}</td>
                  <td>{{ $item->cantidad }}</td>
                  <td>
                    <input type="number" name="cant_prod" id="cant_prod" value="1" min="1" max="{{ $item->cantidad }}">
                  </td>
                  <td>
                    <button type='button' id="{{ $item->id }}" value="{{ $item->id }}" class="btn btn-info btn-xs select_prod_person" data-dismiss='modal'> Seleccionar</button>                  
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            </div>
          </div>
          <div class="modal-footer">
           <button type="button" class="btn btn-default pull-left" data-dismiss="modal">CERRAR</button>
           <!--{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}-->
         </div>
         {!! Form::close() !!}
       </div>
       <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
   </div>
   <!-- /.modal -->
   

   <script type="text/javascript">
    $(function() {
        $('#productos_tab').DataTable({
    responsive: true
});
    });
    
    $(document).ready(function(){
      /*$('#example2').DataTable();*/
    });

    //Boton id=select_prod de la modalselect_prod obtiene los datos de la fila seleccionada envia por ajax al controlador ComponetController funcion addItem y guarda en la tabla item_ventas
$('.select_prod_person').click(function(){
  var dataId = this.id;
  var idventa= $("#idventa").val();
  var token = $("input[name=_token]").val();
  //var route = '/admin/saveprod/'; 
  var route = '{{ url("admin/saveprod") }}'; 
  var id = $(this).parents("tr").find("td")[0].innerHTML;
  var prod = $(this).parents("tr").find("td")[2].innerHTML;
  var codbarra = $(this).parents("tr").find("td")[4].innerHTML;
  var precio = $(this).parents("tr").find("td")[5].innerHTML;
  var stock = $(this).parents("tr").find("td")[6].innerHTML;
  var cantidad = $(this).parents("tr").find('#cant_prod').val();
  var total = cantidad*precio;
  /*if(cantidad>stock){
    alert("Error!!!...La cantidad seleccionada supera al stock actual. No se puede agregar esta cantidad");
    return false;
  }*/
  //console.log(nombre);
  var parametros = {
    "id" :dataId,
    "idproducto" :id,
    "nombre" :prod,
    "codbarra" :codbarra,
    "precio" :precio,
    "cantidad" :cantidad,
    "total" :total,
    "idventa": idventa
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
      console.log("copy data selected");
      console.log("copy data succefull");
        items_cart_person();
    },
    error:function(data)
    {
      console.log('Error '+data);
    }  
  });
});

  </script>
