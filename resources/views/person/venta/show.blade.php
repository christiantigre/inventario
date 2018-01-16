@extends('person.page')
@section('content')
@include('errors.messages')
<div class="row">
    <div class="col-md-12">
     {{--
      <a href="{{ url('/person/venta') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> VENTAS</button></a>--}}
        <section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i> Venta, {{ $ventum->num_venta }}.
                <small class="pull-right">Fecha: {{ $ventum->fecha }}</small>
            </h2>
        </div>
        <!-- /.col -->
     }
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Almacen
          <address>
            <strong>{{ $almacen->almacen }}, Inc.</strong><br>
            {{ $almacen->slogan }}<br>
            {{ $almacen->provincia->provincia }} - {{ $almacen->canton->canton }}<br>
            {{ $almacen->dir }}<br>
            Contactos: ({{ $almacen->telefono }})<br>
            Movil: {{ $almacen->cel_movi }} / {{ $almacen->cel_claro }}<br>
            Watsapp: {{ $almacen->cel_watsapp }}<br>
            Correo: {{ $almacen->email }}<br>
        </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      Cliente
      <address>
        <strong>{{ $ventum->cliente }}</strong>
        <br>
        @if(empty($ventum->dir_cli))
        n/n
        @else
        {{ $ventum->dir_cli }}
        @endif
        <br>
        Tlfn: 
        @if(empty($ventum->cel_cli))
        n/n
        @else
        ({{ $ventum->cel_cli }})
        @endif
        <br>
        Correo: 
        @if(empty($ventum->mail_cli))
        n/n
        @else
        {{ $ventum->mail_cli }}
        @endif
        <br>            
        C.I.:
        @if(empty($ventum->cc_cli))
        n/n
        @else
        {{ $ventum->cc_cli }}
        @endif
        RUC: 
        @if(empty($ventum->ruc_cli))
        n/n
        @else
        {{ $ventum->ruc_cli }}
        @endif
    </address>
</div>
<!-- /.col -->
<div class="col-sm-4 invoice-col">
  <b>Factura #{{ $ventum->num_venta }}</b><br>
  <br>
  <b>AUT .S.R.I.:</b> {{ $almacen->auth_sri }}<br>
  <b>Serie:</b> {{ $almacen->codestablecimiento }}-{{ $almacen->codpntemision }}<br>
  <b>Fecha pago:</b> {{ $ventum->fecha }}<br>
  <b>Pago:</b> {{ $ventum->typepay->type }}<br>
</div>
<!-- /.col -->
</div>
<!-- /.row -->

<!-- Table row -->
<div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
        <thead>
            <tr>
              <th>#</th>
              <th>CANT</th>
              <th>CODIGO</th>
              <th>PRODUCTO</th>
              <th>P.V.P.</th>
              <th>TOTAL</th>
          </tr>
      </thead>
      <tbody>
       <?php $i=1; ?>
       @foreach($detallventa as $item)
       <tr>
          <td style="width: 10px"><?Php echo $i; ?></td>
          <td>{{ $item->cant }}</td>
          <td>{{ $item->codbarra }}</td>
          <td>{{ $item->producto }}</td>
          <td>{{ $item->precio }}</td>
          <td>{{ $item->total }}</td>
      </tr>
      <?Php $i++; ?>
      @endforeach 
  </tbody>
</table>
</div>
<!-- /.col -->
</div>
<!-- /.row -->

<div class="row">
    <!-- accepted payments column -->
    <div class="col-xs-6">
          <!--<p class="lead">Payment Methods:</p>
          <img src="../../dist/img/credit/visa.png" alt="Visa">
          <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../../dist/img/credit/american-express.png" alt="American Express">
          <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p>-->
    </div>
    <!-- /.col -->
    <div class="col-xs-6">
      <p class="lead">Monto de {{ $ventum->fecha }}</p>

      <div class="table-responsive">
        <table class="table">
          <tbody><tr>
            <th style="width:50%">Subtotal:</th>
            <td>${{ number_format($ventum->subtotal,2) }}</td>
        </tr>
        <tr>
            <th>Iva 0%</th>
            <td>${{ number_format($ventum->iva_cero,2) }}</td>
        </tr>
        <tr>
            <th>Iva {{ number_format($ventum->porcentaje_iva,2) }} %:</th>
            <td>${{ number_format($ventum->iva_calculado,2) }}</td>
        </tr>
        <tr>
            <th>Total:</th>
            <td>${{ number_format($ventum->total,2) }}</td>
        </tr>
    </tbody></table>
</div>
</div>
<!-- /.col -->
</div>
<!-- /.row -->

<!-- this row will not appear when printing -->
<div class="row no-print">
    <div class="col-xs-12">
      <!--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
      <!--<button type="button" class="btn btn-success pull-right"><i class="fa fa-eye"></i> VER FACTURA
      </button>-->
      <a href="{{ url('person/viewfactura',$ventum->id) }}" target="_blanck" class="btn btn-success pull-right" style="margin-right: 5px;">
        <i class="fa fa-eye"></i> VER FACTURA
    </a>
      <a href="{{ url('person/print',$ventum->id) }}" class="btn btn-primary pull-right" style="margin-right: 5px;">
        <i class="fa fa-download"></i> IMPRIMIR
    </a>
</div>
</div>
</section>
</div>
</div>
@endsection
