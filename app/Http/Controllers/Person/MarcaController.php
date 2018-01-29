<?php

namespace App\Http\Controllers\Person;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SvLog;
use App\Marca;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Input;
use Session;

class MarcaController extends Controller
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
            $marca = Marca::where('marca', 'LIKE', "%$keyword%")
            ->orWhere('detall', 'LIKE', "%$keyword%")
            ->orWhere('img', 'LIKE', "%$keyword%")
            ->orWhere('name_img', 'LIKE', "%$keyword%")
            ->orWhere('activo', 'LIKE', "%$keyword%")
            ->paginate($perPage);
            $this->genLog("Busqueda datos :".$keyword);

        } else {
            $marca = Marca::orderBy('marca','ASC')->paginate($perPage);
            $this->genLog("Visualizó sección.");

        }

        return view('person.marca.index', compact('marca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->genLog("Ingresó a nuevo registro.");
        return view('person.marca.create');
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
           'marca' => 'required|unique:marcas|max:191',
       ]);

        $requestData = $request->all();
        
        try {

            if ($request->hasFile('img')) {
                $file = Input::file('img');
                $uploadPath = public_path('uploads/marca/');
                $extension = $file->getClientOriginalName();
                $image  = Image::make($file->getRealPath());
                $image->resize(300, 300);
                $extension = rand(11111, 99999) . '.' . $extension;
                $image->save($uploadPath.$extension);
                $requestData['img'] = 'uploads/marca/'.$extension;
                $requestData['name_img'] = $extension;
            }

            Marca::create($requestData);
            $this->genLog("Registró nuevo : ".$requestData['marca']);
            Session::flash('flash_message', 'Guardado correctamente el nueva marca : '.$requestData['marca']);
            
        } catch (\Exception $e) {
            $this->genLog("Error al registrar nuevo : ".$requestData['marca']);
            Session::flash('warning', 'Error al registrar nueva marca');
            
        }
        return redirect('person/marca');
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
        $marca = Marca::findOrFail($id);
        $this->genLog("Visualizó : ".$marca['marca']);

        return view('person.marca.show', compact('marca'));
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
        $marca = Marca::findOrFail($id);
        $this->genLog("Ingresó actualizar : ".$marca['marca']);

        return view('person.marca.edit', compact('marca'));
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
           'marca' => 'required|unique:marcas|max:191',
       ]);

        $requestData = $request->all();
        try {



            if ($request->hasFile('img')) {
                $file = Input::file('img');
                $uploadPath = public_path('uploads/marca/');
                $extension = $file->getClientOriginalName();
                $image  = Image::make($file->getRealPath());
                $image->resize(300, 300);
                $extension = rand(11111, 99999) . '.' . $extension;
                $image->save($uploadPath.$extension);
                $requestData['img'] = 'uploads/marca/'.$extension;
                $requestData['name_img'] = $extension;

                $item_delete = Marca::findOrFail($id);   
                $move = $item_delete['name_img'];
                $old = public_path('uploads/marca/').$move;
                       //verificamos si la imagen exist
                if(!empty($move)){
                    if(\File::exists($old)){
                        unlink($old);
                    }
                }
            }

            $marca = Marca::findOrFail($id);
            $marca->update($requestData);
            $this->genLog("Actualizó : ".$requestData['marca']);
            Session::flash('flash_message', 'Actualizado correctamente marca : '.$requestData['marca']);

        } catch (\Exception $e) {
            $this->genLog("Error al actualizar : ".$requestData['marca']);
            Session::flash('warning', 'Error al actualizar marca');
            
        }
        return redirect('person/marca')->with('flash_message', 'Marca updated!');
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
            $item_delete = Marca::findOrFail($id);   
            $move = $item_delete['name_img'];
            $old = public_path('uploads/marca/').$move;
                       //verificamos si la imagen exist
            if(!empty($move)){
                if(\File::exists($old)){
                    unlink($old);
                }
            }
            Marca::destroy($id);
            $this->genLog("Eliminó id:".$id);
            Session::flash('flash_message', 'Eliminado corretamente.');

        } catch (\Exception $e) {
            $this->genLog("Error al eliminar id: ".$id);
            Session::flash('warning', 'Error al eliminar marca');
        }
        return redirect('person/marca');
    }

    public function genLog($mensaje)
    {
        $area = 'Marca';
        $logs = Svlog::log($mensaje,$area);
    }

    protected function guard()
    {
        return Auth::guard('person');
    }
}
