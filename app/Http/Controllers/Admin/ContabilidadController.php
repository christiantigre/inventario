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
use Carbon\Carbon;
use App\SvLogAdmin;
use App\tempdetallasiento;
use Session;
use DB;

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

    public function balanceinicial(){
        $dato = $this->gen_section_balance_inicial();
        $this->genLog("Ingresó a balance inicial");

        $asiento = num_asiento::where('num_asiento','1')->first();
        if(!empty($asiento)){
            $detalles = detall_asiento::where('asiento_id',$asiento['id'])->get();
        }else{
            $detalles = "";
        }

        return view('admin.contabilidad.balanceinicial.index', compact('dato','asiento','detalles'));
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

        } catch (\Exception $e) {

            Session::flash('warning', 'Error al Guardar el Balance Inicial');     
            return response()->json(array('message' => 'Error al Guardar el Balance Inicial !!!')); 

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



}
