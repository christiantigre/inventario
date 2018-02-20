<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\SvLogAdmin;
use App\Admin;
use App\Person as People;
use App\Perfil;
use Session;
use Image;
use Illuminate\Support\Facades\Input;

class PeopleController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'logout']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dato = $this->gen_section();
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $users = People::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->paginate($perPage);
                $this->genLog("Busqueda datos :".$keyword);
        } else {
            $users = People::paginate($perPage);
            $this->genLog("Visualizó usuarios");            
        }

        return view('admin.usuarios.index', compact('users','dato'));
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
        $dato = $this->gen_section();
        $user = People::findOrFail($id);
        $perfil = Perfil::where('id_usuario',$user->id)->first();

        return view('admin.usuarios.show', compact('user','dato','perfil'));
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
        $area = 'Usuarios';
        $logs = Svlogadmin::log($mensaje,$area);
    }

    public function gen_section(){
        $data = array(
            "txtinicio"=>"Inicio",
            "rutainicio" => "/admin/people",
            "txtmodulo" => "USUARIOS",
            "section" => "Usuarios",
            "rutamodulo" => "/admin/people",
            "ventana" => "Usuarios"
        );
        return $data;
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }


}
