<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\auxiliar;
use Illuminate\Http\Request;

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
        $perPage = 25;

        if (!empty($keyword)) {
            $auxiliar = auxiliar::where('auxiliar', 'LIKE', "%$keyword%")
                ->orWhere('codigo', 'LIKE', "%$keyword%")
                ->orWhere('detall', 'LIKE', "%$keyword%")
                ->orWhere('activo', 'LIKE', "%$keyword%")
                ->orWhere('subcuenta_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $auxiliar = auxiliar::paginate($perPage);
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
        return view('admin.auxiliar.create');
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
			'auxiliar' => 'required|max:200'
		]);
        $requestData = $request->all();
        
        auxiliar::create($requestData);

        return redirect('admin/auxiliar')->with('flash_message', 'auxiliar added!');
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

        return view('admin.auxiliar.show', compact('auxiliar'));
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

        return view('admin.auxiliar.edit', compact('auxiliar'));
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
			'auxiliar' => 'required|max:200'
		]);
        $requestData = $request->all();
        
        $auxiliar = auxiliar::findOrFail($id);
        $auxiliar->update($requestData);

        return redirect('admin/auxiliar')->with('flash_message', 'auxiliar updated!');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        auxiliar::destroy($id);

        return redirect('admin/auxiliar')->with('flash_message', 'auxiliar deleted!');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
