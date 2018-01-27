<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SvLogAdmin;
use App\auxiliar;
use Illuminate\Http\Request;
use App\subcuentum;
use Session;

class auxiliarController extends Controller
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
        $dato = $this->gen_section();

        $keyword = $request->get('search');
        $perPage = 30;

        if (!empty($keyword)) {
            $auxiliar = auxiliar::where('auxiliar', 'LIKE', "%$keyword%")
            ->orWhere('codigo', 'LIKE', "%$keyword%")
            ->orWhere('detall', 'LIKE', "%$keyword%")
            ->orWhere('activo', 'LIKE', "%$keyword%")
            ->orWhere('subcuenta_id', 'LIKE', "%$keyword%")
            ->paginate($perPage);
            $this->genLog("Busqueda auxiliar :".$keyword);
        } else {
            $auxiliar = auxiliar::OrderBy('codigo','ASC')->paginate($perPage);
            $this->genLog("Visualizó auxiliares"); 
        }
        return view('admin.auxiliar.index', compact('auxiliar','dato'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $dato = $this->gen_section();
        $this->genLog("Ingresó a crear cta auxiliar"); 
        $subcuentas = subcuentum::orderBy('codigo', 'ASC')->where('activo', 1)->pluck('subcuenta', 'id');
        return view('admin.auxiliar.create',compact('dato','subcuentas'));
    }
    
    public function variasaux(Request $request)
    {        
        $dato = $this->gen_section();
        $this->genLog("Ingresó a crear varias ctas auxiliares"); 
        $subcuentas = subcuentum::orderBy('codigo', 'ASC')->where('activo', 1)->pluck('subcuenta', 'id');
        return view('admin.auxiliar.variasaux',compact('dato','subcuentas'));
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
        $this->validate($request, [
         'auxiliar' => 'required|max:200',
         'codigo' => 'required|max:15|unique:auxiliars',
     ]);
        $requestData = $request->all();
        try {
            auxiliar::create($requestData);
            Session::flash('flash_message', 'Guardado correctamente');
            $this->genLog("Registró auxiliar ".$request->auxiliar); 
        } catch (\Exception $e) {
            $this->genLog("Error al crear auxiliar ".$request->auxiliar);
            Session::flash('warning', 'Error al Guardar');  
            return redirect()->back()->withInput();
        }

        return redirect('admin/auxiliar');
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
        $auxiliar = auxiliar::findOrFail($id);
        $dato = $this->gen_section();
        $this->genLog("Visualizó auxiliar id : ".$id);

        return view('admin.auxiliar.show', compact('auxiliar','dato'));
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
        $auxiliar = auxiliar::findOrFail($id);
        $dato = $this->gen_section();
        $this->genLog("Visualizó auxiliar id : ".$id); 

        $subcuentas = subcuentum::orderBy('codigo', 'ASC')->where('activo', 1)->pluck('subcuenta', 'id');

        return view('admin.auxiliar.edit', compact('auxiliar','dato','subcuentas'));
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
        $this->validate($request, [
         'auxiliar' => 'required|max:200',
         'codigo' => 'required|max:15|unique:auxiliars,codigo,'.$id,
     ]);
        $requestData = $request->all();
        try {            
            $auxiliar = auxiliar::findOrFail($id);
            $auxiliar->update($requestData);
            Session::flash('flash_message', 'Actualizado correctamente');
            $this->genLog("Actualizó a auxiliar id : ".$id); 
        } catch (\Exception $e) {
            $this->genLog("Error al actualizar auxiliar id : ".$id); 
            Session::flash('warning', 'Error al Actualizar');  
            return redirect()->back()->withInput();
        }

        return redirect('admin/auxiliar');
    }

    public function gen_section(){
        $data = array(
            "txtinicio"=>"Inicio",
            "rutainicio" => "/admin/inicio",
            "txtmodulo" => "CONTABILIDAD",
            "section" => "Contabilidad",
            "rutamodulo" => "/admin/auxiliar",
            "ventana" => "Auxiliares"
        );

        return $data;
    }

    public function genLog($mensaje)
    {
        $area = 'Auxiliar';
        $logs = Svlogadmin::log($mensaje,$area);
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
        try {

            auxiliar::destroy($id);
            $this->genLog("Eliminó a auxiliar id : ".$id); 
            Session::flash('flash_message', 'Eliminado correctamente');
        } catch (\Exception $e) {
            $this->genLog("Error al eliminar auxiliar id : ".$id); 
            Session::flash('warning', '!!!Error al Eliminar');
        }

        return redirect('admin/auxiliar');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
