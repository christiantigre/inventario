<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\detall_asiento;
use Illuminate\Http\Request;
use Session;
use App\SvLogAdmin;

class detall_asientoController extends Controller
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
            $detall_asiento = detall_asiento::where('num_asiento', 'LIKE', "%$keyword%")
                ->orWhere('cod_cuenta', 'LIKE', "%$keyword%")
                ->orWhere('cuenta', 'LIKE', "%$keyword%")
                ->orWhere('periodo', 'LIKE', "%$keyword%")
                ->orWhere('fecha', 'LIKE', "%$keyword%")
                ->orWhere('saldo_debe', 'LIKE', "%$keyword%")
                ->orWhere('saldo_haber', 'LIKE', "%$keyword%")
                ->orWhere('almacen_id', 'LIKE', "%$keyword%")
                ->orWhere('cuenta_id', 'LIKE', "%$keyword%")
                ->orWhere('asiento_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $detall_asiento = detall_asiento::paginate($perPage);
        }

        return view('admin.detall_asiento.index', compact('detall_asiento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.detall_asiento.create');
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
        
        detall_asiento::create($requestData);

        return redirect('admin/detall_asiento')->with('flash_message', 'detall_asiento added!');
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
        $detall_asiento = detall_asiento::findOrFail($id);

        return view('admin.detall_asiento.show', compact('detall_asiento'));
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
        $detall_asiento = detall_asiento::findOrFail($id);

        return view('admin.detall_asiento.edit', compact('detall_asiento'));
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
        
        $detall_asiento = detall_asiento::findOrFail($id);
        $detall_asiento->update($requestData);

        return redirect('admin/detall_asiento')->with('flash_message', 'detall_asiento updated!');
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
        detall_asiento::destroy($id);

        return redirect('admin/detall_asiento')->with('flash_message', 'detall_asiento deleted!');
    }
}
