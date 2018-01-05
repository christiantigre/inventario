<!DOCTYPE html>

<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link href="css/comprobante.css" rel="stylesheet"/>-->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap_prince.css">

    <title>{{ $nom_factura }}</title>
    <style>
    /*@import url(http://fonts.googleapis.com/css?family=Bree+Serif);*/
    body, h1, h2, h3, h4, h5, h6{
      font-family: Georgia, "Times New Roman", Times,, serif;
    }
    span, h4, .letra {
      font-family: "Times New Roman";
      font-size: 10px;
    }
    .titulo {
      font-family: "Arial Narrow", Arial, sans-serif;
      font-size: 12px;
      white-space: pre;
    }
    .titulopie {
      font-family: Tahoma, Verdana, Segoe, sans-serif;
      font-size: 12px;
      white-space: pre;
    }
    .row > .sinespacio {
      display: inline-block;
      margin: 0;
      float: left;
      white-space: nowrap;
    }
    .row > .limpiar {
      clear: both;
    }
    table {
      border: 0px;
      border-spacing: 0px;
      border-collapse: collapse;
    }
    td, th {
      padding: 0px;
      border: 0px;
      margin: 0px;
    }
    .izq {
      text-align: right;
    }
    .borde {
      border-style: solid;
      border-width: 1px;
      border-color: black;
      padding-bottom: 3px;
    }
    .logo {
      float: center;
      text-align: center;
      margin-bottom: 0px;
    }
    .fieldset_header{
      border: 1px solid #050505; padding: 10px;
      border-radius: 11px 11px 11px 11px;
      -moz-border-radius: 11px 11px 11px 11px;
      -webkit-border-radius: 11px 11px 11px 11px
    /*margin:3px;
    padding-bottom: 5px;
    padding-top: 5px;*/
    /*espacio desde margen hacia afuera*/
    margin-top: .5em;
    margin-bottom: .5em;
    margin-left: 1em;
    margin-right: .5em;

    /*espacio desde margen hacia dentro*/
    /*enpuja abajo*/padding-top: 5px;
    padding-bottom: -15px;
    padding-right: 5px;
    padding-left: 5px;
  }
  #field_head{
    /*padding-bottom: -7px;*/
  }
  .container{
    margin-top: 15px;
  }
  .detall_cli{
    margin-top: 5px;
  }
  p{
    line-height: 1px; 
  }
  p.intro{
    line-height: 1em; 
  }
  .serie{
    font: 10px Georgia, "Times New Roman", Times, serif;
  }
  .header_label{
    font: 10px Georgia, "Times New Roman", Times, serif;
  }
  h1 {
    font: 16px Georgia, "Times New Roman", Times, serif;
  }
  h2 {
    font: 12px Georgia, "Times New Roman", Times, serif;
  }
  strong{ font-size: 75%; }
}

