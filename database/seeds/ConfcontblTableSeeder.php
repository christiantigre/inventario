<?php

use Illuminate\Database\Seeder;
use App\Confcont;

class ConfcontblTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Confcont::create( [
    		'id'=>1,
    		'generar_contabilidad'=>1,
    		'assauto_compras'=>1,
    		'assauto_ventas'=>1,
    		'assauto_pagos'=>1,
    		'assauto_gastos'=>1,
    		'assauto_costos'=>1,
    		'assauto_inversiones'=>1,
    		'assauto_cobros'=>1,
    		'assauto_sueldos'=>1,
    		'assauto_obligaciones'=>1,
    		'assauto_impuestos'=>1,
    		'assauto_servicios'=>1,
    		'assauto_creditos'=>1,
    		'almacen_id'=>1
    	] );
    }
}
