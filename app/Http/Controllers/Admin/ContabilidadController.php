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
use Session;

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

            $asiento = num_asiento::where('num_asiento','1')->get();

            if(empty($asiento)){
                $detalles = detall_asiento::where('asiento_id',$asiento->num_asiento)->get();
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
