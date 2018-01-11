<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create( [
'id'=>1,
'producto'=>'perno 6 x 20',
'cod_barra'=>'620',
'pre_compra'=>0.18,
'pre_venta'=>0.25,
'compras'=>300,
'cantidad'=>300,
'imagen'=>'uploads/product/69655.pernos6x20.jpg',
'name_img'=>'69655.pernos6x20.jpg',
'nuevo'=>1,
'promo'=>1,
'catalogo'=>1,
'activo'=>1,
'id_category'=>1,
'id_subcategory'=>1,
'fecha_ingreso'=>"2018-01-10"
] );

			

Product::create( [
'id'=>2,
'producto'=>'Seguros Guardachoque Delantero',
'cod_barra'=>'100234',
'pre_compra'=>0.75,
'pre_venta'=>1.95,
'compras'=>300,
'cantidad'=>300,
'imagen'=>'uploads/product/52249.soporteguardachoque.jpg',
'name_img'=>'52249.soporteguardachoque.jpg',
'nuevo'=>1,
'promo'=>1,
'catalogo'=>1,
'activo'=>1,
'id_category'=>1,
'id_subcategory'=>1,
'fecha_ingreso'=>"2018-02-10"
] );

			

Product::create( [
'id'=>3,
'producto'=>'Tuercas metal 9mm',
'cod_barra'=>'875987',
'pre_compra'=>0.7,
'compras'=>300,
'pre_venta'=>0.15,
'cantidad'=>300,
'imagen'=>'uploads/product/82937.tuercas.jpg',
'name_img'=>'82937.tuercas.jpg',
'nuevo'=>1,
'promo'=>1,
'catalogo'=>1,
'activo'=>1,
'id_category'=>1,
'id_subcategory'=>1,
'fecha_ingreso'=>"2018-03-10"
] );


Product::create( [
'id'=>4,
'producto'=>'Tuercas con perno metal 15mm',
'cod_barra'=>'875986',
'pre_compra'=>0.7,
'pre_venta'=>0.30,
'compras'=>300,
'cantidad'=>300,
'imagen'=>'uploads/product/82937.tuercas.jpg',
'name_img'=>'82937.tuercas.jpg',
'nuevo'=>1,
'promo'=>1,
'catalogo'=>1,
'activo'=>1,
'id_category'=>1,
'id_subcategory'=>1,
'fecha_ingreso'=>"2018-01-10"
] );

Product::create( [
'id'=>5,
'producto'=>'Silicon color negro',
'cod_barra'=>'875985',
'pre_compra'=>1.50,
'pre_venta'=>3.30,
'compras'=>300,
'cantidad'=>300,
'imagen'=>'uploads/product/82937.tuercas.jpg',
'name_img'=>'82937.tuercas.jpg',
'nuevo'=>1,
'promo'=>1,
'catalogo'=>1,
'activo'=>1,
'id_category'=>1,
'id_subcategory'=>1,
'fecha_ingreso'=>"2018-01-10"
] );

Product::create( [
'id'=>6,
'producto'=>'Silicon color blanco',
'cod_barra'=>'875984',
'pre_compra'=>1.50,
'pre_venta'=>3.30,
'compras'=>300,
'cantidad'=>300,
'imagen'=>'uploads/product/82937.tuercas.jpg',
'name_img'=>'82937.tuercas.jpg',
'nuevo'=>1,
'promo'=>1,
'catalogo'=>1,
'activo'=>1,
'id_category'=>1,
'id_subcategory'=>1,
'fecha_ingreso'=>"2018-05-10"
] );


Product::create( [
'id'=>7,
'producto'=>'Seguros del tapisado color plomo',
'cod_barra'=>'875983',
'pre_compra'=>1.50,
'pre_venta'=>3.30,
'compras'=>300,
'cantidad'=>300,
'imagen'=>'uploads/product/82937.tuercas.jpg',
'name_img'=>'82937.tuercas.jpg',
'nuevo'=>1,
'promo'=>1,
'catalogo'=>1,
'activo'=>1,
'id_category'=>1,
'id_subcategory'=>1,
'fecha_ingreso'=>"2018-02-10"
] );

Product::create( [
'id'=>8,
'producto'=>'Visagras puerta forza 1',
'cod_barra'=>'875982',
'pre_compra'=>7.50,
'pre_venta'=>15.50,
'compras'=>300,
'cantidad'=>300,
'imagen'=>'uploads/product/82937.tuercas.jpg',
'name_img'=>'82937.tuercas.jpg',
'nuevo'=>1,
'promo'=>1,
'catalogo'=>1,
'activo'=>1,
'id_category'=>1,
'id_subcategory'=>1,
'fecha_ingreso'=>"2018-06-10"
] );
			

    }
}
