<?php

use Illuminate\Database\Seeder;
use App\Grupo;

class GruposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	

        
        Grupo::create( [
            'id'=>1,
            'grupo'=>'ACTIVO CORRIENTE',
            'secuencia'=>'1',
            'codigo'=>'1.1',
            'detall'=>'ACTIVO CORRIENTE',
            'activo'=>1,
            'clase_id'=>1,
            'created_at'=>'2018-01-23 05:35:25',
            'updated_at'=>'2018-01-23 05:35:25'
        ] );


        
        Grupo::create( [
            'id'=>2,
            'grupo'=>'ACTIVO NO CORRIENTE',
            'secuencia'=>'2',
            'codigo'=>'1.2',
            'detall'=>'ACTIVO CORRIENTE',
            'activo'=>1,
            'clase_id'=>1,
            'created_at'=>'2018-01-23 05:35:38',
            'updated_at'=>'2018-01-23 05:35:38'
        ] );


        
        Grupo::create( [
            'id'=>3,
            'grupo'=>'PASIVO CORRIENTE',
            'secuencia'=>'1',
            'codigo'=>'2.1',
            'detall'=>'PASIVO CORRIENTE',
            'activo'=>1,
            'clase_id'=>2,
            'created_at'=>'2018-01-23 05:35:55',
            'updated_at'=>'2018-01-23 05:35:55'
        ] );


        
        Grupo::create( [
            'id'=>4,
            'grupo'=>'PASIVO NO CORRIENTE',
            'secuencia'=>'2',
            'codigo'=>'2.2',
            'detall'=>'ACTIVO CORRIENTE',
            'activo'=>1,
            'clase_id'=>2,
            'created_at'=>'2018-01-23 05:36:07',
            'updated_at'=>'2018-01-23 05:36:07'
        ] );


        
        Grupo::create( [
            'id'=>5,
            'grupo'=>'CAPITAL',
            'secuencia'=>'1',
            'codigo'=>'3.1',
            'detall'=>'CAPITAL',
            'activo'=>1,
            'clase_id'=>3,
            'created_at'=>'2018-01-23 05:36:27',
            'updated_at'=>'2018-01-24 14:09:12'
        ] );


        
        Grupo::create( [
            'id'=>6,
            'grupo'=>'INGRESOS OPERATIVOS',
            'secuencia'=>'1',
            'codigo'=>'4.1',
            'detall'=>'INGRESOS OPERATIVOS',
            'activo'=>1,
            'clase_id'=>4,
            'created_at'=>'2018-01-23 05:36:43',
            'updated_at'=>'2018-01-23 05:36:43'
        ] );


        
        Grupo::create( [
            'id'=>7,
            'grupo'=>'INGRESOS NO OPERATIVOS',
            'secuencia'=>'2',
            'codigo'=>'4.2',
            'detall'=>'INGRESOS NO OPERATIVOS',
            'activo'=>1,
            'clase_id'=>4,
            'created_at'=>'2018-01-23 05:36:53',
            'updated_at'=>'2018-01-23 05:37:14'
        ] );


        
        Grupo::create( [
            'id'=>8,
            'grupo'=>'COSTO DE VENTAS',
            'secuencia'=>'1',
            'codigo'=>'5.1',
            'detall'=>'COSTO DE VENTAS',
            'activo'=>1,
            'clase_id'=>5,
            'created_at'=>'2018-01-23 05:37:28',
            'updated_at'=>'2018-01-24 15:31:19'
        ] );


        
        Grupo::create( [
            'id'=>9,
            'grupo'=>'GASTOS',
            'secuencia'=>'2',
            'codigo'=>'5.2',
            'detall'=>'GASTOS',
            'activo'=>1,
            'clase_id'=>5,
            'created_at'=>'2018-01-23 05:37:40',
            'updated_at'=>'2018-01-24 15:31:41'
        ] );


        
        Grupo::create( [
            'id'=>10,
            'grupo'=>'OTROS ACTIVOS',
            'secuencia'=>'3',
            'codigo'=>'1.3',
            'detall'=>'OTROS ACTIVOS',
            'activo'=>1,
            'clase_id'=>1,
            'created_at'=>'2018-01-24 14:05:54',
            'updated_at'=>'2018-01-24 14:05:54'
        ] );


        
        Grupo::create( [
            'id'=>11,
            'grupo'=>'RESERVAS',
            'secuencia'=>'2',
            'codigo'=>'3.2',
            'detall'=>'RESERVAS',
            'activo'=>1,
            'clase_id'=>3,
            'created_at'=>'2018-01-24 14:09:35',
            'updated_at'=>'2018-01-24 14:09:35'
        ] );


        
        Grupo::create( [
            'id'=>12,
            'grupo'=>'SUPERAVITS',
            'secuencia'=>'3',
            'codigo'=>'3.3',
            'detall'=>'SUPERAVITS',
            'activo'=>1,
            'clase_id'=>3,
            'created_at'=>'2018-01-24 14:10:13',
            'updated_at'=>'2018-01-24 14:10:13'
        ] );


        
        Grupo::create( [
            'id'=>13,
            'grupo'=>'RESULTADOS',
            'secuencia'=>'4',
            'codigo'=>'3.4',
            'detall'=>'RESULTADOS',
            'activo'=>1,
            'clase_id'=>3,
            'created_at'=>'2018-01-24 14:10:25',
            'updated_at'=>'2018-01-24 14:10:25'
        ] );


    }
}
