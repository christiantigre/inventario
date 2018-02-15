<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
  return view('welcome');
});

Auth::routes();
/*
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@index')->name('test');*/


Route::group(['prefix' => 'admin'], function () {
  Route::get('almacen/getcanton/{id}', 'ComponentController@getCanton');
  Route::get('almacen/{var}/getcanton/{id}', 'ComponentController@getCanton');
  Route::post('/proveedor/importexcelProveedor', 'Admin\\ProveedorController@importExcelProveedor');
  Route::get('/proveedor/downloadExcel/{type}', 'Admin\\ProveedorController@downloadExcel');
  Route::get('proveedor/getcanton/{id}', 'ComponentController@getCanton');
  Route::get('proveedor/{var}/getcanton/{id}', 'ComponentController@getCanton');
  Route::get('/administracion', 'Admin\AdminController@index')->name('home');
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');
  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');
  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
  Route::resource('/almacen', 'Admin\\AlmacenController');
  Route::resource('/category', 'Admin\\CategoryController');
  Route::post('/category/trash', 'Admin\\CategoryController@trash');
  Route::get('category/restore/{id}', 'Admin\\CategoryController@restore');
  Route::post('/category/trash_delete', 'Admin\\CategoryController@trash_sofdelete');
  Route::post('/category/allrestore', 'Admin\\CategoryController@allrestore');
  Route::resource('/subcategory', 'Admin\\SubcategoryController');
  Route::post('/subcategory/trash', 'Admin\\SubcategoryController@trash');
  Route::get('subcategory/restore/{id}', 'Admin\\SubcategoryController@restore');
  Route::post('subcategory/allrestore', 'Admin\\SubcategoryController@allrestore');
  Route::post('/subcategory/trash', 'Admin\\SubcategoryController@trash');
  Route::post('/subcategory/trash_delete', 'Admin\\SubcategoryController@trash_sofdelete');
  Route::resource('/marca', 'Admin\\MarcaController');
  Route::resource('/pais', 'Admin\\PaisController');
  Route::resource('/provincia', 'Admin\\ProvinciaController');
  Route::resource('/canton', 'Admin\\CantonController');
  Route::resource('/parroquia', 'Admin\\ParroquiaController');
  Route::resource('/proveedor', 'Admin\\ProveedorController');
  Route::resource('/product', 'Admin\\ProductController');
  Route::post('/product/importexcelProducts', 'Admin\\ProductController@importExcelProducts');
  Route::get('/product/downloadExcel/{type}', 'Admin\\ProductController@downloadExcel');
  Route::get('products/buscaproveedorruc','Admin\\ProveedorController@buscarrucproveedor');
  Route::get('products/buscaproveedorempresa','Admin\\ProveedorController@buscarempresaproveedor');
  Route::get('products/buscaproveedormail','Admin\\ProveedorController@buscarmailproveedor');
  Route::resource('/cliente', 'Admin\\ClienteController');
  Route::resource('/iva', 'Admin\\IvaController');
  Route::resource('/venta', 'Admin\\VentaController');
  Route::get('/extraerdatoscli/','Admin\\VentaController@extraerdatoscliente');
  Route::post('/getClienteId/', 'ComponentController@getcliente');
  Route::post('/savecli/', 'ComponentController@savecliente');
  Route::post('/saveprod/', 'ComponentController@saveproducto');
  Route::get('/listcartitems/', 'ComponentController@listallitems');
  Route::post('/trashItem/','ComponentController@trashItem');
  Route::post('/deleteItem/','ComponentController@deleteItem');
  Route::get('/DetalleVenta/{id}', ['as' => 'detallventaadmin', 'uses' => 'Admin\\VentaController@detallventa']);
  Route::get('/print/{id}', 'Admin\\VentaController@print');
  Route::get('/viewfactura/{id}', 'Admin\\VentaController@viewfactura');  
  Route::resource('/type-pay', 'Admin\\TypePayController');
  Route::resource('/clausule', 'Admin\\ClausuleController');

  /*Modulo de inventario admin*/
  Route::resource('/inventario', 'Admin\\InventarioController');
  Route::get('/inventario/ingresos/{dato}', 'Admin\\InventarioController@ingresos');  
  Route::get('/inventario/egresos/{dato}', 'Admin\\InventarioController@egresos');  
  Route::post('/inventario/bymonthingre', 'Admin\\InventarioController@bymonthingre');
  Route::post('/inventario/byrangoingre', 'Admin\\InventarioController@byrangoingre');
  Route::post('/inventario/bymonthegre', 'Admin\\InventarioController@bymonthegre');
  Route::post('/inventario/byrangoegre', 'Admin\\InventarioController@byrangoegre');
  Route::post('/inventario/bymonthinv', 'Admin\\InventarioController@inventariobymonth');
  Route::get('/inventario/downloadExcel/{type}/{year}/', 'Admin\\InventarioController@downloadExcelYearInv');
  Route::get('/inventario/downloadExcel/{type}/{year}/{month}/', 'Admin\\InventarioController@downloadExcelMonthInv');

  Route::get('/inventario/downloadExcelingresos/{type}/{year}/', 
    'Admin\\InventarioController@downloadExcelYearInvIngresos');
  Route::get('/inventario/downloadExcelingresos/{type}/{year}/{month}/', 
    'Admin\\InventarioController@downloadExcelMonthInvIngresos');
  Route::get('/inventario/downloadExcelingresos/{type}/{year}/{month}/{rangostart}/{rangofinish}', 
    'Admin\\InventarioController@downloadExcelMonthInvIngresosRangos');

  Route::get('/inventario/downloadExcelEgresos/{type}/{year}/',
    'Admin\\InventarioController@downloadExcelYearInvEgresos');
  Route::get('/inventario/downloadExcelEgresos/{type}/{year}/{month}/',
    'Admin\\InventarioController@downloadExcelMonthInvEgresos');
  Route::get('/inventario/downloadExcelEgresos/{type}/{year}/{month}/{rangostart}/{rangofinish}', 
    'Admin\\InventarioController@downloadExcelMonthInvEgresosRangos');

  /*Audotoria desde Admin*/

  Route::resource('/logs', 'Admin\\LogController');
  Route::post('/registro', ['as' => 'admin.seguridad.logfecha', 'uses' => 'Admin\LogController@revisarLogfecha']);
  
  /*Modulo de contabilidad*/
  Route::resource('/tipocuenta', 'Admin\\tipocuentaController');
  Route::resource('/clase', 'Admin\\claseController');
  Route::resource('/grupo', 'Admin\\GrupoController');
  Route::resource('/cuenta', 'Admin\\CuentaController');
  Route::resource('/subcuenta', 'Admin\\subcuentaController');
  Route::resource('/auxiliar', 'Admin\\auxiliarController');
  Route::resource('/subauxiliar', 'Admin\\subauxiliarController');
  Route::get('/extraercontadorclases/','ComponentController@extraercantidadclases');
  Route::get('/extraercontadorgrupos/','ComponentController@extraercantidadgrupos');
  Route::get('/extraercontadorcuentas/','ComponentController@extraercontadorcuentas');
  Route::get('/extraercontadorcuentasvarias/','ComponentController@extraercontadorcuentasvarias');
  Route::get('/extraercontadorsubcuentas/','ComponentController@extraercontadorsubcuentas');
  Route::get('/extraercontadorsubcuentasvarias/','ComponentController@extraercontadorsubcuentasvarias');
  Route::get('/extraercontadorauxcuentas/','ComponentController@extraercontadorauxcuentas');
  Route::get('/extraercontadorsubauxcuentas/','ComponentController@extraercontadorsubauxcuentas');
  Route::get('/vercuentas/','ComponentController@vercuentas');
  Route::get('/variassubctas','Admin\\subcuentaController@variassubctas');
  Route::get('/variasaux','Admin\\auxiliarController@variasaux');
  Route::get('/variasSubAux','Admin\\subauxiliarController@variasSubaux');  
  Route::resource('/tempsubcta', 'Admin\\TempsubctaController');
  Route::get('/listsubcuentas/', 'ComponentController@listaSubcuentas');  
  Route::post('/savesubcuenta/', 'ComponentController@savesubcuenta');
  Route::post('/trashSubcuentas/','ComponentController@trashSubcuentas');
  Route::get('/guardarsubcuentas/','ComponentController@guardarsubcuentas');
  Route::post('/saveauxcuenta/', 'ComponentController@saveauxcuenta');
  Route::get('/listauxcuentas/', 'ComponentController@listaAuxcuentas'); 
  Route::post('/trashAuxcuentas/','ComponentController@trashAuxcuentas');
  Route::get('/guardarAuxCuentas/','ComponentController@guardarAuxCuentas');
  Route::post('/savesubauxcuenta/', 'ComponentController@savesubauxcuenta');
  Route::get('/listsubauxcuentas/', 'ComponentController@listsubauxcuentas'); 
  Route::post('/trashSubAuxcuentas/','ComponentController@trashSubAuxcuentas');
  Route::get('/guardarSubAuxCuentas/','ComponentController@guardarSubAuxCuentas');
  Route::resource('/plan', 'Admin\\PlanController');
  Route::get('/plan/downloadExcel/{type}', 'Admin\\PlanController@downloadExcel');
  Route::resource('/confcontbl', 'Admin\\ConfcontblController');
  Route::resource('/contabilidad', 'Admin\\ContabilidadController');
  Route::resource('admin/num_asiento', 'Admin\\num_asientoController');
  Route::resource('admin/detall_asiento', 'Admin\\detall_asientoController');
  Route::get('/balanceinicial/', 'Admin\\ContabilidadController@balanceinicial');
  Route::get('/balanceinicial/createBalanceInicial', 'Admin\\ContabilidadController@createBalanceInicial');
  Route::get('/listtrs/', 'ComponentController@listaTrs');  
  Route::post('/saveAsiento/', 'ComponentController@saveAsiento');
  Route::post('/trashBalanceInicial/','ComponentController@trashBalanceInicial');
  Route::post('/delete_trs_blini/','ComponentController@delete_trs_blini');
  Route::get('/sumBIni/', 'ComponentController@sumBIni');  
  Route::get('/saveBInicial/', 'Admin\\ContabilidadController@storeBalanceInicial');    
  Route::get('/DetalleAsiento/{id}', ['as' => 'detallAsiento', 'uses' => 'Admin\\ContabilidadController@detallAsiento']);
  Route::get('/balanceinicial/editBalanceInicial/{id}/edit', 'Admin\\ContabilidadController@editBalanceInicial');
  Route::get('/listtrsEdit/', 'ComponentController@listaTrsEdit');  
  Route::get('/DetsumBIni/', 'ComponentController@DetsumBIni');  
  Route::post('/trashBalanceInicialDetall/','ComponentController@trashBalanceInicialDetall');
  Route::post('/delete_trs_blinidetall/','ComponentController@delete_trs_blinidetall');
  Route::get('/vertrs/','ComponentController@vertrs');
  Route::post('/saveAsientoEdit/', 'ComponentController@saveAsientoEdit');
  Route::post('/saveAsientoAdd/', 'ComponentController@saveAsientoAdd');
  Route::get('/saveBInicialEdit/', 'Admin\\ContabilidadController@updateBalanceInicial');
  //Libro
  Route::get('/libro/', 'Admin\\ContabilidadController@libro');
  Route::get('/libro/createAsiento', 'Admin\\ContabilidadController@createAsiento');
  Route::get('/sumSaldoAsiento/', 'ComponentController@sumSaldoAsiento');  
  Route::get('/saveAsiento/', 'Admin\\ContabilidadController@storeAsiento');    
  Route::get('/editarAsiento/','ComponentController@verAsiento');
  Route::get('/sumSaldoAsientoDetall/', 'ComponentController@sumSaldoAsientoDetall');  
  Route::get('/libro/editarAsiento/{id}', 'Admin\\ContabilidadController@editarAsiento');
  Route::get('/libro/verAsiento/{id}', 'Admin\\ContabilidadController@verAsiento');
  Route::get('/Edit_detall/', 'ComponentController@Edit_detall');   
  Route::get('/DetsumAs/', 'ComponentController@DetsumAs');  
  Route::get('/saveUpAsiento/', 'Admin\\ContabilidadController@upAsiento');
  Route::get('/verDetallAsiento/','ComponentController@verDetallAsiento');
  Route::get('/verAsiento/','ComponentController@verAsiento');  
  Route::get('/ver_detall/', 'ComponentController@ver_detall');  
  //Mayor
  Route::get('mayor/', 'Admin\\ContabilidadController@mayor');
  Route::get('situacionfinanciera/', 'Admin\\ContabilidadController@situacionfinanciera');

});


