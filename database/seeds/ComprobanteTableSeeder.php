<?php

use Illuminate\Database\Seeder;
use App\FacturacionElectronica;

class ComprobanteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Facturacionelectronica::create( [
    		'obligado_contabilidad'=>0,
    		'path_certificado'=>'C:\\xampp\\htdocs\\inventario\\public\\archivos/certificado/christian_andres_tigre_condo.p12',
    		'clave_certificado'=>'Christian0105',
            'modo_ambiente'=>1,
    		'tipo_emision'=>1,
    		'generar_facturas'=>1,
    		'id_almacen'=>1
    	] );
    	
    }
}
