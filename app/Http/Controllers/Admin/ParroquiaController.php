<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Parroquias as Parroquia;
use Illuminate\Http\Request;

class ParroquiaController extends Controller
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
            $parroquia = Parroquia::paginate($perPage);
        } else {
            $parroquia = Parroquia::paginate($perPage);
        }

        return view('admin.parroquia.index', compact('parroquia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.parroquia.create');
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
        
        Parroquia::create($requestData);

        return redirect('admin/parroquia')->with('flash_message', 'Parroquia added!');
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
        $parroquium = Parroquia::findOrFail($id);

        return view('admin.parroquia.show', compact('parroquium'));
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
        $parroquium = Parroquia::findOrFail($id);

        return view('admin.parroquia.edit', compact('parroquium'));
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
        
        $parroquium = Parroquia::findOrFail($id);
        $parroquium->update($requestData);

        return redirect('admin/parroquia')->with('flash_message', 'Parroquia updated!');
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
        Parroquia::destroy($id);

        return redirect('admin/parroquia')->with('flash_message', 'Parroquia deleted!');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
