<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cliente;
use Illuminate\Http\Request;
use Session;

class ClienteController extends Controller
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
            $cliente = Cliente::where('nom_cli', 'LIKE', "%$keyword%")
            ->orWhere('app_cli', 'LIKE', "%$keyword%")
            ->orWhere('ced_cli', 'LIKE', "%$keyword%")
            ->orWhere('ruc_cli', 'LIKE', "%$keyword%")
            ->orWhere('dir_cli', 'LIKE', "%$keyword%")
            ->orWhere('mail_cli', 'LIKE', "%$keyword%")
            ->orWhere('tlf_cli', 'LIKE', "%$keyword%")
            ->orWhere('wts_cli', 'LIKE', "%$keyword%")
            ->orWhere('clmovi_cli', 'LIKE', "%$keyword%")
            ->orWhere('clclr_cli', 'LIKE', "%$keyword%")
            ->orWhere('activo', 'LIKE', "%$keyword%")
            ->orWhere('id_pais', 'LIKE', "%$keyword%")
            ->orWhere('id_provincia', 'LIKE', "%$keyword%")
            ->orWhere('id_canton', 'LIKE', "%$keyword%")
            ->paginate($perPage);
        } else {
            $cliente = Cliente::paginate($perPage);
        }

        return view('admin.cliente.index', compact('cliente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.cliente.create');
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
        try {
            $requestData = $request->all();
            Cliente::create($requestData);
            Session::flash('flash_message', 'Guardado correctamente');
        } catch (\Exception $e) {
            Session::flash('warning', 'Error al Guardar');            
        };

        return redirect('admin/cliente');
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
        $cliente = Cliente::findOrFail($id);

        return view('admin.cliente.show', compact('cliente'));
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
        $cliente = Cliente::findOrFail($id);

        return view('admin.cliente.edit', compact('cliente'));
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
        try {

            $requestData = $request->all();

            $cliente = Cliente::findOrFail($id);
            $cliente->update($requestData);
            Session::flash('flash_message', 'Actualizado correctamente');
        } catch (\Exception $e) {
            Session::flash('warning', 'Error al actualizar!!!');            
        }

        return redirect('admin/cliente');
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
        try {
            Cliente::destroy($id);
            Session::flash('flash_message', 'Eliminado correctamente');
        } catch (\Exception $e) {
            Session::flash('warning', 'Error al eliminar!!!');
        }

        return redirect('admin/cliente');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
