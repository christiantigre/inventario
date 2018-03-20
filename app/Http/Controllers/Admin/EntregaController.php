<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Entrega;
use Illuminate\Http\Request;
use App\SvLogAdmin;
use Session;

class EntregaController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin', ['except' => 'logout']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $dato = $this->gen_section();

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $entrega = Entrega::where('metodo', 'LIKE', "%$keyword%")
            ->orWhere('detalle', 'LIKE', "%$keyword%")
            ->orWhere('activo', 'LIKE', "%$keyword%")
            ->paginate($perPage);
        } else {
            $entrega = Entrega::paginate($perPage);
        }

        return view('admin.entrega.index', compact('entrega','dato'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $dato = $this->gen_section();
        return view('admin.entrega.create',compact('dato'));
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
            'detalle' => 'required|max:200',
            'metodo' => 'required|max:191|unique:entregas',
        ]);
        
        $requestData = $request->all();

        try {
            
            Entrega::create($requestData);

            Session::flash('flash_message', 'Guardado correctamente');

            $this->genLog("Registró metodo de entrega  ".$request->metodo); 
            
        } catch (\Exception $e) {

            $this->genLog("Error al crear metodo de entrega ".$request->metodo);
            Session::flash('warning', 'Error al Guardar');  
            return redirect()->back()->withInput();
            
        }
        

        return redirect('admin/entrega');
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
        $dato = $this->gen_section();

        $entrega = Entrega::findOrFail($id);

        return view('admin.entrega.show', compact('entrega','dato'));
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

        $entrega = Entrega::findOrFail($id);

        return view('admin.entrega.edit', compact('entrega','dato'));
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
            'detalle' => 'required|max:200',
            'metodo' => 'required|max:191|unique:entregas',
        ]);

        $requestData = $request->all();
        
        try {

            $entrega = Entrega::findOrFail($id);
            $entrega->update($requestData);
            Session::flash('flash_message', 'Actualizado correctamente');
            $this->genLog("Actualizó a metodo id : ".$id); 
            
        } catch (\Exception $e) {
            $this->genLog("Error al actualizar metodo id : ".$id); 
            Session::flash('warning', 'Error al Actualizar');  
            return redirect()->back()->withInput();
        }

        return redirect('admin/entrega');
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
            
            Entrega::destroy($id);
            $this->genLog("Eliminó metodo de entrega id : ".$id); 
            Session::flash('flash_message', 'Eliminado correctamente');

        } catch (\Exception $e) {
            $this->genLog("Error al eliminar metodo de entrega id : ".$id); 
            Session::flash('warning', '!!!Error al Eliminar');
        }

        return redirect('admin/entrega');
    }

    public function gen_section(){
        $data = array(
            "txtinicio"=>"Inicio",
            "rutainicio" => "/admin/inicio",
            "txtmodulo" => "CONFIGURACIÓN",
            "section" => "Entregas",
            "rutamodulo" => "/adminentrega",
            "ventana" => "Métodos"
        );

        return $data;
    }

    public function genLog($mensaje)
    {
        $area = 'Metodos de entegas';
        $logs = Svlogadmin::log($mensaje,$area);
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    
}
