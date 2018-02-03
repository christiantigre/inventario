<?php

namespace App\Http\Controllers\Person;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\Iva;
use App\SvLog;
use Illuminate\Http\Request;

class IvaController extends Controller
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
            $iva = Iva::where('iva', 'LIKE', "%$keyword%")
                ->orWhere('activo', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        $this->genLog("Busqueda datos :".$keyword);
        } else {
            $iva = Iva::paginate($perPage);
        $this->genLog("Visualizó seccion iva");
        }
        return view('person.iva.index', compact('iva'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->genLog("Ingresó a nuevo registro");

        return view('person.iva.create');
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
        'iva'=>'numeric|unique:ivas',
    ];

    $messages = [
        'iva.numeric'=>'Cantidad fuera de rango permitido',
        'iva.unique' => 'El valor ingresado ya esta en uso'
    ];

    $this->validate($request, $rules, $messages);

        try {

        $requestData = $request->all();        
        Iva::create($requestData);
            Session::flash('flash_message', 'Guardado correctamente el nuevo iva : '.$requestData['iva']);
            $this->genLog("Registró nuevo iva : ".$requestData['iva']);

        } catch (\Exception $e) {
            Session::flash('warning', 'Error al registrar nuevo iva');
            $this->genLog("Error al registrar nuevo iva : ".$requestData['iva']);
        }

        return redirect('person/iva');
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
        $iva = Iva::findOrFail($id);
            $this->genLog("Visualizó iva : ".$iva['iva']);

        return view('person.iva.show', compact('iva'));
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
        $iva = Iva::findOrFail($id);
            $this->genLog("Ingresó actualizar iva : ".$iva['iva']);

        return view('person.iva.edit', compact('iva'));
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
        'iva'=>'numeric|required|max:15,2',
            'iva' => 'required|unique:ivas,iva,'.$id,
    ];

    $messages = [
        'iva.numeric'=>'Cantidad fuera de rango permitido',
        'iva.max'=>'Fuera de limite permitido',
        'iva.required'=>'Campo requerido',
        'iva.unique'=>'El valor ingresado ya esta en uso',
    ];

    $this->validate($request, $rules, $messages);
    
        $requestData = $request->all();
        try {
            
        $iva = Iva::findOrFail($id);
        $iva->update($requestData);
            Session::flash('flash_message', 'Actualizado correctamente IVA : '.$requestData['iva']);
            $this->genLog("Actualizó iva : ".$requestData['iva']);

        } catch (\Exception $e) {
            Session::flash('warning', 'Error al actualizar iva');
            $this->genLog("Error al actualizar iva : ".$requestData['iva']);
            
        }

        return redirect('person/iva');
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
            
        $iva = Iva::destroy($id);
            Session::flash('flash_message', 'Eliminado corretamente.');
            $this->genLog("Eliminó iva id:".$id);

        } catch (\Exception $e) {
            Session::flash('warning', 'Error al eliminar iva');
            $this->genLog("Error al eliminar iva id: ".$id);
        }

        return redirect('person/iva');
    }

    public function genLog($mensaje)
    {
        $area = 'Iva';
        $logs = Svlog::log($mensaje,$area);
    }

    protected function guard()
    {
        return Auth::guard('person');
    }

}
