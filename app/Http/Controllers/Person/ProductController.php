<?php

namespace App\Http\Controllers\Person;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SvLog;
use App\Product;
use App\Category;
use App\Subcategory;
use App\Proveedor;
use App\Marca;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Input;
use Session;
use DB;
use Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        $this->middleware('person', ['except' => 'logout']);
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

            $this->genLog("Busqueda datos :".$keyword);
        } else {
            $product = Product::paginate($perPage);
            $this->genLog("Visualizó sección.");
        }

        return view('person.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
        $fecha = $carbon->now()->format('Y-m-d');
        $this->genLog("Ingresó a nuevo registro.");
        $category = Category::orderBy('id', 'ASC')->where('activo', 1)->pluck('category', 'id');
        $subcategory = Subcategory::orderBy('id', 'ASC')->where('active', 1)->pluck('subcategory', 'id');
        $marca = Marca::orderBy('id', 'ASC')->where('activo', 1)->pluck('marca', 'id');
        return view('person.product.create',compact('category','subcategory','marca','fecha'));
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
            $this->genLog("Registró nuevo : ".$requestData['producto']);       
    } catch (\Exception $e) {
        Session::flash('warning', 'Error al registrar producto!!!');       
            $this->genLog("Error al registrar : ".$requestData['producto']);    

    }

    return redirect('person/product');
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

        $this->genLog("Visualizó : ".$product['producto']);
        return view('person.product.show', compact('product'));
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

        $carbon = Carbon::now(new \DateTimeZone('America/Guayaquil'));
        $fecha = $carbon->now()->format('Y-m-d');
        
        $product = Product::findOrFail($id);
        $this->genLog("Ingresó actualizar producto id: ".$id);
        $category = Category::orderBy('id', 'ASC')->where('activo', 1)->pluck('category', 'id');
        $subcategory = Subcategory::orderBy('id', 'ASC')->where('active', 1)->pluck('subcategory', 'id');
        $marca = Marca::orderBy('id', 'ASC')->where('activo', 1)->pluck('marca', 'id');
        return view('person.product.edit', compact('product','category','subcategory','marca','fecha'));
    }

    public function downloadExcel($type){
                $this->genLog("Descargó excel : ".$type);
        $data = Product::get()->toArray();
        return Excel::create('exportardatos', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);

    }

    public function importExcelProducts(Request $request){
        $this->genLog("Importó excel productos");
        $excel_file = $request->file('file');

        $validator = Validator::make($request->all(), [
         'file' => 'required'
     ]);
        try {
            if(Input::hasFile('file')){
                $path = Input::file('file')->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();
                if(!empty($data) && $data->count()){
                    foreach ($data as $key => $value) {
                        if($value == '')
                        {
                            $value = 'n/n';
                        }
                        $insert[] = [
                            'producto' => $value->producto, 
                            'cod_barra' => $value->cod_barra,
                            'pre_compra' => $value->pre_compra,
                            'pre_venta' => $value->pre_venta,
                            'cantidad' => $value->cantidad,
                            "imagen" => $value->imagen,
                            "name_img" => $value->name_img,
                            'nuevo' => $value->nuevo,
                            'promo' => $value->promo,
                            'catalogo' => $value->catalogo,
                            'activo' => $value->activo,
                            'propaganda' => $value->propaganda,
                            'id_category' => $value->id_category,
                            'id_subcategory' => $value->id_subcategory,
                            'id_proveedor' => $value->id_proveedor,
                            'id_marca' => $value->id_marca
                        ];
                    }
                    if(!empty($insert)){

                        DB::table('products')->insert($insert);
                    }
                }
            }
            Session::flash('flash_message', 'Importación correctamente');            
        } catch (\Exception $e) {
            Session::flash('warning', 'Error al procesar archivo, reviselo y intentelo nuevamente !!!');                 
        }
        return redirect('person/product');
    }

    public function importProducts(Request $request)
    {
        try {
            \Excel::load($request->excel, function($reader) {
                $excel = $reader->get();
        // iteracción
                $reader->each(function($row) { 
                    $Product = new Product;
                    $Product->producto = $row->producto;
                    $Product->cod_barra = $row->cod_barra;
                    $Product->pre_compra = $row->pre_compra;
                    $Product->pre_venta = $row->pre_venta;
                    $Product->cantidad = $row->cantidad;
                    $Product->imagen = $row->imagen;
                    $Product->name_imagen = $row->name_imagen;
                    $Product->nuevo = $row->nuevo;
                    $Product->promo = $row->promo;
                    $Product->catalogo = $row->catalogo;
                    $Product->activo = $row->activo;
                    $Product->propaganda = $row->propaganda;
                    $Product->id_category = $row->id_category;
                    $Product->id_subcategory = $row->id_subcategory;
                    $Product->id_proveedor = $row->id_proveedor;
                    $Product->id_marca = $row->id_marca;
                    $Product->save();
                });
            });    
            Session::flash('flash_message', 'Importación correctamente');            
        } catch (\Exception $e) {
            Session::flash('warning', 'Error al procesar archivo!!!');         
        }
        return redirect('person/product');
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
            $this->genLog("Actualizó producto id: ".$id);
            Session::flash('flash_message', 'Actualizado correctamente');            

        } catch (\Exception $e) {
            $this->genLog("Error al actualizar producto id: ".$id);
            Session::flash('warning', 'Error al actualizar!!!');            
        }

        return redirect('person/product');
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
            $this->genLog("Eliminó id:".$id);           
        } catch (\Exception $e) {
            $this->genLog("Error al eliminar id: ".$id);      
            Session::flash('warning', 'Error al eliminar!!!');            
        }

        return redirect('person/product');
    }

    public function genLog($mensaje)
    {
        $area = 'Producto';
        $logs = Svlog::log($mensaje,$area);
    }

    protected function guard()
    {
        return Auth::guard('person');
    }
}
