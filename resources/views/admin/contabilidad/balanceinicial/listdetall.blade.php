 <table class="table table-borderless" id="tempBInicial">
    <thead>
        <tr>
            <th>#</th>
            <th>CÓD</th>
            <th>CUENTA</th>
            <th>DEBE</th>
            <th>HABER</th>
            <th>ACCIÓNES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transacciones as $item)
        <tr class="suma">
            <td>{{ $loop->iteration or $item->id }}</td>
            <td>{{ $item->cod_cuenta }}</td>                                        
            <td>{{ $item->cuenta }}</td>                                        
            <td>{{ $item->saldo_debe }}</td>
            <td>{{ $item->saldo_haber }}</td>
            <td>

                <a data-toggle="modal" data-target="#ver-item" class="ver-item" title="Ver transacción"><button class="btn btn-info btn-xs" id="ver_trs" onclick="ver_trs({{ $item->id }});"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>

                <a data-toggle="modal" data-target="#edit-item" class="edit-item" title="Editar Transacción"><button class="btn btn-primary btn-xs"  id="editar_trs" onclick="ver_trs_edit({{ $item->id }});"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

               <button type="button" class="btn btn-danger btn-xs" title="Eliminar Transacción" onclick="eliminarTrs({{ $item->id }});">
                <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar
                </button>

            </td>
        </tr>
        @endforeach
        

        <tr class="total">
            <td></td>
            <td></td>
            <td></td>            
            <td>
                DEBE : {!! Form::text('debe', null, ['class' => 'form-control input-sm','id'=>'debe','autofocus'=>'autofocus','readonly'=>'readonly']), old('debe') !!}
            </td>
            <td>
                HABER : {!! Form::text('haber', null, ['class' => 'form-control input-sm','id'=>'haber','autofocus'=>'autofocus','readonly'=>'readonly']), old('haber') !!}
            </td>
        </tr>
    </tbody>
</table>