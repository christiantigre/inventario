<?php

namespace App\Http\Controllers\Person;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SvLog;
use App\Subcategory;
use App\Category;
use Illuminate\Http\Request;
use DB;
use Session;

class SubcategoryController extends Controller
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
            $subcategory = Subcategory::where('subcategory', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                ->orWhere('active', 'LIKE', "%$keyword%")
                ->orWhere('category_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            $this->genLog("Busqueda datos :".$keyword);

        } else {
            $subcategory = Subcategory::orderBy('category_id','ASC')->paginate($perPage);
            $this->genLog("Visualizó sección.");
        }

        $subcategory_deleted = DB::table('subcategories')->whereNotNull('deleted_at')->get();

        return view('person.subcategory.index', compact('subcategory','subcategory_deleted'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
   
    public function create()
    {
        $category = Category::orderBy('id', 'ASC')->where('activo', 1)->pluck('category', 'id');
        $this->genLog("Ingresó a nuevo registro.");

        return view('person.subcategory.create',compact('category'));
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
           'subcategory' => 'required|unique:subcategories|max:75',
        ]);

        $requestData = $request->all();
        try {
            
        Subcategory::create($requestData);
        Session::flash('flash_message', 'Guardado correctamente el nueva : '.$requestData['subcategory']);
            $this->genLog("Registró nuevo : ".$requestData['subcategory']);
        } catch (\Exception $e) {
            $this->genLog("Error al registrar : ".$requestData['subcategory']);
            Session::flash('warning', 'Error al registrar nueva marca');
            
        }

        return redirect('person/subcategory');
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
        
        $subcategory = Subcategory::findOrFail($id);
        $this->genLog("Visualizó : ".$subcategory['subcategory']);

        return view('person.subcategory.show', compact('subcategory'));
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
        $category = Category::orderBy('id', 'ASC')->where('activo', 1)->pluck('category', 'id');

        $subcategory = Subcategory::findOrFail($id);
        $this->genLog("Ingresó actualizar : ".$subcategory['subcategory']);

        return view('person.subcategory.edit', compact('subcategory','category'));
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
            'subcategory' => 'required|max:75|unique:subcategories,subcategory,'.$id,
        ]);
        
        $requestData = $request->all();
        try {
            
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update($requestData);
            $this->genLog("Actualizó : ".$requestData['subcategory']);
            Session::flash('flash_message', 'Actualizado correctamente : '.$requestData['subcategory']);

        } catch (\Exception $e) {
            $this->genLog("Error al actualizar : ".$requestData['subcategory']);
            Session::flash('warning', 'Error al actualizar subcategoría');
        }

        return redirect('person/subcategory');
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
            
        Subcategory::destroy($id);
            $this->genLog("Eliminó id:".$id);
            Session::flash('flash_message', 'Eliminado correctamente');
        } catch (\Exception $e) {
            $this->genLog("Error al eliminar id: ".$id);
            Session::flash('danger', '!!!Error al eliminar');
        }

        return redirect('person/subcategory');
    }

    public function genLog($mensaje)
    {
        $area = 'SubCategoria';
        $logs = Svlog::log($mensaje,$area);
    }

    protected function guard()
    {
        return Auth::guard('person');
    }
}
