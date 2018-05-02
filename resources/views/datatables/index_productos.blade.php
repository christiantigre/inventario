@extends('layouts.master')

@section('content')

            <table class="table table-bordered" id="productos-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Producto</th>
                <th>Cod Barra</th>
                <th>Precio Venta</th>
                <th>Stock</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
    </table>
    @stop

    @push('scripts')
<script>
$(function() {
    $('#productos-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('prod.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'producto', name: 'producto' },
            { data: 'cod_barra', name: 'cod_barra' },
            { data: 'pre_venta', name: 'pre_venta' },
            { data: 'cantidad', name: 'cantidad' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' }
        ]
    });
});
</script>
@endpush
        