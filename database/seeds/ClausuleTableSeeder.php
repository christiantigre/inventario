<?php

use Illuminate\Database\Seeder;
use App\Clausule;

class ClausuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Clausule::create( [
    		'id'=>1,
    		'documento'=>'FACTURA',
    		'pre_clausula'=>'ORIGINAL ADQUIRIENTE: Blanco Adquiriente / COPIA: Color Emisor (SUCURSAL).',
    		'clausula'=>'SALIDA LA MERCADERÍA NO SE ACEPTA DEVOLUCIONES.\r\nDesarrollo de aplicaciones administrativas para grandes, mediana y pequeñas empresas. PcSolutions. // Jaime Roldos y Manuel Moreno Telfn.:0992702599 - 0985288525 > RUC.: 0105118509001 > Correo.: andrescondo17@gmail.com',
    		'activo'=>1
    	] );
    }
}
