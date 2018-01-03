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
'cantidad'=>30,
'imagen'=>'uploads/product/69655.pernos6x20.jpg',
'name_img'=>'69655.pernos6x20.jpg',
'nuevo'=>1,
'promo'=>1,
'catalogo'=>1,
'activo'=>1,
'id_category'=>1,
'id_subcategory'=>1
] );

			

Product::create( [
'id'=>2,
'producto'=>'Seguros Guardachoque Delantero',
'cod_barra'=>'100234',
'pre_compra'=>0.75,
'pre_venta'=>1.95,
'cantidad'=>50,
'imagen'=>'uploads/product/52249.soporteguardachoque.jpg',
'name_img'=>'52249.soporteguardachoque.jpg',
'nuevo'=>1,
'promo'=>1,
'catalogo'=>1,
'activo'=>1,
'id_category'=>1,
'id_subcategory'=>1
] );

			

Product::create( [
'id'=>3,
'producto'=>'Tuercas metal 9mm',
'cod_barra'=>'875987',
'pre_compra'=>0.7,
'pre_venta'=>0.15,
'cantidad'=>150,
'imagen'=>'uploads/product/82937.tuercas.jpg',
'name_img'=>'82937.tuercas.jpg',
'nuevo'=>1,
'promo'=>1,
'catalogo'=>1,
'activo'=>1,
'id_category'=>1,
'id_subcategory'=>1,
] );

			

Product::create( [
'id'=>4,
'producto'=>'perno 6 x 20',
'nuevo'=>1,
'promo'=>1,
'catalogo'=>1,
'activo'=>1,
] );
    }
}
