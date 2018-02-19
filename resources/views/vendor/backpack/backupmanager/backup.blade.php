@extends('adminlte::page')


@section('header')
<section class="content-header">
 <h1>
   {{ trans('backpack::backup.backup') }}
</h1>
<ol class="breadcrumb">
   <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}">Admin</a></li>
   <li class="active">{{ trans('backpack::backup.backup') }}</li>
</ol>
</section>
@endsection

@section('content')
<!-- Default box -->
<div class="box">
    <div class="box-body">

        <div class="row"> 
            <div class="col-md-1 col-lg-1 col-xs-12 col-sm-12"> 
                <form method="POST" action="{{ url('/admin/backups') }}" accept-charset="UTF-8" class="form-inline" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input class="btn btn-success btn-xs" type="submit" value="{{ $submitButtonText or 'Backup complete' }}">
                </form>

                <form method="POST" action="{{ url('/admin/backups/db') }}" accept-charset="UTF-8" class="form-inline" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input class="btn btn-success btn-xs" type="submit" value="{{ $submitButtonText or 'Backup DB' }}">
                </form>
            </div>
        </div>


        <br>
        <h3>Backups List:</h3>
        <table class="table table-hover table-condensed">
            <thead>
              <tr>
                <th>#</th>
                <th>Unidad</th>
                <th>Fecha</th>
                <th class="text-right">tamaño</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($backups as $k => $b)
          <tr>
            <th scope="row">{{ $k+1 }}</th>
            <td>{{ $b['disk'] }}</td>
            <td>{{ \Carbon\Carbon::createFromTimeStamp($b['last_modified'])->formatLocalized('%d %B %Y, %H:%M') }}</td>
            <td class="text-right">{{ round((int)$b['file_size']/1048576, 2).' MB' }}</td>
            <td class="text-right">
                @if ($b['download'])
                <a class="btn btn-xs btn-default" href="{{ url('/admin/backup/download/') }}?disk={{ $b['disk'] }}&path={{ urlencode($b['file_path']) }}&file_name={{ urlencode($b['file_name']) }}"><i class="fa fa-cloud-download"></i>Descargar</a>
                @endif

                <a class="btn btn-xs btn-danger eliminar" href="{{ url('admin/backup/delete/'.$b['file_name']) }}?disk={{ $b['disk'] }}"><i class="fa fa-trash-o"></i> Eliminar </a>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div><!-- /.box-body -->
</div><!-- /.box -->

@endsection

@section('after_scripts')


@endsection
