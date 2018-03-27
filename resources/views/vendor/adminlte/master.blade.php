<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
@yield('title', config('adminlte.title', 'AdminLTE 2'))
@yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">

    @if(config('adminlte.plugins.select2'))
        <!-- Select2 -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
    @endif

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

    @if(config('adminlte.plugins.datatables'))
        
        
    @endif

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Jquery edit-->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker.standalone.min.css')}}">
    <script src="{{asset('plugins/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- Languaje -->
    <script src="{{asset('plugins/bootstrap-datepicker-1.6.4/locales/bootstrap-datepicker.es.min.js')}}"></script>
    <!-- DataTables -->
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> 


 


</head>
<body class="hold-transition @yield('body_class')">


@yield('body')
<!--edit-->
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script>
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>

@if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
@endif

<!-- DataTables -->
<!-- jQuery -->
<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

@if(config('adminlte.plugins.datatables'))
    <!-- jQuery -->

<!-- Bootstrap JavaScript -->
<!--<script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->
<!-- App scripts -->

@endif

<!--toastr edit 
   <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
  -->
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    
    <script>
@if(isset($notification['message']))
    var type = $notification['type'];
    switch(type){
        case 'info':
            toastr.info("{{ $notification['message'] }}");
            break;
        
        case 'warning':
            toastr.warning("{{ $notification['message'] }}");
            break;
 
        case 'success':
            toastr.success("{{ $notification['message'] }}");
            break;
 
        case 'error':
            toastr.error("{{ $notification['message'] }}");
            break;
    }
@endif
</script>

    {!! Html::script('js/dropdown.js') !!}
    {!! Html::script('js/scriptmodalsearchs.js') !!}
    {!! Html::script('js/modulocontabilidad.js') !!}

@yield('adminlte_js')

</body>
</html>
