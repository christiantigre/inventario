<table class="table table-borderless">
    <thead>
        <tr>
            <th>#</th>
            <th>ASIENTO</th>
            <th>CÓD</th>
            <th>CUENTA</th>
            <th>DEBE</th>
            <th>HABER</th>
            <th>ACCIÓNES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transacciones as $item)
        <tr>
            <td>{{ $loop->iteration or $item->id }}</td>
            <td>{{ $item->num_asiento }}</td>
            <td>{{ $item->cod_cuenta }}</td>                                        
            <td>{{ $item->cuenta }}</td>                                        
            <td>{{ $item->saldo_debe }}</td>
            <td>{{ $item->saldo_haber }}</td>
            <td>
                <a href="{{ url('/admin/cuenta/' . $item->id) }}" title="Ver Cuenta"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                <a href="{{ url('/admin/cuenta/' . $item->id . '/edit') }}" title="Editar Cuenta"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                <form method="POST" action="{{ url('/admin/cuenta' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Cuenta" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>