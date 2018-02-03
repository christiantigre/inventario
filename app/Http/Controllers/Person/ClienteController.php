<?php

namespace App\Http\Controllers\Person;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cliente;
use Illuminate\Http\Request;
use Session;
use App\SvLog;
use App\Pais;
use App\Provincias;
use App\Canton;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function __construct()
    {
        $this->middleware('person', ['except' => 'logout']);
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
            $this->genLog("Busqueda datos :".$keyword);

        } else {
            $cliente = Cliente::paginate($perPage);
            $this->genLog("Visualizó sección.");

        }

        return view('person.cliente.index', compact('cliente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $this->genLog("Ingresó a nuevo registro.");
        $paises = Pais::orderBy('id', 'DESC')->where('status', 1)->pluck('pais', 'id');
        $provincias = Provincias::orderBy('id', 'ASC')->pluck('provincia', 'id');
        $cantones = Canton::orderBy('id', 'ASC')->pluck('canton', 'id');
        return view('person.cliente.create',compact('paises','provincias','cantones'));
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
        $rules = [
        'nom_cli'=>'required|max:75',
        'app_cli'=>'required|max:75',
        'ced_cli'=>'required|unique:clientes',
    ];

    $messages = [
        'nom_cli.required'=>'Campo obligatorio',
        'app_cli.required' => 'Campo obligatorio',
        'ced_cli.required' => 'Campo obligatorio',
        'ced_cli.unique' => 'Campo ingresado ya esta en uso'
    ];

    $this->validate($request, $rules, $messages);

        try {
            $requestData = $request->all();
            Cliente::create($requestData);
            Session::flash('flash_message', 'Guardado correctamente');
            $this->genLog("Registró nuevo : ".$requestData['mail_cli']);

        } catch (\Exception $e) {
            Session::flash('warning', 'Error al Guardar');            
            $this->genLog("Error al registrar : ".$requestData['mail_cli']);
        };


        return redirect('person/cliente');
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
        $this->genLog("Visualizó : ".$cliente['mail_cli']);

        return view('person.cliente.show', compact('cliente'));
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
        $this->genLog("Ingresó actualizar : ".$cliente['cliente']);
        $paises = Pais::orderBy('id', 'DESC')->where('status', 1)->pluck('pais', 'id');
        $provincias = Provincias::orderBy('id', 'ASC')->pluck('provincia', 'id');
        $cantones = Canton::orderBy('id', 'ASC')->pluck('canton', 'id');
        return view('person.cliente.edit', compact('cliente','paises','provincias','cantones'));
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
        $rules = [
        'nom_cli'=>'required|max:75',
        'app_cli'=>'required|max:75',
        'ced_cli' => 'required|unique:clientes,ced_cli,'.$id,
    ];

    $messages = [
        'nom_cli.required'=>'Campo obligatorio',
        'app_cli.required' => 'Campo obligatorio',
        'ced_cli.required' => 'Campo obligatorio',
        'ced_cli.unique' => 'Campo ingresado ya esta en uso'
    ];
    
    $this->validate($request, $rules, $messages);

        try {
            $requestData = $request->all();
            $cliente = Cliente::findOrFail($id);
            $cliente->update($requestData);
            Session::flash('flash_message', 'Actualizado correctamente');
            $this->genLog("Actualizó : ".$requestData['mail_cli']);
        } catch (\Exception $e) {
            Session::flash('warning', 'Error al actualizar!!!');      
            $this->genLog("Error al actualizar : ".$requestData['mail_cli']);
        }

        return redirect('person/cliente');
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
            $this->genLog("Eliminó id:".$id);
        } catch (\Exception $e) {
            $this->genLog("Error al eliminar id: ".$id);            
            Session::flash('warning', 'Error al eliminar!!!');
        }

        return redirect('person/cliente');
    }

    public function genLog($mensaje)
    {
        $area = 'Cliente';
        $logs = Svlog::log($mensaje,$area);
    }

    protected function guard()
    {
        return Auth::guard('person');
    }
}
