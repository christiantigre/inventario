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
                <i class="fa fa-globe"></i> Venta, {{ $venta->num_venta }}.
                <small class="pull-right">Fecha: {{ $venta->fecha }}</small>
            </h2>
        </div>
        <!-- /.col -->
     
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
        <strong>{{ $venta->cliente }}</strong>
        <br>
        @if(empty($venta->dir_cli))
        n/n
        @else
        {{ $venta->dir_cli }}
        @endif
        <br>
        Tlfn: 
        @if(empty($venta->cel_cli))
        n/n
        @else
        ({{ $venta->cel_cli }})
        @endif
        <br>
        Correo: 
        @if(empty($venta->mail_cli))
        n/n
        @else
        {{ $venta->mail_cli }}
        @endif
        <br>            
        C.I.:
        @if(empty($venta->cc_cli))
        n/n
        @else
        {{ $venta->cc_cli }}
        @endif
        RUC: 
        @if(empty($venta->ruc_cli))
        n/n
        @else
        {{ $venta->ruc_cli }}
        @endif
    </address>
</div>
<!-- /.col -->
<div class="col-sm-4 invoice-col">
  <b>Factura #{{ $venta->num_venta }}</b><br>
  <br>
  <b>AUT .S.R.I.:</b> {{ $almacen->auth_sri }}<br>
  <b>Serie:</b> {{ $almacen->codestablecimiento }}-{{ $almacen->codpntemision }}<br>
  <b>Fecha pago:</b> {{ $venta->fecha }}<br>
  <b>Pago:</b> {{ $venta->typepay->type }}<br>
  <b>Entrega:</b> {{ $venta->entrega->metodo }}<br>
</div>
<!-- /.col -->
</div>
<!-- /.row -->

