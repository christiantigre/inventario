<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SvLogAdmin;
use App\tipocuentum;
use Illuminate\Http\Request;

class tipocuentaController extends Controller
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
            $tipocuenta = tipocuentum::where('nombre', 'LIKE', "%$keyword%")
                ->orWhere('detall', 'LIKE', "%$keyword%")
                ->orWhere('activo', 'LIKE', "%$keyword%")
                ->paginate($perPage);
                $this->genLog("Busqueda datos tipo cta contable :".$keyword);
        } else {
            $tipocuenta = tipocuentum::paginate($perPage);
            $this->genLog("Visualizó tipo ctas");            
        }

        return view('admin.tipocuenta.index', compact('tipocuenta','dato'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.tipocuenta.create');
        $this->genLog("Ingresó a crear nivel");            
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
        
        $requestData = $request->all();
        
        tipocuentum::create($requestData);

        return redirect('admin/tipocuenta')->with('flash_message', 'tipocuentum added!');
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
        $tipocuentum = tipocuentum::findOrFail($id);

        return view('admin.tipocuenta.show', compact('tipocuentum'));
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
        $tipocuentum = tipocuentum::findOrFail($id);

        return view('admin.tipocuenta.edit', compact('tipocuentum'));
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
        
        $requestData = $request->all();
        
        $tipocuentum = tipocuentum::findOrFail($id);
        $tipocuentum->update($requestData);

        return redirect('admin/tipocuenta')->with('flash_message', 'tipocuentum updated!');
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
        tipocuentum::destroy($id);

        return redirect('admin/tipocuenta')->with('flash_message', 'tipocuentum deleted!');
    }

    /**
     * Guarda los eventos que realize el usuario.
     *
     * @param  string  $mensaje
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function gen_section(){
        $data = array(
            "txtinicio"=>"Inicio",
            "rutainicio" => "/admin/inicio",
            "txtmodulo" => "CONTABILIDAD",
            "section" => "Contabilidad",
            "rutamodulo" => "/admin/tipocuenta",
            "ventana" => "Niveles"
        );

        return $data;
    }

    public function genLog($mensaje)
    {
        $area = 'Nivel ctas';
        $logs = Svlogadmin::log($mensaje,$area);
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }


}
