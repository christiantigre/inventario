<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Confcont;
use App\SvLogAdmin;
use Session;
use App\Cuentum;
use App\Perdidas_Ganancias;
use App\Plan;

class ConfcontblController extends Controller
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
            $perdidasganancias = Perdidas_Ganancias::orderBy('id','ASC')->paginate($perPage);
            $this->genLog("Visualizó conf auto");  
        }
        return view('admin.contabilidad.config_contabilidad.index', compact('config','dato','perdidasganancias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dato = $this->gen_section();
        $this->genLog("Ingresó a registrar nuevo tipo de asiento automaticos"); 
    }

    public function crearperdidadyganancias(){
        $cuentas = Plan::orderBy('cod', 'ASC')->get();
        $dato = $this->gen_section();
        $this->genLog("Ingresó a configuración de perdidas y ganancias"); 
        return view('admin.contabilidad.config_contabilidad.create', compact('dato','cuentas'));
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

    public function storeperdidadyganancias(Request $request)
    {
        $this->validate($request, [
            'cuenta' => 'required|max:200',
            'cod_cuenta' => 'required|max:75',
        ]);
        $requestData = $request->all();
        try {        

            Perdidas_Ganancias::create($requestData);

            Session::flash('flash_message', 'Guardado correctamente');

        $this->genLog("Registró cuenta ".$request->cuenta); 
        } catch (\Exception $e) {
            $this->genLog("Error al crear ".$request->cuenta); 

            Session::flash('warning', 'Error al Guardar');  
            return redirect()->back()->withInput();

        }
         return redirect('admin/confcontbl');
    }

    public function editperdidadyganancias($id){

        $cuentas = Plan::orderBy('cod', 'ASC')->get();
        $dato = $this->gen_section();
        $this->genLog("Ingresó a editar cuenta perdidas y ganancias id : ".$id); 
        $perdidasyganancias = Perdidas_Ganancias::findOrFail($id);
        return view('admin.contabilidad.config_contabilidad.editpyg', compact('perdidasyganancias','dato','cuentas'));
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
        $dato = $this->gen_section();
        $config = Confcont::findOrFail($id);
        $this->genLog("Ingresó a editar asientos automaticos"); 
        return view('admin.contabilidad.config_contabilidad.edit', compact('config','dato'));
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
        $requestData = $request->all();

        try {
            
            $config = Confcont::findOrFail($id);

            $config->update($requestData);

            Session::flash('flash_message', 'Actualizado correctamente');

            $this->genLog("Actualizar asientos automaticos"); 
        } catch (\Exception $e) {

            $this->genLog("Error al actualizar");   
            Session::flash('warning', '!!!Error al Actualizar asientos automaticos config');          

        }

        return redirect('admin/confcontbl');
    }
    
    public function updateperdidadyganancias(Request $request, $id)
    {
        $requestData = $request->all();

        try {
            
            $pyg = Perdidas_Ganancias::findOrFail($id);

            $pyg->update($requestData);

            Session::flash('flash_message', 'Actualizado correctamente');
            $this->genLog("Actualizar cuentas de perdidas y ganancias"); 

        } catch (\Exception $e) {

            $this->genLog("Error al actualizar asientos automaticos");   
            Session::flash('warning', '!!!Error al Actualizar perdidas y ganancias');

        }

        return redirect('admin/confcontbl');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function gen_section(){
        $data = array(
            "txtinicio"=>"Inicio",
            "rutainicio" => "/admin/inicio",
            "txtmodulo" => "CONTABILIDAD",
            "section" => "Contabilidad",
            "rutamodulo" => "/admin/confcontbl",
            "ventana" => "Config"
        );

        return $data;
    }

    public function genLog($mensaje)
    {
        $area = 'ConfiguraciónContbl';
        $logs = Svlogadmin::log($mensaje,$area);
    }

    public function destroy($id)
    {
        try {
            Perdidas_Ganancias::destroy($id);
            $this->genLog("Eliminó a cuenta de perdidas y ganancias id : ".$id); 
            Session::flash('flash_message', 'Eliminado correctamente');
        } catch (\Exception $e) {
            $this->genLog("Error al eliminar cuenta de perdidas y ganancias id : ".$id); 
            Session::flash('warning', '!!!Error al Eliminar');
        }

        return redirect('admin/confcontbl');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
