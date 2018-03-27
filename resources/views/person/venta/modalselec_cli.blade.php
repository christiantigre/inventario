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


<div class="modal fade" id="modal-seleccionacliente">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      {!! Form::open(['id'=>'myForm'])  !!}
      {{ csrf_field() }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>

          <h4 class="modal-title">Seleccione Cliente</h4>           

        </div>
        <div class="modal-body">


          <!-- /.box-header -->
          <div class="box-body no-padding">
            <div id="list-clientes">

            </div>  
          </div>
          <!-- /.box-body -->
          <!-- /.box -->

          <div class="table-responsive">

            <table id="clientes_tab" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Dirección</th>
                <th>Contactos</th>
                <th>mail</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($clientes as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nom_cli }} {{ $item->app_cli }}</td>
                <td>{{ $item->ced_cli }} {{ $item->ruc_cli }}</td>
                <td>{{ $item->dir_cli }}</td>
                <td>{{ $item->tlf_cli }} / {{ $item->wts_cli }}</td>
                <td>{{ $item->mail_cli }}</td>
                <td>
                <button type='button' id="{{ $item->id }}" value="{{ $item->id }}" class="btn btn-info btn-xs select_cli_person" data-dismiss='modal'> Seleccionar</button>                  
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
        $('#clientes_tab').DataTable({
    responsive: true
});
    });

/*  $(document).ready(function(){
        items_clientes_person();
    });
  function items_clientes_person(){
    console.log('loading clientes');
    var route = "{{ url('person/listclientes') }}";
    $.ajax({
        type:'get',
        url:route,
        success: function(data){
            $('#list-clientes').empty().html(data);
        }
    });
}
*/
</script>