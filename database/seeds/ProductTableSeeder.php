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
            'cantidad'=>290,
            'fecha_ingreso'=>'2018-01-10',
            'compras'=>300,
            'ventas'=>0,
            'imagen'=>'uploads/product/69655.pernos6x20.jpg',
            'name_img'=>'69655.pernos6x20.jpg',
            'nuevo'=>1,
            'promo'=>1,
            'catalogo'=>1,
            'activo'=>1,
            'id_category'=>1,
            'id_subcategory'=>1,
            'created_at'=>'2018-03-14 21:55:49',
            'updated_at'=>'2018-03-14 22:19:01'
        ] );
        
        Product::create( [
            'id'=>2,
            'producto'=>'Seguros Guardachoque Delantero',
            'cod_barra'=>'100234',
            'pre_compra'=>0.75,
            'pre_venta'=>1.95,
            'cantidad'=>214,
            'fecha_ingreso'=>'2018-02-10',
            'compras'=>300,
            'ventas'=>0,
            'imagen'=>'uploads/product/52249.soporteguardachoque.jpg',
            'name_img'=>'52249.soporteguardachoque.jpg',
            'nuevo'=>1,
            'promo'=>1,
            'catalogo'=>1,
            'activo'=>1,
            'id_category'=>1,
            'id_subcategory'=>1,
            'created_at'=>'2018-03-14 21:55:49',
            'updated_at'=>'2018-03-15 15:30:13'
        ] );
        
        Product::create( [
            'id'=>3,
            'producto'=>'Tuercas metal 9mm',
            'cod_barra'=>'875987',
            'pre_compra'=>0.7,
            'pre_venta'=>0.15,
            'cantidad'=>300,
            'fecha_ingreso'=>'2018-03-10',
            'compras'=>300,
            'ventas'=>0,
            'imagen'=>'uploads/product/82937.tuercas.jpg',
            'name_img'=>'82937.tuercas.jpg',
            'nuevo'=>1,
            'promo'=>1,
            'catalogo'=>1,
            'activo'=>1,
            'id_category'=>1,
            'id_subcategory'=>1,
            'created_at'=>'2018-03-14 21:55:49',
            'updated_at'=>'2018-03-14 21:55:49'
        ] );
        
        Product::create( [
            'id'=>4,
            'producto'=>'Tuercas con perno metal 15mm',
            'cod_barra'=>'875986',
            'pre_compra'=>0.7,
            'pre_venta'=>0.3,
            'cantidad'=>300,
            'fecha_ingreso'=>'2018-01-10',
            'compras'=>300,
            'ventas'=>0,
            'imagen'=>'uploads/product/82937.tuercas.jpg',
            'name_img'=>'82937.tuercas.jpg',
            'nuevo'=>1,
            'promo'=>1,
            'catalogo'=>1,
            'activo'=>1,
            'id_category'=>1,
            'id_subcategory'=>1,
            'created_at'=>'2018-03-14 21:55:49',
            'updated_at'=>'2018-03-14 21:55:49'
        ] );
        
        Product::create( [
            'id'=>5,
            'producto'=>'Silicon color negro',
            'cod_barra'=>'875985',
            'pre_compra'=>1.5,
            'pre_venta'=>3.3,
            'cantidad'=>300,
            'fecha_ingreso'=>'2018-01-10',
            'compras'=>300,
            'ventas'=>0,
            'imagen'=>'uploads/product/82937.tuercas.jpg',
            'name_img'=>'82937.tuercas.jpg',
            'nuevo'=>1,
            'promo'=>1,
            'catalogo'=>1,
            'activo'=>1,
            'id_category'=>1,
            'id_subcategory'=>1,
            'created_at'=>'2018-03-14 21:55:49',
            'updated_at'=>'2018-03-14 21:55:49'
        ] );
        
        Product::create( [
            'id'=>6,
            'producto'=>'Silicon color blanco',
            'cod_barra'=>'875984',
            'pre_compra'=>25,
            'pre_venta'=>30,
            'cantidad'=>300,
            'fecha_ingreso'=>'2018-03-15',
            'compras'=>300,
            'ventas'=>0,
            'imagen'=>'uploads/product/82937.tuercas.jpg',
            'name_img'=>'82937.tuercas.jpg',
            'nuevo'=>1,
            'promo'=>1,
            'catalogo'=>1,
            'activo'=>1,
            'id_category'=>1,
            'id_subcategory'=>1,
            'created_at'=>'2018-03-14 21:55:49',
            'updated_at'=>'2018-03-15 15:55:11'
        ] );
        
        Product::create( [
            'id'=>7,
            'producto'=>'Seguros del tapisado color plomo',
            'cod_barra'=>'875983',
            'pre_compra'=>1.5,
            'pre_venta'=>3.3,
            'cantidad'=>300,
            'fecha_ingreso'=>'2018-02-10',
            'compras'=>300,
            'ventas'=>0,
            'imagen'=>'uploads/product/82937.tuercas.jpg',
            'name_img'=>'82937.tuercas.jpg',
            'nuevo'=>1,
            'promo'=>1,
            'catalogo'=>1,
            'activo'=>1,
            'id_category'=>1,
            'id_subcategory'=>1,
            'created_at'=>'2018-03-14 21:55:49',
            'updated_at'=>'2018-03-14 21:55:49'
        ] );
        
        Product::create( [
            'id'=>8,
            'producto'=>'Visagras puerta forza 1',
            'cod_barra'=>'875982',
            'pre_compra'=>7.5,
            'pre_venta'=>15.5,
            'cantidad'=>300,
            'fecha_ingreso'=>'2018-06-10',
            'compras'=>300,
            'ventas'=>0,
            'imagen'=>'uploads/product/82937.tuercas.jpg',
            'name_img'=>'82937.tuercas.jpg',
            'nuevo'=>1,
            'promo'=>1,
            'catalogo'=>1,
            'activo'=>1,
            'id_category'=>1,
            'id_subcategory'=>1,
            'created_at'=>'2018-03-14 21:55:49',
            'updated_at'=>'2018-03-14 21:55:49'
        ] );
        
        Product::create( [
            'id'=>9,
            'producto'=>'Faro esq suzuki forza 2',
            'cod_barra'=>'909090',
            'pre_compra'=>6,
            'pre_venta'=>7.59,
            'cantidad'=>15,
            'fecha_ingreso'=>'2018-03-15',
            'compras'=>15,
            'ventas'=>0,
            'nuevo'=>1,
            'promo'=>1,
            'catalogo'=>1,
            'activo'=>1,
            'id_category'=>1,
            'id_subcategory'=>1,
            'created_at'=>'2018-03-15 16:03:43',
            'updated_at'=>'2018-03-15 16:03:43'
        ] );
        
        Product::create( [
            'id'=>10,
            'producto'=>'cinta led 1/2 metro',
            'cod_barra'=>'767677',
            'pre_compra'=>1,
            'pre_venta'=>2.68,
            'cantidad'=>4,
            'fecha_ingreso'=>'2018-03-15',
            'compras'=>5,
            'ventas'=>0,
            'nuevo'=>1,
            'promo'=>1,
            'catalogo'=>1,
            'activo'=>1,
            'id_category'=>1,
            'id_subcategory'=>1,
            'created_at'=>'2018-03-15 16:18:24',
            'updated_at'=>'2018-03-15 16:22:36'
        ] );
        
        Product::create( [
            'id'=>11,
            'producto'=>'Simoniz grande',
            'cod_barra'=>'7777777777',
            'pre_compra'=>3,
            'pre_venta'=>4.46,
            'cantidad'=>14,
            'fecha_ingreso'=>'2018-03-15',
            'compras'=>15,
            'ventas'=>0,
            'nuevo'=>1,
            'promo'=>1,
            'catalogo'=>1,
            'activo'=>1,
            'id_category'=>1,
            'id_subcategory'=>1,
            'created_at'=>'2018-03-15 16:19:20',
            'updated_at'=>'2018-03-15 16:22:36'
        ] );
        

    }
}
