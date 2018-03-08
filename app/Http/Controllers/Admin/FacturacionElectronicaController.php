<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\FacturacionElectronica;
use Illuminate\Http\Request;
use App\SvLogAdmin;
use App\Almacen;
use Illuminate\Support\Facades\Input;

class FacturacionElectronicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'logout']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $dato = $this->gen_section();
        $this->genLog("Visualizó Configuración Facturación electrónica"); 
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $facturacionelectronica = FacturacionElectronica::where('generar_facturas', 'LIKE', "%$keyword%")
            ->orWhere('obligado_contabilidad', 'LIKE', "%$keyword%")
            ->orWhere('path_certificado', 'LIKE', "%$keyword%")
            ->orWhere('modo_ambiente', 'LIKE', "%$keyword%")
            ->paginate($perPage);
        } else {
            $facturacionelectronica = FacturacionElectronica::paginate($perPage);
        }

        return view('admin.facturacion-electronica.index', compact('facturacionelectronica','dato'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $dato = $this->gen_section();
        return view('admin.facturacion-electronica.create',compact('dato'));
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
         'path_certificado' => 'required|max:255'
     ]);

        $requestData = $request->all();

        $empresa = Almacen::first();
        if (!empty($empresa)) {
            $requestData['id_almacen'] = $empresa->id;
        }else{
            $requestData['id_almacen'] = "1";
        }
        
        if ($request->hasFile('path_certificado')) {
            $certificate = Input::file('path_certificado');
            $uploadPath = public_path('archivos/certificado/');
            $filename = $certificate->getClientOriginalExtension();
            $name = $certificate->getClientOriginalName();
            if (file_exists($uploadPath.$name)) {
                unlink($uploadPath.$name);                
            }
            try {
                    $certificate->move($uploadPath,$name);
                    $requestData['path_certificado'] = $uploadPath.$name;
                    $this->genLog("Subió archivo firma electrónica"); 
                } catch (\Exception $e) {
                    $this->genLog("Error al subir firma electrónica"); 
                }
        }
        try {
            FacturacionElectronica::create($requestData);
            $this->genLog("Configuró Factura electrónica"); 
            Session::flash('flash_message', 'Guardado correctamente');
        } catch (\Exception $e) {
            $this->genLog("Error al Configurrar Factura electrónica".$e); 
            Session::flash('warning', 'Error al Guardar');   
        }

        return redirect('admin/facturacion-electronica');
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
        $dato = $this->gen_section();
        try {

            $facturacionelectronica = FacturacionElectronica::findOrFail($id);
            $this->genLog("Visualizó Facturación electrónica"); 

        } catch (\Exception $e) {

          $this->genLog("Visualizó Facturación electrónica error: ".$e);  
      }

      return view('admin.facturacion-electronica.show', compact('facturacionelectronica','dato'));
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
        $dato = $this->gen_section();


        $facturacionelectronica = FacturacionElectronica::findOrFail($id);


        return view('admin.facturacion-electronica.edit', compact('facturacionelectronica','dato'));
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

        $empresa = Almacen::first();
        if (!empty($empresa)) {
            $requestData['id_almacen'] = $empresa->id;
        }else{
            $requestData['id_almacen'] = "1";
        }

        if ($request->hasFile('path_certificado')) {
            $certificate = Input::file('path_certificado');
            $uploadPath = public_path('archivos/certificado/');
            $filename = $certificate->getClientOriginalExtension();
            $name = $certificate->getClientOriginalName();

            $item_delete = FacturacionElectronica::findOrFail($id);   
            $move = $item_delete['path_certificado'];
            $old = $move;
            if(!empty($move)){
                if(\File::exists($old)){
                    unlink($old);
                }
            }

            if (!file_exists($uploadPath.$name)) {

                $certificate->move($uploadPath,$name);
                $requestData['path_certificado'] = $uploadPath.$name;
            }
        }
        try {
            $facturacionelectronica = FacturacionElectronica::findOrFail($id);
            $facturacionelectronica->update($requestData);
            $this->genLog("Actualizó Facturación electrónica"); 
            Session::flash('flash_message', 'Actualizado correctamente');
        } catch (\Exception $e) {
            $this->genLog("Error al Actualizar Facturación electrónica"); 
            Session::flash('warning', 'Error al Actualizar');   
        }
        
        

        return redirect('admin/facturacion-electronica');
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
        try {
            FacturacionElectronica::destroy($id);
            $this->genLog("Eliminó Confiruración Facturación electrónica"); 
            Session::flash('flash_message', 'Eliminado correctamente');
        } catch (\Exception $e) {
            $this->genLog("Error al Eliminar Facturación electrónica"); 
            Session::flash('warning', 'Error al Eliminar Configuración Facturaciín Electrónica');   
        }

        return redirect('admin/facturacion-electronica')->with('flash_message', 'FacturacionElectronica deleted!');
    }

    public function gen_section(){
        $data = array(
            "txtinicio"=>"Inicio",
            "rutainicio" => "/admin/inicio",
            "txtmodulo" => "FACTURA ELECTRÓNICA",
            "section" => "Factura",
            "rutamodulo" => "/admin/factura-electronica",
            "ventana" => "Factura"
        );
        return $data;
    }

    public function genLog($mensaje)
    {
        $area = 'Factura Electrónica';
        $logs = Svlogadmin::log($mensaje,$area);
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }


}
