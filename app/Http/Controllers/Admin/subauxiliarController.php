<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\subauxiliar;
use Illuminate\Http\Request;

class subauxiliarController extends Controller
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
            $subauxiliar = subauxiliar::where('subauxiliar', 'LIKE', "%$keyword%")
                ->orWhere('codigo', 'LIKE', "%$keyword%")
                ->orWhere('detall', 'LIKE', "%$keyword%")
                ->orWhere('activo', 'LIKE', "%$keyword%")
                ->orWhere('auxiliar_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $subauxiliar = subauxiliar::paginate($perPage);
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
        return view('admin.subauxiliar.create');
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
        
        subauxiliar::create($requestData);

        return redirect('admin/subauxiliar')->with('flash_message', 'subauxiliar added!');
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

        return view('admin.subauxiliar.show', compact('subauxiliar'));
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
        $subauxiliar = subauxiliar::findOrFail($id);

        return view('admin.subauxiliar.edit', compact('subauxiliar'));
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
			'subauxiliar' => 'required|max:200'
		]);
        $requestData = $request->all();
        
        $subauxiliar = subauxiliar::findOrFail($id);
        $subauxiliar->update($requestData);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        subauxiliar::destroy($id);

        return redirect('admin/subauxiliar')->with('flash_message', 'subauxiliar deleted!');
    }
}