.tabla{
  border: 1px solid #050505; padding: 10px;
  margin: 6; padding: 6;
  width: 100%;
  height: auto;
}
.tabladetall{
  margin: 6; padding: 6;
  width: 100%;
  height: auto;
}
tr.itemdetall td{
  font: 10px Georgia, "Times New Roman", Times, serif;
  border: 0;
}
.detallval{
  padding-top: 2px;
  padding-bottom: 2px;
  padding-left: 25px;
  padding-right: 25px;
  margin: 25px;
}
.detallval label{
  font: 10px Georgia, "Times New Roman", Times, serif;
}
/*.border{
  border: 1px solid #050505; padding: 10px; 
  }*/
  table.head_fac{
    background-color: #000000
  }
  tbody tr td.border_round{
    border-radius: 11px 11px 11px 11px;
    -moz-border-radius: 11px 11px 11px 11px;
    -webkit-border-radius: 11px 11px 11px 11px;
    border: 1px solid #000000;
  }
  td {
    border: 1px solid;
  }
  tr .border{
    border: blue 5px solid;
  }
  th{
    font: 12px Georgia, "Times New Roman", Times, serif;
  }
  tbody {
    /*border: blue 5px solid;*/
  }

  tr {
    border-bottom: 1px solid #ccc;
  }
  .align_right{text-align: left;}
  .align_center{text-align: center;}
  .align_left{text-align: right;}

  table.tabla tfoot {
    border-top: 2px solid black;
  }
  
  .tabla_media_right{
    margin: 6; padding-bottom: 6;
    text-align: right;
    width: 45%;
    height: auto;
    border: 1px solid #050505; padding: 10px;
    height: auto;
  }
  .tabla_media_left{
    margin: 6; padding-bottom: 6;
    width: 45%;
    height: auto;
    border: 1px solid #050505; padding: 10px;
  }

  .header_label_clausula{
    font: 9px Georgia, "Times New Roman", Times, serif;
  }
  hr .hr_fr{
    /*height: 1px;
    width: 30%;
    background-color: black;*/
    border: 0; border-top: 1px solid #999; border-bottom: 1px solid #333; height:0;
  }
  .t_frm_detall{
    width: 100%;
    height: 10%;
    border: 1px solid #050505; padding: 10px;
    margin: 6; padding: 6;
  }
  div.panel-heading{
    background-color: #000000;
    color: #ffffff;
  }
  #divfac{
    margin-top: -27px;
  }
  div.panel-body{
    margin-top: -15px;
  }

  h4.titulo_tab{
    font: 9px Georgia, "Times New Roman", Times, serif;
  }
  .table thead tr th h4{
    padding-bottom: -15px;
    padding-top: -15px;
  }
  .table tbody tr td h4{
    padding-bottom: -15px;
    padding-top: -15px;         
  }
  table.table{
    margin-right: 7px;
    margin-left: 7px;
  }
  .round{
    border: 1px solid #050505; padding: 10px;
    border-radius: 11px 11px 11px 11px;
    -moz-border-radius: 11px 11px 11px 11px;
    -webkit-border-radius: 11px 11px 11px 11px
  }
  .un{
    width: 5px;
    height: auto;
  }
  .ds{
    width: 15px;
    height: auto;
  }
  .tr{
    width: 10px;
    height: auto;
  }
  .ct{
    width: auto;
    height: auto;
  }
  .cs{
    width: 10px;
    height: auto;
  }
  .sx{
    width: 10px;
    height: auto;
  }
  .st{
    width: 10px;
    height: auto;
  }
  .detalle{
    font: 10px Georgia, "Times New Roman", Times, serif;        
  }
  @page { size:8.5in 11in; margin: 1cm }
</style>
</head>

