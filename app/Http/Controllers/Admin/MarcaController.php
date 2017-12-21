<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Marca;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Input;
use Session;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'logout']);
    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $marca = Marca::where('marca', 'LIKE', "%$keyword%")
            ->orWhere('detall', 'LIKE', "%$keyword%")
            ->orWhere('img', 'LIKE', "%$keyword%")
            ->orWhere('name_img', 'LIKE', "%$keyword%")
            ->orWhere('activo', 'LIKE', "%$keyword%")
            ->paginate($perPage);
        } else {
            $marca = Marca::paginate($perPage);
        }

        return view('admin.marca.index', compact('marca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.marca.create');
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

        $requestData = $request->all();
        

        if ($request->hasFile('img')) {
            $file = Input::file('img');
            $uploadPath = public_path('uploads/marca/');
            $extension = $file->getClientOriginalName();
            $image  = Image::make($file->getRealPath());
            $image->resize(300, 300);
            $extension = rand(11111, 99999) . '.' . $extension;
            $image->save($uploadPath.$extension);
            $requestData['img'] = 'uploads/marca/'.$extension;
            $requestData['name_img'] = $extension;
        }

        Marca::create($requestData);

        return redirect('admin/marca')->with('flash_message', 'Marca added!');
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
        $marca = Marca::findOrFail($id);

        return view('admin.marca.show', compact('marca'));
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
        $marca = Marca::findOrFail($id);

        return view('admin.marca.edit', compact('marca'));
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
        

        if ($request->hasFile('img')) {
            $file = Input::file('img');
            $uploadPath = public_path('uploads/marca/');
            $extension = $file->getClientOriginalName();
            $image  = Image::make($file->getRealPath());
            $image->resize(300, 300);
            $extension = rand(11111, 99999) . '.' . $extension;
            $image->save($uploadPath.$extension);
            $requestData['img'] = 'uploads/marca/'.$extension;
            $requestData['name_img'] = $extension;

            $item_delete = Marca::findOrFail($id);   
            $move = $item_delete['name_img'];
            $old = public_path('uploads/marca/').$move;
                       //verificamos si la imagen exist
            if(!empty($move)){
                if(\File::exists($old)){
                    unlink($old);
                }
            }
        }

        $marca = Marca::findOrFail($id);
        $marca->update($requestData);

        return redirect('admin/marca')->with('flash_message', 'Marca updated!');
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
            $item_delete = Marca::findOrFail($id);   
            $move = $item_delete['name_img'];
            $old = public_path('uploads/marca/').$move;
                       //verificamos si la imagen exist
            if(!empty($move)){
                if(\File::exists($old)){
                    unlink($old);
                }
            }
            Marca::destroy($id);

        } catch (Exception $e) {

        }
        return redirect('admin/marca')->with('flash_message', 'Marca deleted!');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
