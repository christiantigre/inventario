<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tempsubauxctum;
use Illuminate\Http\Request;

class TempsubauxctaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $tempsubauxcta = Tempsubauxctum::where('subauxiliar', 'LIKE', "%$keyword%")
                ->orWhere('secuencia', 'LIKE', "%$keyword%")
                ->orWhere('codigo', 'LIKE', "%$keyword%")
                ->orWhere('detall', 'LIKE', "%$keyword%")
                ->orWhere('activo', 'LIKE', "%$keyword%")
                ->orWhere('auxiliar', 'LIKE', "%$keyword%")
                ->orWhere('auxiliar_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $tempsubauxcta = Tempsubauxctum::paginate($perPage);
        }

        return view('admin.tempsubauxcta.index', compact('tempsubauxcta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        return view('admin.tempsubauxcta.create');
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
        
        Tempsubauxctum::create($requestData);

        return redirect('admin/tempsubauxcta')->with('flash_message', 'Tempsubauxctum added!');
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
        $tempsubauxctum = Tempsubauxctum::findOrFail($id);

        return view('admin.tempsubauxcta.show', compact('tempsubauxctum'));
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
        $tempsubauxctum = Tempsubauxctum::findOrFail($id);

        return view('admin.tempsubauxcta.edit', compact('tempsubauxctum'));
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
        
        $tempsubauxctum = Tempsubauxctum::findOrFail($id);
        $tempsubauxctum->update($requestData);

        return redirect('admin/tempsubauxcta')->with('flash_message', 'Tempsubauxctum updated!');
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
        Tempsubauxctum::destroy($id);

        return redirect('admin/tempsubauxcta')->with('flash_message', 'Tempsubauxctum deleted!');
    }
}
