<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\subauxiliar;
use App\auxiliar;
use Illuminate\Http\Request;
use Session;
use App\SvLogAdmin;

class subauxiliarController extends Controller
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
            $subauxiliar = subauxiliar::where('subauxiliar', 'LIKE', "%$keyword%")
                ->orWhere('codigo', 'LIKE', "%$keyword%")
                ->orWhere('detall', 'LIKE', "%$keyword%")
                ->orWhere('activo', 'LIKE', "%$keyword%")
                ->orWhere('auxiliar_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
                $this->genLog("Busqueda sub-auxiliar :".$keyword);
        } else {
            $subauxiliar = subauxiliar::paginate($perPage);
            $this->genLog("Busqueda sub-auxiliares");
        }

        return view('admin.subauxiliar.index', compact('subauxiliar','dato'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $dato = $this->gen_section();  
        $this->genLog("Ingresó a crear cta sub-auxiliar"); 
        $auxiliares = auxiliar::orderBy('codigo', 'ASC')->where('activo', 1)->pluck('auxiliar', 'id');
        return view('admin.subauxiliar.create',compact('dato','auxiliares'));
    }

    public function variasSubaux(Request $request)
    {        
        $dato = $this->gen_section();
        $this->genLog("Ingresó a crear varias cta sub-auxiliar"); 

        $auxiliares = auxiliar::orderBy('codigo', 'ASC')->where('activo', 1)->pluck('auxiliar', 'id');
        return view('admin.subauxiliar.variasSubAux',compact('dato','auxiliares'));

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
			'subauxiliar' => 'required|max:200'
		]);
        $requestData = $request->all();
        try {
        subauxiliar::create($requestData);
            Session::flash('flash_message', 'Guardado correctamente');
            $this->genLog("Registró sub-auxiliar ".$request->subauxiliar); 
            
        } catch (\Exception $e) {
            
            $this->genLog("Error al crear subauxiliar ".$request->subauxiliar);
            Session::flash('warning', 'Error al Guardar');  
            return redirect()->back()->withInput();
        }

        return redirect('admin/subauxiliar');
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
        $subauxiliar = subauxiliar::findOrFail($id);
        $dato = $this->gen_section();

        $this->genLog("Visualizó sub-auxiliar id : ".$id);
        return view('admin.subauxiliar.show', compact('subauxiliar','dato'));
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
        $auxiliares = auxiliar::orderBy('codigo', 'ASC')->where('activo', 1)->pluck('auxiliar', 'id');

        $subauxiliar = subauxiliar::findOrFail($id);

        $this->genLog("Visualizó subauxiliar id : ".$id); 
        return view('admin.subauxiliar.edit', compact('subauxiliar','dato','auxiliares'));
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
			'subauxiliar' => 'required|max:200',
            'codigo' => 'required|max:30|unique:subauxiliars,codigo,'.$id,
		]);
        $requestData = $request->all();
        try {
        $subauxiliar = subauxiliar::findOrFail($id);
        $subauxiliar->update($requestData);
            Session::flash('flash_message', 'Actualizado correctamente');
            $this->genLog("Actualizó a subauxiliar id : ".$id); 
        } catch (\Exception $e) {
            $this->genLog("Error al actualizar subauxiliar id : ".$id); 
            Session::flash('warning', 'Error al Actualizar');  
            return redirect()->back()->withInput();
        }

        return redirect('admin/subauxiliar')->with('flash_message', 'subauxiliar updated!');
    }


    public function gen_section(){
        $data = array(
            "txtinicio"=>"Inicio",
            "rutainicio" => "/admin/inicio",
            "txtmodulo" => "CONTABILIDAD",
            "section" => "Contabilidad",
            "rutamodulo" => "/admin/subauxiliar",
            "ventana" => "Subauxiliar"
        );

        return $data;
    }

    public function genLog($mensaje)
    {
        $area = 'SubAuxiliar';
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
            subauxiliar::destroy($id);
            $this->genLog("Eliminó a subauxiliar id : ".$id); 
            Session::flash('flash_message', 'Eliminado correctamente');
        } catch (\Exception $e) {
            $this->genLog("Error al eliminar auxiliar id : ".$id); 
            Session::flash('warning', '!!!Error al Eliminar');
        }

        return redirect('admin/subauxiliar');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
