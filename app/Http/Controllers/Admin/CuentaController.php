<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Grupo;
use App\Cuentum;
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
        $perPage = 25;

        if (!empty($keyword)) {
            $cuenta = Cuentum::orderBy('codigo','ASC')->where('cuenta', 'LIKE', "%$keyword%")
            ->orWhere('codigo', 'LIKE', "%$keyword%")
            ->orWhere('detall', 'LIKE', "%$keyword%")
            ->orWhere('activo', 'LIKE', "%$keyword%")
            ->orWhere('grupo_id', 'LIKE', "%$keyword%")
            ->paginate($perPage);
        } else {
            $cuenta = Cuentum::orderBy('codigo','ASC')->paginate($perPage);
        }

        return view('admin.cuenta.index', compact('cuenta','dato'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
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

        } catch (\Exception $e) {

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

        return view('admin.cuenta.show', compact('cuentum'));
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

            Session::flash('flash_message', 'Aztualizado correctamente');

        } catch (\Exception $e) {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Cuentum::destroy($id);

        return redirect('admin/cuenta')->with('flash_message', 'Cuenta deleted!');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
