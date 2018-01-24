<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Canton;
use App\Cliente;
use App\ItemVenta;
use App\Iva;
use App\Grupo;
use App\Cuentum;
use App\subcuentum;
use App\Tempsubctum;
use App\auxiliar;
use Session;

class ComponentController extends Controller
{


    public function getCanton(Request $request, $id){
        if($request->ajax()){
            $cantons = Canton::canton($id);
            return response()->json($cantons);
        }
    }    

    public function getcliente(Request $request){
        if($request->ajax()){
            $cliente = Cliente::where('id',$request->id)->first();
            return response()->json($cliente);
        }
    }

    public function savecliente(Request $request){    
        if($request->ajax()){
            $requestData['nom_cli']=$request->nom_cli;
            $requestData['app_cli']=$request->app_cli;
            $requestData['ced_cli']=$request->ced_cli;
            $requestData['ruc_cli']=$request->ruc_cli;
            $requestData['dir_cli']=$request->dir_cli;
            $requestData['mail_cli']=$request->mail_cli;
            $requestData['mail_cli']=$request->mail_cli;
            $requestData['tlf_cli']=$request->tlf_cli;
            $cliente = Cliente::create($requestData);
            $$requestData['id'] = $cliente->id;
            $cliData = $requestData;
            return response()->json($cliData);
        }
    }

    public function saveproducto(Request $request){    
        if($request->ajax()){
            $item = new ItemVenta;        
            $item->producto = $request->nombre;
            $item->codbarra = $request->codbarra;
            $item->precio = $request->precio;
            $item->cant = $request->cantidad;
            $item->total = ($request->precio*$request->cantidad);
            $item->id_producto = $request->idproducto;
            if($item->save()){
                return response()->json(["mensaje"=>"Registrado con exito","data"=>$request->all()]);
            }else{
                return response()->json(["mensaje"=>"Error !!! al guardar","data"=>$request->all()]);
            }
            /*$cliente = ItemVenta::create($requestData);
            return response()->json($cliente);*/
        }
    }

    public function listallitems()
    {
        $carrito = ItemVenta::orderBy('id','ASC')->get();
        $total = ItemVenta::sum('total');

        $iva = Iva::where('activo', 1)->first();
        $iva_valor=$iva->iva;
        $iva_id=$iva->id;
        $iva_mostrar = ($iva_valor*1);
        $mult = $iva_valor+100;
        $iva_final = $mult/100;

        $subtotal = ($total/$iva_final);
        $valor_con_iva = ($total-$subtotal);

        return view('admin/venta/list-cartitems', compact('carrito'),array(
            'total' =>  $total,
            'iva' =>  $valor_con_iva,
            'subtotal' =>  $subtotal,
            'ivavalor' =>  $iva_mostrar,
            'idiva' =>  $iva_id
        ));
    }

