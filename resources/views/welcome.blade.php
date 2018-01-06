<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>



    <!-- Styles -->
    <style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
    .btn-sq-lg {
      width: 150px !important;
      height: 150px !important;
  }

  .btn-sq {
      width: 100px !important;
      height: 100px !important;
      font-size: 10px;
  }

  .btn-sq-sm {
      width: 50px !important;
      height: 50px !important;
      font-size: 10px;
  }

  .btn-sq-xs {
      width: 25px !important;
      height: 25px !important;
      padding:2px;
  }


</style>
</head>
<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">SISTEMA</a>
            @else
            <a href="{{ route('login') }}">INICIO</a>
            <a href="{{ route('register') }}">REGISTRARSE</a>
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
            </div>

            <div class="container">
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <p>
                    <a href="{{ url('person/home') }}" class="btn btn-sq-lg btn-default">
                        <i class="fa fa-laptop fa-5x"></i><br/>
                        SISTEMA
                    </a>
                    <a href="{{ url('person/venta') }}" class="btn btn-sq-lg btn-default">
                        <i class="fa fa-calculator fa-5x"></i><br/>
                        VENTAS
                    </a>
                    <a href="{{ url('person/product') }}" class="btn btn-sq-lg btn-default">
                      <i class="fa fa-institution fa-5x"></i><br/>
                      PRODUCTOS
                  </a>
                  <a href="{{ url('person/cliente') }}" class="btn btn-sq-lg btn-default">
                      <i class="fa fa-users fa-5x"></i><br/>
                      CLIENTES
                  </a>
                  <a href="{{ url('person/proveedor') }}" class="btn btn-sq-lg btn-default">
                      <i class="fa fa-handshake-o fa-5x"></i><br/>
                      PROVEEDORES
                  </a>
                  <a href="#" class="btn btn-sq-lg btn-default">
                      <i class="fa fa-line-chart fa-5x"></i><br/>
                      INVENTARIOS
                  </a>
                  <a href="#" class="btn btn-sq-lg btn-default">
                      <i class="fa fa-gears fa-5x"></i><br/>
                      PARAMETROS
                  </a>
              </p>
          </div>
      </div>
  </div>

  </div>
</div>
</body>
</html>
