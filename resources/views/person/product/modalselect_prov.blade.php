
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
 

<div class="modal fade" id="modal-seleccionaprov">
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
              <div id="list-prov">

              </div>  
            </div>
            <!-- /.box-body -->
          <!-- /.box -->

         
            
          
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