    public function deleteItem(Request $request){
     if ($request->ajax()) {        
        $item = ItemVenta::find($request->id);
        if($item->delete()){
            return response()->json(["mensaje"=>"Eliminado con exito","data"=>"Eliminado"]);
        }else{
            return response()->json(["mensaje"=>"Error !!! al guardar","data"=>$request->all()]);
        }
    }else{
       return response()->json(["mensaje"=>$request->all()]);   
   }
}

public function trashItem(Request $request){
    if ($request->ajax()) {        
        if(ItemVenta::truncate()){
            return response()->json(["mensaje"=>"Vaciado con exito","data"=>"Vaciado"]);
        }else{
            return response()->json(["mensaje"=>"Error !!! al vaciar","data"=>$request->all()]);
        }
    }else{
       return response()->json(["mensaje"=>$request->all()]);   
   }
}


/*
Modulo de contabilidad
*/


public function extraercantidadclases(Request $request){
    if ($request->ajax()) {
        $cantidad = Grupo::where('clase_id', $request->id)->count();
        $cantidad = $cantidad+1;
        return response()->json($cantidad);
    }
}

public function extraercantidadgrupos(Request $request){
    if ($request->ajax()) {
        $grupo = Grupo::where('id', $request->id)->first();
        $cantidad = Cuentum::where('grupo', $grupo->codigo)->count();
        $cantidad = $cantidad+1;
        $grupo_id = $grupo->id;
        $dato['grupo_id'] = $grupo_id;
        $dato['grupo_codigo'] = $grupo->codigo;
        $dato['cantidad'] = $cantidad;
        return response()->json($dato);
    }
}

public function extraercontadorcuentas(Request $request){
    if ($request->ajax()) {
        $cuenta = Cuentum::where('id', $request->id)->first();
        $cantidad = subcuentum::where('cuenta', $cuenta->codigo)->count();
        $cantidad = $cantidad+1;
        $cuenta_id = $cuenta->id;
        $dato['cuenta_id'] = $cuenta_id;
        $dato['cuenta_codigo'] = $cuenta->codigo;
        $dato['cantidad'] = $cantidad;
        return response()->json($dato);
    }
}

public function listaSubcuentas()
{
    $tempsubcta = Tempsubctum::orderBy('codigo','ASC')->get();
    return view('admin/subcuenta/list_tempsubcuenta', compact('tempsubcta'));
}

public function savesubcuenta(Request $request){    
    if($request->ajax()){
        $item = new Tempsubctum;        
        $item->cuenta_id = $request->cuenta_id;
        $item->cuenta = $request->cuenta;
        $item->secuencia = $request->secuencia;
        $item->subcuenta = $request->subcuenta;
        $item->codigo = $request->codigo;

        if($item->save()){
            return response()->json(["mensaje"=>"Registrado con exito","data"=>$request->all()]);
        }else{
            return response()->json(["mensaje"=>"Error !!! al guardar","data"=>$request->all()]);
        }
            /*$cliente = ItemVenta::create($requestData);
            return response()->json($cliente);*/
        }
    }



    public function extraercontadorcuentasvarias(Request $request){
        if ($request->ajax()) {
            $cuenta = Cuentum::where('id', $request->id)->first();
            $cantidad = subcuentum::where('cuenta', $cuenta->codigo)->count();
            $cantidad_temp = Tempsubctum::where('cuenta', $cuenta->codigo)->count();
            $cantidad = $cantidad+1+$cantidad_temp;
            $cuenta_id = $cuenta->id;
            $dato['cuenta_id'] = $cuenta_id;
            $dato['cuenta_codigo'] = $cuenta->codigo;
            $dato['cantidad'] = $cantidad;
            return response()->json($dato);
        }
    }

    public function trashSubcuentas(Request $request){
        if ($request->ajax()) {        
            if(Tempsubctum::truncate()){
                return response()->json(["mensaje"=>"Vaciado con exito","data"=>"Vaciado"]);
            }else{
                return response()->json(["mensaje"=>"Error !!! al vaciar","data"=>$request->all()]);
            }
        }else{
           return response()->json(["mensaje"=>$request->all()]);   
       }
   }

   public function guardarsubcuentas(Request $request){
    try {

        $subcuentas = Tempsubctum::get();
        foreach ($subcuentas as $subcuenta) {
            $requestData_returned = $this->saveItem($subcuenta);
            $requestData_returned->save();
        }

        Tempsubctum::truncate();

        Session::flash('flash_message', 'Guardado correctamente');
    } catch (\Exception $e) {
        Session::flash('warning', 'Error al Guardar');  

        return redirect()->back();

    }
    return redirect('admin/subcuenta');
}


    protected function saveItem($subcuenta)
    {
        $requestData = new subcuentum;
        $requestData->subcuenta = $subcuenta->subcuenta;
        $requestData->secuencia = $subcuenta->secuencia;
        $requestData->codigo = $subcuenta->codigo;
        $requestData->detall = $subcuenta->detall;
        $requestData->activo = $subcuenta->activo;
        $requestData->cuenta = $subcuenta->cuenta;
        $requestData->cuenta_id = $subcuenta->cuenta_id;
        return $requestData;
    }


    public function extraercontadorsubcuentas(Request $request){
        if ($request->ajax()) {
            $subcuenta = subcuentum::where('id', $request->id)->first();
            $cantidad = auxiliar::where('subcuenta', $subcuenta->codigo)->count();
            $cantidad = $cantidad+1;
            $subcuenta_id = $subcuenta->id;
            $dato['subcuenta_id'] = $subcuenta_id;
            $dato['cuenta_codigo'] = $subcuenta->codigo;
            $dato['cantidad'] = $cantidad;
            return response()->json($dato);
        }
    }

}
