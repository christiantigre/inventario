<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\detall_asiento;
use App\num_asiento;
use Illuminate\Http\Request;
use Session;
use App\SvLogAdmin;

class num_asientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $num_asiento = num_asiento::where('num_asiento', 'LIKE', "%$keyword%")
                ->orWhere('concepto', 'LIKE', "%$keyword%")
                ->orWhere('periodo', 'LIKE', "%$keyword%")
                ->orWhere('fecha', 'LIKE', "%$keyword%")
                ->orWhere('saldo_debe', 'LIKE', "%$keyword%")
                ->orWhere('saldo_haber', 'LIKE', "%$keyword%")
                ->orWhere('almacen_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $num_asiento = num_asiento::paginate($perPage);
        }

        return view('admin.num_asiento.index', compact('num_asiento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.num_asiento.create');
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
			'num_asiento' => 'required|integer|max:999999'
		]);
        $requestData = $request->all();
        
        num_asiento::create($requestData);

        return redirect('admin/num_asiento')->with('flash_message', 'num_asiento added!');
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
        $num_asiento = num_asiento::findOrFail($id);

        return view('admin.num_asiento.show', compact('num_asiento'));
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
        $num_asiento = num_asiento::findOrFail($id);

        return view('admin.num_asiento.edit', compact('num_asiento'));
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
			'num_asiento' => 'required|integer|max:999999'
		]);
        $requestData = $request->all();
        
        $num_asiento = num_asiento::findOrFail($id);
        $num_asiento->update($requestData);

        return redirect('admin/num_asiento')->with('flash_message', 'num_asiento updated!');
    }

    public function gen_section(){
        $data = array(
            "txtinicio"=>"Inicio",
            "rutainicio" => "/admin/inicio",
            "txtmodulo" => "CONTABILIDAD",
            "section" => "Contabilidad",
            "rutamodulo" => "/admin/clase",
            "ventana" => "Clases"
        );

        return $data;
    }

    public function genLog($mensaje)
    {
        $area = 'Libro';
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
        num_asiento::destroy($id);

        return redirect('admin/num_asiento')->with('flash_message', 'num_asiento deleted!');
    }
}
