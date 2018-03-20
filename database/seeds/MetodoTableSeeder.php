<?php

use Illuminate\Database\Seeder;
use App\Entrega;

class MetodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Entrega::create( [
    		'id'=>1,
    		'created_at'=>'2018-03-14 13:43:23',
    		'updated_at'=>'2018-03-14 13:43:23',
    		'metodo'=>'Retiro Personal',
    		'detalle'=>'El Cliente retira el producto personalmente de la sucursal.',
    		'activo'=>1
    	] );
    	
    	Entrega::create( [
    		'id'=>2,
    		'created_at'=>'2018-03-14 14:02:47',
    		'updated_at'=>'2018-03-14 14:02:47',
    		'metodo'=>'Envío a domicilio',
    		'detalle'=>'Se realiza el envío del producto al domicilio del cliente.',
    		'activo'=>1
    	] );


    }
}
