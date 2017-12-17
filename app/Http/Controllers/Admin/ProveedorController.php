<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Proveedor;
use App\Pais;
use App\Provincias;
use App\Canton;
use Illuminate\Http\Request;

class ProveedorController extends Controller
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
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $proveedor = Proveedor::where('proveedor', 'LIKE', "%$keyword%")
                ->orWhere('dir', 'LIKE', "%$keyword%")
                ->orWhere('tlfn', 'LIKE', "%$keyword%")
                ->orWhere('cel_movi', 'LIKE', "%$keyword%")
                ->orWhere('cel_claro', 'LIKE', "%$keyword%")
                ->orWhere('watsapp', 'LIKE', "%$keyword%")
                ->orWhere('fax', 'LIKE', "%$keyword%")
                ->orWhere('mail', 'LIKE', "%$keyword%")
                ->orWhere('web', 'LIKE', "%$keyword%")
                ->orWhere('ruc', 'LIKE', "%$keyword%")
                ->orWhere('representante', 'LIKE', "%$keyword%")
                ->orWhere('actividad', 'LIKE', "%$keyword%")
                ->orWhere('logo', 'LIKE', "%$keyword%")
                ->orWhere('id_pais', 'LIKE', "%$keyword%")
                ->orWhere('id_provincia', 'LIKE', "%$keyword%")
                ->orWhere('id_canton', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('empresa', 'LIKE', "%$keyword%")
                ->orWhere('ubicacion', 'LIKE', "%$keyword%")
                ->orWhere('latitud', 'LIKE', "%$keyword%")
                ->orWhere('longitud', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $proveedor = Proveedor::paginate($perPage);
        }

        return view('admin.proveedor.index', compact('proveedor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $paises = Pais::orderBy('id', 'DESC')->where('status', 1)->pluck('pais', 'id');
        $provincias = Provincias::orderBy('id', 'ASC')->pluck('provincia', 'id');
        $cantones = Canton::orderBy('id', 'ASC')->pluck('canton', 'id');
        return view('admin.proveedor.create',compact('paises','provincias','cantones'));
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
			'proveedor' => 'max:35',
			'dir' => 'max:150',
			'tlfn' => 'max:15',
			'cel_movi' => 'max:15',
			'cel_claro' => 'max:15',
			'watsapp' => 'max:15',
			'fax' => 'max:150',
			'mail' => 'max:75',
			'web' => 'max:150',
			'ruc' => 'max:15',
			'representante' => 'max:150',
			'watsapp' => 'max:15'
		]);
        $requestData = $request->all();
        
        Proveedor::create($requestData);

        return redirect('admin/proveedor')->with('flash_message', 'Proveedor added!');
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
        $proveedor = Proveedor::findOrFail($id);

        return view('admin.proveedor.show', compact('proveedor'));
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
        $proveedor = Proveedor::findOrFail($id);
        $paises = Pais::orderBy('id', 'DESC')->where('status', 1)->pluck('pais', 'id');
        $provincias = Provincias::orderBy('id', 'ASC')->pluck('provincia', 'id');
        $cantones = Canton::orderBy('id', 'ASC')->pluck('canton', 'id');
        return view('admin.proveedor.edit', compact('proveedor','paises','provincias','cantones'));
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
			'proveedor' => 'max:35',
			'dir' => 'max:150',
			'tlfn' => 'max:15',
			'cel_movi' => 'max:15',
			'cel_claro' => 'max:15',
			'watsapp' => 'max:15',
			'fax' => 'max:150',
			'mail' => 'max:75',
			'web' => 'max:150',
			'ruc' => 'max:15',
			'representante' => 'max:150',
			'watsapp' => 'max:15'
		]);
        $requestData = $request->all();
        
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($requestData);

        return redirect('admin/proveedor')->with('flash_message', 'Proveedor updated!');
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
        Proveedor::destroy($id);

        return redirect('admin/proveedor')->with('flash_message', 'Proveedor deleted!');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
