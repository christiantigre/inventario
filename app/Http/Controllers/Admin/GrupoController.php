<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
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
            $grupo = Grupo::where('grupo', 'LIKE', "%$keyword%")
                ->orWhere('codigo', 'LIKE', "%$keyword%")
                ->orWhere('detall', 'LIKE', "%$keyword%")
                ->orWhere('activo', 'LIKE', "%$keyword%")
                ->orWhere('clase_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $grupo = Grupo::paginate($perPage);
        }

        return view('admin.grupo.index', compact('grupo','dato'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $dato = $this->gen_section();

        return view('admin.grupo.create',compact('dato'));
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
			'clase' => 'required|max:75'
		]);
        $requestData = $request->all();
        
        Grupo::create($requestData);

        return redirect('admin/grupo')->with('flash_message', 'Grupo added!');
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
        $grupo = Grupo::findOrFail($id);

        return view('admin.grupo.show', compact('grupo'));
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

        $grupo = Grupo::findOrFail($id);

        return view('admin.grupo.edit', compact('grupo','dato'));
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
			'clase' => 'required|max:75'
		]);
        $requestData = $request->all();
        
        $grupo = Grupo::findOrFail($id);
        $grupo->update($requestData);

        return redirect('admin/grupo')->with('flash_message', 'Grupo updated!');
    }


    public function gen_section(){
        $data = array(
            "txtinicio"=>"Inicio",
            "rutainicio" => "/admin/inicio",
            "txtmodulo" => "CONTABILIDAD",
            "section" => "Contabilidad",
            "rutamodulo" => "/admin/grupo",
            "ventana" => "Grupos"
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
        Grupo::destroy($id);

        return redirect('admin/grupo')->with('flash_message', 'Grupo deleted!');
    }
}
