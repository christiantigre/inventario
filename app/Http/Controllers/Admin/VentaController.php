<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cliente;
use App\Product;
use App\Ventum;
use App\ItemVenta;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        ItemVenta::truncate();
        $cant_ventas = Ventum::count();
        $clientes = Cliente::all();
        $products = Product::all();
        $cant_incr = $cant_ventas+1;
        $numbers     = $this->generate_numbers($cant_incr, 1, 8);
        $numero_venta = implode("", $numbers);
        $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
        $fecha_venta = $carbon->now()->format('Y-m-d H:i:s');
        return view('admin.venta.create',compact('numero_venta','fecha_venta','clientes','products','cant_incr'));
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
        
        $requestData = $request->all();
        
        Ventum::create($requestData);

        return redirect('admin/venta')->with('flash_message', 'Ventum added!');
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

        return view('admin.venta.show', compact('ventum'));
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
