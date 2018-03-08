<?php

use Illuminate\Database\Seeder;
use App\Moneda;

class MonedaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Moneda::create( [
    		'id'=>1,
    		'moneda'=>'DOLAR',
    		'estado'=>1,
    		'created_at'=>'2018-03-06 21:07:56',
    		'updated_at'=>'2018-03-06 21:13:39'
    	] );


    	
    	Moneda::create( [
    		'id'=>2,
    		'moneda'=>'EUROS',
    		'estado'=>0,
    		'created_at'=>'2018-03-06 21:11:11',
    		'updated_at'=>'2018-03-06 21:12:57'
    	] );


    	
    	Moneda::create( [
    		'id'=>3,
    		'moneda'=>'PESOS',
    		'estado'=>0,
    		'created_at'=>'2018-03-06 21:11:17',
    		'updated_at'=>'2018-03-06 21:13:02'
    	] );


    	
    	Moneda::create( [
    		'id'=>4,
    		'moneda'=>'YEN',
    		'estado'=>0,
    		'created_at'=>'2018-03-06 21:11:22',
    		'updated_at'=>'2018-03-06 21:13:07'
    	] );


    	
    	Moneda::create( [
    		'id'=>5,
    		'moneda'=>'FRANCO',
    		'estado'=>0,
    		'created_at'=>'2018-03-06 21:11:29',
    		'updated_at'=>'2018-03-06 21:13:11'
    	] );


    	
    	Moneda::create( [
    		'id'=>6,
    		'moneda'=>'CORONA',
    		'estado'=>0,
    		'created_at'=>'2018-03-06 21:11:35',
    		'updated_at'=>'2018-03-06 21:13:16'
    	] );


    	
    	Moneda::create( [
    		'id'=>7,
    		'moneda'=>'RUBRO',
    		'estado'=>0,
    		'created_at'=>'2018-03-06 21:11:44',
    		'updated_at'=>'2018-03-06 21:13:21'
    	] );


    	
    	Moneda::create( [
    		'id'=>8,
    		'moneda'=>'COLÓN',
    		'estado'=>0,
    		'created_at'=>'2018-03-06 21:11:56',
    		'updated_at'=>'2018-03-06 21:13:26'
    	] );


    	
    	Moneda::create( [
    		'id'=>9,
    		'moneda'=>'QUETZAL',
    		'estado'=>0,
    		'created_at'=>'2018-03-06 21:12:15',
    		'updated_at'=>'2018-03-06 21:12:15'
    	] );


    	
    	Moneda::create( [
    		'id'=>10,
    		'moneda'=>'LEMPIRA',
    		'estado'=>0,
    		'created_at'=>'2018-03-06 21:12:24',
    		'updated_at'=>'2018-03-06 21:13:32'
    	] );


    	
    	Moneda::create( [
    		'id'=>11,
    		'moneda'=>'CÓRDOVA',
    		'estado'=>0,
    		'created_at'=>'2018-03-06 21:12:37',
    		'updated_at'=>'2018-03-06 21:12:37'
    	] );


    	
    	Moneda::create( [
    		'id'=>12,
    		'moneda'=>'BALBOA',
    		'estado'=>0,
    		'created_at'=>'2018-03-06 21:12:45',
    		'updated_at'=>'2018-03-06 21:12:45'
    	] );


    	
    	Moneda::create( [
    		'id'=>13,
    		'moneda'=>'KINA',
    		'estado'=>0,
    		'created_at'=>'2018-03-06 21:12:52',
    		'updated_at'=>'2018-03-06 21:12:52'
    	] );
    }
}
