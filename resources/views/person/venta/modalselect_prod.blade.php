
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
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>


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
          <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <!--<table id="example1" class="table table-bordered table-striped">-->
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Imagen</th>
                  <th>Producto</th>
                  <th>Detalle</th>
                  <th>Cod</th>
                  <th>PVP</th>
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
                  <td>
                    <input type="number" name="cant_prod" id="cant_prod" value="1" min="1" max="{{ $item->cantidad }}">
                  </td>
                  <td>
                    <button type='button' id="{{ $item->id }}" value="{{ $item->id }}" class="btn btn-info btn-xs select_prod" data-dismiss='modal'> Seleccionar</button>                  
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
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
   <script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

   <script type="text/javascript">
    $(document).ready(function(){
      $('#example2').DataTable();
    });
  </script>
