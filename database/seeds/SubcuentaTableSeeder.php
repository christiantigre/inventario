<?php

use Illuminate\Database\Seeder;
use App\subcuentum as Subcuenta;

class SubcuentaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	

        Subcuenta::create( [
            'id'=>1,
            'subcuenta'=>'Caja General',
            'secuencia'=>'1',
            'codigo'=>'1.1.1.1',
            'detall'=>'Caja General',
            'activo'=>1,
            'cuenta'=>'1.1.1',
            'cuenta_id'=>1,
            'created_at'=>'2018-01-24 20:43:20',
            'updated_at'=>'2018-01-24 20:43:20'
        ] );


        
        Subcuenta::create( [
            'id'=>2,
            'subcuenta'=>'Bancos',
            'secuencia'=>'2',
            'codigo'=>'1.1.1.2',
            'detall'=>'Bancos',
            'activo'=>1,
            'cuenta'=>'1.1.1',
            'cuenta_id'=>1,
            'created_at'=>'2018-01-24 20:45:36',
            'updated_at'=>'2018-01-24 20:45:36'
        ] );


        
        Subcuenta::create( [
            'id'=>3,
            'subcuenta'=>'Cuentas por Cobrar Clientes',
            'secuencia'=>'1',
            'codigo'=>'1.1.2.1',
            'detall'=>'Cuentas por Cobrar Clientes',
            'activo'=>1,
            'cuenta'=>'1.1.2',
            'cuenta_id'=>2,
            'created_at'=>'2018-01-24 20:46:22',
            'updated_at'=>'2018-01-24 20:46:22'
        ] );


        
        Subcuenta::create( [
            'id'=>4,
            'subcuenta'=>'(-) Provisión Cuentas Incobrables',
            'secuencia'=>'2',
            'codigo'=>'1.1.2.2',
            'detall'=>'(-) Provisión Cuentas Incobrables',
            'activo'=>1,
            'cuenta'=>'1.1.2',
            'cuenta_id'=>2,
            'created_at'=>'2018-01-24 20:46:41',
            'updated_at'=>'2018-01-24 20:46:41'
        ] );


        
        Subcuenta::create( [
            'id'=>5,
            'subcuenta'=>'Cuentas por Cobrar Tarjeta de Crédito',
            'secuencia'=>'3',
            'codigo'=>'1.1.2.3',
            'detall'=>'Cuentas por Cobrar Tarjeta de Crédito',
            'activo'=>1,
            'cuenta'=>'1.1.2',
            'cuenta_id'=>2,
            'created_at'=>'2018-01-24 20:47:00',
            'updated_at'=>'2018-01-24 20:47:00'
        ] );


        
        Subcuenta::create( [
            'id'=>6,
            'subcuenta'=>'Cuentas por Cobrar Empleados',
            'secuencia'=>'4',
            'codigo'=>'1.1.2.4',
            'detall'=>'Cuentas por Cobrar Empleados',
            'activo'=>1,
            'cuenta'=>'1.1.2',
            'cuenta_id'=>2,
            'created_at'=>'2018-01-24 20:47:14',
            'updated_at'=>'2018-01-24 20:47:14'
        ] );


        
        Subcuenta::create( [
            'id'=>7,
            'subcuenta'=>'Mercaderías',
            'secuencia'=>'1',
            'codigo'=>'1.1.3.1',
            'detall'=>'Mercaderías',
            'activo'=>1,
            'cuenta'=>'1.1.3',
            'cuenta_id'=>3,
            'created_at'=>'2018-01-24 20:47:40',
            'updated_at'=>'2018-01-24 20:47:40'
        ] );


        
        Subcuenta::create( [
            'id'=>8,
            'subcuenta'=>'IVA Compras de Bienes',
            'secuencia'=>'1',
            'codigo'=>'1.1.4.1',
            'detall'=>'IVA Compras de Bienes',
            'activo'=>1,
            'cuenta'=>'1.1.4',
            'cuenta_id'=>4,
            'created_at'=>'2018-01-24 20:49:19',
            'updated_at'=>'2018-01-24 20:49:19'
        ] );


        
        Subcuenta::create( [
            'id'=>9,
            'subcuenta'=>'IVA Compras Servicios',
            'secuencia'=>'2',
            'codigo'=>'1.1.4.2',
            'detall'=>'IVA Compras Servicios',
            'activo'=>1,
            'cuenta'=>'1.1.4',
            'cuenta_id'=>4,
            'created_at'=>'2018-01-24 20:50:04',
            'updated_at'=>'2018-01-24 20:50:04'
        ] );


        
        Subcuenta::create( [
            'id'=>10,
            'subcuenta'=>'IVA Retenido 30%',
            'secuencia'=>'3',
            'codigo'=>'1.1.4.3',
            'detall'=>'IVA Retenido 30%',
            'activo'=>1,
            'cuenta'=>'1.1.4',
            'cuenta_id'=>4,
            'created_at'=>'2018-01-24 20:53:10',
            'updated_at'=>'2018-01-24 20:53:10'
        ] );


        
        Subcuenta::create( [
            'id'=>11,
            'subcuenta'=>'Crédito Tributario IVA Adquisiciones',
            'secuencia'=>'4',
            'codigo'=>'1.1.4.4',
            'detall'=>'Crédito Tributario IVA Adquisiciones',
            'activo'=>1,
            'cuenta'=>'1.1.4',
            'cuenta_id'=>4,
            'created_at'=>'2018-01-24 20:53:31',
            'updated_at'=>'2018-01-24 20:53:31'
        ] );


        
        Subcuenta::create( [
            'id'=>12,
            'subcuenta'=>'Crédito Tributario Retenciones IVA',
            'secuencia'=>'5',
            'codigo'=>'1.1.4.5',
            'detall'=>'Crédito Tributario Retenciones IVA',
            'activo'=>1,
            'cuenta'=>'1.1.4',
            'cuenta_id'=>4,
            'created_at'=>'2018-01-24 20:53:47',
            'updated_at'=>'2018-01-24 20:53:47'
        ] );


        
        Subcuenta::create( [
            'id'=>13,
            'subcuenta'=>'Anticipo Impuesto a la Renta',
            'secuencia'=>'6',
            'codigo'=>'1.1.4.6',
            'detall'=>'Anticipo Impuesto a la Renta',
            'activo'=>1,
            'cuenta'=>'1.1.4',
            'cuenta_id'=>4,
            'created_at'=>'2018-01-24 20:54:00',
            'updated_at'=>'2018-01-24 20:54:00'
        ] );


        
        Subcuenta::create( [
            'id'=>14,
            'subcuenta'=>'Retención a la Renta 1%',
            'secuencia'=>'7',
            'codigo'=>'1.1.4.7',
            'detall'=>'Retención a la Renta 1%',
            'activo'=>1,
            'cuenta'=>'1.1.4',
            'cuenta_id'=>4,
            'created_at'=>'2018-01-24 20:54:15',
            'updated_at'=>'2018-01-24 20:54:15'
        ] );


        
        Subcuenta::create( [
            'id'=>15,
            'subcuenta'=>'Anticipos a Proveedores',
            'secuencia'=>'1',
            'codigo'=>'1.1.5.1',
            'detall'=>'Anticipos a Proveedores',
            'activo'=>1,
            'cuenta'=>'1.1.5',
            'cuenta_id'=>5,
            'created_at'=>'2018-01-24 20:54:57',
            'updated_at'=>'2018-01-24 20:54:57'
        ] );


        
        Subcuenta::create( [
            'id'=>16,
            'subcuenta'=>'Seguros Pagados Por Anticipado',
            'secuencia'=>'2',
            'codigo'=>'1.1.5.2',
            'detall'=>'Seguros Pagados Por Anticipado',
            'activo'=>1,
            'cuenta'=>'1.1.5',
            'cuenta_id'=>5,
            'created_at'=>'2018-01-24 20:55:13',
            'updated_at'=>'2018-01-24 20:55:13'
        ] );


        
        Subcuenta::create( [
            'id'=>17,
            'subcuenta'=>'Terrenos',
            'secuencia'=>'1',
            'codigo'=>'1.2.1.1',
            'detall'=>'Terrenos',
            'activo'=>1,
            'cuenta'=>'1.2.1',
            'cuenta_id'=>7,
            'created_at'=>'2018-01-24 20:56:51',
            'updated_at'=>'2018-01-24 20:56:51'
        ] );


        
        Subcuenta::create( [
            'id'=>18,
            'subcuenta'=>'Edificios',
            'secuencia'=>'2',
            'codigo'=>'1.2.1.2',
            'detall'=>'Edificios',
            'activo'=>1,
            'cuenta'=>'1.2.1',
            'cuenta_id'=>7,
            'created_at'=>'2018-01-24 20:57:07',
            'updated_at'=>'2018-01-24 20:57:07'
        ] );


        
        Subcuenta::create( [
            'id'=>19,
            'subcuenta'=>'Depreciación Acumulada Edificios',
            'secuencia'=>'3',
            'codigo'=>'1.2.1.3',
            'detall'=>'Depreciación Acumulada Edificios',
            'activo'=>1,
            'cuenta'=>'1.2.1',
            'cuenta_id'=>7,
            'created_at'=>'2018-01-24 21:12:58',
            'updated_at'=>'2018-01-24 21:12:58'
        ] );


        
        Subcuenta::create( [
            'id'=>20,
            'subcuenta'=>'Maquinarias',
            'secuencia'=>'4',
            'codigo'=>'1.2.1.4',
            'detall'=>'Maquinarias',
            'activo'=>1,
            'cuenta'=>'1.2.1',
            'cuenta_id'=>7,
            'created_at'=>'2018-01-24 21:13:12',
            'updated_at'=>'2018-01-24 21:13:12'
        ] );


        
        Subcuenta::create( [
            'id'=>21,
            'subcuenta'=>'Depreciación Acumulada Maquinarias',
            'secuencia'=>'5',
            'codigo'=>'1.2.1.5',
            'detall'=>'Depreciación Acumulada Maquinarias',
            'activo'=>1,
            'cuenta'=>'1.2.1',
            'cuenta_id'=>7,
            'created_at'=>'2018-01-24 21:13:34',
            'updated_at'=>'2018-01-24 21:13:34'
        ] );


        
        Subcuenta::create( [
            'id'=>22,
            'subcuenta'=>'Mobiliarios',
            'secuencia'=>'6',
            'codigo'=>'1.2.1.6',
            'detall'=>'Mobiliarios',
            'activo'=>1,
            'cuenta'=>'1.2.1',
            'cuenta_id'=>7,
            'created_at'=>'2018-01-24 21:13:49',
            'updated_at'=>'2018-01-24 21:13:49'
        ] );


        
        Subcuenta::create( [
            'id'=>23,
            'subcuenta'=>'Depreciación Acumulada Mobiliarios',
            'secuencia'=>'7',
            'codigo'=>'1.2.1.7',
            'detall'=>'Depreciación Acumulada Mobiliarios',
            'activo'=>1,
            'cuenta'=>'1.2.1',
            'cuenta_id'=>7,
            'created_at'=>'2018-01-24 21:14:03',
            'updated_at'=>'2018-01-24 21:14:03'
        ] );


        
        Subcuenta::create( [
            'id'=>24,
            'subcuenta'=>'Vehìculos',
            'secuencia'=>'8',
            'codigo'=>'1.2.1.8',
            'detall'=>'Vehìculos',
            'activo'=>1,
            'cuenta'=>'1.2.1',
            'cuenta_id'=>7,
            'created_at'=>'2018-01-24 21:14:16',
            'updated_at'=>'2018-01-24 21:14:16'
        ] );


        
        Subcuenta::create( [
            'id'=>25,
            'subcuenta'=>'Depreciación Acumulada Vehículos',
            'secuencia'=>'9',
            'codigo'=>'1.2.1.9',
            'detall'=>'Depreciación Acumulada Vehículos',
            'activo'=>1,
            'cuenta'=>'1.2.1',
            'cuenta_id'=>7,
            'created_at'=>'2018-01-24 21:14:34',
            'updated_at'=>'2018-01-24 21:14:34'
        ] );


        
        Subcuenta::create( [
            'id'=>26,
            'subcuenta'=>'Equipo de Computación',
            'secuencia'=>'10',
            'codigo'=>'1.2.1.10',
            'detall'=>'Equipo de Computación',
            'activo'=>1,
            'cuenta'=>'1.2.1',
            'cuenta_id'=>7,
            'created_at'=>'2018-01-24 21:14:49',
            'updated_at'=>'2018-01-24 21:14:49'
        ] );


        
        Subcuenta::create( [
            'id'=>27,
            'subcuenta'=>'Depreciación Acumulada Equipo de Computación',
            'secuencia'=>'11',
            'codigo'=>'1.2.1.11',
            'detall'=>'Depreciación Acumulada Equipo de Computación',
            'activo'=>1,
            'cuenta'=>'1.2.1',
            'cuenta_id'=>7,
            'created_at'=>'2018-01-24 21:15:11',
            'updated_at'=>'2018-01-24 21:15:11'
        ] );


        
        Subcuenta::create( [
            'id'=>28,
            'subcuenta'=>'Sobregiros Bancarios',
            'secuencia'=>'1',
            'codigo'=>'2.1.1.1',
            'detall'=>'Sobregiros Bancarios',
            'activo'=>1,
            'cuenta'=>'2.1.1',
            'cuenta_id'=>8,
            'created_at'=>'2018-01-24 21:15:38',
            'updated_at'=>'2018-01-24 21:15:38'
        ] );


        
        Subcuenta::create( [
            'id'=>29,
            'subcuenta'=>'Cuentas por Pagar Proveedores',
            'secuencia'=>'2',
            'codigo'=>'2.1.1.2',
            'detall'=>'Cuentas por Pagar Proveedores',
            'activo'=>1,
            'cuenta'=>'2.1.1',
            'cuenta_id'=>8,
            'created_at'=>'2018-01-24 21:16:00',
            'updated_at'=>'2018-01-24 21:16:00'
        ] );


        
        Subcuenta::create( [
            'id'=>30,
            'subcuenta'=>'Anticipos de Clientes',
            'secuencia'=>'3',
            'codigo'=>'2.1.1.3',
            'detall'=>'Anticipos de Clientes',
            'activo'=>1,
            'cuenta'=>'2.1.1',
            'cuenta_id'=>8,
            'created_at'=>'2018-01-24 21:16:19',
            'updated_at'=>'2018-01-24 21:16:19'
        ] );


        
        Subcuenta::create( [
            'id'=>41,
            'subcuenta'=>'Sueldos por Pagar',
            'secuencia'=>'1',
            'codigo'=>'2.1.2.1',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'2.1.2',
            'cuenta_id'=>9,
            'created_at'=>'2018-01-24 21:42:37',
            'updated_at'=>'2018-01-24 21:42:37'
        ] );


        
        Subcuenta::create( [
            'id'=>42,
            'subcuenta'=>'Aporte Personal IESS por Pagar',
            'secuencia'=>'2',
            'codigo'=>'2.1.2.2',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'2.1.2',
            'cuenta_id'=>9,
            'created_at'=>'2018-01-24 21:42:37',
            'updated_at'=>'2018-01-24 21:42:37'
        ] );


        
        Subcuenta::create( [
            'id'=>43,
            'subcuenta'=>'Aporte Patronal IESS por Pagar',
            'secuencia'=>'3',
            'codigo'=>'2.1.2.3',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'2.1.2',
            'cuenta_id'=>9,
            'created_at'=>'2018-01-24 21:42:37',
            'updated_at'=>'2018-01-24 21:42:37'
        ] );


        
        Subcuenta::create( [
            'id'=>44,
            'subcuenta'=>'Fondos de Reserva por Pagar',
            'secuencia'=>'4',
            'codigo'=>'2.1.2.4',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'2.1.2',
            'cuenta_id'=>9,
            'created_at'=>'2018-01-24 21:42:37',
            'updated_at'=>'2018-01-24 21:42:37'
        ] );


        
        Subcuenta::create( [
            'id'=>45,
            'subcuenta'=>'Décimo Tercer Sueldo por Pagar',
            'secuencia'=>'5',
            'codigo'=>'2.1.2.5',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'2.1.2',
            'cuenta_id'=>9,
            'created_at'=>'2018-01-24 21:42:37',
            'updated_at'=>'2018-01-24 21:42:37'
        ] );


        
        Subcuenta::create( [
            'id'=>46,
            'subcuenta'=>'Décimo Cuarto Sueldo por Pagar',
            'secuencia'=>'6',
            'codigo'=>'2.1.2.6',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'2.1.2',
            'cuenta_id'=>9,
            'created_at'=>'2018-01-24 21:42:37',
            'updated_at'=>'2018-01-24 21:42:37'
        ] );


        
        Subcuenta::create( [
            'id'=>47,
            'subcuenta'=>'Vacaciones por Pagar',
            'secuencia'=>'7',
            'codigo'=>'2.1.2.7',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'2.1.2',
            'cuenta_id'=>9,
            'created_at'=>'2018-01-24 21:42:37',
            'updated_at'=>'2018-01-24 21:42:37'
        ] );


        
        Subcuenta::create( [
            'id'=>48,
            'subcuenta'=>'Participaciòn de trabajadores por pagar',
            'secuencia'=>'8',
            'codigo'=>'2.1.2.8',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'2.1.2',
            'cuenta_id'=>9,
            'created_at'=>'2018-01-24 21:42:37',
            'updated_at'=>'2018-01-24 21:42:37'
        ] );


        
        Subcuenta::create( [
            'id'=>49,
            'subcuenta'=>'IVA 12% Ventas',
            'secuencia'=>'1',
            'codigo'=>'2.1.3.1',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'2.1.3',
            'cuenta_id'=>10,
            'created_at'=>'2018-01-24 21:43:44',
            'updated_at'=>'2018-01-24 21:43:44'
        ] );


        
        Subcuenta::create( [
            'id'=>50,
            'subcuenta'=>'Retención de IVA 30%',
            'secuencia'=>'2',
            'codigo'=>'2.1.3.2',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'2.1.3',
            'cuenta_id'=>10,
            'created_at'=>'2018-01-24 21:43:44',
            'updated_at'=>'2018-01-24 21:43:44'
        ] );


        
        Subcuenta::create( [
            'id'=>51,
            'subcuenta'=>'Retención en la Fuente 1%',
            'secuencia'=>'3',
            'codigo'=>'2.1.3.3',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'2.1.3',
            'cuenta_id'=>10,
            'created_at'=>'2018-01-24 21:43:44',
            'updated_at'=>'2018-01-24 21:43:44'
        ] );


        
        Subcuenta::create( [
            'id'=>52,
            'subcuenta'=>'Impuesto a la Renta por pagar',
            'secuencia'=>'4',
            'codigo'=>'2.1.3.4',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'2.1.3',
            'cuenta_id'=>10,
            'created_at'=>'2018-01-24 21:43:44',
            'updated_at'=>'2018-01-24 21:43:44'
        ] );


        
        Subcuenta::create( [
            'id'=>53,
            'subcuenta'=>'SRI por pagar',
            'secuencia'=>'5',
            'codigo'=>'2.1.3.5',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'2.1.3',
            'cuenta_id'=>10,
            'created_at'=>'2018-01-24 21:43:44',
            'updated_at'=>'2018-01-24 21:43:44'
        ] );


        
        Subcuenta::create( [
            'id'=>54,
            'subcuenta'=>'Obligaciones con Instituciones Financieras Locales',
            'secuencia'=>'1',
            'codigo'=>'2.2.1.1',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'2.2.1',
            'cuenta_id'=>12,
            'created_at'=>'2018-01-24 21:44:25',
            'updated_at'=>'2018-01-24 21:44:25'
        ] );


        
        Subcuenta::create( [
            'id'=>55,
            'subcuenta'=>'Ventas Netas 12%',
            'secuencia'=>'1',
            'codigo'=>'4.1.1.1',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'4.1.1',
            'cuenta_id'=>19,
            'created_at'=>'2018-01-24 21:45:13',
            'updated_at'=>'2018-01-24 21:45:13'
        ] );


        
        Subcuenta::create( [
            'id'=>56,
            'subcuenta'=>'Ventas Netas 0%',
            'secuencia'=>'2',
            'codigo'=>'4.1.1.2',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'4.1.1',
            'cuenta_id'=>19,
            'created_at'=>'2018-01-24 21:45:59',
            'updated_at'=>'2018-01-24 21:45:59'
        ] );


        
        Subcuenta::create( [
            'id'=>57,
            'subcuenta'=>'GASTOS DE PERSONAL',
            'secuencia'=>'1',
            'codigo'=>'5.2.1.1',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'5.2.1',
            'cuenta_id'=>22,
            'created_at'=>'2018-01-24 21:47:08',
            'updated_at'=>'2018-01-24 21:47:08'
        ] );


        
        Subcuenta::create( [
            'id'=>58,
            'subcuenta'=>'GASTOS DE MANTENIMIENTO',
            'secuencia'=>'2',
            'codigo'=>'5.2.1.2',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'5.2.1',
            'cuenta_id'=>22,
            'created_at'=>'2018-01-24 21:47:08',
            'updated_at'=>'2018-01-24 21:47:08'
        ] );


        
        Subcuenta::create( [
            'id'=>59,
            'subcuenta'=>'GASTOS GENERALES',
            'secuencia'=>'3',
            'codigo'=>'5.2.1.3',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'5.2.1',
            'cuenta_id'=>22,
            'created_at'=>'2018-01-24 21:47:08',
            'updated_at'=>'2018-01-24 21:47:08'
        ] );


        
        Subcuenta::create( [
            'id'=>60,
            'subcuenta'=>'GASTOS DE PUBLICIDAD Y PROPAGANDA',
            'secuencia'=>'1',
            'codigo'=>'5.2.2.1',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'5.2.2',
            'cuenta_id'=>23,
            'created_at'=>'2018-01-24 21:47:37',
            'updated_at'=>'2018-01-24 21:47:37'
        ] );


        
        Subcuenta::create( [
            'id'=>61,
            'subcuenta'=>'INTERESES EN PRESTAMOS',
            'secuencia'=>'1',
            'codigo'=>'5.2.3.1',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'5.2.3',
            'cuenta_id'=>24,
            'created_at'=>'2018-01-24 21:48:00',
            'updated_at'=>'2018-01-24 21:48:00'
        ] );


        
        Subcuenta::create( [
            'id'=>62,
            'subcuenta'=>'Otros Gastos',
            'secuencia'=>'1',
            'codigo'=>'5.2.4.1',
            'detall'=>'Otros Gastos',
            'activo'=>1,
            'cuenta'=>'5.2.4',
            'cuenta_id'=>25,
            'created_at'=>'2018-01-24 21:48:27',
            'updated_at'=>'2018-01-24 21:48:27'
        ] );


        
        Subcuenta::create( [
            'id'=>63,
            'subcuenta'=>'Participación de Trabajadores',
            'secuencia'=>'1',
            'codigo'=>'5.2.5.1',
            'detall'=>NULL,
            'activo'=>1,
            'cuenta'=>'5.2.5',
            'cuenta_id'=>26,
            'created_at'=>'2018-01-24 21:49:07',
            'updated_at'=>'2018-01-24 21:49:07'
        ] );


        
        Subcuenta::create( [
            'id'=>64,
            'subcuenta'=>'Impuesto a la Renta',
            'secuencia'=>'2',
            'codigo'=>'5.2.5.2',
            'detall'=>'Impuesto a la Renta',
            'activo'=>1,
            'cuenta'=>'5.2.5',
            'cuenta_id'=>26,
            'created_at'=>'2018-01-24 21:49:07',
            'updated_at'=>'2018-01-24 21:49:37'
        ] );
        

    }
}
