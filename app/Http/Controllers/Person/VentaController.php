<?php

namespace App\Http\Controllers\Person;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cliente;
use App\Admin;
use App\Product;
use App\Ventum;
use App\ItemVenta;
use App\detallVenta;
use App\Almacen;
use App\Iva;
use App\Moneda;
use App\TypePay;
use App\Clausule;
use App\FacturacionElectronica;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use App\SvLog;
use App\Comprobante_venta;
use DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        $this->middleware('person', ['except' => 'logout']);
    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $venta = Ventum::where('fecha', 'LIKE', "%$keyword%")
            ->orWhere('cliente', 'LIKE', "%$keyword%")
            ->orWhere('cel_cli', 'LIKE', "%$keyword%")
            ->orWhere('ruc_cli', 'LIKE', "%$keyword%")
            ->orWhere('dir_cli', 'LIKE', "%$keyword%")
            ->orWhere('mail_cli', 'LIKE', "%$keyword%")
            ->orWhere('total', 'LIKE', "%$keyword%")
            ->orWhere('subtotal', 'LIKE', "%$keyword%")
            ->orWhere('iva_cero', 'LIKE', "%$keyword%")
            ->orWhere('iva_calculado', 'LIKE', "%$keyword%")
            ->orWhere('porcentaje_iva', 'LIKE', "%$keyword%")
            ->orWhere('can_items', 'LIKE', "%$keyword%")
            ->orWhere('vendedor', 'LIKE', "%$keyword%")
            ->orWhere('id_cliente', 'LIKE', "%$keyword%")
            ->orWhere('id_personal', 'LIKE', "%$keyword%")
            ->orWhere('id_iva', 'LIKE', "%$keyword%")
            ->paginate($perPage);
            $this->genLog("Busqueda datos :".$keyword);
        } else {
            $venta = Ventum::orderBy('id','DESC')->paginate($perPage);
            $this->genLog("Visualizó sección.");
        }

        return view('person.venta.index', compact('venta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->genLog("Ingresó a nuevo registro.");

        try {
            $mailAdmin = auth('admin')->user()->email;
            $adminid = auth('admin')->user()->id;
            $administrador = Admin::findOrFail($adminid);
            $dataArray['mail'] = $mailAdmin;          
            $dataArray['iduser'] = $adminid;          
        } catch (\Exception $e) {            
            $administrador = Admin::findOrFail(1);
        }
        $username = $administrador['name'];
        $userid = $administrador['id'];
        $useremail = $administrador['email'];
        ItemVenta::truncate();
        $cant_ventas = Ventum::count();
        $clientes = Cliente::all();
        //$products = Product::orderBy('id','ASC')->where('cantidad'>'0')->get();
        $products = \DB::table('products')->where('cantidad', '>', 0)->orderBy('id','ASC')->get();
        $cant_incr = $cant_ventas+1;
        $numbers     = $this->generate_numbers($cant_incr, 1, 8);
        $numero_venta = implode("", $numbers);
        $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
        $fecha_venta = $carbon->now()->format('Y-m-d H:i:s');
        $tipospagos = TypePay::orderBy('id', 'ASC')->pluck('type', 'id');

        return view('person.venta.create',compact('numero_venta','fecha_venta','clientes','products','cant_incr','username','userid','useremail','tipospagos'));
    }

    public function extraerdatoscliente(Request $request){
        if ($request->ajax()) {
            $cliente = Cliente::orderBy('id','DESC')->where('id',$request->id)->first();
            return response()->json($cliente);
        }
    }

    public static function generate_numbers($start, $count, $digits)
    {
        $result = array();
        for ($n = $start; $n < $start + $count; $n++) {
            $result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
        }
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $producto = ItemVenta::get();

        $dataVenta['num_venta'] = $request['num_factura'];
        $carbon = new Carbon();
        $date = $carbon->now();
        $dataVenta['fecha'] = $date->format('Y-m-d');
        $dataVenta['cliente'] = $request['cliente'];
        $dataVenta['cel_cli'] = $request['cel_cli'];
        $dataVenta['ruc_cli'] = $request['ruc_cli'];
        $dataVenta['cc_cli'] = $request['ced_cli'];
        $dataVenta['dir_cli'] = $request['dir_cli'];
        $dataVenta['mail_cli'] = $request['mail_cli'];
        $dataVenta['total'] = $request['total'];
        $dataVenta['subtotal'] = $request['subtotal'];
        $dataVenta['iva_cero'] = $request['iva_cero'];
        $dataVenta['iva_calculado'] = $request['iva_calculado'];
        $dataVenta['porcentaje_iva'] = $request['porcentaje_iva'];
        $dataVenta['can_items'] = ItemVenta::count();
        $dataVenta['vendedor'] = $request['vendedor'];
        $dataVenta['id_cliente'] = $request['id_cliente'];
        //$id_user = $request['id_user'];
        $dataVenta['id_iva'] = $request['idiva'];  
        $dataVenta['id_typepay'] = $request['id_typepay'];                
        /*dd($dataVenta); $requestData = $request->all();        
        Ventum::create($requestData);*/
        try {
            //Guarda cabecera de la factura
            $venta = Ventum::create($dataVenta);
            //envia los valore del detalle de la factura para guardar el detalle desde la funcion saveItem
            foreach ($producto as $product) {
                $requestData_returned = $this->saveItem($product,$venta->id,$dataVenta['fecha']);
                $requestData_returned->save();
            }
            //actualiza en inventario pasandole el parametro idventa a la función actualizaInventario para que realize la lectura de todos los productos que se encuentran en el detalle de la factura y actualize el inventario de todos los producto que estan en el detalle.
            $this->actualizaInventario($venta->id);
            //Envia al metodo generarFacturaXml y le pasa el id de la venta para generar el archivo factura xml de la venta realizada
            //$this->generarFacturaXml($venta->id);
            Session::flash('flash_message', 'Guardado correctamente');
            $this->genLog("Registró nuevo : ".$venta->id);
        } catch (\Exception $e) {
            Session::flash('warning', 'Error al Guardar');  
            $this->genLog("Error al registrar : ".$venta->id);       
        }
        //Redireccióna a ventana show con parametros, para visualizar el detalle de la venta
        return redirect()->route('detallventa', ['id' => $venta->id]);
    }

    public function detallventa($id){
        $ventum = Ventum::findOrFail($id);
        $detallventa= detallVenta::where('id_venta',$id)->get();
        $almacen = Almacen::first();
        return view('person.venta.show', compact('ventum','detallventa','almacen'));
    }

    //Recibe parametros de la funcion store para guardar el detalle de la factura.
    protected function saveItem($product, $order_id, $fecha)
    {
        $requestData = new detallVenta;
        $requestData->producto = $product->producto;
        $requestData->codbarra = $product->codbarra;
        $requestData->precio = $product->precio;
        $requestData->cant = $product->cant;
        $requestData->total = $product->total;
        $requestData->id_venta = $order_id;
        $requestData->id_producto = $product->id;
        $requestData->fecha_egreso = $fecha;
        return $requestData;
    }
    //Recibe parametros de funcion store para actualizar el inventario
    public function actualizaInventario($order_id)
    {
        $the_pedido = ItemVenta::select('id_producto','cant')->get();
        foreach ($the_pedido as $item) {
            $obj= Product::find($item->id_producto);
            if(!is_null($obj)){
                $cant=$obj->cantidad;
                $cantidad=$item->cant;
                $new_cant=$cantidad-$cant;
                if($new_cant<0){
                    $new_cant=$cant-$cantidad;
                }
                $obj->cantidad=$new_cant;
                $obj->update();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $ventum = Ventum::findOrFail($id);
        $detallventa= detallVenta::where('id_venta',$id)->get();
        $almacen = Almacen::first();
        $this->genLog("Visualizó venta id : ".$id);
        return view('person.venta.show', compact('ventum','detallventa','almacen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $ventum = Ventum::findOrFail($id);
        $cant_incr = $ventum->id;
        $numero_venta = $ventum->num_venta;
        $fecha_venta = $ventum->fecha_venta;
//numero_venta','fecha_venta','clientes','products','cant_incr','username','userid','useremail','tipospagos'

        $this->genLog("Ingresó actualizar venta id: ".$id);
        return view('person.venta.edit', compact('ventum','cant_incr','numero_venta','fecha_venta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();
        try {
            $ventum = Ventum::findOrFail($id);
            $ventum->update($requestData);
            $this->genLog("Actualizó venta id: ".$id);
        } catch (\Exception $e) {
            $this->genLog("Error al actualizar proveedor id: ".$id);
        }

        return redirect('person/venta')->with('flash_message', 'Ventum updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function print($id) {
        $this->genLog("Imprimio factura id: ".$id);

        /*$clausulas  = FormatOrden::orderBy('id', 'DESC')->get();
        $hoy        = new Carbon();
        $hoy        = Carbon::now(new \DateTimeZone('America/Guayaquil'));
        $orden      = Order::orderBy('id', 'DESC')->where('id', $id)->get();
        $ordenes    = Order::orderBy('id', 'DESC')->where('id', $id)->first();
        $tot_abonos = \DB::table('abonos')
            ->where('id_orden', $id)
            ->sum('abono');
        $anticipo = $ordenes->anticipo;

        $valor_reparacion = $ordenes->valor;
        $suma_anti_abono  = $tot_abonos + $anticipo;
        $pre_final        = $valor_reparacion - $suma_anti_abono;

        $empresa = Empres::orderBy('id', 'DESC')->where('id', 1)->get();
        $pdf     = \PDF::loadView('adminlte::layouts.order.comprobante', ['orden' => $orden, 'empresa' => $empresa, 'hoy' => $hoy]);
        $pdf     = \PDF::loadView('pdf.comprobante', [
            'orden'      => $orden,
            'empresa'    => $empresa,
            'hoy'        => $hoy,
            'tot_abonos' => $tot_abonos,
            'pre_final'  => $pre_final,
            'clausulas'  => $clausulas]);

            return $pdf->download('orden-#.pdf');*/
        //$clausulas = "Clausulas";
            $clausulas = Clausule::orderBy('id', 'DESC')->where('id', 1)->first();
            $ventum = Ventum::orderBy('id', 'DESC')->where('id', $id)->get();
            $venta = Ventum::findOrFail($id);
            $num_venta = $venta->num_venta;
            $nom_factura = "factura-#".$num_venta;
            $numero_factura = $venta->num_venta;
            $detallventa= detallVenta::where('id_venta',$id)->get();
            $almacen = Almacen::orderBy('id', 'DESC')->where('id', 1)->get();
        //return $almacen;
            $pdf     = \PDF::loadView('pdf.factura', [
                'ventum'      => $ventum,
                'detallventa'    => $detallventa,
                'almacen'        => $almacen,
                'clausulas'  => $clausulas,
                'nom_factura'  => $nom_factura,
                'numero_factura'=>$numero_factura,
                'clausulas'=>$clausulas,
            ]);

            return $pdf->download($nom_factura.'.pdf');
        }

        public function viewfactura($id){
            $this->genLog("Visualizó factura id: ".$id);

            $clausulas = "Clausulas";
            $ventum = Ventum::orderBy('id', 'DESC')->where('id', $id)->get();
            $venta = Ventum::findOrFail($id);
            $num_venta = $venta->num_venta;
            $nom_factura = "factura-#".$num_venta;
            $numero_factura = $venta->num_venta;
            $detallventa= detallVenta::where('id_venta',$id)->get();
            $almacen = Almacen::orderBy('id', 'DESC')->where('id', 1)->get();
        //return $almacen;
            $pdf     = \PDF::loadView('pdf.factura', [
                'ventum'      => $ventum,
                'detallventa'    => $detallventa,
                'almacen'        => $almacen,
                'clausulas'  => $clausulas,
                'nom_factura'  => $nom_factura,
                'numero_factura'=>$numero_factura
            ]);

        //return $pdf->download($nom_factura.'.pdf');
            return view('pdf.factura',compact('ventum','detallventa','almacen','clausulas','nom_factura','numero_factura'));
        }

        public function destroy($id)
        {
            try {
                Ventum::destroy($id);
                $this->genLog("Eliminó id:".$id);            
            } catch (\Exception $e) {

                $this->genLog("Error al eliminar id: ".$id);  
            }

            return redirect('person/venta')->with('flash_message', 'Ventum deleted!');
        }

        public function genera($id){
            $venta = Ventum::findOrFail($id);
            $factura = $venta['num_venta'];
            $claveacceso    = $this->generaclaveacceso($factura);
            $verificador    = $this->generaDigitoModulo11($claveacceso);
            $data['factura'] = $factura;
            $data['clavedeacceso'] = $claveacceso;
            $data['verificador'] = $verificador;
            $codigogenerado = $claveacceso . '' . $verificador . '';
            try {
                $comprobante = Comprobante_venta::create([
                    'id_venta' => $venta->id,
                    'numfactura' => $factura,
                    'claveacceso' => $codigogenerado,
                ]);
                $this->genLog("Registrado correctamente comprobante de venta id: ".$id); 
                if ($generado = $this->generarFacturaXml($id)) {
                    Comprobante_venta::where('id', $comprobante->id)
                    ->where('claveacceso', $comprobante->claveacceso)
                    ->update(['gen_xml' => 1]);
                }
            } catch (\Exception $e) {
                return $e;
                $comprobante = "ERROR".$e;
                $this->genLog("ERROR al crear comprobante de venta id: ".$id); 
            }
                
        }


        public function generaDigitoModulo11($cadena){
            $cadena            = trim($cadena);
            $baseMultiplicador = 7;
            $aux               = new \SplFixedArray(strlen($cadena));
            $aux               = $aux->toArray();
            $multiplicador     = 2;
            $total             = 0;
            $verificador       = 0;
            for ($i = count($aux) - 1; $i >= 0; --$i) {
                $aux[$i] = substr($cadena, $i, 1);
                $aux[$i] *= $multiplicador;
                ++$multiplicador;
                if ($multiplicador > $baseMultiplicador) {
                    $multiplicador = 2;
                }
                $total += $aux[$i];
            }

            if (($total == 0) || ($total == 1)) {
                $verificador = 0;
            } else {
                $verificador = (11 - ($total % 11) == 11) ? 0 : 11 - ($total % 11);
            }

            if ($verificador == 10) {
                $verificador = 1;
            }
            return $verificador;
        }


        public function generaclaveacceso($id){
            $venta = Ventum::findOrFail($id);
            $factura = $venta['num_venta'];

            $date           = Carbon::now();
            $date->timezone = new \DateTimeZone('America/Guayaquil');

            $d     = $date->format('d');
            $m     = $date->format('m');
            $y     = $date->format('Y');
            $fecha = $d . '' . $m . '' . $y;
            //tipo comprobante
            $tipocmprobante = '01';
            //ruc
            $dt_empress = Almacen::select()->first();
            $ruc        = $dt_empress->ruc;
            //ambiente
            $ambiente = $dt_empress->ambiente;
            //serie de factura = odigo establecimiento concatenado codigogo punto de emision
            $codestab      = $dt_empress->codestablecimiento;
            $codpntemision = $dt_empress->codpntemision;
            $cod           = $codestab . '' . $codpntemision;
            //serie factura
            $seriefac = $cod;
            //Numero factura
            $numerofactura = $factura;
            //numero cualquiera 8
            $random           = $this->randomlongitud(8);
            $numerocualquiera = $random;
            //tipo emision
            $tipoemision   = '1';
            $clavedeacceso = $fecha . '' . $tipocmprobante . '' . $ruc . '' . $ambiente . '' . $seriefac . '' . $numerofactura . '' . $numerocualquiera . '' . $tipoemision;
            //$verificador = $this->generaDigitoModulo11($clavedeacceso);
            //dd($clavedeacceso);
            $clavedeacceso = $clavedeacceso; 
            //.''.$verificador;

            //$verificador    = $this->generaDigitoModulo11($clavedeacceso);
        return $clavedeacceso;
        //dd($clavedeacceso);
    }



    public function generarFacturaXml($id){        
        $venta = Ventum::findOrFail($id);
        $items = detallVenta::where('id_venta',$id)->get();
        $perfils = Cliente::where('id',$venta['id_cliente'])->get();
        $sale_comprobante = Comprobante_venta::select('claveacceso', 'numfactura')->where('id_venta',$venta->id)->first();
        $dt_empress = DB::table('almacens')
            ->join('facturacion_electronicas', 'facturacion_electronicas.id_almacen', '=', 'almacens.id')
            ->select('facturacion_electronicas.*','almacens.*')
            ->get();
        $datos_empresa = Almacen::first();
        $facturacion = FacturacionElectronica::first();        
        //hacer $venta = $pedidoshow
        /*$pedidoshow = Pedido::select()->where('id', '=', $idpedido)->first();
        $items      = ItemPedido::where('pedido_id', '=', $pedidoshow->id)->orderBy('id', 'asc')->get();
        $perfils    = client::select()->where('id', '=', $pedidoshow->users_id)->get();
        $sale       = sales::select('claveacceso', 'numfactura')->where('pedido_id', '=', $idpedido)->first();

        $dt_empress = Empresaa::select()->get();
        */

        $xml     = new \DomDocument('1.0', 'UTF-8');
        $factura = $xml->createElement('factura');
        $factura->setAttribute('id', 'comprobante');
        $factura->setAttribute('version', '1.0.0');
        $factura = $xml->appendChild($factura);

        $infoTributaria = $xml->createElement('infoTributaria');
        $infoTributaria = $factura->appendChild($infoTributaria);

        foreach ($dt_empress as $dt_empres) {
            $ambiente = $xml->createElement('ambiente', $dt_empres->modo_ambiente);
            $ambiente = $infoTributaria->appendChild($ambiente);

            $tipoEmision = $xml->createElement('tipoEmision', '1');
            $tipoEmision = $infoTributaria->appendChild($tipoEmision);

            $razonSocial = $xml->createElement('razonSocial', $dt_empres->propietario);
            $razonSocial = $infoTributaria->appendChild($razonSocial);

            $nombreComercial = $xml->createElement('nombreComercial', $dt_empres->almacen);
            $nombreComercial = $infoTributaria->appendChild($nombreComercial);

            $ruc = $xml->createElement('ruc', $dt_empres->ruc);
            $ruc = $infoTributaria->appendChild($ruc);

            $claveAcceso = $xml->createElement('claveAcceso', $sale_comprobante->claveacceso);
            $claveAcceso = $infoTributaria->appendChild($claveAcceso);

            $codDoc = $xml->createElement('codDoc', '01');
            $codDoc = $infoTributaria->appendChild($codDoc);

            $estab = $xml->createElement('estab', $dt_empres->codestablecimiento);
            $estab = $infoTributaria->appendChild($estab);

            $ptoEmi = $xml->createElement('ptoEmi', $dt_empres->codpntemision);
            $ptoEmi = $infoTributaria->appendChild($ptoEmi);

            $secuencial = $xml->createElement('secuencial', $sale_comprobante->numfactura);
            $secuencial = $infoTributaria->appendChild($secuencial);

            $dirMatriz = $xml->createElement('dirMatriz', $dt_empres->dir);
            $dirMatriz = $infoTributaria->appendChild($dirMatriz);
        }

        

        foreach ($perfils as $perfil) {

            $cedula = $datos_empresa->cedula;
            $ruc    = $datos_empresa->ruc;
            if (!empty($ruc)) {
                $identificacion = '04'; //ruc
                $id             = $ruc;
            } elseif (!empty($cedula)) {
                $identificacion = '05'; //cedula
                $id             = $cedula;
            }
            //soluionar que sea seleccionable el iva en el almacen
            //Solucionar que la moneda se seleccione en almacen
//sss
            $tabiva          = Iva::select()->where('activo', 1)->first();
            $monedas         = Moneda::select()->where('estado', 1)->first();
            $iva             = $tabiva->iva;
            $codporcentaje   = $tabiva->codporcentaje;
            $tarifa          = $iva * 1;
            $valor           = $iva + 100;
            $obtnvl          = $valor / 100;
            $totalfactura    = $venta->total;
            $valsinimpuestos = $totalfactura / $obtnvl;

            $valor = $totalfactura - $valsinimpuestos;

            $infoFactura = $xml->createElement('infoFactura');
            $infoFactura = $factura->appendChild($infoFactura);
            //reemplazar feha por date
            $fechaEmision = $xml->createElement('fechaEmision', $venta['fecha']);
            $fechaEmision = $infoFactura->appendChild($fechaEmision);

            $dirEstablecimiento = $xml->createElement('dirEstablecimiento', $datos_empresa->dir);
            $dirEstablecimiento = $infoFactura->appendChild($dirEstablecimiento);
            if ($facturacion->obligado_contabilidad == 0) {
                $obligado = "NO";
            } else {
                $obligado = "SI";
            }

            $obligadoContabilidad = $xml->createElement('obligadoContabilidad', $obligado);
            $obligadoContabilidad = $infoFactura->appendChild($obligadoContabilidad);

            $tipoIdentificacionComprador = $xml->createElement('tipoIdentificacionComprador', $identificacion);
            $tipoIdentificacionComprador = $infoFactura->appendChild($tipoIdentificacionComprador);

            $razonSocialComprador = $xml->createElement('razonSocialComprador', $perfil->nom_cli . ' ' . $perfil->app_cli);
            $razonSocialComprador = $infoFactura->appendChild($razonSocialComprador);

            $identificacionComprador = $xml->createElement('identificacionComprador', $id);
            $identificacionComprador = $infoFactura->appendChild($identificacionComprador);

            $totalSinImpuestos = $xml->createElement('totalSinImpuestos', number_format($valsinimpuestos, 2, '.', ','));
            $totalSinImpuestos = $infoFactura->appendChild($totalSinImpuestos);
            
            if($venta->descuento==null){
                $venta_descuento = '0.00';
            }else{
                $venta_descuento = number_format($venta->descuento,2);
            }

            $totalDescuento = $xml->createElement('totalDescuento', $venta_descuento);
            $totalDescuento = $infoFactura->appendChild($totalDescuento);

            $totalConImpuestos = $xml->createElement('totalConImpuestos');
            $totalConImpuestos = $infoFactura->appendChild($totalConImpuestos);

            $totalImpuesto = $xml->createElement('totalImpuesto');
            $totalImpuesto = $totalConImpuestos->appendChild($totalImpuesto);

            $codigo = $xml->createElement('codigo', '2');
            $codigo = $totalImpuesto->appendChild($codigo);
            //Revidar de donde viene la variable de codporcentaje
             dd($codigo);

            $codigoPorcentaje = $xml->createElement('codigoPorcentaje', $codporcentaje);
            $codigoPorcentaje = $totalImpuesto->appendChild($codigoPorcentaje);

            $baseImponible = $xml->createElement('baseImponible', number_format($valsinimpuestos, 2, '.', ','));
            $baseImponible = $totalImpuesto->appendChild($baseImponible);

            $tarifa = $xml->createElement('tarifa', $tarifa);
            $tarifa = $totalImpuesto->appendChild($tarifa);

            $valor = $xml->createElement('valor', number_format($valor, 2, '.', ','));
            $valor = $totalImpuesto->appendChild($valor);

            $propina = $xml->createElement('propina', number_format($venta->propina, 2, '.', ','));
            $propina = $infoFactura->appendChild($propina);

            $importeTotal = $xml->createElement('importeTotal', $totalfactura);
            $importeTotal = $infoFactura->appendChild($importeTotal);

            $moneda = $xml->createElement('moneda', $monedas->moneda);
            $moneda = $infoFactura->appendChild($moneda);

            $pagos = $xml->createElement('pagos');
            $pagos = $infoFactura->appendChild($pagos);

            $pago = $xml->createElement('pago');
            $pago = $pagos->appendChild($pago);

            $formaPago = $xml->createElement('formaPago', '01');
            $formaPago = $pago->appendChild($formaPago);

            $total = $xml->createElement('total', number_format($totalfactura, 2, '.', ','));
            $total = $pago->appendChild($total);
        }

        $detalles = $xml->createElement('detalles');
        $detalles = $factura->appendChild($detalles);
        foreach ($items as $item) {
            $product = product::select()->where('id', '=', $item->products_id)->first();
            $detalle = $xml->createElement('detalle');
            $detalle = $detalles->appendChild($detalle);

            $codigoPrincipal = $xml->createElement('codigoPrincipal', $product->slug);
            $codigoPrincipal = $detalle->appendChild($codigoPrincipal);

            $codigoAuxiliar = $xml->createElement('codigoAuxiliar', $product->id);
            $codigoAuxiliar = $detalle->appendChild($codigoAuxiliar);

            $descripcion = $xml->createElement('descripcion', $product->prgr_tittle);
            $descripcion = $detalle->appendChild($descripcion);

            $cantidadproducto = $item->cant;
            $precioventa      = ($product->pre_ven * $cantidadproducto);

            $cantidad       = $xml->createElement('cantidad', $cantidadproducto);
            $cantidad       = $detalle->appendChild($cantidad);
            $productoprecio = $product->pre_ven;
            $valsiniv       = $productoprecio / $obtnvl;
            $ivcero         = $iva / 100;
            $valiv          = $valsiniv * $ivcero;

            $precioUnitario = $xml->createElement('precioUnitario', number_format($valsiniv, 2, '.', ','));
            $precioUnitario = $detalle->appendChild($precioUnitario);

            $descuento = $xml->createElement('descuento', $item->descuento);
            $descuento = $detalle->appendChild($descuento);

            $totsininpuesto = $precioventa * $cantidadproducto;
            $sinInp         = ($valsiniv * $cantidadproducto);

            //$precioTotalSinImpuesto = $xml->createElement('precioTotalSinImpuesto',number_format($valsinimpuestos, 2, '.', ','));
            $precioTotalSinImpuesto = $xml->createElement('precioTotalSinImpuesto', number_format($sinInp, 2, '.', ','));
            $precioTotalSinImpuesto = $detalle->appendChild($precioTotalSinImpuesto);

            $impuestos = $xml->createElement('impuestos');
            $impuestos = $detalle->appendChild($impuestos);

            $impuesto = $xml->createElement('impuesto');
            $impuesto = $impuestos->appendChild($impuesto);

            $codigo = $xml->createElement('codigo', '2');
            $codigo = $impuesto->appendChild($codigo);

            $codigoPorcentaje = $xml->createElement('codigoPorcentaje', $codporcentaje);
            $codigoPorcentaje = $impuesto->appendChild($codigoPorcentaje);

            $tarifa = $xml->createElement('tarifa', $iva);
            $tarifa = $impuesto->appendChild($tarifa);

            //$baseImponible = $xml->createElement('baseImponible',number_format($valsinimpuestos, 2, '.', ','));
            $baseImponible = $xml->createElement('baseImponible', number_format($sinInp, 2, '.', ','));
            $baseImponible = $impuesto->appendChild($baseImponible);

            $totivaval = $valiv * $cantidadproducto;

            $valor = $xml->createElement('valor', number_format($totivaval, 2, '.', ','));
            $valor = $impuesto->appendChild($valor);
        }

        $infoAdicional = $xml->createElement('infoAdicional');
        $infoAdicional = $factura->appendChild($infoAdicional);
        foreach ($perfils as $adicionalperson) {
            if ($adicionalperson->dir1 == "") {
                $direccionuno = "n/s";
            } else {
                $direccionuno = $adicionalperson->dir1;
            }
            if ($adicionalperson->dir2 == "") {
                $direcciondos = "n/s";
            } else {
                $direcciondos = $adicionalperson->dir2;
            }

            //$campoAdicional = $xml->createElement('campoAdicional',$adicionalperson->dir1.' y '.$adicionalperson->dir2);
            $campoAdicional = $xml->createElement('campoAdicional', $direccionuno . ' y ' . $direcciondos);
            $campoAdicional->setAttribute('nombre', 'Direccion');
            $campoAdicional = $infoAdicional->appendChild($campoAdicional);
            if ($adicionalperson->telefono == "") {
                $telefonocli = "n/s";
            } else {
                $telefonocli = $adicionalperson->telefono;
            }

            //$campoAdicional = $xml->createElement('campoAdicional',$adicionalperson->telefono);
            $campoAdicional = $xml->createElement('campoAdicional', $telefonocli);
            $campoAdicional->setAttribute('nombre', 'Telefono');
            $campoAdicional = $infoAdicional->appendChild($campoAdicional);

            $campoAdicional = $xml->createElement('campoAdicional', $adicionalperson->email);
            $campoAdicional->setAttribute('nombre', 'Email');
            $campoAdicional = $infoAdicional->appendChild($campoAdicional);
        }
        

        $xml->formatOutput = true;
        $el_xml            = $xml->saveXML();
        /*\DB::table('comprobante_ventas')
            ->where('id_venta', $id)
            ->update(['gen_xml' => '1']);*/
        //$rout = $this->makeDir('generados');

        $xml->save('archivos/generados/' . $sale_comprobante->claveacceso . '.xml');

        htmlentities($el_xml);
        return response($el_xml)->header('Content-Type', 'text/xml');
        
        
        
        /*$xml     = new \DomDocument('1.0', 'UTF-8');
        $factura = $xml->createElement('factura');
        $factura->setAttribute('id', 'comprobante');
        $factura->setAttribute('version', '1.0.0');
        $xml->formatOutput = true;
        $el_xml            = $xml->saveXML();

        $xml->save('archivos/generados/' . $sale_comprobante->claveacceso . '.xml');
        return $xml;

        htmlentities($el_xml);
        return response($el_xml)->header('Content-Type', 'text/xml');
        */
        
    }


    public function randomlongitud($longitud)
    {
        $generado   = '';
        $collection = '123456789';
        $max        = strlen($collection) - 1;
        for ($i = 0; $i < $longitud; $i++) {
            $generado .= $collection{mt_rand(0, $max)};
        }

        return $generado;
    }



    public function genLog($mensaje)
    {
        $area = 'Venta';
        $logs = Svlog::log($mensaje,$area);
    }

    protected function guard()
    {
        return Auth::guard('person');
    }





}
