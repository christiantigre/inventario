<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cuentum;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
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
            $cuenta = Cuentum::where('cuenta', 'LIKE', "%$keyword%")
                ->orWhere('codigo', 'LIKE', "%$keyword%")
                ->orWhere('detall', 'LIKE', "%$keyword%")
                ->orWhere('activo', 'LIKE', "%$keyword%")
                ->orWhere('grupo_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $cuenta = Cuentum::paginate($perPage);
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
        return view('admin.cuenta.create');
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
			'cuenta' => 'required|max:200'
		]);
        $requestData = $request->all();
        
        Cuentum::create($requestData);

        return redirect('admin/cuenta')->with('flash_message', 'Cuentum added!');
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
        $cuentum = Cuentum::findOrFail($id);

        return view('admin.cuenta.edit', compact('cuentum'));
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
			'cuenta' => 'required|max:200'
		]);
        $requestData = $request->all();
        
        $cuentum = Cuentum::findOrFail($id);
        $cuentum->update($requestData);

        return redirect('admin/cuenta')->with('flash_message', 'Cuentum updated!');
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

        return redirect('admin/cuenta')->with('flash_message', 'Cuentum deleted!');
    }
}
