<?php

namespace App\Http\Controllers\Person;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\SvLog;
use App\Product;
use Carbon\Carbon;
use App\detallVenta;
use Excel;
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
        $this->middleware('person', ['except' => 'logout']);
    }

    public function index(Request $request)
    {
        $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
        $year = $carbon->now()->format('Y');

        $keyword = $request->get('search');
        $perPage = 25;
        $mensaje = "";

        if (!empty($keyword)) {

            $product = DB::table("products")
            ->select("products.*","items_count.cantidadventas","items_count.totalventa")
            ->leftJoin(DB::raw("(SELECT codbarra, COUNT(*) AS cantidadventas, coalesce(SUM(cant),0) AS totalventa FROM detall_ventas WHERE date_format(fecha_egreso, '%Y') = ".$year."  GROUP BY codbarra) as items_count"),function($join){
                $join->on("items_count.codbarra","=","products.cod_barra");
            })
            ->whereYear('products.fecha_ingreso','=',$year)
            ->where('products.producto', 'LIKE', "%$keyword%")
            ->orWhere('products.cod_barra', 'LIKE', "%$keyword%")
            ->orWhere('products.pre_compra', 'LIKE', "%$keyword%")
            ->orWhere('products.pre_venta', 'LIKE', "%$keyword%")
            ->orWhere('products.cantidad', 'LIKE', "%$keyword%")
            ->orWhere('products.propaganda', 'LIKE', "%$keyword%")
            ->orderBy('products.fecha_ingreso','ASC')
            ->paginate($perPage);

            $this->genLog("Busqueda datos inventario ingreso/egreso palabra :".$keyword);
        } else {
            $product = DB::table("products")
            ->select("products.*","items_count.cantidadventas","items_count.totalventa")
            ->leftJoin(DB::raw("(SELECT codbarra, COUNT(*) AS cantidadventas, coalesce(SUM(cant),0) AS totalventa FROM detall_ventas WHERE date_format(fecha_egreso, '%Y') = ".$year."  GROUP BY codbarra) as items_count"),function($join){
                $join->on("items_count.codbarra","=","products.cod_barra");
            })
            ->whereYear('products.fecha_ingreso','=',$year)
            ->orderBy('products.fecha_ingreso','ASC')
            ->paginate($perPage);

            $this->genLog("Visualizó sección año ".$year);
        }

        return view('person.inventario.index', compact('product','year','mensaje'));
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
        $mensaje = "";
        $rangostart = "";
        $rangofinish = "";

        if (!empty($keyword)) {
            dd($request);
            $product = Product::orderBy('fecha_ingreso','ASC')
            ->whereYear('fecha_ingreso','=',$year)
            ->where('producto', 'LIKE', "%$keyword%")
            ->orWhere('cod_barra', 'LIKE', "%$keyword%")
            ->orWhere('pre_compra', 'LIKE', "%$keyword%")
            ->orWhere('pre_venta', 'LIKE', "%$keyword%")
            ->orWhere('cantidad', 'LIKE', "%$keyword%")
            ->orWhere('propaganda', 'LIKE', "%$keyword%")
            ->paginate($perPage);

            $this->genLog("Busqueda datos :".$keyword);
        } else {
            $product = Product::orderBy('fecha_ingreso','ASC')->whereYear('fecha_ingreso','=',$year)->paginate($perPage);
            /*MUESTRA LA CANTIDAD DE VENTAS GENERADAS Y LA CANTIDAD DE PRODUCTOS VENDIDOS
        SELECT * FROM products C LEFT JOIN (SELECT codbarra, COUNT(*) AS CANTIDAD, SUM(cant) AS TOTALVENTA FROM detall_ventas GROUP BY codbarra) AS D ON C.cod_barra = D.codbarra 
        */
        //$product = Product::orderBy()
        $this->genLog("Visualizó sección ingresos.");
    }

    return view('person.inventario.ingresos', compact('product','year','mensaje','mes','rangostart','rangofinish'));
}
/*Ingreso filtro por mes*/
public function bymonthingre(Request $request){
    $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
    $year = $carbon->now()->format('Y');
    $mes = $this->gen_month($request->month);
    $rangostart = "";
    $rangofinish = "";

    $perPage = 25;
    try {
        $product = Product::whereMonth('fecha_ingreso','=',$request->month)->paginate($perPage);
        $this->genLog("Visualizó inventario ingresos por mes id :" .$request->month);
        Session::flash('flash_message', 'Consulta realizada correctamente');            
    } catch (\Exception $e) {
        $this->genLog("Error al visualizar inventario ingresos por mes id :" .$request->month);  
        Session::flash('warning', 'Error al realizar busqueda!!!');           
    }
    $mensaje = $request->month;
    return view('person.inventario.ingresos', compact('product','year','mensaje','mes','rangostart','rangofinish'));
}
/*Ingreso filtro por rango de fechas*/
public function byrangoingre(Request $request){
    $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
    $year = $carbon->now()->format('Y');

    $perPage = 25;
    $mensaje = '3';
    $mensajerangos = 'Desde '.$request->fecha_inicio. ' a '. $request->fecha_fin;
    $mes = "";
    $rangostart = $request->fecha_inicio;
    $rangofinish = $request->fecha_fin;
    try {
        $product = Product::orderBy('fecha_ingreso','ASC')->whereBetween('fecha_ingreso', [$request->fecha_inicio, $request->fecha_fin])->whereYear('fecha_ingreso','=',$year)->paginate($perPage);
        $this->genLog("Visualizó inventario ingresos rango de fecha :" .$mensaje);
        Session::flash('flash_message', 'Consulta realizada correctamente');            
    } catch (\Exception $e) {
        $this->genLog("Error vizualizando inventario ingresos fecha:" .$mensaje);  
        Session::flash('warning', 'Error al realizar busqueda!!!');           
    }
    return view('person.inventario.ingresos', compact('product','year','mensaje','mensajerangos','mes','rangostart','rangofinish'));
}

