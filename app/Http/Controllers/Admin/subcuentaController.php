<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SvLogAdmin;
use App\subcuentum;
use App\Cuentum;
use Illuminate\Http\Request;
use Session;

class subcuentaController extends Controller
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
            $subcuenta = subcuentum::where('subcuenta', 'LIKE', "%$keyword%")
            ->orWhere('codigo', 'LIKE', "%$keyword%")
            ->orWhere('detall', 'LIKE', "%$keyword%")
            ->orWhere('activo', 'LIKE', "%$keyword%")
            ->orWhere('cuenta_id', 'LIKE', "%$keyword%")
            ->paginate($perPage);
            $this->genLog("Busqueda subcuentas :".$keyword);
        } else {
            $subcuenta = subcuentum::OrderBy('codigo','ASC')->paginate($perPage);
            $this->genLog("Visualizó subcuentas");  
        }

        return view('admin.subcuenta.index', compact('subcuenta','dato'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {        
        $dato = $this->gen_section();  
        $this->genLog("Ingresó a crear subcuenta"); 
        $cuentas = Cuentum::orderBy('codigo', 'ASC')->where('activo', 1)->pluck('cuenta', 'id');
        return view('admin.subcuenta.create',compact('dato','cuentas'));
    }

    
    public function variassubctas(Request $request)
    {        
        $dato = $this->gen_section(); 
        $this->genLog("Ingresó a crear varias subcuenta"); 
        $cuentas = Cuentum::orderBy('codigo', 'ASC')->where('activo', 1)->pluck('cuenta', 'id');
        return view('admin.subcuenta.variassubctas',compact('dato','cuentas'));
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
           'subcuenta' => 'required|max:200',           
            'codigo' => 'required|max:15|unique:subcuentas',
       ]);
        $requestData = $request->all();

        $requestData['cuenta'] = $request->cuenta;
        
        try {

            subcuentum::create($requestData);
            Session::flash('flash_message', 'Guardado correctamente');
            $this->genLog("Registró subcuenta ".$request->subcuenta); 
        } catch (\Exception $e) {
            $this->genLog("Error al crear subcuenta ".$request->subcuenta);

            Session::flash('warning', 'Error al Guardar');  
            return redirect()->back()->withInput();
        }

        return redirect('admin/subcuenta');
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
        $subcuentum = subcuentum::findOrFail($id);
        $dato = $this->gen_section();
        $this->genLog("Visualizó subcuenta id : ".$id); 

        return view('admin.subcuenta.show', compact('subcuentum','dato'));
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

        $subcuentum = subcuentum::findOrFail($id);

        $cuentas = Cuentum::orderBy('codigo', 'ASC')->where('activo', 1)->pluck('cuenta', 'id');
        $this->genLog("Visualizó subcuenta id : ".$id); 

        return view('admin.subcuenta.edit', compact('subcuentum','cuentas','dato'));
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
            'subcuenta' => 'required|max:200',
            'codigo' => 'required|max:15|unique:subcuentas,codigo,'.$id,
       ]);
        $requestData = $request->all();

        $requestData['cuenta'] = $request->cuenta;
        try {

            $subcuentum = subcuentum::findOrFail($id);
            $subcuentum->update($requestData);
            Session::flash('flash_message', 'Actualizado correctamente');
            $this->genLog("Actualizó a subcuenta id : ".$id); 
        } catch (\Exception $e) {
            $this->genLog("Error al actualizar subcuenta id : ".$id); 
            Session::flash('warning', 'Error al Actualizar');  
            return redirect()->back()->withInput();
        }

        return redirect('admin/subcuenta')->with('flash_message', 'subcuentum updated!');
    }

    public function gen_section(){
        $data = array(
            "txtinicio"=>"Inicio",
            "rutainicio" => "/admin/inicio",
            "txtmodulo" => "CONTABILIDAD",
            "section" => "Contabilidad",
            "rutamodulo" => "/admin/subcuenta",
            "ventana" => "Subcuentas"
        );

        return $data;
    }

    public function genLog($mensaje)
    {
        $area = 'SubCuentas';
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
            subcuentum::destroy($id);
            $this->genLog("Eliminó a subcuenta id : ".$id); 
            Session::flash('flash_message', 'Eliminado correctamente');
        } catch (\Exception $e) {
            $this->genLog("Error al eliminar subcuenta id : ".$id); 
            Session::flash('warning', '!!!Error al Eliminar');
        }

        return redirect('admin/subcuenta')->with('flash_message', 'subcuentum deleted!');
    }
    
    protected function guard()
    {
        return Auth::guard('admin');
    }

}
