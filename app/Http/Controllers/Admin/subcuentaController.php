<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\subcuentum;
use Illuminate\Http\Request;

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
        $perPage = 25;

        if (!empty($keyword)) {
            $subcuenta = subcuentum::where('subcuenta', 'LIKE', "%$keyword%")
                ->orWhere('codigo', 'LIKE', "%$keyword%")
                ->orWhere('detall', 'LIKE', "%$keyword%")
                ->orWhere('activo', 'LIKE', "%$keyword%")
                ->orWhere('cuenta_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $subcuenta = subcuentum::paginate($perPage);
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
        return view('admin.subcuenta.create');
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
			'subcuenta' => 'required|max:200'
		]);
        $requestData = $request->all();
        
        subcuentum::create($requestData);

        return redirect('admin/subcuenta')->with('flash_message', 'subcuentum added!');
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

        return view('admin.subcuenta.show', compact('subcuentum'));
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
        $subcuentum = subcuentum::findOrFail($id);

        return view('admin.subcuenta.edit', compact('subcuentum'));
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
			'subcuenta' => 'required|max:200'
		]);
        $requestData = $request->all();
        
        $subcuentum = subcuentum::findOrFail($id);
        $subcuentum->update($requestData);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        subcuentum::destroy($id);

        return redirect('admin/subcuenta')->with('flash_message', 'subcuentum deleted!');
    }
    
    protected function guard()
    {
        return Auth::guard('admin');
    }

}
