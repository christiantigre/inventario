<?php

use Illuminate\Database\Seeder;
use App\clase as Clase;

class ClasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Clase::create( [
            'id'=>1,
            'clase'=>'ACTIVO',
            'codigo'=>'1',
            'detall'=>'ACTIVO',
            'activo'=>1,
            'created_at'=>'2018-01-22 23:05:11',
            'updated_at'=>'2018-01-22 23:05:11'
        ] );
        
        Clase::create( [
            'id'=>2,
            'clase'=>'PASIVO',
            'codigo'=>'2',
            'detall'=>'PASIVO',
            'activo'=>1,
            'created_at'=>'2018-01-22 23:05:37',
            'updated_at'=>'2018-01-22 23:05:37'
        ] );
        
        Clase::create( [
            'id'=>3,
            'clase'=>'PATRIMONIO',
            'codigo'=>'3',
            'detall'=>'PATRIMONIO',
            'activo'=>1,
            'created_at'=>'2018-01-22 23:06:07',
            'updated_at'=>'2018-01-22 23:06:07'
        ] );
        
        Clase::create( [
            'id'=>4,
            'clase'=>'INGRESOS',
            'codigo'=>'4',
            'detall'=>'INGRESOS',
            'activo'=>1,
            'created_at'=>'2018-01-22 23:06:57',
            'updated_at'=>'2018-01-22 23:06:57'
        ] );
        
        Clase::create( [
            'id'=>5,
            'clase'=>'COSTOS',
            'codigo'=>'5',
            'detall'=>'COSTOS',
            'activo'=>1,
            'created_at'=>'2018-01-22 23:07:29',
            'updated_at'=>'2018-01-24 15:30:41'
        ] );
    }
}
