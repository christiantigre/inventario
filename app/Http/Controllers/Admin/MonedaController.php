<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Moneda;
use Illuminate\Http\Request;

class MonedaController extends Controller
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
        $keyword = $request->get('search');
        $perPage = 25;

        $dato = $this->gen_section();

        if (!empty($keyword)) {
            $moneda = Moneda::where('moneda', 'LIKE', "%$keyword%")
                ->orWhere('estado', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $moneda = Moneda::paginate($perPage);
        }

        return view('admin.moneda.index', compact('moneda','dato'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $dato = $this->gen_section();

        return view('admin.moneda.create',compact('dato'));
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
        
        Moneda::create($requestData);

        return redirect('admin/moneda')->with('flash_message', 'Moneda added!');
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

        $moneda = Moneda::findOrFail($id);

        return view('admin.moneda.show', compact('moneda','dato'));
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

        $moneda = Moneda::findOrFail($id);

        return view('admin.moneda.edit', compact('moneda','dato'));
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
        
        $moneda = Moneda::findOrFail($id);
        $moneda->update($requestData);

        return redirect('admin/moneda')->with('flash_message', 'Moneda updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function gen_section(){
        $data = array(
            "txtinicio"=>"Inicio",
            "rutainicio" => "/admin/inicio",
            "txtmodulo" => "Moneda",
            "section" => "Moneda",
            "rutamodulo" => "/adminmoneda",
            "ventana" => "moneda"
        );
        return $data;
    }


    public function destroy($id)
    {
        Moneda::destroy($id);

        return redirect('admin/moneda')->with('flash_message', 'Moneda deleted!');
    }

    protected function guard()
    {
        return Auth::guard('person');
    }

    
}
