<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Canton;
use App\Cliente;

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

}
