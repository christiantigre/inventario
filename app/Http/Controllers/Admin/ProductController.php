<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;
use App\Subcategory;
use App\Proveedor;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Input;
use Session;

class ProductController extends Controller
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
            $product = Product::where('producto', 'LIKE', "%$keyword%")
            ->orWhere('cod_barra', 'LIKE', "%$keyword%")
            ->orWhere('pre_compra', 'LIKE', "%$keyword%")
            ->orWhere('pre_venta', 'LIKE', "%$keyword%")
            ->orWhere('cantidad', 'LIKE', "%$keyword%")
            ->orWhere('imagen', 'LIKE', "%$keyword%")
            ->orWhere('name_img', 'LIKE', "%$keyword%")
            ->orWhere('nuevo', 'LIKE', "%$keyword%")
            ->orWhere('promo', 'LIKE', "%$keyword%")
            ->orWhere('catalogo', 'LIKE', "%$keyword%")
            ->orWhere('activo', 'LIKE', "%$keyword%")
            ->orWhere('propaganda', 'LIKE', "%$keyword%")
            ->orWhere('id_category', 'LIKE', "%$keyword%")
            ->orWhere('id_subcategory', 'LIKE', "%$keyword%")
            ->orWhere('id_proveedor', 'LIKE', "%$keyword%")
            ->paginate($perPage);
        } else {
            $product = Product::paginate($perPage);
        }

        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $category = Category::orderBy('id', 'ASC')->where('activo', 1)->pluck('category', 'id');
        $subcategory = Subcategory::orderBy('id', 'ASC')->where('active', 1)->pluck('subcategory', 'id');
        return view('admin.product.create',compact('category','subcategory'));
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
         $rules = [
            'producto' => 'required|max:75',
            'cod_barra'=>'unique:products|max:99999999999999999999',
            'pre_compra'=>'numeric',
            'pre_venta'=>'numeric',
            'cantidad'=>'numeric',
            'imagen' => 'mimes:jpg,jpeg,gif,png',
        ];

        $messages = [
            'pre_compra.numeric'=>'Caractér invalido',
            'pre_venta.numeric'=>'Caractér invalido',
            'cod_barra.unique'=>'Este codigo de barra ya esta en uso.',
            'cantidad.numeric'=>'Cantidad incorrecta',
            'cantidad.max'=>'Cantidad fuera de rango permitido'
        ];

         $this->validate($request, $rules, $messages);

        try {



            $requestData = $request->all();

            if ($request->hasFile('imagen')) {
                $file = Input::file('imagen');
                $uploadPath = public_path('uploads/product/');
                $extension = $file->getClientOriginalName();
                $image  = Image::make($file->getRealPath());
                $image->resize(300, 300);
                $extension = rand(11111, 99999) . '.' . $extension;
                $image->save($uploadPath.$extension);
                $requestData['imagen'] = 'uploads/product/'.$extension;
                $requestData['name_img'] = $extension;
            }

            Product::create($requestData);
            Session::flash('flash_message', 'Guardado correctamente');            

        } catch (\Exception $e) {
            Session::flash('warning', 'Error al registrar producto!!!');            
            
        }

        return redirect('admin/product');
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
        $product = Product::findOrFail($id);

        return view('admin.product.show', compact('product'));
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
        $product = Product::findOrFail($id);

        $category = Category::orderBy('id', 'ASC')->where('activo', 1)->pluck('category', 'id');
        $subcategory = Subcategory::orderBy('id', 'ASC')->where('active', 1)->pluck('subcategory', 'id');
        return view('admin.product.edit', compact('product','category','subcategory'));
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
        $rules = [
            'producto' => 'required|max:75',
            'pre_compra'=>'numeric',
            'pre_venta'=>'numeric',
            'cantidad'=>'numeric',
            'imagen' => 'mimes:jpg,jpeg,gif,png',
        ];

        $messages = [
            'pre_compra.numeric'=>'Caractér invalido',
            'pre_venta.numeric'=>'Caractér invalido',
            'cod_barra.unique'=>'Este codigo de barra ya esta en uso.',
            'cantidad.numeric'=>'Cantidad incorrecta',
            'cantidad.max'=>'Cantidad fuera de rango permitido'
        ];

         $this->validate($request, $rules, $messages);

        try {


            $requestData = $request->all();


            if ($request->hasFile('imagen')) {
                $file = Input::file('imagen');
                $uploadPath = public_path('uploads/product/');
                $extension = $file->getClientOriginalName();
                $image  = Image::make($file->getRealPath());
                $image->resize(300, 300);
                $extension = rand(11111, 99999) . '.' . $extension;
                $image->save($uploadPath.$extension);
                $requestData['imagen'] = 'uploads/product/'.$extension;
                $requestData['name_img'] = $extension;

                $item_delete = Product::findOrFail($id);   
                $move = $item_delete['name_img'];
                $old = public_path('uploads/product/').$move;
                       //verificamos si la imagen exist
                if(!empty($move)){
                    if(\File::exists($old)){
                        unlink($old);
                    }
                }
            }

            $product = Product::findOrFail($id);
            $product->update($requestData);    
            Session::flash('flash_message', 'Actualizado correctamente');            

        } catch (\Exception $e) {
            Session::flash('warning', 'Error al actualizar!!!');            
        }

        return redirect('admin/product');
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
            $item_delete = Product::findOrFail($id);   
            $move = $item_delete['name_img'];
            $old = public_path('uploads/product/').$move;
                       //verificamos si la imagen exist
            if(!empty($move)){
                if(\File::exists($old)){
                    unlink($old);
                }
            }
            Product::destroy($id);
            Session::flash('flash_message', 'Eliminado correctamente');            
        } catch (\Exception $e) {
            Session::flash('warning', 'Error al eliminar!!!');            
        }

        return redirect('admin/product');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
