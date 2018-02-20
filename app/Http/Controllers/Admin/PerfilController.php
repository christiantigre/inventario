<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\SvLogAdmin;
use App\Admin;
use App\Perfil;
use Session;
use Image;
use Illuminate\Support\Facades\Input;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'logout']);
    }
    public function index(){
    	try {

            $mailAdmin = auth('admin')->user()->email;
            $adminid = auth('admin')->user()->id;
            $administrador = Admin::findOrFail($adminid);
            $dataArray['mail'] = $mailAdmin;          
            $dataArray['iduser'] = $adminid;         

            $perfil = Perfil::where('id_usuario',$administrador->id)->where('tipo_usuario','admin')->first(); 

        } catch (\Exception $e) {         

            $administrador = Admin::findOrFail(1);
            $perfil = "";
        }

        $this->genLog("Ingresó a perfìl");
        $dato = $this->gen_section();
        return view('perfil.index',compact('dato','perfil'));
    }

    public function edit($id)
    {
        $perfil = Perfil::findOrFail($id);
        $this->genLog("Ingresó a editar perfìl email: ".$perfil->email);
        $dato = $this->gen_section();        
        return view('perfil.edit',compact('perfil','dato'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
           'nombre' => 'required|max:75',
           'apellido' => 'required|max:75',
           'cedula' => 'required|max:75',
           'ruc' => 'nullable|max:13',
           'telefono' => 'nullable|max:13',
           'celular' => 'nullable|max:15',
           'email' => 'nullable|max:75|email',
           'fecha_nacimiento' => 'nullable|max:15',
           'titulo' => 'nullable|max:75',
           'logo' => 'nullable|mimes:jpeg,png|max:1500'
       ]);

        $requestData = $request->all();        

        if ($request->hasFile('foto')) {
            $file = Input::file('foto');
            $uploadPath = public_path('uploads\\perfil\\');
            $extension_ext = $file->getClientOriginalExtension();
            $extension = $file->getClientOriginalName();
            $image  = Image::make($file->getRealPath());
            $fileName = rand(11111, 99999) . '.' . $extension;
            $image->save($uploadPath.$fileName);
            $requestData['foto'] = 'uploads\\perfil\\'.$fileName;

            $item_delete = perfil::findOrFail($id);   
            $move = $item_delete['foto'];
            if($move!=""){
	            $old = public_path('\\').$move;
	            if(!empty($old)){
	                if(\File::exists($old)){
	                    unlink($old);
				        $this->genLog("Elimino foto ruta: ".$old);
	                }
	            }
            }

        }
        try {       
        $perfil = Perfil::findOrFail($id);
        $perfil->update($requestData);
            Session::flash('flash_message', 'Actualizado correctamente');
				        $this->genLog("Actualizó cuenta email : ".$perfil->email);

        } catch (\Exception $e) {
            Session::flash('warning', 'Error al actualizar!!!');            
				        $this->genLog("Error al actualizar cuenta email : ".$perfil->email);

        }

        return redirect('admin/settings');
	}

    public function genLog($mensaje)
    {
        $area = 'Perfil';
        $logs = Svlogadmin::log($mensaje,$area);
    }

    public function gen_section(){
        $data = array(
            "txtinicio"=>"Inicio",
            "rutainicio" => "/admin/settings",
            "txtmodulo" => "PERFÍL",
            "section" => "Perfil",
            "rutamodulo" => "/admin/settings",
            "ventana" => "Perfil"
        );
        return $data;
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
