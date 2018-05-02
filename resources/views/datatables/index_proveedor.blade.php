@extends('layouts.master')

@section('content')

<table class="table table-bordered" id="proveedor-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Proveedor</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Cel. Movistar</th>
            <th>Cel. Claro</th>
            <th>Correo</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
</table>
@stop

@push('scripts')
<script>
    $(function() {
        $('#proveedor-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('prov.data') !!}',
            columns: [
            { data: 'id', name: 'id' },
            { data: 'proveedor', name: 'proveedor' },
            { data: 'dir', name: 'dir' },
            { data: 'tlfn', name: 'tlfn' },
            { data: 'cel_movi', name: 'cel_movi' },
            { data: 'cel_claro', name: 'cel_claro' },
            { data: 'mail', name: 'mail' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' }
            ]
        });
    });
</script>
@endpush
