<?php

use Illuminate\Database\Seeder;
use App\auxiliar as Auxiliar;

class AuxiliarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Auxiliar::create( [
    		'id'=>1,
    		'auxiliar'=>'Banco de Guayaquil',
    		'secuencia'=>'1',
    		'codigo'=>'1.1.1.2.1',
    		'detall'=>'Banco de Guayaquil',
    		'subcuenta'=>'1.1.1.2',
    		'activo'=>1,
    		'subcuenta_id'=>2,
    		'created_at'=>'2018-01-26 15:50:29',
    		'updated_at'=>'2018-01-26 16:02:54'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>2,
    		'auxiliar'=>'Banco del Pichincha',
    		'secuencia'=>'2',
    		'codigo'=>'1.1.1.2.2',
    		'detall'=>'Banco del Pichincha',
    		'subcuenta'=>'1.1.1.2',
    		'activo'=>1,
    		'subcuenta_id'=>2,
    		'created_at'=>'2018-01-26 15:50:29',
    		'updated_at'=>'2018-01-26 15:50:29'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>3,
    		'auxiliar'=>'Banco del Fomento',
    		'secuencia'=>'3',
    		'codigo'=>'1.1.1.2.3',
    		'detall'=>'Banco del Fomento',
    		'subcuenta'=>'1.1.1.2',
    		'activo'=>1,
    		'subcuenta_id'=>2,
    		'created_at'=>'2018-01-26 15:50:29',
    		'updated_at'=>'2018-01-26 15:50:29'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>4,
    		'auxiliar'=>'Banco del Pacífico',
    		'secuencia'=>'4',
    		'codigo'=>'1.1.1.2.4',
    		'detall'=>'Banco del Pacífico',
    		'subcuenta'=>'1.1.1.2',
    		'activo'=>1,
    		'subcuenta_id'=>2,
    		'created_at'=>'2018-01-26 15:50:29',
    		'updated_at'=>'2018-01-26 15:50:29'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>5,
    		'auxiliar'=>'Banco del Austro',
    		'secuencia'=>'5',
    		'codigo'=>'1.1.1.2.5',
    		'detall'=>'Banco del Austro',
    		'subcuenta'=>'1.1.1.2',
    		'activo'=>1,
    		'subcuenta_id'=>2,
    		'created_at'=>'2018-01-26 15:50:29',
    		'updated_at'=>'2018-01-26 15:50:29'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>6,
    		'auxiliar'=>'Mercaderías en Stock',
    		'secuencia'=>'1',
    		'codigo'=>'1.1.3.1.1',
    		'detall'=>'Mercaderías en Stock',
    		'subcuenta'=>'1.1.3.1',
    		'activo'=>1,
    		'subcuenta_id'=>7,
    		'created_at'=>'2018-01-26 15:51:20',
    		'updated_at'=>'2018-01-26 15:51:20'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>7,
    		'auxiliar'=>'Mercaderías en Tránsito compras',
    		'secuencia'=>'2',
    		'codigo'=>'1.1.3.1.2',
    		'detall'=>'Mercaderías en Tránsito compras',
    		'subcuenta'=>'1.1.3.1',
    		'activo'=>1,
    		'subcuenta_id'=>7,
    		'created_at'=>'2018-01-26 15:51:21',
    		'updated_at'=>'2018-01-26 15:51:21'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>8,
    		'auxiliar'=>'Sobregiros Bancarios Banco de Guayaquil',
    		'secuencia'=>'1',
    		'codigo'=>'2.1.1.1.1',
    		'detall'=>'Sobregiros Bancarios Banco de Guayaquil',
    		'subcuenta'=>'2.1.1.1',
    		'activo'=>1,
    		'subcuenta_id'=>28,
    		'created_at'=>'2018-01-26 15:51:59',
    		'updated_at'=>'2018-01-26 15:51:59'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>9,
    		'auxiliar'=>'Cooperativa Juventud Ecuatoriana Progresista',
    		'secuencia'=>'1',
    		'codigo'=>'2.2.1.1.1',
    		'detall'=>'Cooperativa Juventud Ecuatoriana Progresista',
    		'subcuenta'=>'2.2.1.1',
    		'activo'=>1,
    		'subcuenta_id'=>54,
    		'created_at'=>'2018-01-26 15:52:29',
    		'updated_at'=>'2018-01-26 15:52:29'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>10,
    		'auxiliar'=>'Sueldo Unificado',
    		'secuencia'=>'1',
    		'codigo'=>'5.2.1.1.1',
    		'detall'=>'Sueldo Unificado',
    		'subcuenta'=>'5.2.1.1',
    		'activo'=>1,
    		'subcuenta_id'=>57,
    		'created_at'=>'2018-01-26 15:54:27',
    		'updated_at'=>'2018-01-26 15:54:27'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>11,
    		'auxiliar'=>'Décimo Cuarto Sueldo',
    		'secuencia'=>'2',
    		'codigo'=>'5.2.1.1.2',
    		'detall'=>'Décimo Cuarto Sueldo',
    		'subcuenta'=>'5.2.1.1',
    		'activo'=>1,
    		'subcuenta_id'=>57,
    		'created_at'=>'2018-01-26 15:54:27',
    		'updated_at'=>'2018-01-26 15:54:27'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>12,
    		'auxiliar'=>'DécimoTercer Sueldo',
    		'secuencia'=>'3',
    		'codigo'=>'5.2.1.1.3',
    		'detall'=>'DécimoTercer Sueldo',
    		'subcuenta'=>'5.2.1.1',
    		'activo'=>1,
    		'subcuenta_id'=>57,
    		'created_at'=>'2018-01-26 15:54:27',
    		'updated_at'=>'2018-01-26 15:54:27'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>13,
    		'auxiliar'=>'Vacaciones',
    		'secuencia'=>'4',
    		'codigo'=>'5.2.1.1.4',
    		'detall'=>'Vacaciones',
    		'subcuenta'=>'5.2.1.1',
    		'activo'=>1,
    		'subcuenta_id'=>57,
    		'created_at'=>'2018-01-26 15:54:27',
    		'updated_at'=>'2018-01-26 15:54:27'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>14,
    		'auxiliar'=>'Fondos de Reserva',
    		'secuencia'=>'5',
    		'codigo'=>'5.2.1.1.5',
    		'detall'=>'Fondos de Reserva',
    		'subcuenta'=>'5.2.1.1',
    		'activo'=>1,
    		'subcuenta_id'=>57,
    		'created_at'=>'2018-01-26 15:54:27',
    		'updated_at'=>'2018-01-26 15:54:27'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>15,
    		'auxiliar'=>'Aporte Patronal IESS',
    		'secuencia'=>'6',
    		'codigo'=>'5.2.1.1.6',
    		'detall'=>'Aporte Patronal IESS',
    		'subcuenta'=>'5.2.1.1',
    		'activo'=>1,
    		'subcuenta_id'=>57,
    		'created_at'=>'2018-01-26 15:54:27',
    		'updated_at'=>'2018-01-26 15:54:27'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>16,
    		'auxiliar'=>'Horas Extras 100%',
    		'secuencia'=>'7',
    		'codigo'=>'5.2.1.1.7',
    		'detall'=>'Horas Extras 100%',
    		'subcuenta'=>'5.2.1.1',
    		'activo'=>1,
    		'subcuenta_id'=>57,
    		'created_at'=>'2018-01-26 15:54:27',
    		'updated_at'=>'2018-01-26 15:54:27'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>17,
    		'auxiliar'=>'Horas Extras 50%',
    		'secuencia'=>'8',
    		'codigo'=>'5.2.1.1.8',
    		'detall'=>'Horas Extras 50%',
    		'subcuenta'=>'5.2.1.1',
    		'activo'=>1,
    		'subcuenta_id'=>57,
    		'created_at'=>'2018-01-26 15:54:27',
    		'updated_at'=>'2018-01-26 15:54:27'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>18,
    		'auxiliar'=>'Mantenimiento de Vehículos',
    		'secuencia'=>'1',
    		'codigo'=>'5.2.1.2.1',
    		'detall'=>'Mantenimiento de Vehículos',
    		'subcuenta'=>'5.2.1.2',
    		'activo'=>1,
    		'subcuenta_id'=>58,
    		'created_at'=>'2018-01-26 15:55:14',
    		'updated_at'=>'2018-01-26 15:55:14'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>19,
    		'auxiliar'=>'Mantenimiento de Muebles y Enseres',
    		'secuencia'=>'2',
    		'codigo'=>'5.2.1.2.2',
    		'detall'=>'Mantenimiento de Muebles y Enseres',
    		'subcuenta'=>'5.2.1.2',
    		'activo'=>1,
    		'subcuenta_id'=>58,
    		'created_at'=>'2018-01-26 15:55:14',
    		'updated_at'=>'2018-01-26 15:55:14'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>20,
    		'auxiliar'=>'Mantenimiento de Equipos de Computación',
    		'secuencia'=>'3',
    		'codigo'=>'5.2.1.2.3',
    		'detall'=>'Mantenimiento de Equipos de Computación',
    		'subcuenta'=>'5.2.1.2',
    		'activo'=>1,
    		'subcuenta_id'=>58,
    		'created_at'=>'2018-01-26 15:55:14',
    		'updated_at'=>'2018-01-26 15:55:14'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>21,
    		'auxiliar'=>'Energía Eléctrica',
    		'secuencia'=>'1',
    		'codigo'=>'5.2.1.3.1',
    		'detall'=>'Energía Eléctrica',
    		'subcuenta'=>'5.2.1.3',
    		'activo'=>1,
    		'subcuenta_id'=>59,
    		'created_at'=>'2018-01-26 15:59:53',
    		'updated_at'=>'2018-01-26 15:59:53'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>22,
    		'auxiliar'=>'Agua Potable',
    		'secuencia'=>'2',
    		'codigo'=>'5.2.1.3.2',
    		'detall'=>'Agua Potable',
    		'subcuenta'=>'5.2.1.3',
    		'activo'=>1,
    		'subcuenta_id'=>59,
    		'created_at'=>'2018-01-26 15:59:53',
    		'updated_at'=>'2018-01-26 15:59:53'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>23,
    		'auxiliar'=>'Teléfono',
    		'secuencia'=>'3',
    		'codigo'=>'5.2.1.3.3',
    		'detall'=>'Teléfono',
    		'subcuenta'=>'5.2.1.3',
    		'activo'=>1,
    		'subcuenta_id'=>59,
    		'created_at'=>'2018-01-26 15:59:53',
    		'updated_at'=>'2018-01-26 15:59:53'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>24,
    		'auxiliar'=>'Gastos de Internet',
    		'secuencia'=>'4',
    		'codigo'=>'5.2.1.3.4',
    		'detall'=>'Gastos de Internet',
    		'subcuenta'=>'5.2.1.3',
    		'activo'=>1,
    		'subcuenta_id'=>59,
    		'created_at'=>'2018-01-26 15:59:53',
    		'updated_at'=>'2018-01-26 15:59:53'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>25,
    		'auxiliar'=>'Utiles y Papelería de Oficina',
    		'secuencia'=>'5',
    		'codigo'=>'5.2.1.3.5',
    		'detall'=>'Utiles y Papelería de Oficina',
    		'subcuenta'=>'5.2.1.3',
    		'activo'=>1,
    		'subcuenta_id'=>59,
    		'created_at'=>'2018-01-26 15:59:53',
    		'updated_at'=>'2018-01-26 15:59:53'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>26,
    		'auxiliar'=>'Suministros de Limpieza',
    		'secuencia'=>'6',
    		'codigo'=>'5.2.1.3.6',
    		'detall'=>'Suministros de Limpieza',
    		'subcuenta'=>'5.2.1.3',
    		'activo'=>1,
    		'subcuenta_id'=>59,
    		'created_at'=>'2018-01-26 15:59:53',
    		'updated_at'=>'2018-01-26 15:59:53'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>27,
    		'auxiliar'=>'Gastos Legales',
    		'secuencia'=>'7',
    		'codigo'=>'5.2.1.3.7',
    		'detall'=>'Gastos Legales',
    		'subcuenta'=>'5.2.1.3',
    		'activo'=>1,
    		'subcuenta_id'=>59,
    		'created_at'=>'2018-01-26 15:59:53',
    		'updated_at'=>'2018-01-26 15:59:53'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>28,
    		'auxiliar'=>'Gastos Depreciación Edificios',
    		'secuencia'=>'8',
    		'codigo'=>'5.2.1.3.8',
    		'detall'=>'Gastos Depreciación Edificios',
    		'subcuenta'=>'5.2.1.3',
    		'activo'=>1,
    		'subcuenta_id'=>59,
    		'created_at'=>'2018-01-26 15:59:53',
    		'updated_at'=>'2018-01-26 15:59:53'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>29,
    		'auxiliar'=>'Gastos Depreciación de Maquinarias',
    		'secuencia'=>'9',
    		'codigo'=>'5.2.1.3.9',
    		'detall'=>'Gastos Depreciación de Maquinarias',
    		'subcuenta'=>'5.2.1.3',
    		'activo'=>1,
    		'subcuenta_id'=>59,
    		'created_at'=>'2018-01-26 15:59:53',
    		'updated_at'=>'2018-01-26 15:59:53'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>30,
    		'auxiliar'=>'Gastos Depreciaciónde Mobiliarios',
    		'secuencia'=>'10',
    		'codigo'=>'5.2.1.3.10',
    		'detall'=>'Gastos Depreciaciónde Mobiliarios',
    		'subcuenta'=>'5.2.1.3',
    		'activo'=>1,
    		'subcuenta_id'=>59,
    		'created_at'=>'2018-01-26 15:59:53',
    		'updated_at'=>'2018-01-26 15:59:53'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>31,
    		'auxiliar'=>'Gastos Depreciación de Vehículos',
    		'secuencia'=>'11',
    		'codigo'=>'5.2.1.3.11',
    		'detall'=>'Gastos Depreciación de Vehículos',
    		'subcuenta'=>'5.2.1.3',
    		'activo'=>1,
    		'subcuenta_id'=>59,
    		'created_at'=>'2018-01-26 15:59:53',
    		'updated_at'=>'2018-01-26 15:59:53'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>32,
    		'auxiliar'=>'Gastos Depreciación de Equipos de Computación',
    		'secuencia'=>'12',
    		'codigo'=>'5.2.1.3.12',
    		'detall'=>'Gastos Depreciación de Equipos de Computación',
    		'subcuenta'=>'5.2.1.3',
    		'activo'=>1,
    		'subcuenta_id'=>59,
    		'created_at'=>'2018-01-26 15:59:53',
    		'updated_at'=>'2018-01-26 15:59:53'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>33,
    		'auxiliar'=>'Impuestos Municipales',
    		'secuencia'=>'13',
    		'codigo'=>'5.2.1.3.13',
    		'detall'=>'Impuestos Municipales',
    		'subcuenta'=>'5.2.1.3',
    		'activo'=>1,
    		'subcuenta_id'=>59,
    		'created_at'=>'2018-01-26 15:59:53',
    		'updated_at'=>'2018-01-26 15:59:53'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>34,
    		'auxiliar'=>'Impuestos Fiscales',
    		'secuencia'=>'14',
    		'codigo'=>'5.2.1.3.14',
    		'detall'=>'Impuestos Fiscales',
    		'subcuenta'=>'5.2.1.3',
    		'activo'=>1,
    		'subcuenta_id'=>59,
    		'created_at'=>'2018-01-26 15:59:53',
    		'updated_at'=>'2018-01-26 15:59:53'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>35,
    		'auxiliar'=>'Gastos Cuentas Incobrables',
    		'secuencia'=>'15',
    		'codigo'=>'5.2.1.3.15',
    		'detall'=>'Gastos Cuentas Incobrables',
    		'subcuenta'=>'5.2.1.3',
    		'activo'=>1,
    		'subcuenta_id'=>59,
    		'created_at'=>'2018-01-26 15:59:54',
    		'updated_at'=>'2018-01-26 15:59:54'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>36,
    		'auxiliar'=>'Públicidad',
    		'secuencia'=>'1',
    		'codigo'=>'5.2.2.1.1',
    		'detall'=>'Públicidad',
    		'subcuenta'=>'5.2.2.1',
    		'activo'=>1,
    		'subcuenta_id'=>60,
    		'created_at'=>'2018-01-26 15:59:54',
    		'updated_at'=>'2018-01-26 15:59:54'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>37,
    		'auxiliar'=>'Transporte en Compras',
    		'secuencia'=>'2',
    		'codigo'=>'5.2.2.1.2',
    		'detall'=>'Transporte en Compras',
    		'subcuenta'=>'5.2.2.1',
    		'activo'=>1,
    		'subcuenta_id'=>60,
    		'created_at'=>'2018-01-26 15:59:54',
    		'updated_at'=>'2018-01-26 15:59:54'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>38,
    		'auxiliar'=>'Intereses Bancarios',
    		'secuencia'=>'1',
    		'codigo'=>'5.2.3.1.1',
    		'detall'=>'Intereses Bancarios',
    		'subcuenta'=>'5.2.3.1',
    		'activo'=>1,
    		'subcuenta_id'=>61,
    		'created_at'=>'2018-01-26 15:59:54',
    		'updated_at'=>'2018-01-26 15:59:54'
    	] );
    	
    	Auxiliar::create( [
    		'id'=>39,
    		'auxiliar'=>'Servicios Bancarios',
    		'secuencia'=>'2',
    		'codigo'=>'5.2.3.1.2',
    		'detall'=>'Servicios Bancarios',
    		'subcuenta'=>'5.2.3.1',
    		'activo'=>1,
    		'subcuenta_id'=>61,
    		'created_at'=>'2018-01-26 15:59:54',
    		'updated_at'=>'2018-01-26 15:59:54'
    	] );
    }
}
