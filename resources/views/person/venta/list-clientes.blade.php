
<div class="row">
  <div class="col-md-10 col-lg-12 col-xs-12 col-sm-12">

    <table id="example1" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>DNI</th>
          <th>Dirección</th>
          <th>Contactos</th>
          <th>mail</th>
          <th>Estado</th>
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
            @if( ($item->is_active)=="0" )
            Inactivo
            @else
            Activo
            @endif
          </td>
          <td>
            <button type='button' id="{{ $item->id }}" value="{{ $item->id }}" class="btn btn-info btn-xs select_cli_person" data-dismiss='modal'> Seleccionar</button>                  
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>


  </div>
</div>

<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>