<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Clausule;
use Illuminate\Http\Request;

class ClausuleController extends Controller
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
            $clausule = Clausule::where('documento', 'LIKE', "%$keyword%")
                ->orWhere('pre_clausula', 'LIKE', "%$keyword%")
                ->orWhere('clausula', 'LIKE', "%$keyword%")
                ->orWhere('activo', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $clausule = Clausule::paginate($perPage);
        }

        return view('admin.clausule.index', compact('clausule'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.clausule.create');
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
        
        $requestData = $request->all();
        
        Clausule::create($requestData);

        return redirect('admin/clausule')->with('flash_message', 'Clausule added!');
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
        $clausule = Clausule::findOrFail($id);

        return view('admin.clausule.show', compact('clausule'));
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
        $clausule = Clausule::findOrFail($id);

        return view('admin.clausule.edit', compact('clausule'));
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
        
        $requestData = $request->all();
        
        $clausule = Clausule::findOrFail($id);
        $clausule->update($requestData);

        return redirect('admin/clausule')->with('flash_message', 'Clausule updated!');
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
        Clausule::destroy($id);

        return redirect('admin/clausule')->with('flash_message', 'Clausule deleted!');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
    
}
