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
  Route::resource('/almacen', 'Admin\\AlmacenController')->middleware('admin');
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
  Route::get('mayor/detallecuenta/{cuenta}', 'Admin\\ContabilidadController@mayordetallecuenta');  
  Route::get('balancecomprobacion/', 'Admin\\ContabilidadController@balancecomprobacion');
  Route::get('estadoresultados/', 'Admin\\ContabilidadController@estadoresultados');

  //backups
  Route::resource('/backups', 'Admin\\BackupController'); 
  Route::post('/backups/db', 'Admin\\BackupController@storedb');
  Route::get('/backup/download/{file_name?}', 'Admin\\BackupController@download');
  Route::get('/backup/delete/{file}/{file_name?}', 'Admin\\BackupController@delete');

  //perfil
  Route::resource('/settings', 'Admin\\PerfilController'); 
  //usuarios
  Route::resource('/people', 'Admin\\PeopleController'); 
  Route::get('/extraergrupo/','ComponentController@extraergrupo');
  //Test
  Route::get('/codcuenta/{cod}', 'Admin\\TestController@index');
  //Perdidas y Ganancias
  Route::get('/cuentasperdidasganancias/createcuentaspyg','Admin\\ConfcontblController@crearperdidadyganancias');
  Route::post('/creaperdidadyganancias', 'Admin\\ConfcontblController@storeperdidadyganancias');
  Route::get('/cuentaperdidasyganancias/{id}/edit','Admin\\ConfcontblController@editperdidadyganancias');
  Route::post('/upcreaperdidadyganancias/{id}', 'Admin\\ConfcontblController@updateperdidadyganancias');
  Route::post('/deletecuentaperdidasyganancias/{id}', 'Admin\\ConfcontblController@destroy');
  //Perdidas y Ganancias
  Route::get('perdidasyganancias/', 'Admin\\ContabilidadController@perdidasyganancias');
  //facturacion-electronica
  Route::resource('/facturacion-electronica', 'Admin\\FacturacionElectronicaController');

  Route::resource('/descuento', 'Admin\\DescuentoController');
  Route::resource('/moneda', 'Admin\\MonedaController');

  Route::resource('/entrega', 'Admin\\EntregaController');
  //Realizar controlador para mostrar las facturas y sus estados
  //Route::resource('/facturacion', 'Admin\\VentaController@verfacturas');
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

  //Route::get('//', 'ComponentController@listallitemsProv');
  Route::get('/listprovtitems/', 'ComponentController@listallitemsProv');
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

  Route::resource('/almacen', 'Person\\AlmaceController')->middleware('person');


  Route::get('/listclientes/', 'ComponentController@listallClientes');
  Route::get('/extraerdatosprov/','ComponentController@extraerdatosProv');
  //perfil
  Route::resource('/settings', 'Person\\PerfilController'); 
  Route::get('/settings/{id}/editcredentials/', 'Person\\PerfilController@editcredentials');
  Route::post('/settings/updatecredentials/{id}', 'Person\\PerfilController@updatecredentials');

  //Pruebas creando xml factura pasandole el id de la venta realizada
  
  Route::get('/generar/{id}', ['as' => 'generar', 'uses' => 'Person\\VentaController@genera']);
  Route::get('/generarClaveAcceso/{id}', ['as' => 'generarClaveAcceso', 'uses' => 'Person\\VentaController@generaclaveacceso']);
  Route::get('/generarFacturaXml/{id}', ['as' => 'generarFacturaXml', 'uses' => 'Person\\VentaController@generarFacturaXml']);
  Route::get('/firmarfactura/{id}', ['as' => 'generar', 'uses' => 'Person\\VentaController@firmarFactura']);
  Route::get('/autorizarfactura/{id}', ['as' => 'autorizarfactura', 'uses' => 'Person\\VentaController@autorizar']);
  Route::get('/revisarxml/{id}', ['as' => 'revisarxml', 'uses' => 'Person\\VentaController@revisarXml']);
  Route::get('/generarpdf/{id}', ['as' => 'generarpdf', 'uses' => 'Person\\VentaController@generaPdf']);
  Route::get('/procesosfacturacion/{id}', ['as' => 'procesosfacturacion', 'uses' => 'Person\\VentaController@procesosfacturacion']);
  Route::resource('facturacion', 'Person\\FacturacionController'); 
  Route::get('/enviarcomprobantes/{id}', ['as' => 'enviarcomprobantes', 'uses' => 'Person\\VentaController@sendEmail']);

  Route::get('/f_generafactura/{id}', ['as' => 'f_generafactura', 'uses' => 'Person\\VentaController@generafactura']);
  Route::get('/f_firmarfactura/{id}', ['as' => 'f_firmarfactura', 'uses' => 'Person\\VentaController@f_firmafactura']);
  Route::get('/f_autorizarfactura/{id}', ['as' => 'f_autorizarfactura', 'uses' => 'Person\\VentaController@f_autorizarfactura']);
  Route::get('/f_generarpdf/{id}', ['as' => 'f_generarpdf', 'uses' => 'Person\\VentaController@f_generarpdf']);
  Route::get('/f_enviarcomprobantes/{id}', ['as' => 'f_enviarcomprobantes', 'uses' => 'Person\\VentaController@f_sendEmail']);

  Route::get('/return_generafactura/{id}', ['as' => 'return_generafactura', 'uses' => 'Person\\VentaController@return_generafactura']);
  Route::get('/return_firmarfactura/{id}', ['as' => 'return_firmarfactura', 'uses' => 'Person\\VentaController@return_firmafactura']);
  Route::get('/return_autorizarfactura/{id}', ['as' => 'return_autorizarfactura', 'uses' => 'Person\\VentaController@return_autorizarfactura']);
  Route::get('/return_generarpdf/{id}', ['as' => 'return_generarpdf', 'uses' => 'Person\\VentaController@return_generarpdf']);
  Route::get('/return_enviarcomprobantes/{id}', ['as' => 'return_enviarcomprobantes', 'uses' => 'Person\\VentaController@return_sendEmail']);
});

  Route::get('getSubcategory/{id}', 'ComponentController@getSubcategory');

  //copiado category y subcategory (carpetas) Realizar la revicion de controladores
  Route::resource('admin/tempauxcta', 'Admin\\TempauxctaController');
  Route::resource('admin/tempsubauxcta', 'Admin\\TempsubauxctaController');



  Route::get('getcanton/{id}', 'ComponentController@getCanton');
  Route::get('{var}/getcanton/{id}', 'ComponentController@getCanton');

  Route::get('solicitarAutorizacion', function(){
    //$comprobante = new \App\Comprobante_venta();
    //$job = new \App\Jobs\solicitarAutorizacion($comprobante);
    $job = new \App\Jobs\solicitarAutorizacion();
    dispatch($job);
  }
  );

  Route::get('productos','DataTables\\ProductosDatatablesController@getIndex');
  Route::get('/anyDataProd','DataTables\\ProductosDatatablesController@anyDataProd')->name('prod.data');

  Route::get('clientes','DataTables\\ClientesDatatablesController@getIndex');
  Route::get('/anyDataCli','DataTables\\ClientesDatatablesController@anyDataCli')->name('cli.data');

  Route::get('proveedores','DataTables\\ProveedoresDatatablesController@getIndex');
  Route::get('/anyDataPro','DataTables\\ProveedoresDatatablesController@anyDataPro')->name('prov.data');