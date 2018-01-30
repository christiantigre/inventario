<?php

use Illuminate\Database\Seeder;
use App\Subcategory;

class SucategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
    	Subcategory::create( [
    		'id'=>1,
    		'subcategory'=>'n/n',
    		'content'=>'No Registrado',
    		'active'=>1,
    		'category_id'=>1,
    		'created_at'=>'2018-01-29 19:40:27',
    		'updated_at'=>'2018-01-29 19:44:54',
    		'deleted_at'=>NULL
    	] );
    	
    	Subcategory::create( [
    		'id'=>2,
    		'subcategory'=>'Franelas',
    		'content'=>NULL,
    		'active'=>1,
    		'category_id'=>7,
    		'created_at'=>'2018-01-29 19:40:27',
    		'updated_at'=>'2018-01-29 19:45:22',
    		'deleted_at'=>NULL
    	] );
    	
    	Subcategory::create( [
    		'id'=>3,
    		'subcategory'=>'Desarmadores',
    		'content'=>NULL,
    		'active'=>1,
    		'category_id'=>2,
    		'created_at'=>'2018-01-29 19:40:27',
    		'updated_at'=>'2018-01-29 19:46:00',
    		'deleted_at'=>NULL
    	] );
    	
    	Subcategory::create( [
    		'id'=>4,
    		'subcategory'=>'Playos',
    		'content'=>NULL,
    		'active'=>1,
    		'category_id'=>2,
    		'created_at'=>'2018-01-29 19:40:27',
    		'updated_at'=>'2018-01-29 19:46:34',
    		'deleted_at'=>NULL
    	] );
    	
    	Subcategory::create( [
    		'id'=>5,
    		'subcategory'=>'Seguros',
    		'content'=>NULL,
    		'active'=>1,
    		'category_id'=>4,
    		'created_at'=>'2018-01-29 19:40:28',
    		'updated_at'=>'2018-01-29 19:46:57',
    		'deleted_at'=>NULL
    	] );
    	
    	Subcategory::create( [
    		'id'=>6,
    		'subcategory'=>'Soportes',
    		'content'=>NULL,
    		'active'=>1,
    		'category_id'=>4,
    		'created_at'=>'2018-01-29 19:40:28',
    		'updated_at'=>'2018-01-29 19:48:37',
    		'deleted_at'=>NULL
    	] );
    	
    	Subcategory::create( [
    		'id'=>7,
    		'subcategory'=>'Manubrios',
    		'content'=>NULL,
    		'active'=>1,
    		'category_id'=>6,
    		'created_at'=>'2018-01-29 19:40:28',
    		'updated_at'=>'2018-01-29 19:49:23',
    		'deleted_at'=>NULL
    	] );
    	
    	Subcategory::create( [
    		'id'=>8,
    		'subcategory'=>'Retrovisores',
    		'content'=>NULL,
    		'active'=>1,
    		'category_id'=>6,
    		'created_at'=>'2018-01-29 19:40:28',
    		'updated_at'=>'2018-01-29 19:53:29',
    		'deleted_at'=>NULL
    	] );
    	
    	Subcategory::create( [
    		'id'=>9,
    		'subcategory'=>'Shampoo',
    		'content'=>NULL,
    		'active'=>1,
    		'category_id'=>7,
    		'created_at'=>'2018-01-29 20:20:30',
    		'updated_at'=>'2018-01-29 20:20:30',
    		'deleted_at'=>NULL
    	] );
    	
    	Subcategory::create( [
    		'id'=>10,
    		'subcategory'=>'Llaves acero templado',
    		'content'=>NULL,
    		'active'=>1,
    		'category_id'=>2,
    		'created_at'=>'2018-01-29 20:21:19',
    		'updated_at'=>'2018-01-29 20:21:19',
    		'deleted_at'=>NULL
    	] );
    	
    	Subcategory::create( [
    		'id'=>11,
    		'subcategory'=>'Carrocería',
    		'content'=>NULL,
    		'active'=>1,
    		'category_id'=>3,
    		'created_at'=>'2018-01-29 20:22:19',
    		'updated_at'=>'2018-01-29 20:22:19',
    		'deleted_at'=>NULL
    	] );
    	
    	Subcategory::create( [
    		'id'=>12,
    		'subcategory'=>'Compacto',
    		'content'=>NULL,
    		'active'=>1,
    		'category_id'=>3,
    		'created_at'=>'2018-01-29 20:22:46',
    		'updated_at'=>'2018-01-29 20:22:46',
    		'deleted_at'=>NULL
    	] );
    	
    	Subcategory::create( [
    		'id'=>13,
    		'subcategory'=>'Chasis',
    		'content'=>NULL,
    		'active'=>1,
    		'category_id'=>3,
    		'created_at'=>'2018-01-29 20:23:17',
    		'updated_at'=>'2018-01-29 20:23:17',
    		'deleted_at'=>NULL
    	] );
    	
    	Subcategory::create( [
    		'id'=>14,
    		'subcategory'=>'Guardafangos',
    		'content'=>NULL,
    		'active'=>1,
    		'category_id'=>3,
    		'created_at'=>'2018-01-29 20:27:42',
    		'updated_at'=>'2018-01-29 20:27:42',
    		'deleted_at'=>NULL
    	] );

    }
}
