<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SvLogAdmin;
use App\clase;
use Illuminate\Http\Request;
use Session;

class claseController extends Controller
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
            $clase = clase::where('clase', 'LIKE', "%$keyword%")
                ->orWhere('codigo', 'LIKE', "%$keyword%")
                ->orWhere('detall', 'LIKE', "%$keyword%")
                ->orWhere('activo', 'LIKE', "%$keyword%")
                ->paginate($perPage);

                $this->genLog("Busqueda clase :".$keyword);
        } else {
            $clase = clase::paginate($perPage);
            $this->genLog("Visualizó clases");   
        }

        return view('admin.clase.index', compact('clase','dato'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $dato = $this->gen_section();
        $this->genLog("Ingresó a crear clase");  
        return view('admin.clase.create',compact('dato'));
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
            'clase' => 'required|max:15',
            'codigo' => 'required|max:3|unique:clases',
        ]);

        $requestData = $request->all();
        try {
            
        clase::create($requestData);
        Session::flash('flash_message', 'Guardado correctamente');
        } catch (\Exception $e) {
            Session::flash('warning', '!!!Error al Guardar');
        }

        return redirect('admin/clase');
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
        $clase = clase::findOrFail($id);
        $this->genLog("Visualizó clase id : ".$id); 
        $dato = $this->gen_section();

        return view('admin.clase.show', compact('clase','dato'));
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
        $dato = $this->gen_section();

        $clase = clase::findOrFail($id);

        $this->genLog("Ingresó a editar clase id : ".$id); 

        return view('admin.clase.edit', compact('clase','dato'));
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
            'clase' => 'required|max:15',
            'codigo' => 'required|max:3|unique:clases,codigo,'.$id,
        ]);

        $requestData = $request->all();

        try {            
        
        $clase = clase::findOrFail($id);
        $clase->update($requestData);

        $this->genLog("Actualizó a clase id : ".$id); 
        Session::flash('flash_message', 'Actualizado correctamente');
        } catch (\Exception $e) {
            
        $this->genLog("Error al actualizar clase id : ".$id); 
        Session::flash('warning', '!!!Error al Actualizar');
        }

        return redirect('admin/clase');
    }

    public function gen_section(){
        $data = array(
            "txtinicio"=>"Inicio",
            "rutainicio" => "/admin/inicio",
            "txtmodulo" => "CONTABILIDAD",
            "section" => "Contabilidad",
            "rutamodulo" => "/admin/clase",
            "ventana" => "Clases"
        );

        return $data;
    }

    public function genLog($mensaje)
    {
        $area = 'Clases';
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
            
        clase::destroy($id);
        $this->genLog("Eliminó a clase id : ".$id); 
Session::flash('flash_message', 'Eliminado correctamente');
        } catch (\Exception $e) {

        $this->genLog("Error al eliminar clase id : ".$id); 
            Session::flash('warning', '!!!Error al Eliminar');
        }


        return redirect('admin/clase');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
    
}
