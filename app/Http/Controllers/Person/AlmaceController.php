<?php

namespace App\Http\Controllers\Person;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Almacen;
use App\Pais;
use App\Provincias;
use App\Canton;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use Carbon\Carbon;
use App\SvLog;

class AlmaceController extends Controller
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

            $this->genLog("Busqueda datos :".$keyword);
        } else {
            $almacen = Almacen::paginate($perPage);

            $this->genLog("Visualizó sección.");
        }

        return view('person.almacen.index', compact('almacen'));
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
        return view('person.almacen.create',compact('paises','provincias','cantones'));
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
           'longitud' => 'max:50',            
           'logo' => 'mimes:jpeg,png|max:1500'
       ]);

        $requestData = $request->all();
        
        if ($request->hasFile('logo')) {
            $file = Input::file('logo');
            $uploadPath = public_path('uploads/logo/');
            //$extension = $file->getClientOriginalExtension();
            $extension = $file->getClientOriginalName();
            $image  = Image::make($file->getRealPath());
            //$image->resize(1200, 900);
            $fileName = rand(11111, 99999) . '.' . $extension;
            $image->save($uploadPath.$fileName);
            //$file->move($uploadPath, $fileName);
            $requestData['logo'] = 'uploads/logo/'.$fileName;
            $requestData['name_logo'] = $fileName;
        }
        try {
            Almacen::create($requestData);
            Session::flash('flash_message', 'Guardado correctamente');
        } catch (\Exception $e) {
            Session::flash('warning', 'Error al Guardar');            
        }

        return redirect('person/almacen');
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

        return view('person.almacen.show', compact('almacen'));
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
        $paises = Pais::orderBy('id', 'DESC')->where('status', 1)->pluck('pais', 'id');
        $provincias = Provincias::orderBy('id', 'ASC')->pluck('provincia', 'id');
        $cantones = Canton::orderBy('id', 'ASC')->pluck('canton', 'id');
        return view('person.almacen.edit',compact('almacen','paises','provincias','cantones'));
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
           'longitud' => 'max:50',
           'logo' => 'mimes:jpeg,png|max:1500'
       ]);

        $requestData = $request->all();        

        if ($request->hasFile('logo')) {
            $file = Input::file('logo');
            $uploadPath = public_path('uploads/logo/');
            $extension_ext = $file->getClientOriginalExtension();
            $extension = $file->getClientOriginalName();
            $image  = Image::make($file->getRealPath());
            //$image->resize(1200, 900);
            $fileName = rand(11111, 99999) . '.' . $extension;
            //$fileName = 'logo.' . $extension_ext;
            $image->save($uploadPath.$fileName);
            //$file->move($uploadPath, $fileName);
            $requestData['logo'] = 'uploads/logo/'.$fileName;
            $requestData['name_logo'] = $fileName;

            $item_delete = Almacen::findOrFail($id);   
            $move = $item_delete['name_logo'];
            $old = public_path('uploads/logo/').$move;
            if(!empty($move)){
                if(\File::exists($old)){
                    unlink($old);
                }
            }

        }
        try {       
        $almacen = Almacen::findOrFail($id);
        $almacen->update($requestData);
            Session::flash('flash_message', 'Actualizado correctamente');
            $this->genLog("Actualizó info almacen.");
        } catch (\Exception $e) {
            Session::flash('warning', 'Error al actualizar!!!');  
            $this->genLog("Error al actualizar info almacen.");          
        }

        return redirect('person/almacen');
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
            $item_delete = Almacen::findOrFail($id);   
            $move = $item_delete['name_logo'];
            $old = public_path('uploads/logo/').$move;
            if(!empty($move)){
                if(\File::exists($old)){
                    unlink($old);
                }
            }
            Almacen::destroy($id);
            Session::flash('flash_message', 'Eliminado correctamente');
        } catch (\Exception $e) {
            Session::flash('warning', 'Error al eliminar!!!');
        }

        return redirect('person/almacen');
    }

    public function genLog($mensaje)
    {
        $area = 'Almacen';
        $logs = Svlog::log($mensaje,$area);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('person');
    }
}
