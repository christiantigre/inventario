<?php

namespace App\Http\Controllers\DataTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Proveedor;
use Yajra\Datatables\Datatables;

class ProveedoresDatatablesController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('datatables.index_proveedor');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyDataPro()
    {
        return Datatables::of(Proveedor::query())->make(true);
    }
}
