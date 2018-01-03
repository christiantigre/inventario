<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Canton;
use App\Cliente;
use App\ItemVenta;
use App\Iva;

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
        $iva_mostrar = ($iva_valor*1);
        $mult = $iva_valor+100;
        $iva_final = $mult/100;

        $subtotal = ($total/$iva_final);
        $valor_con_iva = ($total-$subtotal);

        return view('admin/venta/list-cartitems', compact('carrito'),array(
            'total' =>  $total,
            'iva' =>  $valor_con_iva,
            'subtotal' =>  $subtotal,
            'ivavalor' =>  $iva_mostrar
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



}
