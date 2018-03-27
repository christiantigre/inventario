<?php

namespace App\Http\Controllers\Person;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comprobante_venta;
use DB;
use App\SvLog;
use App\Ventum;
use App\detallVenta;
use App\Almacen;
use Session;
use Carbon\Carbon;


class FacturacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('person', ['except' => 'logout']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $comprobantes = Comprobante_venta::where('numfactura', 'LIKE', "%$keyword%")
            ->orWhere('claveacceso', 'LIKE', "%$keyword%")
            ->orWhere('num_autorizacion', 'LIKE', "%$keyword%")
            ->orWhere('fecha_autorizacion', 'LIKE', "%$keyword%")
            ->orWhere('estado_aprobacion', 'LIKE', "%$keyword%")
            ->orWhere('mensaje', 'LIKE', "%$keyword%")
            ->orWhere('id', 'LIKE', "%$keyword%")
            ->paginate($perPage);
            $this->genLog("Busqueda comprobante :".$keyword);
        } else {
            $comprobantes = Comprobante_venta::orderBy('id','DESC')->paginate($perPage);
            $this->genLog("Visualizó comprobantes.");
        }

        return view('person.facturacion.index', compact('comprobantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comprobante = Comprobante_venta::findOrFail($id);
        $venta = Ventum::findOrFail($comprobante['id_venta']);
        $detallventa= detallVenta::where('id_venta',$id)->get();
        $almacen = Almacen::first();
        
        $this->genLog("Visualizó comprobante id : ". $comprobante['numfactura']);
        
        return view('person.facturacion.show', compact('comprobante','venta','detallventa','almacen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function genLog($mensaje)
    {
        $area = 'Comprobantes';
        $logs = Svlog::log($mensaje,$area);
    }

    protected function guard()
    {
        return Auth::guard('person');
    }


}
