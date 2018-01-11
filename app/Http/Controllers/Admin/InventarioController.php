<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\SvLogAdmin;
use App\Product;
use Carbon\Carbon;
use App\detallVenta;
use DB;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
            $product = Product::where('producto', 'LIKE', "%$keyword%")
            ->orWhere('cod_barra', 'LIKE', "%$keyword%")
            ->orWhere('pre_compra', 'LIKE', "%$keyword%")
            ->orWhere('pre_venta', 'LIKE', "%$keyword%")
            ->orWhere('cantidad', 'LIKE', "%$keyword%")
            ->orWhere('imagen', 'LIKE', "%$keyword%")
            ->orWhere('name_img', 'LIKE', "%$keyword%")
            ->orWhere('nuevo', 'LIKE', "%$keyword%")
            ->orWhere('promo', 'LIKE', "%$keyword%")
            ->orWhere('catalogo', 'LIKE', "%$keyword%")
            ->orWhere('activo', 'LIKE', "%$keyword%")
            ->orWhere('propaganda', 'LIKE', "%$keyword%")
            ->orWhere('id_category', 'LIKE', "%$keyword%")
            ->orWhere('id_subcategory', 'LIKE', "%$keyword%")
            ->orWhere('id_proveedor', 'LIKE', "%$keyword%")
            ->paginate($perPage);

            $this->genLog("Busqueda datos :".$keyword);
        } else {
            /*$fecha = '2018-02-10';
            $product = DB::select(DB::raw('SELECT * FROM products C LEFT JOIN (SELECT codbarra, COUNT(*) AS CANTIDAD, SUM(cant) AS TOTALVENTA FROM detall_ventas GROUP BY codbarra) AS D ON C.cod_barra = D.codbarra where C.fecha_ingreso=:fecha'), array(
   'fecha' => $fecha,
    ));
    dd($product);*/

    /*revisar esta parte*/
    
            $product = DB::select(DB::raw('SELECT * FROM products C LEFT JOIN (SELECT codbarra, COUNT(*) AS cantidadventas, coalesce(SUM(cant),0) AS totalventa FROM detall_ventas GROUP BY codbarra) AS D ON C.cod_barra = D.codbarra'));

                $this->genLog("Visualizó sección.");
        }

        return view('admin.inventario.index', compact('product'));
    }

    /**
    parametros en la consulta

    $results = DB::select( DB::raw("SELECT * FROM some_table WHERE some_col = :somevariable"), array(
   'somevariable' => $someVariable,
    ));

     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function ingresos(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
        $year = $carbon->now()->format('Y');

        if (!empty($keyword)) {
            $product = Product::where('producto', 'LIKE', "%$keyword%")
            ->orWhere('cod_barra', 'LIKE', "%$keyword%")
            ->orWhere('pre_compra', 'LIKE', "%$keyword%")
            ->orWhere('pre_venta', 'LIKE', "%$keyword%")
            ->orWhere('cantidad', 'LIKE', "%$keyword%")
            ->orWhere('imagen', 'LIKE', "%$keyword%")
            ->orWhere('name_img', 'LIKE', "%$keyword%")
            ->orWhere('nuevo', 'LIKE', "%$keyword%")
            ->orWhere('promo', 'LIKE', "%$keyword%")
            ->orWhere('catalogo', 'LIKE', "%$keyword%")
            ->orWhere('activo', 'LIKE', "%$keyword%")
            ->orWhere('propaganda', 'LIKE', "%$keyword%")
            ->orWhere('id_category', 'LIKE', "%$keyword%")
            ->orWhere('id_subcategory', 'LIKE', "%$keyword%")
            ->orWhere('id_proveedor', 'LIKE', "%$keyword%")
            ->paginate($perPage);

            $this->genLog("Busqueda datos :".$keyword);
        } else {
            $product = Product::orderBy('fecha_ingreso','ASC')->whereYear('fecha_ingreso','=',$year)->paginate($perPage);
            /*MUESTRA LA CANTIDAD DE VENTAS GENERADAS Y Y LA CANTIDAD DE PRODUCTOS VENDIDOS
        SELECT * FROM products C LEFT JOIN (SELECT codbarra, COUNT(*) AS CANTIDAD, SUM(cant) AS TOTALVENTA FROM detall_ventas GROUP BY codbarra) AS D ON C.cod_barra = D.codbarra 
        */
        //$product = Product::orderBy()
        $this->genLog("Visualizó sección ingresos.");
    }

    return view('admin.inventario.ingresos', compact('product','year'));
}
/*Ingreso filtro por mes*/
public function bymonthingre(Request $request){
    $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
    $year = $carbon->now()->format('Y');
    $mes = $this->gen_month($request->month);

    $perPage = 25;
    try {
        $product = Product::whereMonth('fecha_ingreso','=',$request->month)->paginate($perPage);
        $this->genLog("Visualizó inventario ingresos por mes id :" .$request->month);
        Session::flash('flash_message', 'Consulta realizada correctamente');            
    } catch (\Exception $e) {
        $this->genLog("Error al visualizar inventario ingresos por mes id :" .$request->month);  
        Session::flash('warning', 'Error al realizar busqueda!!!');           
    }
    $mensaje = $mes;
    return view('admin.inventario.ingresos', compact('product','year','mensaje'));
}
/*Ingreso filtro por rango de fechas*/
public function byrangoingre(Request $request){
    $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
    $year = $carbon->now()->format('Y');

    $perPage = 25;
    $mensaje = 'Desde '.$request->fecha_inicio. ' a '. $request->fecha_fin;
    try {
        $product = Product::orderBy('fecha_ingreso','ASC')->whereBetween('fecha_ingreso', [$request->fecha_inicio, $request->fecha_fin])->paginate($perPage);
        $this->genLog("Visualizó inventario ingresos por rango de fecha :" .$mensaje);
        Session::flash('flash_message', 'Consulta realizada correctamente');            
    } catch (\Exception $e) {
        $this->genLog("Error al visualizar inventario ingresos fecha:" .$mensaje);  
        Session::flash('warning', 'Error al realizar busqueda!!!');           
    }
    return view('admin.inventario.ingresos', compact('product','year','mensaje'));
}

