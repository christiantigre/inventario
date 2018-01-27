<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Plan;
use Excel;
use Session;
use App\SvLogAdmin;

class PlanController extends Controller
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
            $cuentas = Plan::orderBy('cod','ASC')->where('cuenta', 'LIKE', "%$keyword%")
            ->orWhere('cod', 'LIKE', "%$keyword%")
            ->get();
                $this->genLog("Busqueda plan cuentas : ".$keyword);
        } else {
            $cuentas = Plan::orderBy('cod','ASC')->get();
            $this->genLog("Visualizó plan contable");
        }


        return view('admin.plancuentas.index', compact('dato','cuentas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadExcel($type){
        $data = Plan::get()->toArray();
        return Excel::create('planontable', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

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
            "rutamodulo" => "/admin/cuenta",
            "ventana" => "Plan"
        );

        return $data;
    }

    public function genLog($mensaje)
    {
        $area = 'Plan Contable';
        $logs = Svlogadmin::log($mensaje,$area);
    }


    protected function guard()
    {
        return Auth::guard('admin');
    }



}
