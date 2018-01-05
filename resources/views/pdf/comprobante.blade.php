<!DOCTYPE html>

<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
  <link href="css/comprobante.css" rel="stylesheet"/>

  <title>$nom_factura</title>
  
</head>

<body>
  <fieldset>
    <header class="clearfix">  
    </header>
    <table class="tabla">
      @foreach($almacen as $dt_empres)
      <caption>
        <fieldset class="fieldset_header">        
          <p>              
            <span class="right_span">
              <img src="uploads/logo/{{ $dt_empres->name_logo }}" height="30" width="130" alt="logo"/><br/>
              <label class="header_label">{{ $dt_empres->funcion_empresa }}</label><br/>
            </span>
            <label class="header_label">{{ $dt_empres->area_especializacion }}</label>
            <label class="header_label">Gerente :</label>
            <label class="header_label">{{ $dt_empres->gerente }}</label>
            <label class="header_label">Propietario :</label>
            <label class="header_label">{{ $dt_empres->propietario }}</label>
            <label class="header_label">{{ $dt_empres->provincia->provincia }} - {{ $dt_empres->canton->canton }} {{ $dt_empres->dir }}</label>
            <label class="header_label">{{ $dt_empres->mail }}</label>
            <label class="header_label">{{ $dt_empres->cel_movi }} / {{ $dt_empres->cel_claro }}
              <label class="header_label">{{ $dt_empres->telefono }}</label>              
            </p>
          </fieldset>
        </caption>
        @endforeach
        <thead>
          <tr class="head_fac">
            <td class="border_round" colspan="1">
              @foreach($ventum as $or)
              <p>
                <strong>CLIENTE</strong>
                <label class="header_label">{{ $or->cliente }}</label><br/>
                <label class="header_label">{{ $or->cel_cli }}</label><br/>
                <label class="header_label">{{ $or->mail_cli }}</label><br/>                
                <strong>C.I.:</strong>
                <label class="header_label">{{ $or->cc_cli }}</label><br/>
                <strong>RUC.:</strong>
                <label class="header_label">{{ $or->ruc_cli }}</label><br/>
              </p>
              @endforeach
            </td>
            <td class="border_round" colspan="1">
             @foreach($ventum as $or)
             <p>              
              <strong>Fecha venta :</strong><label class="header_label">{{ $or->fecha }}</label><br/>
              <strong>Pagado :</strong><label class="header_label">{{ $or->total }}</label><br/>
              <strong>Pago:</strong><label class="header_label">{{ $or->typepay->type }}</label>
            </p>
            @endforeach
          </td>
          <td class="border_round" colspan="1">
            @foreach($ventum as $or)
            <strong>Factura #{{ $or->num_venta }}</strong><br/>
            @endforeach
            @foreach($almacen as $dt_empres)              
            <strong>Serie {{ $dt_empres->codestablecimiento }}-{{ $dt_empres->codpntemision }}</strong> <br/>             
            <strong>AUTIROZACION SRI {{ $dt_empres->auth_sri }}</strong>                
            @endforeach
          </td>
        </tr>
      </thead>
        <tbody>
        <tr class="align_left">
          <td colspan="3">
            <table class="tabladetall">
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
               <tr class="itemdetall">
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
        </td>
      </tr>
      <tr class="align_left">
        <td colspan="3" class="detallval">
          @foreach($ventum as $or)
          <strong>Subtotal</strong><label>{{ number_format($or->subtotal,2) }}</label><br/>
          <strong>Iva 0%</strong><label>{{ number_format($or->iva_cero,2) }}</label><br/>
          <strong>Iva {{ number_format($or->porcentaje_iva,2) }}%</strong>
          <label>{{ number_format($or->iva_calculado,2) }}</label><br/>
          <strong>Total</strong><label>{{ number_format($or->total,2) }}</label><br/>
          @endforeach 
        </td>
      </tr>           
    </tbody>

  </table>
  <table class="t_frm_detall">
    <tbody>
      <tr>
        <td><center><label class="header_label firma"><hr class="hr_fr"/>FIRMA AUTORIZADA :.......................................</label></center></td>
        <td><center><label class="header_label firma"><hr class="hr_fr"/>CLIENTE :.......................................</label></center></td>
      </tbody>
    </table>

    <table class="tabla">
      <tr>
        <td colspan="3">
          <p>
            <label class="header_label_clausula">
              *datos de clausula
            </label><br/>
          </p>
        </td>
      </tr>
    </table>

    <span> - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </span>

  </body>

  </html>
