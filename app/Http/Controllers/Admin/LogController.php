<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Session;

class LogController extends Controller
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
    public function index()
    {
        $date = Carbon::now();
        $date->timezone = new \DateTimeZone('America/Guayaquil');
        $datesegundos = Carbon::now();
        $datesegundos -> toDateTimeString();

        $date = $date->format('m-d-Y');

        $rutai = public_path();
        $ruta = str_replace("//", "//", $rutai);
        $date = $date;
        $dir = $ruta.'/logs/'.$date;
        $nombre_archivo = $dir;
        if (\file_exists($nombre_archivo)) {
            $rows = \file($nombre_archivo);
            \array_shift($rows);
            return view('admin.logs.index', compact('rows'));
        } else {
            $rows['0']=0;
            return view('admin.logs.index', compact('rows'));
        }
    }

    public function revisarLogfecha(Request $request)
    {   
        $rutai = public_path();
        $ruta = str_replace("//", "//", $rutai);
        $date = $request['date'];
        $dir = $ruta.'/logs/'.$date;
        $nombre_archivo = $dir;
        //return $nombre_archivo;
        if (\file_exists($nombre_archivo)) {
            $rows = \file($nombre_archivo);
            \array_shift($rows);
            return view('admin.logs.index', compact('rows'));
        } else {
            $rows['0']=0;
            return view('admin.logs.index', compact('rows'));
        }
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
        //
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

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
