<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Canton;

class ComponentController extends Controller
{
    

    public function getCanton(Request $request, $id){
        if($request->ajax()){
            $cantons = Canton::canton($id);
            return response()->json($cantons);
        }
    }


}