Route::group(['prefix' => 'person'], function () {
  Route::get('/inicio', 'Person\\InicioController@index');
  Route::get('/login', 'PersonAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'PersonAuth\LoginController@login');
  Route::post('/logout', 'PersonAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'PersonAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'PersonAuth\RegisterController@register');

  Route::post('/password/email', 'PersonAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'PersonAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'PersonAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'PersonAuth\ResetPasswordController@showResetForm');
  Route::resource('/venta', 'Person\\VentaController');
  Route::get('/extraerdatoscli/','Person\\VentaController@extraerdatoscliente');
  Route::post('/getClienteId/', 'ComponentController@getcliente');
  Route::post('/savecli/', 'ComponentController@savecliente');
  Route::post('/saveprod/', 'ComponentController@saveproducto');
  Route::get('/listcartitems/', 'ComponentController@listallitemsPerson');
  Route::post('/trashItem/','ComponentController@trashItem');
  Route::post('/deleteItem/','ComponentController@deleteItem');
  Route::get('/DetalleVenta/{id}', ['as' => 'detallventa', 'uses' => 'Person\\VentaController@detallventa']);
  Route::get('/print/{id}', 'Person\\VentaController@print');
  Route::get('/viewfactura/{id}', 'Person\\VentaController@viewfactura');
  Route::resource('/cliente', 'Person\\ClienteController');
  Route::resource('/product', 'Person\\ProductController');
  Route::post('/product/importexcelProducts', 'Person\\ProductController@importExcelProducts');
  Route::resource('/proveedor', 'Person\\ProveedorController');
  Route::resource('/iva', 'Person\\IvaController');
  Route::resource('/marca', 'Person\\MarcaController');
  Route::resource('/category', 'Person\\CategoryController');
  Route::resource('/subcategory', 'Person\\SubcategoryController');
  
  Route::post('/proveedor/importexcelProveedor', 'Person\\ProveedorController@importExcelProveedor');
  Route::get('/proveedor/downloadExcel/{type}', 'Person\\ProveedorController@downloadExcel');
  Route::get('proveedor/getcanton/{id}', 'ComponentController@getCanton');
  Route::get('proveedor/{var}/getcanton/{id}', 'ComponentController@getCanton');
  /*Modulo de inventario admin*/
  Route::resource('/inventario', 'Person\\InventarioController');
  Route::get('/inventario/ingresos/{dato}', 'Person\\InventarioController@ingresos');  
  Route::get('/inventario/egresos/{dato}', 'Person\\InventarioController@egresos');  
  Route::post('/inventario/bymonthingre', 'Person\\InventarioController@bymonthingre');
  Route::post('/inventario/byrangoingre', 'Person\\InventarioController@byrangoingre');
  Route::post('/inventario/bymonthegre', 'Person\\InventarioController@bymonthegre');
  Route::post('/inventario/byrangoegre', 'Person\\InventarioController@byrangoegre');
  Route::post('/inventario/bymonthinv', 'Person\\InventarioController@inventariobymonth');
  Route::get('/inventario/downloadExcel/{type}/{year}/', 'Person\\InventarioController@downloadExcelYearInv');
  Route::get('/inventario/downloadExcel/{type}/{year}/{month}/', 'Person\\InventarioController@downloadExcelMonthInv');

  Route::get('/inventario/downloadExcelingresos/{type}/{year}/', 'Person\\InventarioController@downloadExcelYearInvIngresos');
  Route::get('/inventario/downloadExcelingresos/{type}/{year}/{month}/', 'Person\\InventarioController@downloadExcelMonthInvIngresos');
  Route::get('/inventario/downloadExcelingresos/{type}/{year}/{month}/{rangostart}/{rangofinish}', 'Person\\InventarioController@downloadExcelMonthInvIngresosRangos');

  Route::get('/inventario/downloadExcelEgresos/{type}/{year}/','Person\\InventarioController@downloadExcelYearInvEgresos');
  Route::get('/inventario/downloadExcelEgresos/{type}/{year}/{month}/','Person\\InventarioController@downloadExcelMonthInvEgresos');
  Route::get('/inventario/downloadExcelEgresos/{type}/{year}/{month}/{rangostart}/{rangofinish}', 'Person\\InventarioController@downloadExcelMonthInvEgresosRangos');

  Route::resource('/almacen', 'Person\\AlmaceController');


  Route::get('/listclientes/', 'ComponentController@listallClientes');

});
  Route::get('getSubcategory/{id}', 'ComponentController@getSubcategory');

//copiado category y subcategory (carpetas) Realizar la revicion de controladores
Route::resource('admin/tempauxcta', 'Admin\\TempauxctaController');
Route::resource('admin/tempsubauxcta', 'Admin\\TempsubauxctaController');



  Route::get('getcanton/{id}', 'ComponentController@getCanton');
  Route::get('{var}/getcanton/{id}', 'ComponentController@getCanton');