/*Egreso por mes*/
public function bymonthegre(Request $request){
    $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
    $year = $carbon->now()->format('Y');
    $mes = $this->gen_month($request->month);
    $rangostart = "";
    $rangofinish = "";

    $perPage = 25;
    try {
        $product = detallVenta::groupBy('codbarra','producto','precio')
        ->select('codbarra','producto','precio',\DB::raw('SUM(cant) as cant'))
        ->whereMonth('fecha_egreso','=',$request->month)
        ->whereYear('fecha_egreso','=',$year)
        ->paginate($perPage);
        $this->genLog("Visualizó inventario egresos mes id :" .$request->month);
        Session::flash('flash_message', 'Consulta realizada correctamente');            
    } catch (\Exception $e) {
        $this->genLog("Error vizualizando inventario egresos mes id :" .$request->month);  
        Session::flash('warning', 'Error al realizar busqueda!!!');           
    }
    $mensaje = $request->month;
    return view('person.inventario.egresos', compact('product','year','mensaje','mes','rangostart','rangofinish'));
}
/*Egreso filtro por rango de fechas*/
public function byrangoegre(Request $request){
    /*Cuenta cantidad de productos vendidos */
    /*SELECT detall_ventas.codbarra,SUM(detall_ventas.cant) as cant from detall_ventas GROUP BY detall_ventas.codbarra*/

    $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
    $year = $carbon->now()->format('Y');
    $rangostart = $request->fecha_inicio;
    $rangofinish = $request->fecha_fin;

    $perPage = 25;
    $mensaje = "3";
    $mensajerangos = 'Desde '.$request->fecha_inicio. ' a '. $request->fecha_fin;
    $mes = "";

    try {
        $product = detallVenta::groupBy('codbarra','producto','precio')
        ->select('codbarra','producto','precio',\DB::raw('SUM(cant) as cant'))
        ->whereBetween('fecha_egreso', [$request->fecha_inicio, $request->fecha_fin])
        ->whereYear('fecha_egreso','=',$year)
        ->paginate($perPage);
        $this->genLog("Visualizó inventario egresos por rango de fecha :" .$mensaje);
        Session::flash('flash_message', 'Consulta realizada correctamente');            
    } catch (\Exception $e) {
        $this->genLog("Error al visualizar inventario por rango egresos fecha:" .$mensaje);  
        Session::flash('warning', 'Error al realizar busqueda!!!');           
    }
    return view('person.inventario.egresos', compact('product','year','mensaje','mes','mensajerangos','rangostart','rangofinish'));
}



