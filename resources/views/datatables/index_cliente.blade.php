@extends('layouts.master')

@section('content')
            <table class="table table-bordered" id="clientes-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cedula</th>
                <th>Ruc</th>
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
    $('#clientes-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('cli.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nom_cli', name: 'nom_cli' },
            { data: 'app_cli', name: 'app_cli' },
            { data: 'ced_cli', name: 'ced_cli' },
            { data: 'ruc_cli', name: 'ruc_cli' },
            { data: 'mail_cli', name: 'mail_cli' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' }
        ]
    });
});
</script>
@endpush
