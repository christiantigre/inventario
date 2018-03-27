@extends('adminlte::master')

@section('adminlte_css')
<link rel="stylesheet"
href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
@stack('css')
@yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
'boxed' => 'layout-boxed',
'fixed' => 'fixed',
'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')


<div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">
        @if(config('adminlte.layout') == 'top-nav')
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="{{ url('/') }}" class="navbar-brand">
                        {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                    </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
                @else
                <!-- Logo -->
                <a href="{{ url('/') }}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                    </a>
                    @endif
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">

                        <ul class="nav navbar-nav">
                            <li>
                                @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                                @else
                                <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                >
                                <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                            </a>
                            <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                @if(config('adminlte.logout_method'))
                                {{ method_field(config('adminlte.logout_method')) }}
                                @endif
                                {{ csrf_field() }}
                            </form>
                            @endif
                        </li>
                    </ul>
                </div>
                @if(config('adminlte.layout') == 'top-nav')
            </div>
            @endif
        </nav>
    </header>

    @if(config('adminlte.layout') != 'top-nav')
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">

                <li class="">
                    <a href="{{ url('person/inicio') }}"
                    >
                    <i class="fa fa-fw fa-desktop "></i>
                    <span>Sistema</span>
                </a>
            </li>
            <li class="">
                    <a href="{{ url('person/settings') }}"
                    >
                    <i class="fa fa-fw fa-user "></i>
                    <span>Perfíl</span>
                </a>
            </li>

            <li class="">
                <a href="{{ url('person/venta') }}"
                >
                <i class="fa fa-fw fa-shopping-basket "></i>
                <span>Ventas</span>
            </a>
        </li>
        <li class="">
                <a href="{{ url('person/facturacion') }}"
                >
                <i class="fa fa-fw fa-calculator "></i>
                <span>Facturación</span>
            </a>
        </li>

        <li class="">
            <a href="{{ url('person/product') }}"><i class="fa fa-fw fa-cloud-upload "></i>
                <span>Productos</span></a>
            </li>
            <li class="">
                <a href="{{ url('person/proveedor') }}"
                >
                <i class="fa fa-fw fa-group "></i>
                <span>Proveedor</span>
            </a>
        </li>
        <li class="">
            <a href="{{ url('person/cliente') }}">
                <i class="fa fa-fw fa-user "></i>
                <span>Cliente</span>
            </a>
        </li>
        <li class="">
            <a href="{{ url('person/inventario') }}">
                <i class="fa fa-fw fa-line-chart "></i>
                <span>Inventario</span>
            </a>
        </li>
        <li class="treeview">
            <a href="#"
            >
            <i class="fa fa-fw fa-share "></i>
            <span>Sistema</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">    
            <li class="">
                <a href="{{ url('person/almacen') }}"
                >
                <i class="fa fa-fw fa-circle-o "></i>
                <span>Almacen</span>
            </a>
        </li>
        <li class="treeview">
            <a href="#"
            >
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Configuración</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="treeview">
                <a href="#"
                >
                <i class="fa fa-fw fa-circle-o "></i>
                <span>Categoría</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="">
                    <a href="{{ url('person/category') }}"
                    >
                    <i class="fa fa-fw fa-circle-o "></i>
                    <span>Categoría</span>
                </a>
            </li>
            <li class="">
                <a href="{{ url('person/subcategory') }}"
                >
                <i class="fa fa-fw fa-circle-o "></i>
                <span>Subcategoría</span>
            </a>
        </li>
    </ul>
</li>
<li class="treeview">
    <a href="#"
    >
    <i class="fa fa-fw fa-circle-o "></i>
    <span>Extras</span>
    <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
    </span>
</a>
<ul class="treeview-menu">
    <li class="">
        <a href="{{ url('person/marca') }}"
        >
        <i class="fa fa-fw fa-circle-o "></i>
        <span>Marca</span>
    </a>
</li>
<li class="">
    <a href="{{ url('person/iva') }}"
    >
    <i class="fa fa-fw fa-circle-o "></i>
    <span>Iva</span>
</a>
</li>
</ul>
</li>
</ul>
</li>
</ul>
</li>
</ul>
<!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>
@endif

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @if(config('adminlte.layout') == 'top-nav')
    <div class="container">
        @endif

        <!-- Content Header (Page header) -->
        <section class="content-header">
            @yield('content_header')
        </section>

        <!-- Main content -->
        <section class="content">

            @yield('content')

        </section>
        <!-- /.content -->
        @if(config('adminlte.layout') == 'top-nav')
    </div>
    <!-- /.container -->
    @endif

    @include('layouts.modal.proveedor')

</div>
<!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
@stack('js')
@yield('js')
    
@stop
