<!DOCTYPE html>

<html>

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

  <title>Factura Electr&oacute;nica</title>
  <link href="{{ asset('css/factura.css') }}" rel="stylesheet"/>
  

</head>

<body>
  <header class="clearfix">
    <h1>FACTURA</h1>    
  </header>
  <table class="factura" width="450" border="0" cellspacing="0">

    <tr>

      <td>

       <table width="100%" border="0">

        <tr>
          
          <td width="49%" rowspan="2"  align="center" valign= "bottom">
            <div class="logo">
              <img src="images/logo.png" height="100" alt="logo"/>
            </div>
            <br/>

            <span style="font-size:18px;">
              <strong>
                {{
                $dt_empress['almacen']
                }}
            </strong></span><br/>

            <span style="font-size:12px;"><strong>Dir. MATRIZ: </strong>
{{
                $dt_empress['dirMatriz']
}}             
              <br/>

              <strong>Dir. SUCURSAL: </strong>
              {{
                $dt_empress['dirSucursal']
              }}
              
              <br/>

              <strong class="inportant">OBLIGADO A LLEVAR CONTABILIDAD: 
                @if ($facturacion['obligado_contabilidad']==0)
                NO
                @elseif($facturacion['obligado_contabilidad']==1)
                SI           
                @endif</strong><br/>
                <strong>Teléfonos : </strong>
                 {{
                   $dt_empress['telefono']
                 }}
                <br/>
                <strong>Móvil : </strong>
                {{

                $dt_empress['cel_movi']
                }}
              /
              {{

                 $dt_empress['cel_claro']
              }}
              
              
              <br/>
                <strong>Fax : </strong>
                {{

                $dt_empress['fax']
                }}               
                <br/>
                
              </span></td>
              
            </tr>

            <tr>

              <td align="left" >
                <fieldset id="datafac" class="radius">
                  <span style="font-size:12px;"><strong class="negrita">R.U.C. {{ $dt_empress['ruc'] }}</strong></span><br/><br/>
                  <span style="font-size:22px;"><center>FACTURA</center></span><br/><br/>
                  <span style="font-size:12px;">No. {{ $dt_empress['codestablecimiento'] }}-{{ $dt_empress['codpntemision'] }}-{{ $comprobante['numfactura'] }}<br/><br/>
                    <strong class="negrita">N&Uacute;MERO DE AUTORIZACI&Oacute;N:</strong><br/>
                    {{ $comprobante['num_autorizacion'] }}
                    <br/><br/>
                    <strong class="negrita">FECHA Y HORA DE AUTORIZACI&Oacute;N:</strong><br/>
                    {{ $comprobante['fecha_autorizacion'] }}
                    <br/><br/>
                    <strong class="negrita">AMBIENTE: </strong>@if($facturacion['modo_ambiente']==1)
                    PRUEBAS
                    @elseif($facturacion['modo_ambiente']==2)
                    PRODUCCIÓN
                    @endif
                    <br/><br/>
                    <strong class="negrita">EMISI&Oacute;N:  </strong>{{$facturacion['tipo_emision']}}<br/><br/>
                    CLAVE DE ACCESO:<br/>
                    <br/>                    
                    <div class="container text-center" style="border: 0px solid #a1a1a1;padding: 15px;width: 5px;">
                      <img width="300" height="75" src="data:image/png;base64,{{DNS1D::getBarcodePNG($comprobante['claveacceso'], 'C39+',1,44) }}" alt="barcode"   />
                      <span style="font-size:11px;">{{ $comprobante['claveacceso'] }}</span>
                    </div>
                  </span>
                </fieldset>
              </td>

            </tr>

          </table>

        </td>
      </tr>
      <tr>

        <td>

          <fieldset class="radius">
            @foreach($aux_clientes as $cliente)                  

            <table width="100%" border="0">
              <tr>
                <td class="negrita">Raz&oacute;n Social / Nombres y Apellidos:</td>
                
                <td>
                  {{

                  $cliente->nom_cli
                  }}
                  
