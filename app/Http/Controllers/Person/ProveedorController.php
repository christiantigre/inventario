<?php

namespace App\Http\Controllers\Person;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SvLog;
use App\Proveedor;
use App\Pais;
use App\Provincias;
use App\Canton;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Excel;
use Session;
use Illuminate\Support\Facades\Validator;

class ProveedorController extends Controller
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
            $this->genLog("Busqueda datos :".$keyword);

        } else {
            $proveedor = Proveedor::paginate($perPage);
            $this->genLog("Visualizó sección.");

        }

        return view('person.proveedor.index', compact('proveedor'));
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
        return view('person.proveedor.create',compact('paises','provincias','cantones'));
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
         'tlfn' => 'nullable|integer|max:999999999999999',
         'cel_movi' => 'nullable|integer|max:999999999999999',
         'cel_claro' => 'nullable|integer|max:999999999999999',
         'watsapp' => 'nullable|integer|max:999999999999999',
         'fax' => 'max:150',
         'mail' => 'max:75',
         'web' => 'max:150',
         'ruc' => 'max:15',
         'representante' => 'max:150',
         'watsapp' => 'max:15'
     ]);
        $requestData = $request->all();
        try {
            
        Proveedor::create($requestData);
            Session::flash('flash_message', 'Guardado correctamente');
            $this->genLog("Registró nuevo : ".$requestData['proveedor']);
        } catch (\Exception $e) {
            Session::flash('warning', 'Error al Guardar');            
            $this->genLog("Error al registrar : ".$requestData['proveedor']);
        }

        return redirect('person/proveedor');
    }

    public function downloadExcel($type){
        $data = Proveedor::get()->toArray();
        return Excel::create('Proveedores', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
                $this->genLog("Descargó excel : ".$type);
    }

    public function importExcelProveedor(Request $request){
        $this->genLog("Importó excel proveedores");
        $excel_file = $request->file('file');

        $validator = Validator::make($request->all(), [
         'file' => 'required'
     ]);
        try {
            if(Input::hasFile('file')){
                $path = Input::file('file')->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();
                if(!empty($data) && $data->count()){
                    foreach ($data as $key => $value) {
                        if($value == '')
                        {
                            $value = "n/n";
                        }
                        $insert[] = [
                            "proveedor" => $value->proveedor, 
                            'dir' => $value->dir,
                            'tlfn' => $value->tlfn,
                            'cel_movi' => $value->cel_movi,
                            'cel_claro' => $value->cel_claro,
                            "watsapp" => $value->watsapp,
                            "fax" => $value->fax,
                            'mail' => $value->mail, 
                            'web' => $value->web,
                            'ruc' => $value->ruc,
                            'representante' => $value->representante,
                            "actividad" => $value->actividad,
                            'status' => $value->status,
                            'empresa' => $value->empresa,
                            'ubicacion' => $value->ubicacion,
                            'latitud' => $value->latitud,
                            'longitud' => $value->longitud,
                            'logo' => $value->logo,
                            'id_pais' => $value->id_pais,
                            'id_provincia' => $value->id_provincia,
                            'id_canton' => $value->id_canton
                        ];
                    }
                    if(!empty($insert)){

                        DB::table('proveedors')->insert($insert);
                    }
                }
            }
            Session::flash('flash_message', 'Importación correctamente');            
        } catch (\Exception $e) {
            Session::flash('warning', 'Error al procesar archivo, reviselo y intentelo nuevamente !!!');                 
        }
        return redirect('person/proveedor');
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
        $this->genLog("Visualizó : ".$proveedor['proveedor']);

        return view('person.proveedor.show', compact('proveedor'));
    }


    public function buscarrucproveedor(Request $request){
        if ($request->ajax()) {
            $proveedor = Proveedor::orderBy('id','DESC')->where('ruc',$request->id)->first();
            return response()->json($proveedor);
        }
    }

    public function buscarempresaproveedor(Request $request){
        if ($request->ajax()) {
            $proveedor = Proveedor::orderBy('id','DESC')->where('proveedor',$request->id)->first();
            return response()->json($proveedor);
        }
    }

    public function buscarmailproveedor(Request $request){
        if ($request->ajax()) {
            $proveedor = Proveedor::orderBy('id','DESC')->where('mail',$request->id)->first();
            return response()->json($proveedor);
        }
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
        $this->genLog("Ingresó actualizar proveedor id: ".$id);
        return view('person.proveedor.edit', compact('proveedor','paises','provincias','cantones'));
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
        
        try {
            
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($requestData);
        
            $this->genLog("Actualizó proveedor id: ".$id);
            Session::flash('flash_message', 'Actualizado correctamente');
        } catch (\Exception $e) {
            $this->genLog("Error al actualizar proveedor id: ".$id);
            Session::flash('warning', 'Error al actualizar!!!');  
            
        }

        return redirect('person/proveedor')->with('flash_message', 'Proveedor updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function genLog($mensaje)
    {
        $area = 'Proveedor';
        $logs = Svlog::log($mensaje,$area);
    }

    public function destroy($id)
    {
        try {
            
        Proveedor::destroy($id);
            Session::flash('flash_message', 'Eliminado correctamente');
            $this->genLog("Eliminó id:".$id);
        } catch (\Exception $e) {
            $this->genLog("Error al eliminar id: ".$id);            
            Session::flash('warning', 'Error al eliminar!!!');            
        }

        return redirect('person/proveedor')->with('flash_message', 'Proveedor deleted!');
    }

    protected function guard()
    {
        return Auth::guard('person');
    }
}
