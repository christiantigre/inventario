<?php

use Illuminate\Database\Seeder;
use App\Marca;

class MarcaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Marca::create( [
    		'id'=>1,
    		'marca'=>'Kingstone',
    		'detall'=>NULL,
    		'img'=>'uploads/marca/41522.kingstone.png',
    		'name_img'=>'41522.kingstone.png',
    		'activo'=>1
    	] );

    	

    	Marca::create( [
    		'id'=>2,
    		'marca'=>'Samsung',
    		'detall'=>NULL,
    		'img'=>'uploads/marca/49050.samsung.jpg',
    		'name_img'=>'49050.samsung.jpg',
    		'activo'=>1
    	] );

    	

    	Marca::create( [
    		'id'=>3,
    		'marca'=>'Intel',
    		'detall'=>'Intel',
    		'img'=>'uploads/marca/64642.intel.png',
    		'name_img'=>'64642.intel.png',
    		'activo'=>1
    	] );

    	

    	Marca::create( [
    		'id'=>4,
    		'marca'=>'Hp',
    		'detall'=>'Hp',
    		'img'=>'uploads/marca/28987.hp.png',
    		'name_img'=>'28987.hp.png',
    		'activo'=>1
    	] );

    	

    	Marca::create( [
    		'id'=>5,
    		'marca'=>'WesternDigital',
    		'detall'=>'WesternDigital',
    		'img'=>'uploads/marca/46522.westernDigital.png',
    		'name_img'=>'46522.westernDigital.png',
    		'activo'=>1
    	] );
    }
}
