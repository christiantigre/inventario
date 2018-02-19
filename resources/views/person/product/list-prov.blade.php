
<div class="row">
  <div class="col-md-10 col-lg-12 col-xs-12 col-sm-12">

    <table id="example1" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Actions</th>
          <th>ID</th>
          <th>Proveedor</th>
          <th>Ruc</th>
          <th>Correo</th>
          <th>Contactos</th>
          <th>Direcciòn</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        @foreach($proveedores as $item)
        <tr>
          <td>
            <button type='button' id="{{ $item->id }}" value="{{ $item->id }}" class="btn btn-info btn-xs select_prov_person" onclick="select_prov({{ $item->id }})" data-dismiss='modal'> Seleccionar</button>                  
          </td>
          <td>{{ $item->id }}</td>
          <td>{{ $item->proveedor }} </td>
          <td>{{ $item->ruc }} </td>
          <td>{{ $item->mail }}</td>
          <td>{{ $item->cel_movi }} / {{ $item->tlfn }}</td>
          <td>{{ $item->dir }}</td>
          <td>
            @if( ($item->status)=="0" )
            Inactivo
            @else
            Activo
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>


  </div>
</div>

<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>