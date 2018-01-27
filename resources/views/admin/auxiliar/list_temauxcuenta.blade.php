<table class="table table-borderless">
    <thead>
        <tr>
            <th>#</th>
            <th>Codigo</th>
            <th>Subcuenta</th>
            <th>Cuenta</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tempauxcta as $item)
        <tr>
            <td>{{ $loop->iteration or $item->id }}</td>
            <td>{{ $item->codigo }}.</td>
            <td>{{ $item->auxiliar }}</td>
            <td>{{ $item->subcuenta }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="form-group">
    <div class="col-md-offset-10 col-md-2 col-sm-offset-8 col-sm-2">
        <a href="{{ URL::to('/admin/guardarAuxCuentas') }}">
            <button title="Guardar todo el listado" class="btn btn-success btn-sm">Guardar Todo</button>
        </a>
    </div>
</div>