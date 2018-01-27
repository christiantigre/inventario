@extends('adminlte::page')
@section('content')
@include('errors.messages')
@include('admin.contabilidad.menucontable')
@include('admin.contabilidad.infosection')
<section class="content">
    <div class="row">
        @include('admin.contabilidad.sidebar')
        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">MOVIMIENTOS</div>
                <div class="panel-body">
                    
                    <a href="{{ url('/admin/cuenta/create') }}" class="btn btn-success btn-xs" title="Registrar Cuenta">
                        <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                    </a>

                    <form method="GET" action="{{ url('/admin/cuenta') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>

                    <br/>
                    <br/>
                    <div class="table-responsive">
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
