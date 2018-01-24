<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tempsubctum;
use Illuminate\Http\Request;

class TempsubctaController extends Controller
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
            $tempsubcta = Tempsubctum::where('subcuenta', 'LIKE', "%$keyword%")
                ->orWhere('secuencia', 'LIKE', "%$keyword%")
                ->orWhere('codigo', 'LIKE', "%$keyword%")
                ->orWhere('detall', 'LIKE', "%$keyword%")
                ->orWhere('activo', 'LIKE', "%$keyword%")
                ->orWhere('cuenta', 'LIKE', "%$keyword%")
                ->orWhere('cuenta_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $tempsubcta = Tempsubctum::paginate($perPage);
        }

        return view('admin.tempsubcta.index', compact('tempsubcta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.tempsubcta.create');
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
        
        Tempsubctum::create($requestData);

        return redirect('admin/tempsubcta')->with('flash_message', 'Tempsubctum added!');
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
        $tempsubctum = Tempsubctum::findOrFail($id);

        return view('admin.tempsubcta.show', compact('tempsubctum'));
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
        $tempsubctum = Tempsubctum::findOrFail($id);

        return view('admin.tempsubcta.edit', compact('tempsubctum'));
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
        
        $tempsubctum = Tempsubctum::findOrFail($id);
        $tempsubctum->update($requestData);

        return redirect('admin/tempsubcta')->with('flash_message', 'Tempsubctum updated!');
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
        Tempsubctum::destroy($id);

        return redirect('admin/tempsubcta')->with('flash_message', 'Tempsubctum deleted!');
    }
}
