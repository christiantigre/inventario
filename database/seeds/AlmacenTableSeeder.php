<?php

use Illuminate\Database\Seeder;
use App\Almacen;

class AlmacenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Almacen::create( [
    		'id'=>1,
    		'almacen'=>'PcSolutions',
    		'propietario'=>'Nombre Nombre Apellido Apellido',
    		'gerente'=>'Nombre Nombre Apellido Apellido',
    		'pag_web'=>'www.empresa.com',
    		'razon_social'=>'Nombre Nombre Apellido Apellido',
    		'ruc'=>'0101001101001',
    		'email'=>'mailempresa@gmail.com',
    		'fecha_inicio'=>'2015-12-01',
    		'activo'=>1,
    		'telefono'=>'2222-555',
    		'cel_movi'=>'0990990991',
    		'cel_claro'=>'0909090909',
    		'watsapp'=>'0990990991',
    		'funcion_empresa'=>'Empresa compra y venta de equipos informáticos, diseño y desarrollo de paginas web, mantenimiento y reparación de hardware.',
    		'dir'=>'Gualaceo, Jaime Roldos y Manuel Moreno.',
    		'pais_id'=>1,
    		'provincia_id'=>1,
    		'canton_id'=>3
    	] );

    }
}