/*Egreso por mes*/
public function bymonthegre(Request $request){
    $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
    $year = $carbon->now()->format('Y');
    $mes = $this->gen_month($request->month);

    $perPage = 25;
    try {
        $product = detallVenta::groupBy('codbarra','producto','precio')
        ->select('codbarra','producto','precio',\DB::raw('SUM(cant) as cant'))
        ->whereMonth('fecha_egreso','=',$request->month)
        ->paginate($perPage);
        $this->genLog("Visualizó inventario egresos por mes id :" .$request->month);
        Session::flash('flash_message', 'Consulta realizada correctamente');            
    } catch (\Exception $e) {
        $this->genLog("Error al visualizar inventario egresos por mes id :" .$request->month);  
        Session::flash('warning', 'Error al realizar busqueda!!!');           
    }
    $mensaje = $mes;
    return view('admin.inventario.egresos', compact('product','year','mensaje'));
}
/*Egreso filtro por rango de fechas*/
public function byrangoegre(Request $request){
    /*Cuenta cantidad de productos vendidos */
    /*SELECT detall_ventas.codbarra,SUM(detall_ventas.cant) as cant from detall_ventas GROUP BY detall_ventas.codbarra*/

    $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
    $year = $carbon->now()->format('Y');

    $perPage = 25;
    $mensaje = 'Desde '.$request->fecha_inicio. ' a '. $request->fecha_fin;
    try {
        $product = detallVenta::groupBy('codbarra','producto','precio')
        ->select('codbarra','producto','precio',\DB::raw('SUM(cant) as cant'))
        ->whereMonth('fecha_egreso','=',$request->month)
        ->paginate($perPage);
        $this->genLog("Visualizó inventario egresos por rango de fecha :" .$mensaje);
        Session::flash('flash_message', 'Consulta realizada correctamente');            
    } catch (\Exception $e) {
        $this->genLog("Error al visualizar inventario egresos fecha:" .$mensaje);  
        Session::flash('warning', 'Error al realizar busqueda!!!');           
    }
    return view('admin.inventario.egresos', compact('product','year','mensaje'));
}

public function egresos(Request $request)
{
    $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
    $year = $carbon->now()->format('Y');

    $keyword = $request->get('search');
    $perPage = 25;

    if (!empty($keyword)) {
        $product = Product::where('producto', 'LIKE', "%$keyword%")
        ->orWhere('cod_barra', 'LIKE', "%$keyword%")
        ->orWhere('pre_compra', 'LIKE', "%$keyword%")
        ->orWhere('pre_venta', 'LIKE', "%$keyword%")
        ->orWhere('cantidad', 'LIKE', "%$keyword%")
        ->orWhere('imagen', 'LIKE', "%$keyword%")
        ->orWhere('name_img', 'LIKE', "%$keyword%")
        ->orWhere('nuevo', 'LIKE', "%$keyword%")
        ->orWhere('promo', 'LIKE', "%$keyword%")
        ->orWhere('catalogo', 'LIKE', "%$keyword%")
        ->orWhere('activo', 'LIKE', "%$keyword%")
        ->orWhere('propaganda', 'LIKE', "%$keyword%")
        ->orWhere('id_category', 'LIKE', "%$keyword%")
        ->orWhere('id_subcategory', 'LIKE', "%$keyword%")
        ->orWhere('id_proveedor', 'LIKE', "%$keyword%")
        ->paginate($perPage);

        $this->genLog("Busqueda datos :".$keyword);
    } else {
        $product = detallVenta::groupBy('codbarra','producto','precio')->select('codbarra','producto','precio',\DB::raw('SUM(cant) as cant'))->paginate($perPage);
        $this->genLog("Visualizó sección egresos.");
    }

    return view('admin.inventario.egresos', compact('product','year'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function genLog($mensaje)
    {
        $area = 'Inventario';
        $logs = Svlogadmin::log($mensaje,$area);
    }

    public function gen_month($month)
    {
        if($month==1)
            $mes = "Enero";
        elseif ($month==2)
            $mes = "Febrero";
        elseif ($month == 3)
            $mes = "Marzo";
        elseif ($month == 4)
            $mes = "Abril";
        elseif ($month == 5)
            $mes = "Mayo";
        elseif ($month == 6)
            $mes = "Junio";
        elseif ($month == 7)
            $mes = "Julio";
        elseif ($month == 8)
            $mes = "Agosto";
        elseif ($month == 9)
            $mes = "Septiembre"; 
        elseif ($month == 10)
            $mes = "Octubre"; 
        elseif ($month == 11)
            $mes = "Noviembre"; 
        elseif ($month == 12)
            $mes = "Diciembre"; 
        return $mes;
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