{{
  
                  $cliente->app_cli
}}


              </td>   
                <td class="negrita">RUC / CI: </td>
                <td>
                  {{

                  $cliente->ruc_cli
                  }}
                  
            </td>    
              </tr>
              <tr>
                <td class="negrita">Fecha Emisi&oacute;n:</td>
                <td>{{ $date }}</td>
                <td class="negrita">Gu&iacute;a Remisi&oacute;n:</td>
                <td></td>   
              </tr>
            </table>
            @endforeach

          </fieldset>

        </td>
      </tr>
      <tr>

        <td>
          <table class="detall" width="100%" border="1" cellspacing="0">
            <tr>
              <td><div align="center" class="inportant">Cod. Principal</div></td>
              <td><div align="center" class="inportant">Cod. Aux</div></td>
              <td><div align="center" class="inportant">Descripci&oacute;n</div></td>
              <td><div align="center" class="inportant">Cant</div></td>
              <td><div align="center" class="inportant">Precio Unitario</div></td>
              <td><div align="center" class="inportant">Descuento</div></td>
              <td><div align="center" class="inportant">Precio Total</div></td>
            </tr>
            @foreach($items as $item)                  

            <tr bgcolor=#FFFFFF>
              <td align="center">{{ $item->id_producto }}</td>
              <td align="center">{{ $item->codbarra }}</td>
              <td align="center">{{ $item->producto }}</td>
              <td align="center">{{ $item->cant }}</td>
              <td align="center">{{ number_format($item->precio,2) }}</td>
              <td align="center">{{ number_format(0,2) }}</td>
              <td align="center">{{ number_format((($item->cant)*($item->precio)),2) }}</td>
            </tr> 

            @endforeach
          </table>
        </td>
      </tr>
      <tr>
        <td align="right">

         <table width="100%" border="0" cellspacing="0">
           <tr>
             <td width="67%">
              <fieldset class="radius">
                @foreach($aux_clientes as $cli)                  
                <strong>INFORMACI&Oacute;N ADICIONAL</strong>
                <table>
                  <tr>
                    <td class="negrita">E-MAIL:</td><td>{{ $cli->mail_cli }}</td>
                  </tr>
                  <tr>
                    <td class="negrita">Dirección :</td> <td>{{ $cli->dir_cli }}</td>
                  </tr>
                  <tr>
                    <td class="negrita">Teléfono :</td> <td>{{ $cli->tlf_cli }}</td>
                  </tr>
                  <tr>
                    <td class="negrita">Móvil :</td> <td>{{ $cli->clmovi_cli }} / {{ $cli->clclr_cli }}</td>
                  </tr>
                </table>
                <strong>INFORMACI&Oacute;N ENTREGA</strong>
                <table>
                  
                  <tr>
                    <td class="negrita">ENTREGA :</td><td>{{ $aux_sales->entrega->metodo }}</td>
                  </tr>
                  
                </table>
                @endforeach
              </fieldset>
            </td>
            <td width="33%">
              
              <table border="0" cellspacing="0" align="right" width="160">
               <tr>  
                <td>SUBTOTAL {{ number_format($aux_sales['porcentaje_iva'],2) }} %</td>
                <td align="right" width="40">{{ number_format($aux_sales['subtotal'],2) }}</td>
              </tr>
              <tr>
                <td>SUBTOTAL 0.00 %</td>
                <td align="right">0</td>
              </tr>
              <tr>
                <td>SUBTOTAL No sujeto de IVA</td>
                <td align="right">0</td>
              </tr>
              <tr>
                <td>SUBTOTAL SIN IMPUESTOS</td>
                <td align="right">{{ number_format($aux_sales['subtotal'],2) }}</td>
              </tr>
              <tr>
                <td>DESCUENTO</td>
                <td align="right">{{ number_format($aux_sales['descuento'],2) }}</td>
              </tr>
              <tr>
                <td>ICE</td>
                <td align="right">0</td>
              </tr>
              <tr>
                <td>IVA  {{ number_format($aux_sales['porcentaje_iva'],2) }}%:</td>
                <td align="right">{{ number_format($aux_sales['iva_calculado'],2) }}</td>
              </tr>
              <tr>
                <td>PROPINA</td>
                <td align="right">{{ number_format($aux_sales['propina'],2) }}</td>
              </tr>
              <tr class="negrita">
                <td >VALOR TOTAL</td>
                <td align="right">{{ number_format($aux_sales['total'],2) }}</td>
              </tr>
            </table> 

            

          </td>
        </tr>
      </table> 
    </td>

  </tr>



</table>
<footer class="footer">
  <center>
    
    {{ $dt_empress['almacen'] }} {{ $dt_empress['funcion_empresa'] }} Contáctos ( {{ $dt_empress['telefono'] }} ) Celulár {{ $dt_empress['cel_movi'] }} / {{ $dt_empress['cel_claro'] }} fáx {{ $dt_empress['fax'] }} Dir Matriz {{ $dt_empress['dirMatriz'] }} - Dir Sucursal {{ $dt_empress['dirSucursal'] }} nuestra página web {{ $dt_empress['pag_web'] }}.
      {{ $dt_empress['propietario'] }} correo {{ $dt_empress['email'] }}.
    
  </center>
</footer>
</body>

</html>
