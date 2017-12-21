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

<div class="modal fade" id="modal-proveedor">
  <div class="modal-dialog">
    <div class="modal-content">
      {!! Form::open(['id'=>'myForm'])  !!}
      {{ csrf_field() }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <?Php
          if (empty($tittle_modal)) {
            ?>
            <h4 class="modal-title">Default Modal</h4>
            <?php
          }else{
            ?>
            <h4 class="modal-title"><?Php echo $tittle_modal ?></h4>
            <?php
          }
          ?>

        </div>
        <div class="modal-body">
          <div class="col-lg-12">
            <div class="input-group">
              <input type="text" class="form-control" id="rucprv" placeholder="Ingrese numero de ruc">
              <span class="input-group-btn">
                <button class="btn btn-default" id="proveedorrucchbuton" type="button">BUSCAR</button>
              </span>
            </div><!-- /input-group -->


            <!--nom cliente-->    
            <div class="input-group">
              <input type="text" class="form-control" id="nompro" placeholder="Ingrese nombre empresa">
              <span class="input-group-btn">
                <button class="btn btn-default" id="proveedorempchbuton" type="button">BUSCAR</button>
              </span>
            </div><!-- /input-group -->

            <!-- /.form-group -->
            <!--Mail cliente-->     
            <div class="input-group">
              <input type="text" class="form-control" id="mailpro" placeholder="Ingrese correo proveedor">
              <span class="input-group-btn">
                <button class="btn btn-default" id="proveedormailchbuton" type="button">BUSCAR</button>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
          <!-- /.form-group -->
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Datos Proveedor</h3>

                  <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover" id="tabla_proveedor">
                    <tr>
                      <th>Proveedor</th>
                      <th>Contactos</th>
                      <th>Mail</th>
                      <th>Empresa</th>
                      <th></th>
                    </tr>
                    <tbody>
                                            
                    </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <!--{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}-->
        </div>
        {!! Form::close() !!}
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

