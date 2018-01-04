<?php

namespace App\Http\Controllers\Admin;

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
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'logout']);
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
        } else {
            $venta = Ventum::paginate($perPage);
        }

        return view('admin.venta.index', compact('venta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
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
        return view('admin.venta.create',compact('numero_venta','fecha_venta','clientes','products','cant_incr','username','userid','useremail'));
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
        /*dd($dataVenta); $requestData = $request->all();        
        Ventum::create($requestData);*/
        try {
            //Guarda cabecera de la factura
            $venta = Ventum::create($dataVenta);
            //envia los valore del detalle de la factura para guardar el detalle desde la funcion saveItem
            foreach ($producto as $product) {
                $requestData_returned = $this->saveItem($product,$venta->id);
                $requestData_returned->save();
            }
            //actualiza en inventario pasandole el parametro idventa a la función actualizaInventario para que realize la lectura de todos los productos que se encuentran en el detalle de la factura y actualize el inventario de todos los producto que estan en el detalle.
            $this->actualizaInventario($venta->id);
                Session::flash('flash_message', 'Guardado correctamente');
        } catch (\Exception $e) {
                Session::flash('warning', 'Error al Guardar');         
        }
        //Redireccióna a ventana show con parametros, para visualizar el detalle de la venta
        return redirect()->route('detallventa', ['id' => $venta->id]);
    }

    public function detallventa($id){
        $ventum = Ventum::findOrFail($id);
        $detallventa= detallVenta::where('id_venta',$id)->get();
        $almacen = Almacen::first();
        return view('admin.venta.show', compact('ventum','detallventa','almacen'));
    }

    //Recibe parametros de la funcion store para guardar el detalle de la factura.
    protected function saveItem($product, $order_id)
    {
        $requestData = new detallVenta;
        $requestData->producto = $product->producto;
        $requestData->codbarra = $product->codbarra;
        $requestData->precio = $product->precio;
        $requestData->cant = $product->cant;
        $requestData->total = $product->total;
        $requestData->id_venta = $order_id;
        $requestData->id_producto = $product->id;
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
        return view('admin.venta.show', compact('ventum','detallventa','almacen'));
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

        return view('admin.venta.edit', compact('ventum'));
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
        
        $ventum = Ventum::findOrFail($id);
        $ventum->update($requestData);

        return redirect('admin/venta')->with('flash_message', 'Ventum updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Ventum::destroy($id);

        return redirect('admin/venta')->with('flash_message', 'Ventum deleted!');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
