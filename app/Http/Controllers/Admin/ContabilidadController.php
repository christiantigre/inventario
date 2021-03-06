<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Confcont;
use App\detall_asiento;
use App\num_asiento;
use App\Plan;
use App\Admin;
use App\Almacen;
use App\Agrupacion_sumada;
use Carbon\Carbon;
use App\SvLogAdmin;
use App\tempdetallasiento;
use Session;
use DB;
use App\Perdidas_Ganancias;
use Illuminate\Database\Eloquent\Collection;

class ContabilidadController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'logout']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dato = $this->gen_section();

        $keyword = $request->get('search');
        $perPage = 30;

        if (!empty($keyword)) {
            $config = Confcont::orderBy('id','ASC')->where('generar_contabilidad', 'LIKE', "%$keyword%")
            ->orWhere('assauto_compras', 'LIKE', "%$keyword%")
            ->orWhere('assauto_ventas', 'LIKE', "%$keyword%")
            ->orWhere('assauto_pagos', 'LIKE', "%$keyword%")
            ->orWhere('assauto_gastos', 'LIKE', "%$keyword%")
            ->orWhere('assauto_costos', 'LIKE', "%$keyword%")
            ->orWhere('assauto_inversiones', 'LIKE', "%$keyword%")
            ->orWhere('assauto_cobros', 'LIKE', "%$keyword%")
            ->orWhere('assauto_sueldos', 'LIKE', "%$keyword%")
            ->orWhere('assauto_obligaciones', 'LIKE', "%$keyword%")
            ->orWhere('assauto_impuestos', 'LIKE', "%$keyword%")
            ->orWhere('assauto_servicios', 'LIKE', "%$keyword%")
            ->orWhere('assauto_creditos', 'LIKE', "%$keyword%")
            ->paginate($perPage);
            $this->genLog("Busqueda cont auto :".$keyword);
        } else {
            $config = Confcont::orderBy('id','ASC')->paginate($perPage);
            $this->genLog("Visualizó conf auto");  
        }
        return view('admin.contabilidad.index', compact('config','dato'));
    }

    public function balanceinicial(){;
        //\Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"])
        $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
        $year = $carbon->now()->format('Y');

        $dato = $this->gen_section_balance_inicial();
        $this->genLog("Ingresó a balance inicial");

        $asiento = num_asiento::where('num_asiento','1')->where('periodo',$year)->first();
        if(!empty($asiento)){
            $detalles = detall_asiento::where('asiento_id',$asiento['id'])->get();
        }else{
            $detalles = "";
        }

        return view('admin.contabilidad.balanceinicial.index', compact('dato','asiento','detalles'));
    }

    public function libro(){

        $dato = $this->gen_section_balance_inicial();
        $dato['ventana'] = "Libro";
        $this->genLog("Ingresó a libro general");

        $asientos= num_asiento::orderBy('id','DESC')->where('num_asiento','>','1')->get();
        $cuentas = Plan::orderBy('cod', 'ASC')->get();

        return view('admin.contabilidad.libro.index', compact('dato','asientos','cuentas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBalanceInicial()
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
        $responsable = $username."(".$useremail.")";

        $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
        $year = $carbon->now()->format('Y');
        $fecha = $carbon->now()->format('Y-m-d');
        //$year = "2018";
        $this->genLog("Ingresó a crear Balance Inicial");
        $dato = $this->gen_section_balance_inicial();
        $cuentas = Plan::orderBy('cod', 'ASC')->get();
        $num_asiento = num_asiento::where('periodo',$year)->count();
        $num_asiento = ($num_asiento+1);
        $almacen = Almacen::where('activo',1)->first();
        $nombre_almacen = $almacen->almacen;
        $almacen_id = $almacen->id;
        return view('admin.contabilidad.balanceinicial.create',compact('dato','cuentas','num_asiento','year','fecha','responsable','nombre_almacen','almacen_id'));
    }

    public function createAsiento()
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
        $responsable = $username."(".$useremail.")";

        $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
        $year = $carbon->now()->format('Y');
        $fecha = $carbon->now()->format('Y-m-d');
        //$year = "2018";
        $this->genLog("Ingresó a crear asientos");
        $dato = $this->gen_section_balance_inicial();
        $dato['ventana'] = "Libro";
        $cuentas = Plan::orderBy('cod', 'ASC')->get();
        $num_asiento = num_asiento::where('periodo',$year)->count();
        $num_asiento = ($num_asiento+1);
        $almacen = Almacen::where('activo',1)->first();
        $nombre_almacen = $almacen->almacen;
        $almacen_id = $almacen->id;
        return view('admin.contabilidad.libro.create',compact('dato','cuentas','num_asiento','year','fecha','responsable','nombre_almacen','almacen_id'));
    }

    /**
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

    public function storeBalanceInicial(Request $request)
    {
        $trs = tempdetallasiento::get();
        $carbon = new Carbon();
        $date = $carbon->now();

        $data['saldo_debe'] = DB::table('tempdetallasientos')->sum('saldo_debe');
        $data['saldo_haber'] = DB::table('tempdetallasientos')->sum('saldo_haber');


        $dataAsiento['num_asiento'] = $request['num_asiento'];
        $dataAsiento['concepto'] = $request['concepto'];
        $dataAsiento['periodo'] = $request['periodo'];
        $dataAsiento['fecha'] = $request['fecha'];
        $dataAsiento['saldo_debe'] = $data['saldo_debe'];
        $dataAsiento['saldo_haber'] = $data['saldo_haber'];
        $dataAsiento['responsable'] = $request['responsable'];
        $dataAsiento['activo'] = "1";
        $dataAsiento['almacen_id'] = $request['almacen_id'];
        $dataAsiento['codaux_clase'] = $request['codaux_clase'];
        $dataAsiento['codaux_grupo'] = $request['codaux_grupo'];
        $dataAsiento['codaux_cuenta'] = $request['codaux_cuenta'];
        $dataAsiento['codaux_subcuenta'] = $request['codaux_subcuenta'];
        $dataAsiento['codaux_auxiliar'] = $request['codaux_auxiliar'];
        $dataAsiento['codaux_subauxiliar'] = $request['codaux_subauxiliar'];

        try {
            //Guarda cabecera del asiento
            $asiento = num_asiento::create($dataAsiento);
            //envia los valore del detalle del asiento para guardar el detalle desde la funcion saveItemBalanceInicial
            foreach ($trs as $item) {
                $requestData_returned = $this->saveItemBalanciInicial($item,$asiento->id, $dataAsiento['fecha'],$dataAsiento['almacen_id']);
                $requestData_returned->save();
            }

            tempdetallasiento::truncate();

            Session::flash('flash_message', 'Balance Inicial Guardado correctamente');
            return response()->json(array('message' => 'Balance Inicial Registrado con exito'));
            //return Redirect::to('admin/contabilidad');

        } catch (\Exception $e) {

            Session::flash('warning', 'Error al Guardar el Balance Inicial');     
            return response()->json(array('message' => 'Error al Guardar el Balance Inicial !!!')); 

        }


    }

    public function storeAsiento(Request $request)
    {
        $trs = tempdetallasiento::get();
        $carbon = new Carbon();
        $date = $carbon->now();

        $data['saldo_debe'] = DB::table('tempdetallasientos')->sum('saldo_debe');
        $data['saldo_haber'] = DB::table('tempdetallasientos')->sum('saldo_haber');


        $dataAsiento['num_asiento'] = $request['num_asiento'];
        $dataAsiento['concepto'] = $request['concepto'];
        $dataAsiento['periodo'] = $request['periodo'];
        $dataAsiento['fecha'] = $request['fecha'];
        $dataAsiento['saldo_debe'] = $data['saldo_debe'];
        $dataAsiento['saldo_haber'] = $data['saldo_haber'];
        $dataAsiento['responsable'] = $request['responsable'];
        $dataAsiento['activo'] = "1";
        $dataAsiento['almacen_id'] = $request['almacen_id'];

        try {
            //Guarda cabecera del asiento
            $asiento = num_asiento::create($dataAsiento);
            //envia los valore del detalle del asiento para guardar el detalle desde la funcion saveItemBalanceInicial
            foreach ($trs as $item) {
                $requestData_returned = $this->saveItemBalanciInicial($item,$asiento->id, $dataAsiento['fecha'],$dataAsiento['almacen_id']);
                $requestData_returned->save();
            }

            tempdetallasiento::truncate();

            Session::flash('flash_message', 'Asiento Guardado correctamente');
            return response()->json(array('message' => 'Asiento Registrado con exito'));
            //return Redirect::to('admin/contabilidad');

        } catch (\Exception $e) {

            Session::flash('warning', 'Error al Guardar el asiento');     
            return response()->json(array('message' => 'Error al Guardar el asiento !!!')); 
        }


    }

    protected function saveItemBalanciInicial($detall_asiento, $ass_id, $fecha,$almacen_id)
    {
        $requestData = new detall_asiento;
        $requestData->num_asiento = $detall_asiento->num_asiento;
        $requestData->cod_cuenta = $detall_asiento->cod_cuenta;
        $requestData->cuenta = $detall_asiento->cuenta;
        $requestData->periodo = $detall_asiento->periodo;
        $requestData->fecha = $detall_asiento->fecha;
        $requestData->saldo_debe = $detall_asiento->saldo_debe;
        $requestData->saldo_haber = $detall_asiento->saldo_haber;
        $requestData->concepto_detalle= $detall_asiento->concepto_detalle;
        $requestData->almacen_id= $almacen_id;
        $requestData->asiento_id= $ass_id;
        $requestData->codaux_clase = $detall_asiento->codaux_clase;
        $requestData->codaux_grupo = $detall_asiento->codaux_grupo;
        $requestData->codaux_cuenta = $detall_asiento->codaux_cuenta;
        $requestData->codaux_subcuenta = $detall_asiento->codaux_subcuenta;
        $requestData->codaux_auxiliar = $detall_asiento->codaux_auxiliar;
        $requestData->codaux_subauxiliar = $detall_asiento->codaux_subauxiliar;
        return $requestData;
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

    public function detallAsiento($id)
    {
        $asiento = num_asiento::findOrFail($id);
        $detall_asiento= detall_asiento::where('asiento_id',$id)->get();
        $almacen = Almacen::first();
        dd($asiento);
        //return view('admin.venta.show', compact('ventum','detallventa','almacen'));
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

    public function editarAsiento($id){

        try {

            $mailAdmin = auth('admin')->user()->email;
            $adminid = auth('admin')->user()->id;
            $administrador = Admin::findOrFail($adminid);
            $dataArray['mail'] = $mailAdmin;          
            $dataArray['iduser'] = $adminid;     

            $asiento = num_asiento::findOrFail($id);   
            $num_asiento = $asiento->num_asiento;  

            $detall_asiento= detall_asiento::where('asiento_id',$id)->get();

        } catch (\Exception $e) {         

            $administrador = Admin::findOrFail(1);

        }
        
        $username = $administrador['name'];
        $userid = $administrador['id'];
        $useremail = $administrador['email'];
        $responsable = $username."(".$useremail.")";

        $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
        $year = $carbon->now()->format('Y');
        $fecha = $carbon->now()->format('Y-m-d');
        //$year = "2018";
        $this->genLog("Ingresó a editar el asiento id:".$id);
        $dato = $this->gen_section_balance_inicial();
        $dato['ventana'] = "Libro";
        $cuentas = Plan::orderBy('cod', 'ASC')->get();
        /*$num_asiento = num_asiento::where('periodo',$year)->count();
        $num_asiento = ($num_asiento+1);*/
        $almacen = Almacen::where('activo',1)->first();
        $nombre_almacen = $almacen->almacen;
        $almacen_id = $almacen->id;
        return view('admin.contabilidad.libro.edit',compact('asiento','detall_asiento','dato','cuentas','num_asiento','year','fecha','responsable','nombre_almacen','almacen_id'));
    }


    public function verAsiento($id){

        try {

            $mailAdmin = auth('admin')->user()->email;
            $adminid = auth('admin')->user()->id;
            $administrador = Admin::findOrFail($adminid);
            $dataArray['mail'] = $mailAdmin;          
            $dataArray['iduser'] = $adminid;     

            $asiento = num_asiento::findOrFail($id);   
            $num_asiento = $asiento->num_asiento;  

            $detall_asiento= detall_asiento::where('asiento_id',$id)->get();

        } catch (\Exception $e) {         

            $administrador = Admin::findOrFail(1);

        }
        
        $username = $administrador['name'];
        $userid = $administrador['id'];
        $useremail = $administrador['email'];
        $responsable = $username."(".$useremail.")";

        $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
        $year = $carbon->now()->format('Y');
        $fecha = $carbon->now()->format('Y-m-d');
        //$year = "2018";
        $this->genLog("Ingresó a editar el asiento id:".$id);
        $dato = $this->gen_section_balance_inicial();
        $dato['ventana'] = "Libro";
        $cuentas = Plan::orderBy('cod', 'ASC')->get();
        /*$num_asiento = num_asiento::where('periodo',$year)->count();
        $num_asiento = ($num_asiento+1);*/
        $almacen = Almacen::where('activo',1)->first();
        $nombre_almacen = $almacen->almacen;
        $almacen_id = $almacen->id;
        return view('admin.contabilidad.libro.show',compact('asiento','detall_asiento','dato','cuentas','num_asiento','year','fecha','responsable','nombre_almacen','almacen_id'));
    }

    
    public function editBalanceInicial($id)
    {
        try {

            $mailAdmin = auth('admin')->user()->email;
            $adminid = auth('admin')->user()->id;
            $administrador = Admin::findOrFail($adminid);
            $dataArray['mail'] = $mailAdmin;          
            $dataArray['iduser'] = $adminid;     

            $asiento = num_asiento::findOrFail($id);     

            $detall_asiento= detall_asiento::where('asiento_id',$id)->get();

        } catch (\Exception $e) {         

            $administrador = Admin::findOrFail(1);

        }
        
        $username = $administrador['name'];
        $userid = $administrador['id'];
        $useremail = $administrador['email'];
        $responsable = $username."(".$useremail.")";

        $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
        $year = $carbon->now()->format('Y');
        $fecha = $carbon->now()->format('Y-m-d');
        //$year = "2018";
        $this->genLog("Ingresó a crear Balance Inicial");
        $dato = $this->gen_section_balance_inicial();
        $cuentas = Plan::orderBy('cod', 'ASC')->get();
        $num_asiento = num_asiento::where('periodo',$year)->count();
        $num_asiento = ($num_asiento+1);
        $almacen = Almacen::where('activo',1)->first();
        $nombre_almacen = $almacen->almacen;
        $almacen_id = $almacen->id;
        return view('admin.contabilidad.balanceinicial.edit',compact('asiento','detall_asiento','dato','cuentas','num_asiento','year','fecha','responsable','nombre_almacen','almacen_id'));
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

    public function updateBalanceInicial(Request $request)
    {
        $trs = num_asiento::findorfail($request->id);

        $decimal_debe = str_replace (",", "", $request['saldo_debe']);
        $decimal_haber = str_replace (",", "", $request['saldo_haber']);

        $trs['num_asiento'] = $request['num_asiento'];
        $trs['concepto'] = $request['concepto'];
        $trs['periodo'] = $request['periodo'];
        $trs['fecha'] = $request['fecha'];
        $trs['saldo_debe'] = $decimal_debe;
        $trs['saldo_haber'] = $decimal_haber;
        $trs['responsable'] = $request['responsable'];
        $trs['activo'] = "1";
        $trs['almacen_id'] = $request['almacen_id'];

        try {
            //Actualiza cabecera del asiento
            if($asiento = $trs->update()){
                Session::flash('flash_message', 'Balance Inicial Actualizado correctamente');
                return response()->json(array('message' => 'Balance Inicial Registrado con exito'));
            }
            

        } catch (\Exception $e) {

            Session::flash('warning', 'Error al Guardar el Balance Inicial');     
            return response()->json(array('message' => 'Error al Actualizar el Balance Inicial !!!','data'=>$request->all())); 

        }


    }

    public function upAsiento(Request $request)
    {
        $trs = num_asiento::findorfail($request->id);

        $decimal_debe = str_replace (",", "", $request['saldo_debe']);
        $decimal_haber = str_replace (",", "", $request['saldo_haber']);

        $trs['num_asiento'] = $request['num_asiento'];
        $trs['concepto'] = $request['concepto'];
        $trs['periodo'] = $request['periodo'];
        $trs['fecha'] = $request['fecha'];
        $trs['saldo_debe'] = $decimal_debe;
        $trs['saldo_haber'] = $decimal_haber;
        $trs['responsable'] = $request['responsable'];
        $trs['activo'] = "1";
        $trs['almacen_id'] = $request['almacen_id'];

        try {
            //Actualiza cabecera del asiento
            if($asiento = $trs->update()){
                Session::flash('flash_message', 'Asiento '.$request['num_asiento'].' Actualizado correctamente');
                return response()->json(array('message' => 'Actualizado con exito'));
            }
            

        } catch (\Exception $e) {

            Session::flash('warning', 'Error al Actualziarel asiento'.$e);     
            return response()->json(array('message' => 'Error al Actualizar el asiento !!!','data'=>$request->all())); 

        }


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

    

    public function gen_section(){
        $data = array(
            "txtinicio"=>"Inicio",
            "rutainicio" => "/admin/inicio",
            "txtmodulo" => "CONTABILIDAD",
            "section" => "Contabilidad",
            "rutamodulo" => "/admin/contabilidad",
            "ventana" => "Contabilidad"
        );
        return $data;
    }
    
    public function gen_section_balance_inicial(){
        $data = array(
            "txtinicio"=>"Inicio",
            "rutainicio" => "/admin/inicio",
            "txtmodulo" => "CONTABILIDAD",
            "section" => "Contabilidad",
            "rutamodulo" => "/admin/contabilidad",
            "ventana" => "Balance Inicial"
        );
        return $data;
    }

    public function genLog($mensaje)
    {
        $area = 'Contabilidad';
        $logs = Svlogadmin::log($mensaje,$area);
    }


    protected function guard()
    {
        return Auth::guard('admin');
    }


    public function mayor(){

        $dato = $this->gen_section_balance_inicial();
        $dato['ventana'] = "Mayor";
        $this->genLog("Ingresó a Mayor general");
        /*
        SELECT `cod_cuenta`,`cuenta`,`periodo`,`fecha`,
sum(`saldo_debe`) as debe,sum(`saldo_haber`) as haber,
`asiento_id`,COUNT(*) as contador 
FROM `detall_asientos` where periodo='2018' 
GROUP BY cod_cuenta cuenta
        */
$carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
$year = $carbon->now()->format('Y');

$mayor = DB::table('detall_asientos')
->select('cod_cuenta','cuenta',DB::raw('sum(saldo_debe) as debe,sum(saldo_haber) as haber, count(*) as count'))
->where('periodo', '=', $year)
->groupBy('cod_cuenta','cuenta')
->get();

$sumas = DB::table('detall_asientos')
->select(DB::raw('sum(saldo_debe) as saldo_debe,sum(saldo_haber) as saldo_haber'))
->where('periodo', '=' , $year)
->get();

$sumas_debe = 0;
$sumas_haber = 0;
foreach ($mayor as $obtensaldos) {
    if ($obtensaldos->debe > $obtensaldos->haber) {
        $sumas_debe = ($obtensaldos->debe - $obtensaldos->haber)+$sumas_debe;
    }else{
        $sumas_haber = ($obtensaldos->haber - $obtensaldos->debe)+$sumas_haber;
    }
}
$sumas_saldo['sumas_acreedor']= $sumas_debe;
$sumas_saldo['sumas_deudor']= $sumas_haber;

return view('admin.contabilidad.mayor.index', compact('dato','mayor','sumas','sumas_saldo'));
}

public function mayordetallecuenta($cuenta){

    $dato = $this->gen_section_balance_inicial();
    $dato['ventana'] = "Mayor";
    $this->genLog("Ingresó a detalle Mayor cuenta : ".$cuenta);

    $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
    $year = $carbon->now()->format('Y');

    $detalle = detall_asiento::where('cod_cuenta',$cuenta)->where('periodo',$year)->get();
    $sumas = DB::table('detall_asientos')
    ->select(DB::raw('sum(saldo_debe) as saldo_debe,sum(saldo_haber) as saldo_haber'))
    ->where('periodo', '=' , $year)
    ->where('cod_cuenta', '=' , $cuenta)
    ->get();
    $cuenta_plan = Plan::where('cod',$cuenta)->first();
    $cuenta_name = $cuenta_plan['cuenta'];
    return view('admin.contabilidad.mayor.detall', compact('dato','detalle','cuenta_name','sumas'));
}

public function balancecomprobacion(){

    $dato = $this->gen_section_balance_inicial();
    $dato['ventana'] = "Situación Financiera";
    $this->genLog("Ingresó a Situación Financiera");

    $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
    $year = $carbon->now()->format('Y');

    $situacionfinanciera = Agrupacion_sumada::OrderBy('cod_cuenta','ASC')->Where('cod_cuenta','<','4')->Where('periodo','=',$year)->get();
    
    /*
    $situaciofinanciera = DB::table('detall_asientos')
    ->select('cod_cuenta','cuenta',DB::raw('sum(saldo_debe) as debe,sum(saldo_haber) as haber, count(*) as count'))
    ->where([
        ['cod_cuenta', '<', '4'],
        ['periodo', '=', $year],
    ])
    ->groupBy('cod_cuenta','cuenta')
    ->get();*/
    
        //dd($sumas);
    
    return view('admin.contabilidad.balancecomprobacion.index', compact('dato','situacionfinanciera'));
}


public function estadoresultados(){

    $dato = $this->gen_section_balance_inicial();
    $dato['ventana'] = "Estado de Resultados";
    $this->genLog("Ingresó a Estado de Resultados");

    $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
    $year = $carbon->now()->format('Y');

    $estadoresultados = Agrupacion_sumada::OrderBy('cod_cuenta','ASC')->Where('cod_cuenta','>=','4')->Where('periodo','=',$year)->get();
    
    return view('admin.contabilidad.estadoresultados.index', compact('dato','estadoresultados'));
}


public function selectGrupo($cod_cuenta,$periodo)
    {
        $dato = Agrupacion_sumada::where('cod_cuenta',$cod_cuenta)->where('periodo',$periodo)->get();
        return $dato;
    }



public function perdidasyganancias(){
    $dato = $this->gen_section_balance_inicial();
    $dato['ventana'] = "Perdidas y Ganancias";
    $this->genLog("Ingresó a Perdidas y Ganancias");

    $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
    $year = $carbon->now()->format('Y');

        $perdidasyganancias = DB::table('perdidas_ganancias')
            ->join('sumas_agrupadas', 'perdidas_ganancias.cod_cuenta', '=', 'sumas_agrupadas.cod_cuenta')
            ->select('sumas_agrupadas.cod_cuenta','sumas_agrupadas.cuenta','sumas_agrupadas.saldo_debe','sumas_agrupadas.saldo_haber')
            ->where('sumas_agrupadas.periodo',$year)
            ->get();
            //dd($perdidasyganancias);
    
        return view('admin.contabilidad.perdidasyganancias.index', compact('dato','perdidasyganancias'));

    }






}



