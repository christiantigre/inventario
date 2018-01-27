<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tempauxctum;
use App\auxiliar;
use Illuminate\Http\Request;

class TempauxctaController extends Controller
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
            $tempauxcta = Tempauxctum::where('auxiliar', 'LIKE', "%$keyword%")
                ->orWhere('secuencia', 'LIKE', "%$keyword%")
                ->orWhere('codigo', 'LIKE', "%$keyword%")
                ->orWhere('detall', 'LIKE', "%$keyword%")
                ->orWhere('activo', 'LIKE', "%$keyword%")
                ->orWhere('cuenta', 'LIKE', "%$keyword%")
                ->orWhere('subcuenta_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $tempauxcta = Tempauxctum::paginate($perPage);
        }

        return view('admin.tempauxcta.index', compact('tempauxcta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $subcuentas = auxiliar::orderBy('codigo', 'ASC')->where('activo', 1)->pluck('auxiliar', 'id');
        return view('admin.tempauxcta.create','subcuentas');
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
        
        Tempauxctum::create($requestData);

        return redirect('admin/tempauxcta')->with('flash_message', 'Tempauxctum added!');
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
        $tempauxctum = Tempauxctum::findOrFail($id);

        return view('admin.tempauxcta.show', compact('tempauxctum'));
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
        $tempauxctum = Tempauxctum::findOrFail($id);

        return view('admin.tempauxcta.edit', compact('tempauxctum'));
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
        
        $tempauxctum = Tempauxctum::findOrFail($id);
        $tempauxctum->update($requestData);

        return redirect('admin/tempauxcta')->with('flash_message', 'Tempauxctum updated!');
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
        Tempauxctum::destroy($id);

        return redirect('admin/tempauxcta')->with('flash_message', 'Tempauxctum deleted!');
    }
}
