<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Iva;
use Illuminate\Http\Request;

class IvaController extends Controller
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
            $iva = Iva::where('iva', 'LIKE', "%$keyword%")
                ->orWhere('activo', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $iva = Iva::paginate($perPage);
        }

        return view('admin.iva.index', compact('iva'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.iva.create');
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
        
        Iva::create($requestData);

        return redirect('admin/iva')->with('flash_message', 'Iva added!');
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
        $iva = Iva::findOrFail($id);

        return view('admin.iva.show', compact('iva'));
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
        $iva = Iva::findOrFail($id);

        return view('admin.iva.edit', compact('iva'));
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
        
        $iva = Iva::findOrFail($id);
        $iva->update($requestData);

        return redirect('admin/iva')->with('flash_message', 'Iva updated!');
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
        Iva::destroy($id);

        return redirect('admin/iva')->with('flash_message', 'Iva deleted!');
    }
}
