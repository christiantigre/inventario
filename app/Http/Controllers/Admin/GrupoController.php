<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SvLogAdmin;
use App\Grupo;
use Illuminate\Http\Request;
use App\clase;
use Session;

class GrupoController extends Controller
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
        $perPage = 25;

        if (!empty($keyword)) {
            $grupo = Grupo::orderBy('codigo','ASC')
                ->where('grupo', 'LIKE', "%$keyword%")
                ->orWhere('codigo', 'LIKE', "%$keyword%")
                ->orWhere('detall', 'LIKE', "%$keyword%")
                ->orWhere('activo', 'LIKE', "%$keyword%")
                ->orWhere('clase_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
                $this->genLog("Busqueda grupo :".$keyword);
        } else {
            $grupo = Grupo::orderBy('codigo','ASC')->paginate($perPage);
            $this->genLog("Visualizó grupos");  
        }

        return view('admin.grupo.index', compact('grupo','dato'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $dato = $this->gen_section();
        $clases = clase::orderBy('id', 'ASC')->where('activo', 1)->pluck('clase', 'id');

        $this->genLog("Ingresó a crear grupo"); 
        return view('admin.grupo.create',compact('dato','clases'));
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
            'grupo' => 'required|max:191',
			'codigo' => 'required|max:6|unique:grupos',
		]);
        $requestData = $request->all();
        try {
        Grupo::create($requestData);
            
        Session::flash('flash_message', 'Guardado correctamente');
        $this->genLog("Registró cuenta ".$request->grupo); 

        } catch (\Exception $e) {
            $this->genLog("Error al crear grupo ".$request->grupo); 
            
            Session::flash('warning', '!!!Error al Guardar');
        }

        return redirect('admin/grupo');
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
        $grupo = Grupo::findOrFail($id);
        $this->genLog("Visualizó grupo id : ".$id); 
        $dato = $this->gen_section();
        return view('admin.grupo.show', compact('grupo','dato'));
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
        $this->genLog("Ingresó a editar grupo id : ".$id); 

        $dato = $this->gen_section();

        $grupo = Grupo::findOrFail($id);
        $clases = clase::orderBy('id', 'ASC')->where('activo', 1)->pluck('clase', 'id');

        return view('admin.grupo.edit', compact('grupo','dato','clases'));
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
            'grupo' => 'required|max:75',
            'codigo' => 'required|max:6|unique:grupos,codigo,'.$id,
		]);
        $requestData = $request->all();
        try {

        $grupo = Grupo::findOrFail($id);
        $grupo->update($requestData);
             $this->genLog("Actualizó a grupo id : ".$id); 
        Session::flash('flash_message', 'Actualizado correctamente');
        } catch (\Exception $e) {
            $this->genLog("Error al actualizar grupo id : ".$id); 
        Session::flash('warning', '!!!Error al Actualizar');
        }

        return redirect('admin/grupo');
    }


    public function gen_section(){
        $data = array(
            "txtinicio"=>"Inicio",
            "rutainicio" => "/admin/inicio",
            "txtmodulo" => "CONTABILIDAD",
            "section" => "Contabilidad",
            "rutamodulo" => "/admin/grupo",
            "ventana" => "Grupos"
        );

        return $data;
    }

    public function genLog($mensaje)
    {
        $area = 'Grupos';
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
        Grupo::destroy($id);
        $this->genLog("Eliminó a grupos id : ".$id); 
Session::flash('flash_message', 'Eliminado correctamente');
            
        } catch (\Exception $e) {
            $this->genLog("Error al eliminar grupo id : ".$id); 
            Session::flash('warning', '!!!Error al Eliminar');
        }

        return redirect('admin/grupo');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
