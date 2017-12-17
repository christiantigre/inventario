<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        $this->middleware('admin', ['except' => 'logout']);
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
        } else {
            $subcategory = Subcategory::paginate($perPage);
        }

        $subcategory_deleted = DB::table('subcategories')->whereNotNull('deleted_at')->get();

        return view('admin.subcategory.index', compact('subcategory','subcategory_deleted'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function allrestore(){
        try {
            $category = Subcategory::withTrashed()
            ->restore();
            Session::flash('flash_message', 'Restaurado correctamente');
        } catch (\Exception $e) {
            Session::flash('danger', 'Error al restaurar');
            
        }
        return redirect('admin/subcategory'); 
    }

    public function create()
    {
        $category = Category::orderBy('id', 'ASC')->where('activo', 1)->pluck('category', 'id');
        return view('admin.subcategory.create',compact('category'));
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
			'subcategory' => 'required|max:75'
		]);
        $requestData = $request->all();
        
        Subcategory::create($requestData);

        return redirect('admin/subcategory')->with('flash_message', 'Subcategory added!');
    }

    public function restore($id){
        try {
            $category = Subcategory::withTrashed()
            ->where('id', $id)
            ->restore();
            Session::flash('flash_message', 'Restaurado correctamente');
        } catch (Exception $e) {
            Session::flash('danger', 'Error al restaurar dato id=>'.$id);
            
        }
        return redirect('admin/subcategory');        
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

        return view('admin.subcategory.show', compact('subcategory'));
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

        return view('admin.subcategory.edit', compact('subcategory','category'));
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
			'subcategory' => 'required|max:75'
		]);
        $requestData = $request->all();
        
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update($requestData);

        return redirect('admin/subcategory')->with('flash_message', 'Subcategory updated!');
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
        Subcategory::destroy($id);

        return redirect('admin/subcategory')->with('flash_message', 'Subcategory deleted!');
    }

    public function trash(){
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('subcategories')->truncate();
            //DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            Session::flash('flash_message', 'Vaciado correctamente');
        } catch (\Exception $e) {
            Session::flash('danger', 'Error al vaciar subcategorías');
        }
        return redirect('admin/subcategory');
    }

    public function trash_sofdelete(){
        try {
            $subcategory_deleted = DB::table('subcategories')->whereNotNull('deleted_at')->delete();            
            Session::flash('flash_message', 'Vaciado correctamente');
        } catch (\Exception $e) {
            Session::flash('danger', 'Error al vaciar subcategorías');
        }
        return redirect('admin/subcategory');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
