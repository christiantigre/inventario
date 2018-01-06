<?php

namespace App\Http\Controllers\Person;

use App\SvLog;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\Category;
use Illuminate\Http\Request;
use DB;
//use Illuminate\Database\Eloquent\Collection::truncate();

class CategoryController extends Controller
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
            $category = Category::where('category', 'LIKE', "%$keyword%")
            ->orWhere('detall', 'LIKE', "%$keyword%")
            ->orWhere('gerente', 'LIKE', "%$keyword%")
            ->orWhere('activo', 'LIKE', "%$keyword%")
            ->paginate($perPage);
            $this->genLog("Busqueda datos :".$keyword);

        } else {
            $category = Category::paginate($perPage);
            $this->genLog("Visualizó sección.");

        }

        $category_deleted = DB::table('categories')->whereNotNull('deleted_at')->get();

        return view('person.category.index', compact('category','category_deleted'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */

    public function create()
    {
        $this->genLog("Ingresó a nuevo registro.");

        return view('person.category.create');
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
        
        Category::create($requestData);
            $this->genLog("Registró nuevo : ".$requestData['category']);
            Session::flash('flash_message', 'Guardado correctamente el nueva categoría : '.$requestData['category']);

} catch (\Exception $e) {
            $this->genLog("Error al registrar nuevo : ".$requestData['category']);
            Session::flash('warning', 'Error al registrar nueva categoría');
}
        return redirect('person/category');
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
        $category = Category::findOrFail($id);
        $this->genLog("Visualizó : ".$category['category']);

        return view('person.category.show', compact('category'));
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
        $category = Category::findOrFail($id);
        $this->genLog("Ingresó actualizar : ".$category['category']);

        return view('person.category.edit', compact('category'));
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
        
        $category = Category::findOrFail($id);
        $category->update($requestData);
            $this->genLog("Actualizó : ".$requestData['category']);
            Session::flash('flash_message', 'Actualizado correctamente categoría : '.$requestData['category']);

} catch (\Exception $e) {
            $this->genLog("Error al actualizar : ".$requestData['category']);
            Session::flash('warning', 'Error al actualizar categoría');
    
}

        return redirect('person/category')->with('flash_message', 'Category updated!');
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

            Category::destroy($id);
            Session::flash('flash_message', 'Eliminado correctamente');
            $this->genLog("Eliminó id:".$id);
            
        } catch (\Exception $e) {

            Session::flash('danger', '!!!Error al eliminar');
            $this->genLog("Error al eliminar id: ".$id);
            
        }

        return redirect('person/category');
    }

    public function trash(){
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('categories')->truncate();
            //DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            Session::flash('flash_message', 'Vaciado correctamente');
        } catch (\Exception $e) {
            Session::flash('danger', 'Error al vaciar categorías');
        }
        return redirect('person/category');
    }

    public function trash_sofdelete(){
        try {
            $subcategory_deleted = DB::table('categories')->whereNotNull('deleted_at')->delete();            
            Session::flash('flash_message', 'Vaciado correctamente');
        } catch (\Exception $e) {
            Session::flash('danger', 'Error al vaciar categorías');
        }
        return redirect('person/category');
    }

    public function genLog($mensaje)
    {
        $area = 'Categoria';
        $logs = Svlog::log($mensaje,$area);
    }

    protected function guard()
    {
        return Auth::guard('person');
    }
}