<!-- Table row -->
<div class="row">
  <div class="col-xs-12 table-responsive">
    <br/>
                        <br/>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>Factura</th> <td>{{ $comprobante['numfactura'] }}</td>
                                      </tr>
                                      <tr>
                                        <th>Clave Acceso</th><td>{{ $comprobante['claveacceso'] }}</td>
                                      </tr>
                                      <tr>
                                        <th>Num Autorización</th><td>{{ $comprobante['num_autorizacion'] }}</td>
                                      </tr>
                                      <tr>
                                        <th>Fecha Autorización</th><td>{{ $comprobante['fecha_autorizacion'] }}</td>
                                      </tr>
                                      <tr>
                                        <th>Estado</th>
                                        <td>{{ $comprobante['estado_aprobacion'] }}</td>
                                      </tr>
                                      <tr>
                                        <th>Mensaje</th>
                                        <td>{{ $comprobante['mensaje'] }}</td>
                                      </tr>
                                      <tr>
                                        <th>XML Generado</th>
                                        <td style="display:inline">
                                            @if(($comprobante['gen_xml'])=='1')
                                            <small class="label pull-left bg-green">GENERADO</small>
                                        @else
                                            <small class="label pull-left bg-red">NO GENERADO</small>
                                            <a href="{{ url('/person/return_generafactura/' . $comprobante['id_venta']) }}" title="Generar XML"><button class="btn btn-info btn-xs"><i class="fa fa-refresh" aria-hidden="true"></i> GENERAR</button></a>
                                        @endif
                                        </td>
                                      </tr>
                                      <tr>
                                        <th>Enviado Autorizar</th>
                                        <td style="display:inline">
                                        @if(($comprobante['fir_xml'])=='1')
                                            <small class="label pull-left bg-green">FIRMADO</small>
                                        @else
                                            <small class="label pull-left bg-red">NO FIRMADO</small>
                                            <a href="{{ url('/person/return_firmarfactura/' . $comprobante['id_venta']) }}" title="Generar XML"><button class="btn btn-info btn-xs"><i class="fa fa-refresh" aria-hidden="true"></i> FIRMAR</button></a>
                                        @endif
                                    </td>
                                  </tr>
                                  <tr>
                                        <th>XML Firmado</th>
                                        <td style="display:inline">
                                        @if(($comprobante['env_xml'])=='1')
                                            <small class="label pull-left bg-green">ENVIADO</small>
                                        @else
                                            <small class="label pull-left bg-red">NO ENVIADO</small>
                                            <a href="{{ url('/person/return_autorizarfactura/' . $comprobante['id_venta']) }}" title="Generar XML"><button class="btn btn-info btn-xs"><i class="fa fa-refresh" aria-hidden="true"></i> ENVIAR</button></a>
                                        @endif</td>
                                      </tr>
                                      <tr>
                                        <th>Autorizado</th>
                                        <td style="display:inline">
                                        @if(($comprobante['aut_xml'])=='1')
                                            <small class="label pull-left bg-green">AUTORIZADO</small>
                                        @else
                                            <small class="label pull-left bg-red">NO AUTORIZADO</small>
                                            <a href="{{ url('/person/return_firmarfactura/' . $comprobante['id_venta']) }}" title="Generar XML"><button class="btn btn-info btn-xs"><i class="fa fa-refresh" aria-hidden="true"></i> AUTORIZAR</button></a>
                                        @endif</td>
                                      </tr>
                                      <tr>
                                        <th>RIDE Generado</th>
                                        <td style="display:inline">
                                         @if(($comprobante['convrt_ride'])=='1')
                                            <small class="label pull-left bg-green">GENERADO</small>
                                        @else
                                            <small class="label pull-left bg-red">NO GENERADO</small>
                                            <a href="{{ url('/person/return_generarpdf/' . $comprobante['id_venta']) }}" title="Generar XML"><button class="btn btn-info btn-xs"><i class="fa fa-refresh" aria-hidden="true"></i> GENERAR</button></a>
                                        @endif</td>
                                      </tr>
                                      <tr>
                                        <th>RIDE Enviado</th>
                                        <td style="display:inline">
                                        @if(($comprobante['send_ride'])=='1')
                                            <small class="label pull-left bg-green">ENVIADO</small>
                                        @else
                                            <small class="label pull-left bg-red">NO ENVIADO</small>
                                            <a href="{{ url('/person/return_enviarcomprobantes/' . $comprobante['id_venta']) }}" title="Generar XML"><button class="btn btn-info btn-xs"><i class="fa fa-refresh" aria-hidden="true"></i> ENVIAR</button></a>
                                        @endif</td>
                                      </tr>
                                      <tr>
                                        <th>XML Enviado</th>
                                        <td style="display:inline">
                                            @if(($comprobante['send_xml'])=='1')
                                            <small class="label pull-left bg-green">ENVIADO</small>
                                        @else
                                            <small class="label pull-left bg-red">NO ENVIADO</small>
                                            <a href="{{ url('/person/return_enviarcomprobantes/' . $comprobante['id_venta']) }}" title="Generar XML"><button class="btn btn-info btn-xs"><i class="fa fa-refresh" aria-hidden="true"></i> ENVIAR</button></a>
                                        @endif</td>
                                      </tr>

                                        
                                </tbody>
                            </table>
                            
  </div>
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
      <p class="lead">Monto de {{ $venta->fecha }}</p>

      <div class="table-responsive">
        <table class="table">
          <tbody><tr>
            <th style="width:50%">Subtotal:</th>
            <td>${{ number_format($venta->subtotal,2) }}</td>
        </tr>
        <tr>
            <th>Iva 0%</th>
            <td>${{ number_format($venta->iva_cero,2) }}</td>
        </tr>
        <tr>
            <th>Iva {{ number_format($venta->porcentaje_iva,2) }} %:</th>
            <td>${{ number_format($venta->iva_calculado,2) }}</td>
        </tr>
        <tr>
            <th>Total:</th>
            <td>${{ number_format($venta->total,2) }}</td>
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
      <a href="{{ url('person/viewfactura',$venta->id) }}" target="_blanck" class="btn btn-success pull-right" style="margin-right: 5px;">
        <i class="fa fa-eye"></i> VER FACTURA
    </a>
      <a href="{{ url('person/print',$venta->id) }}" class="btn btn-primary pull-right" style="margin-right: 5px;">
        <i class="fa fa-download"></i> IMPRIMIR
    </a>
</div>
</div>
</section>
</div>
</div>
@endsection