<body>  
  <div class="container">
    <!--Encabezado del documento factura-->
    <fieldset id="field_head" class="fieldset_header">
      @foreach($almacen as $dt_empres)
      <div class="row">
        <div class="col-xs-4"></div>
        <div class="col-xs-4"><img src="uploads/logo/{{ $dt_empres->name_logo }}" height="30" width="130" alt="logo"/></div>
        <div class="col-xs-4"></div>
      </div>
      <p class="intro"> 
        <div class="row">
          <div class="col-xs-8">
            <em>
              <label class="header_label">
                {{ $dt_empres->slogan }}
                {{ $dt_empres->funcion_empresa }}
                Gerente {{ $dt_empres->gerente }} | Propietario {{ $dt_empres->propietario }}
                {{ $dt_empres->provincia->provincia }} - {{ $dt_empres->canton->canton }} {{ $dt_empres->dir }}
                {{ $dt_empres->mail }}{{ $dt_empres->cel_movi }} / {{ $dt_empres->cel_claro }} {{ $dt_empres->telefono }}
              </label>
            </em>
          </div>
          <div class="col-xs-4">
            <div class="col-xs-8">
              <div id="divfac" class="panel panel-default">
                <div class="panel-heading" style="background-color: #000000;color: #ffffff;">
                  <center><strong>FACTURA</strong></center>
                </div>
                <div class="panel-body" style="height: auto;">
                  <strong><center>#{{ $numero_factura }}</center></strong>
                  <strong><center>AUT.SRI.:{{$dt_empres->auth_sri}}</center></strong>
                </div>
              </div>
            </div>            
          </div>            
        </div>
      </p>
      @endforeach
    </fieldset>
    <!--seccion pre-detalle de factura-->
    <fieldset class="fieldset_header">        
      <div class="row">
        <div class="col-xs-4">
          @foreach($almacen as $dt_empres)
          <p class="intro">  
            <em>
              <label class="header_label">
                SERIE:{{ $dt_empres->codestablecimiento }}-{{$dt_empres->codpntemision}}
                <br/>
                R.U.C.:{{ $dt_empres->ruc}}
              </label>
            </em>
          </p>
          @endforeach
        </div>
        <div class="col-xs-4">
          @foreach($ventum as $or)
          <p class="intro">
            <em>
              <label class="detall_cli header_label">
                CLIENTE
                @if(!empty($or->cliente))
                {{ $or->cliente }}<br/>
                @endif                    
                @if(!empty($or->cel_cli))
                {{ $or->cel_cli }}<br/>
                @endif  
                @if(!empty($or->mail_cli))
                {{ $or->mail_cli }}<br/>
                @endif  
                @if(!empty($or->cc_cli))
                C.I.:{{ $or->cc_cli }}<br/>
                @endif
                @if(!empty($or->ruc_cli))
                RUC.:{{ $or->ruc_cli }}<br/>
                @endif  
              </label>
            </em>
          </p>
          @endforeach
        </div>
        <div class="col-xs-4">
          @foreach($ventum as $or)
          <p class="intro">
            <em>
              <label class="header_label">
                @if(!empty($or->fecha))
                FECHA : {{ $or->fecha }}<br/>
                @endif                    
                @if(!empty($or->id_typepay))
                TIPO PAGO : {{ $or->typepay->type }}<br/>
                @endif  
                @if(!empty($or->total))
                MONTO : {{ $or->total }}<br/>
                @endif                  
              </label>
            </em>
          </p>
          @endforeach
        </div>
      </div>
    </fieldset>

    <fieldset>
      <header class="clearfix">  
      </header>
      
      <!--Items de factura-->
      <table class="table table-bordered round">
        <thead>
          <tr>
            <th class="un"><center><h4 class="titulo_tab">#</h4></center></th>
            <th class="ds"><center><h4 class="titulo_tab">CODIGO</h4></center></th>
            <th class="tr"><center><h4 class="titulo_tab">CANT</h4></center></th>
            <th class="ct"><h4 class="titulo_tab">PRODUCTO</h4></th>
            <th class="cs"><center><h4 class="titulo_tab">P.V.P.</h4></center></th>
            <th class="sx"><center><h4 class="titulo_tab">DSCTO.</h4></center></th>
            <th class="st"><center><h4 class="titulo_tab">TOTAL</h4></center></th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1; ?>
          @foreach($detallventa as $item)
          <tr class="itemdetall">
            <td class="un" style="width: 10px"><center><h4 class="titulo_tab"><?Php echo $i; ?></h4></center></td>
            <td class="ds"><center><h4 class="titulo_tab">{{ $item->codbarra }}</h4></center></td>
            <td class="tr"><center><h4 class="titulo_tab">{{ $item->cant }}</h4></center></td>
            <td class="ct"><h4 class="titulo_tab">{{ $item->producto }}</h4></td>
            <td class="cs"><center><h4 class="titulo_tab">{{ $item->precio }}</h4></center></td>
            <td class="sx"><center><h4 class="titulo_tab">0</h4></center></td>
            <td class="st"><center><h4 class="titulo_tab">{{ $item->total }}</h4></center></td>
          </tr>
          <?Php $i++; ?>
          @endforeach 
        </tbody>
      </table>
      @foreach($ventum as $or)
      <!--FIRMAS-->
      <style type="text/css">
      .sinespacio{
        margin-right: 15px;
        margin-left: 15px;
      }
    </style>
    <div class="row sinespacio">
     <div class="col-xs-4">
      <div>
        <table class="detalle" id="det" style="border: none;">
          <tr style="border: none; ">
            <td style="border: none;font: 10px Georgia, "Times New Roman", Times, serif; ">
              <center>
                <label class="header_label firma"><hr class="hr_fr"/>FIRMA AUTORIZADA :.......................................</label>
              </center>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <div class="col-xs-4">
      <div>
        <table class="detalle" id="det" style="border: none;">
          <tr style="border: none; ">
            <td style="border: none;font: 10px Georgia, "Times New Roman", Times, serif; ">
              <center>
                <label class="header_label firma"><hr class="hr_fr"/>CLIENTE :.......................................</label>
              </center>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <!--detalle de factura-->
    <div class="col-xs-4">
      <p class="intro">
        <em>
          <table class="detalle" id="det" style="border: none;">
            <tr style="border: none; ">
              <td style="border: none;font: 10px Georgia, "Times New Roman", Times, serif; ">Subtotal.:</td><td style="border: none;font: 10px Georgia, "Times New Roman", Times, serif; ">$ {{ number_format($or->subtotal,2) }}</td>
            </tr>
            <tr style="border: none;">
              <td style="border: none;font: 10px Georgia, "Times New Roman", Times, serif; ">Iva 0%:</td><td style="border: none;font: 10px Georgia, "Times New Roman", Times, serif; ">$ {{ number_format($or->iva_cero,2) }}</td>
            </tr>
            <tr style="border: none;">            
              <td style="border: none;font: 10px Georgia, "Times New Roman", Times, serif; ">Descuento:</td><td style="border: none;font: 10px Georgia, "Times New Roman", Times, serif; ">$ {{ number_format(0,2) }}</td>
            </tr>
            <tr style="border: none;">
              <td style="border: none;font: 10px Georgia, "Times New Roman", Times, serif; ">Iva {{ number_format($or->porcentaje_iva,2) }}%:</td><td style="border: none;font: 10px Georgia, "Times New Roman", Times, serif; ">$ {{ number_format($or->porcentaje,2) }}</td>
            </tr>
            <tr style="border: none;">
              <td style="border: none;font: 10px Georgia, "Times New Roman", Times, serif; ">TOTAL.:</td><td style="border: none;font: 10px Georgia, "Times New Roman", Times, serif; ">$ {{ number_format($or->total,2) }}</td>
            </tr>
          </table>
        </em>
      </p>
    </div>         
  </div>
  @endforeach  
  <div class="row">    
    <div class="col-xs-12" style="margin-right: 15px; margin-left: 15px;">
      <style type="text/css">
      hr.hr_fin_fac {
        width: 100%;
        background-color: #050505;
      }
    </style>
    <label class="header_label">
      ORIGINAL ADQUIRIENTE: Blanco Adquiriente / COPIA: Color Emisor (SUCURSAL).
    </label>
    <hr class="hr_fin_fac"/>
  </div>  
</div>
<div class="col-xs-12" style="margin-right: 15px; margin-left: 15px;">
  <p class="intro">
    <em>
      <label class="header_label_clausula">

        *datos de clausula--- En el modelo de caja CSS, cualquier elemento (texto, imagen, etc.) está metido dentro de una caja rectangular que puede tener borde, margen interior y margen exterior.  En el modelo de caja CSS, cualquier elemento (texto, imagen, etc.) está metido dentro de una caja rectangular que puede tener borde, margen interior y margen exterior. 
        
      </label>
    </em>
  </p>
<style type="text/css">
  hr.hr_semicortada { 
    border: 1px dashed #050505; 
  }
</style>
  <hr class="hr_semicortada"/>
</div>
</div>
</body>

</html>
