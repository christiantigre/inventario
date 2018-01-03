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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@index')->name('test');


Route::group(['prefix' => 'admin'], function () {
  Route::post('/product/importexcelProducts', 'Admin\\ProductController@importExcelProducts');
  Route::get('/product/downloadExcel/{type}', 'Admin\\ProductController@downloadExcel');
  Route::post('/proveedor/importexcelProveedor', 'Admin\\ProveedorController@importExcelProveedor');
  Route::get('/proveedor/downloadExcel/{type}', 'Admin\\ProveedorController@downloadExcel');
  Route::get('almacen/getcanton/{id}', 'ComponentController@getCanton');
  Route::get('almacen/{var}/getcanton/{id}', 'ComponentController@getCanton');
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
});


Route::group(['prefix' => 'person'], function () {
  Route::get('/login', 'PersonAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'PersonAuth\LoginController@login');
  Route::post('/logout', 'PersonAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'PersonAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'PersonAuth\RegisterController@register');

  Route::post('/password/email', 'PersonAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'PersonAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'PersonAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'PersonAuth\ResetPasswordController@showResetForm');
  Route::resource('/venta', 'Admin\\VentaController');
});