/*Visualiza los egresos de productos que tiene la empresa*/
public function egresos(Request $request)
{
    $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
    $year = $carbon->now()->format('Y');

    $keyword = $request->get('search');
    $perPage = 25;

    $mensaje = "";
        $rangostart = "";
        $rangofinish = "";

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
        $product = detallVenta::groupBy('codbarra','producto','precio')->select('codbarra','producto','precio',\DB::raw('SUM(cant) as cant'))->whereYear('fecha_egreso','=',$year)->paginate($perPage);
        $this->genLog("Visualizó sección egresos.");
    }

    return view('person.inventario.egresos', compact('product','year','mensaje','rangostart','rangofinish'));
}
/*Muestra el inventario por mes
SELECT * FROM products LEFT JOIN (
    SELECT detall_ventas.codbarra, 
    COUNT(*) AS cantidadventas, 
    coalesce(SUM(detall_ventas.cant),0) AS totalventa 
    FROM detall_ventas GROUP BY detall_ventas.codbarra) 
   as tabla ON products.cod_barra = tabla.codbarra
*/
   public function inventariobymonth(Request $request){
    $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
    $year = $carbon->now()->format('Y');
    $mes = $this->gen_month($request->month);
    $mensaje = $request->month;
    
    $perPage = 25;    

    try {

        $product = DB::table("products")
        ->select("products.*","items_count.cantidadventas","items_count.totalventa")
        ->leftJoin(DB::raw("(SELECT codbarra, COUNT(*) AS cantidadventas, coalesce(SUM(cant),0) AS totalventa FROM detall_ventas WHERE date_format(fecha_egreso, '%m') = ".$request->month." and date_format(fecha_egreso, '%Y') = ".$year." GROUP BY codbarra) as items_count"),function($join){
            $join->on("items_count.codbarra","=","products.cod_barra");
        })
        ->whereYear('products.fecha_ingreso','=',$year)
        ->whereMonth('products.fecha_ingreso','=',$request->month)
        ->paginate($perPage);
        $this->genLog("Visualizó inventario completo por mes ".$mes);
    } catch (\Exception $e) {
        $this->genLog("Error visualizando inventario completo mes ".$mes);
    }

    return view('person.inventario.index', compact('product','year','mensaje','mes'));
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

    public function downloadExcelYearInv($type,$year){
        try {
            $this->genLog("Exportó inventario ingresos año ".$year." formato ".$type);

            return Excel::create('exportardatosinventario', function($excel) use ($type,$year) {
                $excel->sheet('mySheet', function($sheet) use ($type,$year){                    

                    $sheet->mergeCells('A1:D1');
                    $sheet->row(1,['INVENTARIO DE PRODUCTOS PERIODO '.$year]);
                    $sheet->row(2,['CÓDIGO', 'PRODUCTO', 'FECHA DE INGRESO', 'INGRESO','STOCK','PVP COMPRA','PVP COM. X INGRESO','PVP VENTA','PVP VENTA X STOCK','GANANCIA FUTURA','ORD. Ventas','VENDIDOS','TOT VENDIDO','MOV GANANCIA']);

                    $productos = Product::orderBy('fecha_ingreso','ASC')->whereYear('fecha_ingreso','=',$year)->get();
                    $productos = DB::table("products")
                    ->select("products.*","items_count.cantidadventas","items_count.totalventa")
                    ->leftJoin(DB::raw("(SELECT codbarra, COUNT(*) AS cantidadventas, coalesce(SUM(cant),0) AS totalventa FROM detall_ventas WHERE date_format(fecha_egreso, '%Y') = ".$year."  GROUP BY codbarra) as items_count"),function($join){
                        $join->on("items_count.codbarra","=","products.cod_barra");
                    })
                    ->whereYear('products.fecha_ingreso','=',$year)
                    ->orderBy('products.fecha_ingreso','ASC')
                    ->get();

                    foreach ($productos as $producto) {
                        $row = [];
                        $row[0] = $producto->cod_barra;
                        $row[1] = $producto->producto;
                        $row[2] = $producto->fecha_ingreso;
                        $row[3] = $producto->compras;
                        $row[4] = $producto->cantidad;
                        $row[5] = $producto->pre_compra;
                        $row[6] = ($producto->pre_compra * $producto->compras);
                        $row[7] = $producto->pre_venta;
                        $row[8] = ($producto->pre_venta * $producto->compras);
                        $row[9] = ($producto->pre_venta * $producto->compras) - ($producto->pre_compra * $producto->compras);
                        $row[10] = $producto->cantidadventas;
                        $row[11] = $producto->totalventa;
                        $row[12] = ($producto->pre_venta * $producto->totalventa);
                        $row[13] = ($producto->pre_venta * $producto->totalventa)-($producto->pre_compra * $producto->compras);
                        $sheet->appendRow($row);
                    }
                });
            })->download($type); 
        } catch (\Exception $e) {
            $this->genLog("Error exporatando inventario completo año ".$year." formato ".$type);
        }     
    }

    public function downloadExcelMonthInv($type,$year,$month){
        try {
            $mes = $this->gen_month($month);
            $this->genLog("Exportó inventario completo año ".$year." mes ".$mes." formato ".$type);
            

            return Excel::create('exportardatosinventario', function($excel) use ($type,$year,$month,$mes) {
                $excel->sheet('mySheet', function($sheet) use ($type,$year,$month,$mes){                    

                    $sheet->mergeCells('A1:D1');
                    $sheet->row(1,['INVENTARIO DE PRODUCTOS PERIODO '.$year.' MES '.$mes]);
                    $sheet->row(2,['CÓDIGO', 'PRODUCTO', 'FECHA DE INGRESO', 'INGRESO','STOCK','PVP COMPRA','PVP COM. X INGRESO','PVP VENTA','PVP VENTA X STOCK','GANANCIA FUTURA','ORD. Ventas','VENDIDOS','TOT VENDIDO','MOV GANANCIA']);

                    $productos = DB::table("products")
                    ->select("products.*","items_count.cantidadventas","items_count.totalventa")
                    ->leftJoin(DB::raw("(SELECT codbarra, COUNT(*) AS cantidadventas, coalesce(SUM(cant),0) AS totalventa FROM detall_ventas WHERE date_format(fecha_egreso, '%Y') = ".$year."  GROUP BY codbarra) as items_count"),function($join){
                        $join->on("items_count.codbarra","=","products.cod_barra");
                    })
                    ->whereYear('products.fecha_ingreso','=',$year)
                    ->whereMonth('products.fecha_ingreso','=',$month)
                    ->orderBy('products.fecha_ingreso','ASC')
                    ->get();


                    foreach ($productos as $producto) {
                        $row = [];
                        $row[0] = $producto->cod_barra;
                        $row[1] = $producto->producto;
                        $row[2] = $producto->fecha_ingreso;
                        $row[3] = $producto->compras;
                        $row[4] = $producto->cantidad;
                        $row[5] = $producto->pre_compra;
                        $row[6] = ($producto->pre_compra * $producto->compras);
                        $row[7] = $producto->pre_venta;
                        $row[8] = ($producto->pre_venta * $producto->compras);
                        $row[9] = ($producto->pre_venta * $producto->compras) - ($producto->pre_compra * $producto->compras);
                        $row[10] = $producto->cantidadventas;
                        $row[11] = $producto->totalventa;
                        $row[12] = ($producto->pre_venta * $producto->totalventa);
                        $row[13] = ($producto->pre_venta * $producto->totalventa)-($producto->pre_compra * $producto->compras);
                        $sheet->appendRow($row);
                    }
                });
            })->download($type);  
        } catch (\Exception $e) {
            $this->genLog("Error exportando inventario completo año ".$year." mes ".$mes." formato ".$type);
        }
    }



    /*Descargas de inventarios ingresos */

    public function downloadExcelYearInvIngresos($type,$year){
        try {
            $this->genLog("Exportó inventario completo año ".$year." formato ".$type);

            return Excel::create('exportardatosinventarioingresos', function($excel) use ($type,$year) {
                $excel->sheet('mySheet', function($sheet) use ($type,$year){                    

                    $sheet->mergeCells('A1:D1');
                    $sheet->row(1,['INVENTARIO DE INGRESOS DE PRODUCTOS PERIODO '.$year]);
                    $sheet->row(2,['CÓDIGO', 'PRODUCTO', 'FECHA DE INGRESO', 'INGRESO','STOCK','PVP COMPRA','PVP COM. X INGRESO']);


                    $productos = DB::table("products")
                    ->select("products.*","items_count.cantidadventas","items_count.totalventa")
                    ->leftJoin(DB::raw("(SELECT codbarra, COUNT(*) AS cantidadventas, coalesce(SUM(cant),0) AS totalventa FROM detall_ventas WHERE date_format(fecha_egreso, '%Y') = ".$year."  GROUP BY codbarra) as items_count"),function($join){
                        $join->on("items_count.codbarra","=","products.cod_barra");
                    })
                    ->whereYear('products.fecha_ingreso','=',$year)
                    ->orderBy('products.fecha_ingreso','ASC')
                    ->get();

                    foreach ($productos as $producto) {
                        $row = [];
                        $row[0] = $producto->cod_barra;
                        $row[1] = $producto->producto;
                        $row[2] = $producto->fecha_ingreso;
                        $row[3] = $producto->compras;
                        $row[4] = $producto->cantidad;
                        $row[5] = $producto->pre_compra;
                        $row[6] = ($producto->pre_compra * $producto->compras);
                        $sheet->appendRow($row);
                    }
                });
            })->download($type); 
        } catch (\Exception $e) {
            $this->genLog("Error exportando inventario ingresos año ".$year." formato ".$type);
        }     
    }

    public function downloadExcelMonthInvIngresos($type,$year,$month){
        try {
            $mes = $this->gen_month($month);
            $this->genLog("Exportó inventario ingresos año ".$year." mes ".$mes." formato ".$type);
            

            return Excel::create('exportardatosinventarioingresos', function($excel) use ($type,$year,$month,$mes) {
                $excel->sheet('mySheet', function($sheet) use ($type,$year,$month,$mes){                    

                    $sheet->mergeCells('A1:D1');
                    $sheet->row(1,['INVENTARIO DE PRODUCTOS PERIODO '.$year.' MES '.$mes]);
                    $sheet->row(2,['CÓDIGO', 'PRODUCTO', 'FECHA DE INGRESO', 'INGRESO','STOCK','PVP COMPRA','PVP COM. X INGRESO']);

                    $productos = DB::table("products")
                    ->select("products.*","items_count.cantidadventas","items_count.totalventa")
                    ->leftJoin(DB::raw("(SELECT codbarra, COUNT(*) AS cantidadventas, coalesce(SUM(cant),0) AS totalventa FROM detall_ventas WHERE date_format(fecha_egreso, '%Y') = ".$year."  GROUP BY codbarra) as items_count"),function($join){
                        $join->on("items_count.codbarra","=","products.cod_barra");
                    })
                    ->whereYear('products.fecha_ingreso','=',$year)
                    ->whereMonth('products.fecha_ingreso','=',$month)
                    ->orderBy('products.fecha_ingreso','ASC')
                    ->get();


                    foreach ($productos as $producto) {
                        $row = [];
                        $row[0] = $producto->cod_barra;
                        $row[1] = $producto->producto;
                        $row[2] = $producto->fecha_ingreso;
                        $row[3] = $producto->compras;
                        $row[4] = $producto->cantidad;
                        $row[5] = $producto->pre_compra;
                        $row[6] = ($producto->pre_compra * $producto->compras);
                        $sheet->appendRow($row);
                    }
                });
            })->download($type);  
        } catch (\Exception $e) {
            $this->genLog("Error exportando inventario ingresos año ".$year." y mes ".$mes." formato ".$type);
        }
    }

    public function downloadExcelMonthInvIngresosRangos($type,$year,$month,$rangostart,$rangofinish){
        try {
            $mes = $this->gen_month($month);
            $this->genLog("Exportó inventario ingresos año ".$year." rango ".$rangostart."/".$rangofinish);
            

            return Excel::create('exportardatosinventarioingresos', function($excel) use ($type,$year,$rangostart,$rangofinish) {
                $excel->sheet('mySheet', function($sheet) use ($type,$year,$rangostart,$rangofinish){                    

                    $sheet->mergeCells('A1:D1');
                    $sheet->row(1,['INVENTARIO DE PRODUCTOS PERIODO '.$year.' RANGO '.$rangostart.'/'.$rangofinish]);
                    $sheet->row(2,['CÓDIGO', 'PRODUCTO', 'FECHA DE INGRESO', 'INGRESO','STOCK','PVP COMPRA','PVP COM. X INGRESO']);

                    $productos = DB::table("products")
                    ->select("products.*","items_count.cantidadventas","items_count.totalventa")
                    ->leftJoin(DB::raw("(SELECT codbarra, COUNT(*) AS cantidadventas, coalesce(SUM(cant),0) AS totalventa FROM detall_ventas WHERE date_format(fecha_egreso, '%Y') = ".$year."  GROUP BY codbarra) as items_count"),function($join){
                        $join->on("items_count.codbarra","=","products.cod_barra");
                    })
                    ->whereBetween('fecha_ingreso', [$rangostart,$rangofinish])
                    ->whereYear('products.fecha_ingreso','=',$year)
                    ->orderBy('products.fecha_ingreso','ASC')
                    ->get();


                    foreach ($productos as $producto) {
                        $row = [];
                        $row[0] = $producto->cod_barra;
                        $row[1] = $producto->producto;
                        $row[2] = $producto->fecha_ingreso;
                        $row[3] = $producto->compras;
                        $row[4] = $producto->cantidad;
                        $row[5] = $producto->pre_compra;
                        $row[6] = ($producto->pre_compra * $producto->compras);
                        $sheet->appendRow($row);
                    }
                });
            })->download($type);  
        } catch (\Exception $e) {
            $this->genLog("Error exportando inventario ingresos por año ".$year." rango ".$rangostart.'/'.$rangofinish);
        }

    }


    /*Descargas de inventarios Egresos */

    public function downloadExcelYearInvEgresos($type,$year){
        try {
            $this->genLog("Exportó inventario completo año ".$year." formato ".$type);

            return Excel::create('exportardatosinventarioegresos', function($excel) use ($type,$year) {
                $excel->sheet('mySheet', function($sheet) use ($type,$year){                    

                    $sheet->mergeCells('A1:D1');
                    $sheet->row(1,['INVENTARIO DE EGRESOS DE PRODUCTOS PERIODO '.$year]);
                    $sheet->row(2,['CÓDIGO', 'PRODUCTO', 'VENDIDOS','PVP VENTA','TOTAL']);


                    $productos = detallVenta::groupBy('codbarra','producto','precio')->select('codbarra','producto','precio',\DB::raw('SUM(cant) as cant'))->whereYear('fecha_egreso','=',$year)
                    ->get();

                    foreach ($productos as $producto) {
                        $row = [];
                        $row[0] = $producto->codbarra;
                        $row[1] = $producto->producto;
                        $row[2] = $producto->cant;
                        $row[3] = $producto->precio;
                        $row[4] = ($producto->precio * $producto->cant);
                        $sheet->appendRow($row);
                    }
                });
            })->download($type); 
        } catch (\Exception $e) {
            $this->genLog("Error exportando inventario egresos año ".$year." formato ".$type);
        }     
    }

    public function downloadExcelMonthInvEgresos($type,$year,$month){
        try {
            $mes = $this->gen_month($month);
            $this->genLog("Exportó inventario egresos año ".$year." mes ".$mes." formato ".$type);
            

            return Excel::create('exportardatosinventarioegresos', function($excel) use ($type,$year,$month,$mes) {
                $excel->sheet('mySheet', function($sheet) use ($type,$year,$month,$mes){                    

                    $sheet->mergeCells('A1:D1');
                    $sheet->row(1,['INVENTARIO DE PRODUCTOS PERIODO '.$year.' MES '.$mes]);
                    $sheet->row(2,['CÓDIGO', 'PRODUCTO', 'VENDIDOS','PVP VENTA','TOTAL']);

                    $productos = detallVenta::groupBy('codbarra','producto','precio')->select('codbarra','producto','precio',\DB::raw('SUM(cant) as cant'))
                    ->whereYear('fecha_egreso','=',$year)
                    ->whereMonth('fecha_egreso','=',$month)
                    ->get();


                    foreach ($productos as $producto) {
                        $row = [];
                        $row[0] = $producto->codbarra;
                        $row[1] = $producto->producto;
                        $row[2] = $producto->cant;
                        $row[3] = $producto->precio;
                        $row[4] = ($producto->precio * $producto->cant);
                        $sheet->appendRow($row);
                    }
                });
            })->download($type);  
        } catch (\Exception $e) {
            $this->genLog("Error exportando inventario egresos año ".$year." mes ".$mes." formato ".$type);
        }
    }

    public function downloadExcelMonthInvEgresosRangos($type,$year,$month,$rangostart,$rangofinish){
        try {
            $mes = $this->gen_month($month);
            $this->genLog("Exportó inventario egresos año ".$year." rango ".$rangostart."/".$rangofinish);
            

            return Excel::create('exportardatosinventarioegresos', function($excel) use ($type,$year,$rangostart,$rangofinish) {
                $excel->sheet('mySheet', function($sheet) use ($type,$year,$rangostart,$rangofinish){                    

                    $sheet->mergeCells('A1:D1');
                    $sheet->row(1,['INVENTARIO DE PRODUCTOS EGRESO PERIODO '.$year.' RANGO '.$rangostart.'/'.$rangofinish]);
                    $sheet->row(2,['CÓDIGO', 'PRODUCTO', 'VENDIDOS','PVP VENTA','TOTAL']);


                    $productos = detallVenta::groupBy('codbarra','producto','precio')
        ->select('codbarra','producto','precio',\DB::raw('SUM(cant) as cant'))
        ->whereBetween('fecha_egreso', [$rangostart, $rangofinish])
        ->whereYear('fecha_egreso','=',$year)
        ->get();


                    foreach ($productos as $producto) {
                        $row = [];
                        $row[0] = $producto->codbarra;
                        $row[1] = $producto->producto;
                        $row[2] = $producto->cant;
                        $row[3] = $producto->precio;
                        $row[4] = ($producto->precio * $producto->cant);
                        $sheet->appendRow($row);
                    }
                });
            })->download($type);  
        } catch (\Exception $e) {
            $this->genLog("Error exportando inventario egresos por año ".$year." rango ".$rangostart.'/'.$rangofinish);
        }

    }

    public function genLog($mensaje)
    {
        $area = 'Inventario';
        $logs = Svlog::log($mensaje,$area);
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
        return Auth::guard('person');
    }

}
