<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SvLogAdmin;
use App\Cuentum;
use App\Grupo;
use Illuminate\Http\Request;
use Session;

class CuentaController extends Controller
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
            $cuenta = Cuentum::orderBy('codigo','ASC')->where('cuenta', 'LIKE', "%$keyword%")
            ->orWhere('codigo', 'LIKE', "%$keyword%")
            ->orWhere('detall', 'LIKE', "%$keyword%")
            ->orWhere('activo', 'LIKE', "%$keyword%")
            ->orWhere('grupo_id', 'LIKE', "%$keyword%")
            ->paginate($perPage);
                $this->genLog("Busqueda cuentas :".$keyword);
        } else {
            $cuenta = Cuentum::orderBy('codigo','ASC')->paginate($perPage);
            $this->genLog("Visualizó cuentas");  
        }

        $notification = array(
    'message' => 'I am a successful message!', 
    'alert-type' => 'success'
);
        
        return view('admin.cuenta.index', compact('cuenta','dato'))->with($notification);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->genLog("Ingresó a crear cuenta"); 
        $dato = $this->gen_section();
        $grupos = Grupo::orderBy('codigo', 'ASC')->where('activo', 1)->pluck('grupo', 'id');
        return view('admin.cuenta.create',compact('dato','grupos'));
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
            'cuenta' => 'required|max:200',
            'codigo' => 'required|max:75|unique:cuentas',
        ]);
        $requestData = $request->all();
        $requestData['grupo'] = $request->grupo;
        try {        

            Cuentum::create($requestData);

            Session::flash('flash_message', 'Guardado correctamente');

        $this->genLog("Registró cuenta ".$request->cuenta); 
        } catch (\Exception $e) {
            $this->genLog("Error al crear cuenta ".$request->cuenta); 

            Session::flash('warning', 'Error al Guardar');  
            return redirect()->back()->withInput();

        }

        return redirect('admin/cuenta');
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
        $cuentum = Cuentum::findOrFail($id);
        $dato = $this->gen_section();
        $this->genLog("Visualizó cuenta id : ".$id); 
        return view('admin.cuenta.show', compact('cuentum','dato'));
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
        $this->genLog("Ingresó a editar cuenta id : ".$id); 
        $cuentum = Cuentum::findOrFail($id);
        $grupos = Grupo::orderBy('codigo', 'ASC')->where('activo', 1)->pluck('grupo', 'id');
        return view('admin.cuenta.edit', compact('cuentum','grupos','dato'));
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
            'cuenta' => 'required|max:200',
            'codigo' => 'required|max:10|unique:cuentas,codigo,'.$id,
        ]);

        $requestData = $request->all();
        
        $requestData['grupo'] = $request->grupo;

        try {

            $cuentum = Cuentum::findOrFail($id);

            $cuentum->update($requestData);

            Session::flash('flash_message', 'Actualizado correctamente');
 $this->genLog("Actualizó a cuenta id : ".$id); 
        } catch (\Exception $e) {
            $this->genLog("Error al actualizar cuenta id : ".$id); 
            Session::flash('warning', 'Error al Actualizar');  
            return redirect()->back()->withInput();
        }

        return redirect('admin/cuenta');
    }

    public function gen_section(){
        $data = array(
            "txtinicio"=>"Inicio",
            "rutainicio" => "/admin/inicio",
            "txtmodulo" => "CONTABILIDAD",
            "section" => "Contabilidad",
            "rutamodulo" => "/admin/cuenta",
            "ventana" => "Cuentas"
        );

        return $data;
    }
    public function genLog($mensaje)
    {
        $area = 'Cuentas';
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
        Cuentum::destroy($id);
            $this->genLog("Eliminó a cuenta id : ".$id); 
Session::flash('flash_message', 'Eliminado correctamente');
        } catch (\Exception $e) {
            $this->genLog("Error al eliminar cuenta id : ".$id); 
            Session::flash('warning', '!!!Error al Eliminar');
        }

        return redirect('admin/cuenta');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
