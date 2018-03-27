<?php

namespace App\Http\Controllers\Person;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cliente;
use App\Admin;
use App\Person;
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
use App\Entrega;
use \Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\Mail;
use App\Mail\comprobantesMail;

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
            $mailAdmin = auth('person')->user()->email;
            $adminid = auth('person')->user()->id;
            $administrador = Person::findOrFail($adminid);
            $dataArray['mail'] = $mailAdmin;          
            $dataArray['iduser'] = $adminid;          
        } catch (\Exception $e) {            
            $administrador = Person::findOrFail(1);
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
        $numbers     = $this->generate_numbers($cant_incr, 1, 9);
        $numero_venta = implode("", $numbers);
        $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
        $fecha_venta = $carbon->now()->format('Y-m-d H:i:s');
        $tipospagos = TypePay::orderBy('id', 'ASC')->pluck('type', 'id');

        $entregas = Entrega::where('activo',1)->orderBy('id', 'ASC')->pluck('metodo', 'id');

        return view('person.venta.create',compact('numero_venta','fecha_venta','clientes','products','cant_incr','username','userid','useremail','tipospagos','entregas'));
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
        $dataVenta['id_user'] = $request['vendedor'];
        //$id_user = $request['id_user'];
        $dataVenta['id_iva'] = $request['idiva'];  
        $dataVenta['id_typepay'] = $request['id_typepay'];                
        $dataVenta['id_entrega'] = $request['id_entrega'];                

        try {
            //Guarda cabecera de la factura
            $venta = Ventum::create($dataVenta);
            $this->guarda_comprobante($venta->id);
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
            $this->genLog("Venta Registrada de id : ".$venta->id);
        } catch (\Exception $e) {
            Session::flash('warning', 'Error al Guardar');  
            $this->genLog("Error al registrar venta id : ".$venta->id);       
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

        public function verfacturas(){
            return "facturas";
        }

        
        public function procesosfacturacion($id){

            $rutai         = public_path();
            $ruta          = str_replace("\\", "//", $rutai);

            if (!empty($id)) {
                $venta = Ventum::findOrFail($id);
                $comprobante   = Comprobante_venta::where('id_venta',$id)->first();
                $nombrearchivo = $comprobante['claveacceso'];
                $nombrearchivo = $nombrearchivo.'.xml';

                if(count($venta)>0){

                    try {
                        $genera    = $this->genera($id);
                        //verificar si existe el archivo
                        $generado     = $ruta . '/archivos//generados' . '/'.$nombrearchivo;

                        if (!empty($generado)) {
                            if (\File::exists($generado)) {

                                try {

                                    $firma    = $this->firmarFactura($id); 

                                    $firmado      = $ruta . '//archivos//firmados//'.$nombrearchivo;

                                    if (\File::exists($firmado)) {


                                        $autoriza    = $this->autorizar($id);

                                        $autorizado   = $ruta . '//archivos//' . 'autorizados' . '//'.$nombrearchivo;

                                        try {

                                            if (\File::exists($autorizado)) {
                                                $revisar = $this->revisarXml($id);
                                            }else{

                                                return "No se encuentra el archivo autorizado";

                                            } 

                                        } catch (\Exception $e) {
                                            return "No se encuentra el archivo firmado";
                                        }

                                    }else{
                                        return "No se pudo obtener autorizacion";
                                    }

                                } catch (\Exception $e) {
                                    return "No se pudo firmar el archivo";
                                }


                            }else{
                                $this->procesosfacturacion($id);
                            }

                        }else{
                            $this->procesosfacturacion($id);
                        }
                        

                    } catch (\Exception $e) {
                        return "No se pudo generar el archivo xml";
                    }

                }else{
                    return "No hay registro de esta venta";
                }

            }else{
                return "No se recibio la variable";
            }

        }

        public function guarda_comprobante($id){
            $venta = Ventum::findOrFail($id);
            $factura = $venta['num_venta'];
            //retorna cadena de 50 caracteres
            $claveacceso    = $this->generaclaveacceso($id);
            $verificador    = $this->generaDigitoModulo11($claveacceso);
            $data['factura'] = $factura;
            $data['clavedeacceso'] = $claveacceso;
            $data['verificador'] = $verificador;
            //Genera cadena de 51 caracteres
            $codigogenerado = $claveacceso . '' . $verificador . '';

            try {



                $comprobante = Comprobante_venta::create([
                    'id_venta' => $venta->id,
                    'numfactura' => $factura,
                    'claveacceso' => $codigogenerado,
                ]);


                $this->genLog("Registró comprobante : ".$codigogenerado);


            } catch (\Exception $e) {
                $this->genLog("No se registro comprobante : ".$e);   
            }
        }

        //PROCESOS INDEPENDIENTES
        public function generafactura($id){

            $rutai         = public_path();
            $ruta          = str_replace("\\", "//", $rutai);

            try {
                $venta = Ventum::findOrFail($id);
                $comprobante = Comprobante_venta::where('id_venta',$id)->first();

                $archivo = $comprobante['claveacceso'].".xml";

                $archivogenerado     = $ruta . '/archivos//generados' . '/'.$archivo;

                if (\File::exists($archivogenerado)) {

                    Session::flash('warning', 'El archivo ya existe.');   

                }else{
                    if ($generado =$this->genera($id)) {
                        Comprobante_venta::where('id', $comprobante['id'])
                        ->where('claveacceso', $comprobante['claveacceso'])
                        ->update(['gen_xml' => 1]);
                        
                        $this->genLog("Comprobante generado venta_id: ".$id);
                        Session::flash('flash_message', 'Acción realizada con exito.');

                    }
                }

                
            } catch (\Exception $e) {
                $this->genLog("No se genero comprobante venta_id: ".$id);
                Session::flash('warning', 'No se pudo realizar esta acción'); 
            }

            return redirect('person/facturacion');

        }

        public function f_firmafactura($id){

            $rutai         = public_path();
            $ruta          = str_replace("\\", "//", $rutai);

            try {

                $comprobante = Comprobante_venta::where('id_venta',$id)->first();

                $archivo = $comprobante['claveacceso'].".xml";

                $archivogenerado     = $ruta . '/archivos//generados' . '/'.$archivo;
                $archivofirmado     = $ruta . '/archivos//firmados' . '/'.$archivo;

                if (\File::exists($archivogenerado)) {

                    if (\File::exists($archivofirmado)) {
                        Session::flash('warning', 'Ya existe un archivo firmado, no se puede continuar.'); 
                    }else{
                        if ($firmado =$this->firmarFactura($id)) {
                            Comprobante_venta::where('id_venta', $id)
                            ->update(['fir_xml' => 1]);

                            $this->genLog("Comprobante firmado venta_id: ".$id);
                            Session::flash('flash_message', 'Documento firmado con exito.');
                        }
                    }

                }else{
                    Session::flash('warning', 'No se encuentra el archivo generado.');     
                }

                

            } catch (\Exception $e) {
                $this->genLog("No se genero firmo el comprobante venta_id: ".$id);
                Session::flash('warning', 'No se pudo firmar el comprobante.'); 
            }

            return redirect('person/facturacion');
        }

        public function f_autorizarfactura($id){

            $rutai         = public_path();
            $ruta          = str_replace("\\", "//", $rutai);

            try {

                $comprobante = Comprobante_venta::where('id_venta',$id)->first();

                $archivo = $comprobante['claveacceso'].".xml";

                $archivofirmado     = $ruta . '/archivos//firmados' . '/'.$archivo;
                $archivoautorizado     = $ruta . '/archivos//autorizados' . '/'.$archivo;

                if (\File::exists($archivofirmado)) {

                    if (\File::exists($archivoautorizado)) {
                        Session::flash('warning', 'Ya existe un archivo autorizado, no se puede continuar.'); 
                    }else{

                        if ($autorizado = $this->autorizar($id)) {

                            

                            $this->genLog("Comprobante respuesta venta_id: ".$id." / mensaje ".$autorizado);
                            Session::flash('flash_message', 'Respuesta '.$autorizado);

                            try {
                                $this->revisarXml($id);
                            } catch (\Exception $e) {

                            $this->genLog("Revisado xml venta_id: ".$id);
                                
                            }

                        }

                    }

                }else{
                    Session::flash('warning', 'No se encuentra el archivo firmado.');     
                }

                

            } catch (\Exception $e) {
                $this->genLog("No se pudo autorizar el comprobante venta_id: ".$id);
                Session::flash('warning', 'No se pudo autorizar el comprobante.'); 
            }

            return redirect('person/facturacion');
        }



        public function f_generarpdf($id){
            $rutai         = public_path();
            $ruta          = str_replace("\\", "//", $rutai);

            try {

                $comprobante = Comprobante_venta::where('id_venta',$id)->first();

                $archivo = $comprobante['claveacceso'].".xml";
                $archivopdf = $comprobante['claveacceso'].".pdf";

                $archivoautorizado     = $ruta . '/archivos//autorizados' . '/'.$archivo;
                $archivopdf     = $ruta . '/archivos//pdf' . '/'.$archivopdf;

                if (\File::exists($archivoautorizado)) {

                    if (\File::exists($archivopdf)) {
                        Session::flash('warning', 'Ya existe un archivo pdf, no se puede continuar.'); 
                    }else{

                        if ($pdf = $this->generaPdf($id)) {

                            Comprobante_venta::where('id', $comprobante['id'])
                        ->where('claveacceso', $comprobante['claveacceso'])
                        ->update(['convrt_ride' => 1]);

                            $this->genLog("Comprobante respuesta venta_id: ".$id." / mensaje ".$autorizado);
                            Session::flash('flash_message', 'RIDE generado correctamente');

                        }

                    }

                }else{
                    Session::flash('warning', 'No se encuentra el archivo autorizado.');     
                }

                
            } catch (\Exception $e) {
                $this->genLog("No se pudo convertir el comprobante venta_id: ".$id);
                Session::flash('warning', 'No se pudo convertir convertir el pdf.'); 
            }

            return redirect('person/facturacion');
        }



        public function f_sendEmail($id){
            $rutai         = public_path();
            $ruta          = str_replace("\\", "//", $rutai);

            try {

                $comprobante = Comprobante_venta::where('id_venta',$id)->first();

                $archivo = $comprobante['claveacceso'].".xml";
                $archivopdf = $comprobante['claveacceso'].".pdf";

                $archivoautorizado     = $ruta . '/archivos//autorizados' . '/'.$archivo;
                $archivopdf     = $ruta . '/archivos//pdf' . '/'.$archivopdf;

                if (\File::exists($archivoautorizado)) {

                    if (\File::exists($archivopdf)) {
                        if ($pdf = $this->sendEmail($id)) {

                            Comprobante_venta::where('id', $comprobante['id'])
                        ->where('claveacceso', $comprobante['claveacceso'])
                        ->update(['send_xml' => '1', 'send_ride' => '1']);

                            $this->genLog("Comprobantes enviados venta_id: ".$id);
                            Session::flash('flash_message', 'Comprobantes enviados correctamente');

                        }
                    }else{

                        Session::flash('warning', 'No se puede encontrar el archivo pdf.');                     
                    }

                }else{
                    Session::flash('warning', 'No se encuentra el archivo autorizado.');     
                }

                
            } catch (\Exception $e) {
                $this->genLog("No se pudo enviar los comprobantes venta_id: ".$id);
                Session::flash('warning', 'No se pudo enviar los comprobantes.'); 
            }

            return redirect('person/facturacion');            
        }

        //PROCESOS CON RETORNO 
        public function return_generafactura($id){

            $rutai         = public_path();
            $ruta          = str_replace("\\", "//", $rutai);

            try {
                $venta = Ventum::findOrFail($id);
                $comprobante = Comprobante_venta::where('id_venta',$id)->first();

                $archivo = $comprobante['claveacceso'].".xml";

                $archivogenerado     = $ruta . '/archivos//generados' . '/'.$archivo;

                if (\File::exists($archivogenerado)) {
                    
                    Session::flash('warning', 'El archivo ya existe.');   

                }else{
                    if ($generado =$this->genera($id)) {
                        Comprobante_venta::where('id', $comprobante['id'])
                        ->where('claveacceso', $comprobante['claveacceso'])
                        ->update(['gen_xml' => 1]);
                        
                        $this->genLog("Comprobante generado venta_id: ".$id);
                        Session::flash('flash_message', 'Acción realizada con exito.');

                    }
                }

                
            } catch (\Exception $e) {
                $this->genLog("No se genero comprobante venta_id: ".$id);
                Session::flash('warning', 'No se pudo realizar esta acción'); 
            }

            return redirect()->back();
        }

        public function return_firmafactura($id){

            $rutai         = public_path();
            $ruta          = str_replace("\\", "//", $rutai);

            try {

                $comprobante = Comprobante_venta::where('id_venta',$id)->first();

                $archivo = $comprobante['claveacceso'].".xml";

                $archivogenerado     = $ruta . '/archivos//generados' . '/'.$archivo;
                $archivofirmado     = $ruta . '/archivos//firmados' . '/'.$archivo;

                if (\File::exists($archivogenerado)) {

                    if (\File::exists($archivofirmado)) {
                        Session::flash('warning', 'Ya existe un archivo firmado, no se puede continuar.'); 
                    }else{
                        if ($firmado =$this->firmarFactura($id)) {
                            Comprobante_venta::where('id_venta', $id)
                            ->update(['fir_xml' => 1]);

                            $this->genLog("Comprobante firmado venta_id: ".$id);
                            Session::flash('flash_message', 'Documento firmado con exito.');
                        }
                    }

                }else{
                    Session::flash('warning', 'No se encuentra el archivo generado.');     
                }

                

            } catch (\Exception $e) {
                $this->genLog("No se genero firmo el comprobante venta_id: ".$id);
                Session::flash('warning', 'No se pudo firmar el comprobante.'); 
            }

            return redirect()->back();            
        }

        public function return_autorizarfactura($id){

            $rutai         = public_path();
            $ruta          = str_replace("\\", "//", $rutai);

            try {

                $comprobante = Comprobante_venta::where('id_venta',$id)->first();

                $archivo = $comprobante['claveacceso'].".xml";

                $archivofirmado     = $ruta . '/archivos//firmados' . '/'.$archivo;
                $archivoautorizado     = $ruta . '/archivos//autorizados' . '/'.$archivo;

                if (\File::exists($archivofirmado)) {

                    if (\File::exists($archivoautorizado)) {
                        Session::flash('warning', 'Ya existe un archivo autorizado, no se puede continuar.'); 
                    }else{

                        if ($autorizado = $this->autorizar($id)) {

                            

                            $this->genLog("Comprobante respuesta venta_id: ".$id." / mensaje ".$autorizado);
                            Session::flash('flash_message', 'Respuesta '.$autorizado);

                            try {
                                $this->revisarXml($id);
                            } catch (\Exception $e) {

                            $this->genLog("Revisado xml venta_id: ".$id);
                                
                            }

                        }

                    }

                }else{
                    Session::flash('warning', 'No se encuentra el archivo firmado.');     
                }

                

            } catch (\Exception $e) {
                $this->genLog("No se pudo autorizar el comprobante venta_id: ".$id);
                Session::flash('warning', 'No se pudo autorizar el comprobante.'); 
            }

            return redirect()->back();
        }

        public function return_generarpdf($id){
            $rutai         = public_path();
            $ruta          = str_replace("\\", "//", $rutai);

            try {

                $comprobante = Comprobante_venta::where('id_venta',$id)->first();

                $archivo = $comprobante['claveacceso'].".xml";
                $archivopdf = $comprobante['claveacceso'].".pdf";

                $archivoautorizado     = $ruta . '/archivos//autorizados' . '/'.$archivo;
                $archivopdf     = $ruta . '/archivos//pdf' . '/'.$archivopdf;

                if (\File::exists($archivoautorizado)) {

                    if (\File::exists($archivopdf)) {
                        Session::flash('warning', 'Ya existe un archivo pdf, no se puede continuar.'); 
                    }else{

                        if ($pdf = $this->generaPdf($id)) {

                            Comprobante_venta::where('id', $comprobante['id'])
                        ->where('claveacceso', $comprobante['claveacceso'])
                        ->update(['convrt_ride' => 1]);

                            $this->genLog("Comprobante respuesta venta_id: ".$id." / mensaje ".$autorizado);
                            Session::flash('flash_message', 'RIDE generado correctamente');

                        }

                    }

                }else{
                    Session::flash('warning', 'No se encuentra el archivo autorizado.');     
                }

                
            } catch (\Exception $e) {
                $this->genLog("No se pudo convertir el comprobante venta_id: ".$id);
                Session::flash('warning', 'No se pudo convertir convertir el pdf.'); 
            }

            return redirect()->back();
        }

        public function return_sendEmail($id){
            $rutai         = public_path();
            $ruta          = str_replace("\\", "//", $rutai);

            try {

                $comprobante = Comprobante_venta::where('id_venta',$id)->first();

                $archivo = $comprobante['claveacceso'].".xml";
                $archivopdf = $comprobante['claveacceso'].".pdf";

                $archivoautorizado     = $ruta . '/archivos//autorizados' . '/'.$archivo;
                $archivopdf     = $ruta . '/archivos//pdf' . '/'.$archivopdf;

                if (\File::exists($archivoautorizado)) {

                    if (\File::exists($archivopdf)) {
                        if ($pdf = $this->sendEmail($id)) {

                            Comprobante_venta::where('id', $comprobante['id'])
                        ->where('claveacceso', $comprobante['claveacceso'])
                        ->update(['send_xml' => '1', 'send_ride' => '1']);

                            $this->genLog("Comprobantes enviados venta_id: ".$id);
                            Session::flash('flash_message', 'Comprobantes enviados correctamente');

                        }
                    }else{

                        Session::flash('warning', 'No se puede encontrar el archivo pdf.');                     
                    }

                }else{
                    Session::flash('warning', 'No se encuentra el archivo autorizado.');     
                }

                
            } catch (\Exception $e) {
                $this->genLog("No se pudo enviar los comprobantes venta_id: ".$id);
                Session::flash('warning', 'No se pudo enviar los comprobantes.'); 
            }

            return redirect()->back();            
        }


        public function genera($id){
            $venta = Ventum::findOrFail($id);
            $factura = $venta['num_venta'];
            //retorna cadena de 50 caracteres
            $claveacceso    = $this->generaclaveacceso($id);
            $verificador    = $this->generaDigitoModulo11($claveacceso);
            $data['factura'] = $factura;
            $data['clavedeacceso'] = $claveacceso;
            $data['verificador'] = $verificador;
            //Genera cadena de 51 caracteres
            $codigogenerado = $claveacceso . '' . $verificador . '';

            $request['venta_id'] = $venta->id;
            $request['numfactura'] = $factura;
            $request['claveacceso'] = $codigogenerado;

            try {
                //registra que se ha generado el comprobante
                /*
                $comprobante = Comprobante_venta::create([
                    'id_venta' => $venta->id,
                    'numfactura' => $factura,
                    'claveacceso' => $codigogenerado,
                ]);
                */

                $this->genLog("Registrado correctamente comprobante de venta id: ".$id); 

                try {

                    if ($generado = $this->generarFacturaXml($id)) {
                        Comprobante_venta::where('id', $comprobante->id)
                        ->where('claveacceso', $comprobante->claveacceso)
                        ->update(['gen_xml' => 1]);
                    }
                    return $generado;
                } catch (\Exception $e) {
                    $comprobante = "ERROR".$e;
                    $this->genLog("ERROR al crear comprobante de venta id: ".$id);
                    return $e; 
                }


            } catch (\Exception $e) {
                $this->genLog("Error al generar comprobante de venta id: ".$id);
                return $e;
            }

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
            //$ambiente = $dt_empress->ambiente;
            $ambiente = '1';
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
        }



        public function firmarFactura($id){
            //Obtener el nombre del xml, hacer consulta a comprobantes yextraer el nombre
            $almacen    = Almacen::first();
            $dt_empress    = Almacen::where('id',$almacen->id)->get();
            $comprobante   = Comprobante_venta::where('id_venta',$id)->first();
            $firmaelectronica = FacturacionElectronica::first();
            $nombrexml = $comprobante['claveacceso'];
            $rutai         = public_path();
            $ruta          = str_replace("\\", "//", $rutai);
            $rout          = $this->makeDir('firmados');
            $rout          = $this->makeDir('noautorizados');
            $rout          = $this->makeDir('autorizados');
            $rout          = $this->makeDir('temp');
            $rout          = $this->makeDir('pdf');
            $autorizados   = $ruta . '//archivos//' . 'autorizados' . '//';
            $enviados      = $ruta . '//' . 'enviados' . '//';
            $firmados      = $ruta . '//archivos//firmados//';
            $generados     = $ruta . '/archivos//generados' . '/';
            $noautorizados = $ruta . '//archivos//' . 'noautorizados' . '//';
            $certificado   = $ruta . '//archivos//certificado//';
            $WshShell      = new \COM("WScript.Shell");
            foreach ($dt_empress as $dt_empres) {
                $rutafirma        = $firmaelectronica['path_certificado'];
                $passcertificate  = $firmaelectronica['clave_certificado'];
                $pass             = '"' . $passcertificate . '"';
                //$pathfirma        = '"' . $certificado . $rutafirma . '"';
                $pathfirma        = '"' . $rutafirma . '"';
                $xml              = $nombrexml . '.xml';
                $pathsalida       = $firmados;
                $pathgenerado     = $generados . $nombrexml . '.xml';
                try {

                    $jar              = $ruta . '//DevelopedSignature/dist/firmaJava.jar';
                    $cmd              = 'cmd /C java -jar ' . $jar . ' ' . $pathfirma . ' ' . $pass . ' ' . $pathgenerado . ' ' . $pathsalida . ' ' . $xml . ' ';
                    $oExec            = $WshShell->Run($cmd, 0, false);
                    $pathxmlfirmado   = $pathsalida . '' . $xml;
                    $xmlautorizados   = $autorizados . $nombrexml . '.xml';
                    $xmlNoautorizados = $noautorizados . $nombrexml . '.xml';
                    \DB::table('comprobante_ventas')->where('claveacceso', $nombrexml)->update(['fir_xml' => '1']);
                    $this->genLog("Firmo archivo xml : ".$nombrexml); 
                    return $nombrexml;
                } catch (\Exception $e) {
                    $this->genLog("Error al firmar archivo xml : ".$nombrexml); 
                }
                //$this->enviarautorizar($pathxmlfirmado, $nombrexml, $xmlautorizados, $xmlNoautorizados);
            }
        }




        public function autorizar($id){
            try {

                $comprobante   = Comprobante_venta::where('id_venta',$id)->first();

                $rutai         = public_path();
                $ruta          = str_replace("\\", "//", $rutai);
                $autorizados   = $ruta . '//archivos//' . 'autorizados' . '//';
                $enviados      = $ruta . '//' . 'enviados' . '//';
                $firmados      = $ruta . '//archivos//firmados//';
                $noautorizados = $ruta . '//archivos//' . 'noautorizados' . '//';
                $pathxmlfirmado= $firmados.$comprobante['claveacceso'].".xml";

                if (\File::exists($pathxmlfirmado))
                    {
                        $nombrexml = $comprobante['claveacceso'];
                        $xmlautorizados   = $autorizados . $nombrexml . '.xml';
                        $xmlNoautorizados = $noautorizados . $nombrexml . '.xml';
                        $res = $this->enviarautorizar($pathxmlfirmado, $nombrexml, $xmlautorizados, $xmlNoautorizados);

                        $this->genLog("Enviado a autorizar xml venta_id : ".$id );
                        \DB::table('comprobante_ventas')
                        ->where('claveacceso', $comprobante['claveacceso'])
                        ->update(['env_xml' => '1']);

                        return $res;

                    }else{
                        $this->genLog("No existe el archivo xml : ".$comprobante['claveacceso'] );
                    }

                } catch (\Exception $e) {
                    $this->genLog("Error al enviar a autorizar xml venta_id : ".$id );
                    return $e;
                }
            }

            public function enviarautorizar($pathXmlFirmado, $claveAcceso, $autorizados, $rechazados){
                try {

                    $start_time       = microtime(true);
                    $rutai            = public_path();
                    $ruta             = str_replace("\\", "//", $rutai);
                    $WshShell         = new \COM("WScript.Shell");
                    $linkRecepcion    = "https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantes?wsdl";
                    $linkAutorizacion = "https://celcer.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantes?wsdl";
                    $jar              = $ruta . '//SRI//dist//SRI.jar';

                    $cmd              = 'cmd /C java -jar ' . $jar . ' ' . $pathXmlFirmado . ' ' . $claveAcceso . ' ' . $autorizados . ' ' . $rechazados . ' ' . $linkRecepcion . ' ' . $linkAutorizacion . ' ';
        //$oExec            = $WshShell->Run($cmd, 10, true);
        //exec($cmd, $output);
        //print_r($output);
        //return $output;
        //if ($oExec == '0') {
                    if (exec($cmd, $output)) {
                        if(count($output)){
                            $cadena = collect($output)->implode(',');
                        }else{
                            $cadena = $output;
                        }
                        $cadena = utf8_encode($cadena);
                        //$cadena = collect($output)->implode(',');
                        $sql = \DB::table('comprobante_ventas')
                        ->where('claveacceso', $claveAcceso)
                        ->update(['aut_xml' => '1','mensaje'=>$cadena]);
                        //sleep(30);
                        return $cadena;
            //$this->revisarXml($claveAcceso);
            //$this->revisarXml($id);
                    } else {
                        \DB::table('comprobante_ventas')
                        ->where('claveacceso', $claveAcceso)
                        ->update(['aut_xml' => '0']);
                    }

                } catch (\Exception $e) {
                    $this->genLog("Error al autorizar xml : ".$claveAcceso );
                    return $e;
                }

            }


            public function revisarXml($id)
            {
                $comprobante   = Comprobante_venta::where('id_venta',$id)->first();
                $claveacceso = $comprobante['claveacceso'];
                $claveAcceso = $claveacceso;
                $rutai       = public_path();
                $ruta        = str_replace("\\", "\\", $rutai);
        //$autorizados = $ruta.'//archivos//'.'autorizados'.'//';

                $xmlPath = $ruta . "\\archivos\\autorizados\\" . $claveAcceso . ".xml";

                if (file_exists($xmlPath)) {

            //lee el xml y decodifica
                    $content        = utf8_encode(file_get_contents($xmlPath));
                    $xml            = \simplexml_load_string($content);
                    $cont           = (integer) $xml['counter'];
                    $xml['counter'] = $cont + 1;
            //guarda temporalmente el xml decodificado
                    $xml->asXML($ruta . "\\archivos\\temp\\" . $claveAcceso . ".xml");
            //obtiene los valores de los campos del archivo temporal decodificado
                    $doc = new \DOMDocument();
                    $doc->load($ruta . "\\archivos\\temp\\" . $claveAcceso . ".xml");
            // Reading tag's value.
                    $estado = $doc->getElementsByTagName("estado")->item(0)->nodeValue;
                    if ($estado == "AUTORIZADO") {
                        $numAut  = $doc->getElementsByTagName("numeroAutorizacion")->item(0)->nodeValue;
                        $fechAut = $doc->getElementsByTagName("fechaAutorizacion")->item(0)->nodeValue;
                        \DB::table('comprobante_ventas')
                        ->where('claveacceso', $claveAcceso)
                        ->update(['num_autorizacion' => $numAut, 'fecha_autorizacion' => $fechAut, 'estado_aprobacion' => $estado]);
                        /*try {

                            $this->generaPdf($claveAcceso);

                        } catch (\Exception $e) {

                            $this->genLog("Error al convertir xml a pdf : ".$claveAcceso );
                            
                        }
                        */

                    } else {
                        $fechAut = $doc->getElementsByTagName("fechaAutorizacion")->item(0)->nodeValue;
                        $mensaje = $doc->getElementsByTagName("mensajes")->item(0)->nodeValue;
                        $estado  = "NO AUTORIZADO";
                        \DB::table('comprobante_ventas')
                        ->where('claveacceso', $claveAcceso)
                        ->update(['mensaje' => $mensaje, 'fecha_autorizacion' => $fechAut, 'estado_aprobacion' => $estado]);
                    }
                } else {

                    $this->genLog("No se encontro el archivo para revisarlo ". $claveAcceso );
                   

                    //return "Retorna a firmar";
                    //$this->firmarFactura($id);
                    //$message = 'Se recibio la respuesta de la revicion';

                   // \Session::flash('flash_message', $message);
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


            public function generaPdf($id){


                $rutai      = public_path();
                $ruta       = str_replace("\\", "//", $rutai);
                $rutasl     = str_replace("\\", "\\", $rutai);

                $dt_empress = Almacen::first();
                $comprobante   = Comprobante_venta::where('id_venta',$id)->first();

                $claveAcceso    = $comprobante['claveacceso'];

                $date           = Carbon::now();
                $date->timezone = new \DateTimeZone('America/Guayaquil');
                $date           = $date->format('d/m/Y');

                $aux_sales = $venta = Ventum::findOrFail($id);
                $comprobante = Comprobante_venta::where('id_venta',$aux_sales->id)->first();
                $aux_clientes = Cliente::where('id',$aux_sales['id_cliente'])->get();
                $items = detallVenta::where('id_venta',$id)->get();
                $facturacion = FacturacionElectronica::first();
                $pedidos = "";

                $pdf            = \PDF::loadView('pdf/vista', ['dt_empress' => $dt_empress, 'aux_sales' => $aux_sales, 'aux_clientes' => $aux_clientes, 'date' => $date, 'items' => $items, 'pedidos' => $pedidos,'facturacion'=>$facturacion,'comprobante'=>$comprobante]);
                \DB::table('comprobante_ventas')
                ->where('claveacceso', $claveAcceso)
                ->update(['convrt_ride' => '1']);
                $pdf->save($rutasl . "\\archivos\\pdf\\" . $claveAcceso . ".pdf");
        //return $pdf->download('prueba.pdf');
        //$this->deleteDir("generados");
        //$this->deleteDir("firmados");
        //$this->deleteDir("temp");

                $rutaPdf = $ruta . "//archivos//pdf//" . $claveAcceso . ".pdf";
        //$pdf->save("C:\\xampp\\htdocs\\repositoriotesis\\tesis\\tienla\\public\\archivos\\pdf\\".$claveAcceso.".pdf");
                $pdf->save($rutaPdf);
                if (file_exists($rutaPdf)) {
                    \DB::table('comprobante_ventas')
                    ->where('claveacceso', $claveAcceso)
                    ->update(['convrt_ride' => '1']);
            //$this->sendEmail($claveAcceso);
                } else {
                    return "Error";
            //$this->firmarXml($claveAcceso);
                }
        //return $pdf->download('prueba.pdf');
        //$this->deleteDir("generados");
        //$this->deleteDir("firmados");
        //$this->deleteDir("temp");
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

                    $dirMatriz = $xml->createElement('dirMatriz', $dt_empres->dirMatriz);
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
            $tabiva          = Iva::select()->where('activo', 1)->first();
            $monedas         = Moneda::select()->where('estado', 1)->first();
            $iva             = $tabiva->iva;
            $codporcentaje   = $tabiva->codporcentaje;
            $tarifa          = $iva * 1;
            //$valor           = $iva + 100;
            //$obtnvl          = $valor / 100;
            $obtnvl          = $tarifa / 100;
            
            $totalfactura    = $venta->total;
            $valsinimpuestos = $totalfactura / $obtnvl;

            $valor = $totalfactura * $obtnvl;

            $infoFactura = $xml->createElement('infoFactura');
            $infoFactura = $factura->appendChild($infoFactura);
            //reemplazar feha por date
            //cambiar el formato de la fecha fechaEmision 

            $calculo_total = $venta->total;
            $calculo_subtotal = $venta->subtotal;
            $calculo_iva_calculado = $venta->iva_calculado;
            $calculo_total_sin_impuestos = ($calculo_total - $calculo_subtotal);

            $fechaEmite = Carbon::parse($venta['fecha'])->format('d/m/Y');
            //dd($fechaEmite);
            $fechaEmision = $xml->createElement('fechaEmision', $fechaEmite);
            $fechaEmision = $infoFactura->appendChild($fechaEmision);

            $dirEstablecimiento = $xml->createElement('dirEstablecimiento', $datos_empresa->dirSucursal);
            $dirEstablecimiento = $infoFactura->appendChild($dirEstablecimiento);
            if ($facturacion['obligado_contabilidad'] == 0) {
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

            $totalSinImpuestos = $xml->createElement('totalSinImpuestos', number_format($calculo_total-$calculo_iva_calculado, 2, '.', ','));
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

            $codigoPorcentaje = $xml->createElement('codigoPorcentaje', $codporcentaje);
            $codigoPorcentaje = $totalImpuesto->appendChild($codigoPorcentaje);

            $baseImponible = $xml->createElement('baseImponible', number_format($calculo_total-$calculo_iva_calculado, 2, '.', ','));
            $baseImponible = $totalImpuesto->appendChild($baseImponible);

            $tarifa = $xml->createElement('tarifa', $tarifa);
            $tarifa = $totalImpuesto->appendChild($tarifa);

            $valor = $xml->createElement('valor', number_format($calculo_iva_calculado, 2, '.', ','));
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
            ///sss
            $product = Product::select()->where('id', '=', $item->id_producto)->first();
            $detalle = $xml->createElement('detalle');
            $detalle = $detalles->appendChild($detalle);

            $codigoPrincipal = $xml->createElement('codigoPrincipal', $product->id);
            $codigoPrincipal = $detalle->appendChild($codigoPrincipal);

            $codigoAuxiliar = $xml->createElement('codigoAuxiliar', $product->cod_barra);
            $codigoAuxiliar = $detalle->appendChild($codigoAuxiliar);
            if(!empty($product->propaganda)){
                $detallproduct = $product->propaganda;
            }else{
                $detallproduct = 's/n';
            }
            $descripcion = $xml->createElement('descripcion', $detallproduct);
            $descripcion = $detalle->appendChild($descripcion);

            $cantidadproducto = $item->cant;
            $precioventa      = ($product->pre_venta * $cantidadproducto);

            $cantidad       = $xml->createElement('cantidad', $cantidadproducto);
            $cantidad       = $detalle->appendChild($cantidad);
            
            /*$productoprecio = $product->pre_venta;
            $valsiniv       = $productoprecio / $obtnvl;
            $ivcero         = $iva / 100;
            $valiv          = $valsiniv * $ivcero;*/

            $precioUnitario = $xml->createElement('precioUnitario', number_format($item->precio, 2, '.', ','));
            $precioUnitario = $detalle->appendChild($precioUnitario);

             //dd($item); Realizar lectura del modelo de descuentos y extraer el valor que se encuentre en activo
            //$item->descuento
            $descuento = $xml->createElement('descuento', 0);
            $descuento = $detalle->appendChild($descuento);

            /*
            $totsininpuesto = $precioventa * $cantidadproducto;
            $sinInp         = ($valsiniv * $cantidadproducto);
            */
            $sinInp = ($item->precio * $item->cant);

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

            /*$productoprecio = $item->precio;
            $valsiniv       = $productoprecio / $obtnvl;

            $ivcero         = $iva / 100;
            $valiv          = $valsiniv * $ivcero;
            $cantidadproducto = $item->cant;*/
            //$totivaval = $valiv * $cantidadproducto;

            $totivaval = $obtnvl * ($item->cant * $item->precio);

            $valor = $xml->createElement('valor', number_format($totivaval, 2, '.', ','));
            $valor = $impuesto->appendChild($valor);
        }

        $infoAdicional = $xml->createElement('infoAdicional');
        $infoAdicional = $factura->appendChild($infoAdicional);
        foreach ($perfils as $adicionalperson) {
            if ($adicionalperson->dir_cli == "") {
                $direccionuno = "n/s";
            } else {
                $direccionuno = $adicionalperson->dir_cli;
            }
            /*if ($adicionalperson->dir2 == "") {
                $direcciondos = "n/s";
            } else {
                $direcciondos = $adicionalperson->dir2;
            }
            */

            //$campoAdicional = $xml->createElement('campoAdicional',$adicionalperson->dir1.' y '.$adicionalperson->dir2);
            $campoAdicional = $xml->createElement('campoAdicional', $direccionuno );
            $campoAdicional->setAttribute('nombre', 'Direccion');
            $campoAdicional = $infoAdicional->appendChild($campoAdicional);
            if ($adicionalperson->tlf_cli == "") {
                $telefonocli = "n/s";
            } else {
                $telefonocli = $adicionalperson->tlf_cli;
            }

            //$campoAdicional = $xml->createElement('campoAdicional',$adicionalperson->telefono);
            $campoAdicional = $xml->createElement('campoAdicional', $telefonocli);
            $campoAdicional->setAttribute('nombre', 'Telefono');
            $campoAdicional = $infoAdicional->appendChild($campoAdicional);

            $campoAdicional = $xml->createElement('campoAdicional', $adicionalperson->mail_cli);
            $campoAdicional->setAttribute('nombre', 'Email');
            $campoAdicional = $infoAdicional->appendChild($campoAdicional);
        }
        

        $xml->formatOutput = true;
        $el_xml            = $xml->saveXML();

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





    public function sendEmail($id)
    {
        $empresa = Almacen::first();
        $comprobante   = Comprobante_venta::where('id_venta',$id)->first();

        $clavedeacceso = $comprobante->claveacceso;

        $venta = Ventum::findOrFail($id);
        $cliente = Cliente::where('id',$venta['id_cliente'])->first();

        
        $data['empresa']       = $emp           = $empresa->almacen;
        $data['tlfun']         = $tlfun         = $empresa->telefono;
        $data['tlfds']         = $tlfds         = "";
        $data['cel']           = $cel           = $empresa->cel_movi.' '.$empresa->cel_claro;
        $data['dir']           = $dir           = $empresa->dirMatriz;
        $data['pagweb']        = $pagweb        = $empresa->pag_web;
        $data['email']         = $email         = $empresa->email;
        $data['count']         = $count         = "";
        $data['ciu']           = $ciu           = "Azuay";
        $data['email_cliente'] = $emailcliente = $cliente->mail_cli;
        $data['name']          = $nombrecliente          = $cliente->nom_cli.' '.$cliente->app_cli;
        $rutai                 = public_path();
        $ruta                  = str_replace("\\", "//", $rutai);
        $data['xml']           = $autorizados           = $ruta . '//archivos//' . 'autorizados' . '//' . $clavedeacceso . '.xml';
        $data['pdf']           = $convertidos           = $ruta . '//archivos//' . 'pdf' . '//' . $clavedeacceso . '.pdf';
        $data['clave']         = $clavedeacceso;
        $data['message']         = "Gracias por preferirnos.";
        
        if (\File::exists($autorizados)) {
            if (\File::exists($convertidos)) {


                try {

                    Mail::to($emailcliente)->send(new comprobantesMail($data));
                    
                } catch (\Exception $e) {
                    $this->genLog("Error : ".$e );
                }
                
                $pdf = \DB::table('comprobante_ventas')
                ->where('claveacceso', $clavedeacceso)
                ->update(['send_xml' => '1', 'send_ride' => '1']);
                $pdfdelete = $clavedeacceso . ".pdf";
                $xmldelete = $clavedeacceso . ".xml";
                /*$this->moveFile($clavedeacceso);*/
                $this->deleteFile("generados", $xmldelete);
                $this->deleteFile("firmados", $xmldelete);
                $this->deleteFile("autorizados", $xmldelete);
                $this->deleteFile("noautorizados", $xmldelete);
                $this->deleteFile("temp", $xmldelete);
                $this->deleteFile("pdf", $pdfdelete);
            } else {
                $pdf = $this->genLog("comprobantes no enviados : ".$clavedeacceso );

                \DB::table('comprobante_ventas')
                ->where('claveacceso', $clavedeacceso)
                ->update(['send_ride' => '0']);
            }
        } else {

            $pdf = \DB::table('comprobante_ventas')
            ->where('claveacceso', $clavedeacceso)
            ->update(['send_xml' => '0']);
        }
        return $pdf;
    }

    protected function deleteFile($directorio, $archivo)
    {
        $rutai   = public_path();
        $ruta    = str_replace("\\", "\\", $rutai);
        $archivo = $ruta . "\\archivos\\" . $directorio . "\\" . $archivo;
        if (file_exists($archivo)) {
            unlink($archivo);
        }
    }

    private function moveFile($clavedeacceso)
    {
        $rutai   = public_path();
        $ruta    = str_replace("\\", "//", $rutai);
        $origen  = $ruta . '//archivos//' . 'pdf' . '//' . $clavedeacceso . '.pdf';
        $destino = $ruta . '//archivos//' . 'enviados' . '//' . $clavedeacceso . '.pdf';
        copy($origen, $destino);
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

    public function makeDir($nameDir)
    {
        $rutai = public_path();
        $ruta  = str_replace("\\", "\\", $rutai);
        $dir   = $ruta . '\\archivos\\' . $nameDir . '';
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        return $dir;
    }

    protected function guard()
    {
        return Auth::guard('person');
    }

    //Prrobar esta funcion, es para ejecutar script java desde php y recibir la respuesta de la ejecucion
    function __exec($tmppath, $cmd){
        //https://stackoverflow.com/questions/5690134/running-command-line-silently-with-vbscript-and-getting-output
        $WshShell = new COM("WScript.Shell");
        $tmpf = rand(1000, 9999).".tmp"; // Temp file
        $tmpfp = $tmppath.'/'.$tmpf; // Full path to tmp file
        $oExec = $WshShell->Run("cmd /c $cmd -c ... > ".$tmpfp, 0, true);
        // return $oExec == 0 ? true : false; // Return True False after exec
        return $tmpf;
    }


}
