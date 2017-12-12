<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Almacen;
use Illuminate\Http\Request;

class AlmacenController extends Controller
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
            $almacen = Almacen::where('almacen', 'LIKE', "%$keyword%")
                ->orWhere('propietario', 'LIKE', "%$keyword%")
                ->orWhere('gerente', 'LIKE', "%$keyword%")
                ->orWhere('pag_web', 'LIKE', "%$keyword%")
                ->orWhere('razon_social', 'LIKE', "%$keyword%")
                ->orWhere('ruc', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('fecha_inicio', 'LIKE', "%$keyword%")
                ->orWhere('logo', 'LIKE', "%$keyword%")
                ->orWhere('name_logo', 'LIKE', "%$keyword%")
                ->orWhere('activo', 'LIKE', "%$keyword%")
                ->orWhere('telefono', 'LIKE', "%$keyword%")
                ->orWhere('cel_movi', 'LIKE', "%$keyword%")
                ->orWhere('cel_claro', 'LIKE', "%$keyword%")
                ->orWhere('watsapp', 'LIKE', "%$keyword%")
                ->orWhere('fb', 'LIKE', "%$keyword%")
                ->orWhere('tw', 'LIKE', "%$keyword%")
                ->orWhere('ins', 'LIKE', "%$keyword%")
                ->orWhere('gg', 'LIKE', "%$keyword%")
                ->orWhere('funcion_empresa', 'LIKE', "%$keyword%")
                ->orWhere('dir', 'LIKE', "%$keyword%")
                ->orWhere('latitud', 'LIKE', "%$keyword%")
                ->orWhere('longitud', 'LIKE', "%$keyword%")
                ->orWhere('pais_id', 'LIKE', "%$keyword%")
                ->orWhere('provincia_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $almacen = Almacen::paginate($perPage);
        }

        return view('admin.almacen.index', compact('almacen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.almacen.create');
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
			'almacen' => 'required|max:75',
			'propietario' => 'max:75',
			'gerente' => 'max:75',
			'pag_web' => 'max:75',
			'razon_social' => 'max:75',
			'ruc' => 'max:15',
			'email' => 'max:75|email',
			'fecha_inicio' => 'max:15',
			'telefono' => 'max:15',
			'cel_movi' => 'max:15',
			'cel_claro' => 'max:15',
			'watsapp' => 'max:15',
			'dir' => 'max:191',
			'latitud' => 'max:50',
			'longitud' => 'max:50'
		]);
        $requestData = $request->all();
        

        if ($request->hasFile('logo')) {
            foreach($request['logo'] as $file){
                $uploadPath = public_path('/uploads/logo');

                $extension = $file->getClientOriginalExtension();
                $fileName = rand(11111, 99999) . '.' . $extension;

                $file->move($uploadPath, $fileName);
                $requestData['logo'] = $fileName;
            }
        }

        Almacen::create($requestData);

        return redirect('admin/almacen')->with('flash_message', 'Almacen added!');
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
        $almacen = Almacen::findOrFail($id);

        return view('admin.almacen.show', compact('almacen'));
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
        $almacen = Almacen::findOrFail($id);

        return view('admin.almacen.edit', compact('almacen'));
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
			'almacen' => 'required|max:75',
			'propietario' => 'max:75',
			'gerente' => 'max:75',
			'pag_web' => 'max:75',
			'razon_social' => 'max:75',
            'ruc' => 'max:15',
			'email' => 'max:75|email',
			'fecha_inicio' => 'max:15',
			'telefono' => 'max:15',
			'cel_movi' => 'max:15',
			'cel_claro' => 'max:15',
			'watsapp' => 'max:15',
			'dir' => 'max:191',
			'latitud' => 'max:50',
			'longitud' => 'max:50'
		]);
        $requestData = $request->all();
        

        if ($request->hasFile('logo')) {
            foreach($request['logo'] as $file){
                $uploadPath = public_path('/uploads/logo');

                $extension = $file->getClientOriginalExtension();
                $fileName = rand(11111, 99999) . '.' . $extension;

                $file->move($uploadPath, $fileName);
                $requestData['logo'] = $fileName;
            }
        }

        $almacen = Almacen::findOrFail($id);
        $almacen->update($requestData);

        return redirect('admin/almacen')->with('flash_message', 'Almacen updated!');
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
        Almacen::destroy($id);

        return redirect('admin/almacen')->with('flash_message', 'Almacen deleted!');
    }
}
