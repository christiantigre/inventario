<?php

use Illuminate\Database\Seeder;
use App\Cuentum as Cuenta;

class CuentaTbaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Cuenta::create( [
            'id'=>1,
            'cuenta'=>'EFECTIVO Y EQUIVALENTES AL EFECTIVO',
            'secuencia'=>'1',
            'codigo'=>'1.1.1',
            'detall'=>'EFECTIVO Y EQUIVALENTES AL EFECTIVO',
            'grupo'=>'1.1',
            'activo'=>1,
            'grupo_id'=>1,
            'created_at'=>'2018-01-24 14:47:15',
            'updated_at'=>'2018-01-24 14:47:15'
        ] );


        
        Cuenta::create( [
            'id'=>2,
            'cuenta'=>'EXIGIBLE',
            'secuencia'=>'2',
            'codigo'=>'1.1.2',
            'detall'=>'EXIGIBLE',
            'grupo'=>'1.1',
            'activo'=>1,
            'grupo_id'=>1,
            'created_at'=>'2018-01-24 14:47:39',
            'updated_at'=>'2018-01-24 14:47:39'
        ] );


        
        Cuenta::create( [
            'id'=>3,
            'cuenta'=>'INVENTARIOS',
            'secuencia'=>'3',
            'codigo'=>'1.1.3',
            'detall'=>'INVENTARIOS',
            'grupo'=>'1.1',
            'activo'=>1,
            'grupo_id'=>1,
            'created_at'=>'2018-01-24 14:59:40',
            'updated_at'=>'2018-01-24 14:59:40'
        ] );


        
        Cuenta::create( [
            'id'=>4,
            'cuenta'=>'ACTIVOS POR IMPUESTOS CORRIENTES',
            'secuencia'=>'4',
            'codigo'=>'1.1.4',
            'detall'=>'ACTIVOS POR IMPUESTOS CORRIENTES',
            'grupo'=>'1.1',
            'activo'=>1,
            'grupo_id'=>1,
            'created_at'=>'2018-01-24 15:04:21',
            'updated_at'=>'2018-01-24 15:04:21'
        ] );


        
        Cuenta::create( [
            'id'=>5,
            'cuenta'=>'PAGOS ANTICIPADOS',
            'secuencia'=>'5',
            'codigo'=>'1.1.5',
            'detall'=>'PAGOS ANTICIPADOS',
            'grupo'=>'1.1',
            'activo'=>1,
            'grupo_id'=>1,
            'created_at'=>'2018-01-24 15:04:48',
            'updated_at'=>'2018-01-24 15:04:48'
        ] );


        
        Cuenta::create( [
            'id'=>6,
            'cuenta'=>'OTROS ACTIVOS CORRIENTES',
            'secuencia'=>'6',
            'codigo'=>'1.1.6',
            'detall'=>'OTROS ACTIVOS CORRIENTES',
            'grupo'=>'1.1',
            'activo'=>1,
            'grupo_id'=>1,
            'created_at'=>'2018-01-24 15:05:04',
            'updated_at'=>'2018-01-24 15:05:04'
        ] );


        
        Cuenta::create( [
            'id'=>7,
            'cuenta'=>'PROPIEDADES, PLANTA Y EQUIPO',
            'secuencia'=>'1',
            'codigo'=>'1.2.1',
            'detall'=>'PROPIEDADES, PLANTA Y EQUIPO',
            'grupo'=>'1.2',
            'activo'=>1,
            'grupo_id'=>2,
            'created_at'=>'2018-01-24 15:05:48',
            'updated_at'=>'2018-01-24 15:05:48'
        ] );


        
        Cuenta::create( [
            'id'=>8,
            'cuenta'=>'OBLIGACIONES A CORTO PLAZO',
            'secuencia'=>'1',
            'codigo'=>'2.1.1',
            'detall'=>'OBLIGACIONES A CORTO PLAZO',
            'grupo'=>'2.1',
            'activo'=>1,
            'grupo_id'=>3,
            'created_at'=>'2018-01-24 15:12:38',
            'updated_at'=>'2018-01-24 15:14:49'
        ] );


        
        Cuenta::create( [
            'id'=>9,
            'cuenta'=>'OBLIGACIONES LABORALES',
            'secuencia'=>'2',
            'codigo'=>'2.1.2',
            'detall'=>'OBLIGACIONES LABORALES',
            'grupo'=>'2.1',
            'activo'=>1,
            'grupo_id'=>3,
            'created_at'=>'2018-01-24 15:15:16',
            'updated_at'=>'2018-01-24 15:15:16'
        ] );


        
        Cuenta::create( [
            'id'=>10,
            'cuenta'=>'OBLIGACIONES FISCALES',
            'secuencia'=>'3',
            'codigo'=>'2.1.3',
            'detall'=>'OBLIGACIONES FISCALES',
            'grupo'=>'2.1',
            'activo'=>1,
            'grupo_id'=>3,
            'created_at'=>'2018-01-24 15:15:32',
            'updated_at'=>'2018-01-24 15:15:32'
        ] );


        
        Cuenta::create( [
            'id'=>11,
            'cuenta'=>'OTROS PASIVOS CORRIENTES',
            'secuencia'=>'4',
            'codigo'=>'2.1.4',
            'detall'=>'OTROS PASIVOS CORRIENTES',
            'grupo'=>'2.1',
            'activo'=>1,
            'grupo_id'=>3,
            'created_at'=>'2018-01-24 15:15:53',
            'updated_at'=>'2018-01-24 15:15:53'
        ] );


        
        Cuenta::create( [
            'id'=>12,
            'cuenta'=>'OBLIGACIONES A LARGO PLAZO',
            'secuencia'=>'1',
            'codigo'=>'2.2.1',
            'detall'=>'OBLIGACIONES A LARGO PLAZO',
            'grupo'=>'2.2',
            'activo'=>1,
            'grupo_id'=>4,
            'created_at'=>'2018-01-24 15:16:21',
            'updated_at'=>'2018-01-24 15:16:21'
        ] );


        
        Cuenta::create( [
            'id'=>13,
            'cuenta'=>'Capital',
            'secuencia'=>'1',
            'codigo'=>'3.1.1',
            'detall'=>'Capital',
            'grupo'=>'3.1',
            'activo'=>1,
            'grupo_id'=>5,
            'created_at'=>'2018-01-24 15:19:45',
            'updated_at'=>'2018-01-24 15:19:45'
        ] );


        
        Cuenta::create( [
            'id'=>14,
            'cuenta'=>'Reserva Legal',
            'secuencia'=>'1',
            'codigo'=>'3.2.1',
            'detall'=>'Reserva Legal',
            'grupo'=>'3.2',
            'activo'=>1,
            'grupo_id'=>11,
            'created_at'=>'2018-01-24 15:21:36',
            'updated_at'=>'2018-01-24 15:21:36'
        ] );


        
        Cuenta::create( [
            'id'=>15,
            'cuenta'=>'Reserva Facultativa',
            'secuencia'=>'2',
            'codigo'=>'3.2.2',
            'detall'=>'Reserva Facultativa',
            'grupo'=>'3.2',
            'activo'=>1,
            'grupo_id'=>11,
            'created_at'=>'2018-01-24 15:24:30',
            'updated_at'=>'2018-01-24 15:24:30'
        ] );


        
        Cuenta::create( [
            'id'=>16,
            'cuenta'=>'Superavit por Revaluaciones',
            'secuencia'=>'1',
            'codigo'=>'3.3.1',
            'detall'=>'Superavit por Revaluaciones',
            'grupo'=>'3.3',
            'activo'=>1,
            'grupo_id'=>12,
            'created_at'=>'2018-01-24 15:24:59',
            'updated_at'=>'2018-01-24 15:24:59'
        ] );


        
        Cuenta::create( [
            'id'=>17,
            'cuenta'=>'Resultados Acumulados',
            'secuencia'=>'1',
            'codigo'=>'3.4.1',
            'detall'=>'Resultados Acumulados',
            'grupo'=>'3.4',
            'activo'=>1,
            'grupo_id'=>13,
            'created_at'=>'2018-01-24 15:25:24',
            'updated_at'=>'2018-01-24 15:25:24'
        ] );


        
        Cuenta::create( [
            'id'=>18,
            'cuenta'=>'Resultados del Ejercicio',
            'secuencia'=>'2',
            'codigo'=>'3.4.2',
            'detall'=>'Resultados del Ejercicio',
            'grupo'=>'3.4',
            'activo'=>1,
            'grupo_id'=>13,
            'created_at'=>'2018-01-24 15:25:38',
            'updated_at'=>'2018-01-24 15:25:38'
        ] );


        
        Cuenta::create( [
            'id'=>19,
            'cuenta'=>'VENTA DE BIENES',
            'secuencia'=>'1',
            'codigo'=>'4.1.1',
            'detall'=>'VENTA DE BIENES',
            'grupo'=>'4.1',
            'activo'=>1,
            'grupo_id'=>6,
            'created_at'=>'2018-01-24 15:26:07',
            'updated_at'=>'2018-01-24 15:26:07'
        ] );


        
        Cuenta::create( [
            'id'=>20,
            'cuenta'=>'Otros Ingresos',
            'secuencia'=>'1',
            'codigo'=>'4.2.1',
            'detall'=>'Otros Ingresos',
            'grupo'=>'4.2',
            'activo'=>1,
            'grupo_id'=>7,
            'created_at'=>'2018-01-24 15:26:46',
            'updated_at'=>'2018-01-24 15:26:46'
        ] );


        
        Cuenta::create( [
            'id'=>21,
            'cuenta'=>'Costo de Ventas',
            'secuencia'=>'1',
            'codigo'=>'5.1.1',
            'detall'=>'Costo de Ventas',
            'grupo'=>'5.1',
            'activo'=>1,
            'grupo_id'=>8,
            'created_at'=>'2018-01-24 15:27:29',
            'updated_at'=>'2018-01-24 15:27:29'
        ] );


        
        Cuenta::create( [
            'id'=>22,
            'cuenta'=>'GASTOS ADMINISTRATIVOS',
            'secuencia'=>'1',
            'codigo'=>'5.2.1',
            'detall'=>'GASTOS ADMINISTRATIVOS',
            'grupo'=>'5.2',
            'activo'=>1,
            'grupo_id'=>9,
            'created_at'=>'2018-01-24 15:32:43',
            'updated_at'=>'2018-01-24 15:32:43'
        ] );


        
        Cuenta::create( [
            'id'=>23,
            'cuenta'=>'GASTOS DE VENTAS',
            'secuencia'=>'2',
            'codigo'=>'5.2.2',
            'detall'=>'GASTOS DE VENTAS',
            'grupo'=>'5.2',
            'activo'=>1,
            'grupo_id'=>9,
            'created_at'=>'2018-01-24 15:33:23',
            'updated_at'=>'2018-01-24 15:33:23'
        ] );


        
        Cuenta::create( [
            'id'=>24,
            'cuenta'=>'GASTOS FINANCIEROS',
            'secuencia'=>'3',
            'codigo'=>'5.2.3',
            'detall'=>'GASTOS FINANCIEROS',
            'grupo'=>'5.2',
            'activo'=>1,
            'grupo_id'=>9,
            'created_at'=>'2018-01-24 15:33:39',
            'updated_at'=>'2018-01-24 15:33:39'
        ] );


        
        Cuenta::create( [
            'id'=>25,
            'cuenta'=>'OTROS GASTOS',
            'secuencia'=>'4',
            'codigo'=>'5.2.4',
            'detall'=>'OTROS GASTOS',
            'grupo'=>'5.2',
            'activo'=>1,
            'grupo_id'=>9,
            'created_at'=>'2018-01-24 15:33:55',
            'updated_at'=>'2018-01-24 15:33:55'
        ] );


        
        Cuenta::create( [
            'id'=>26,
            'cuenta'=>'PARTICIPACION UTILIDADES E IMPUESTO A LA RENTA',
            'secuencia'=>'5',
            'codigo'=>'5.2.5',
            'detall'=>'PARTICIPACION UTILIDADES E IMPUESTO A LA RENTA',
            'grupo'=>'5.2',
            'activo'=>1,
            'grupo_id'=>9,
            'created_at'=>'2018-01-24 15:34:11',
            'updated_at'=>'2018-01-24 15:34:11'
        ] );
    }
}
