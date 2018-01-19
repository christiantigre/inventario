<?php

use Illuminate\Database\Seeder;
use App\tipocuentum as Tipocuenta;

class NivelesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipocuenta::create( [
'id'=>1,
'nombre'=>'CLASE',
'detall'=>'Cuenta principal',
'activo'=>1
] );

			

Tipocuenta::create( [
'id'=>2,
'nombre'=>'GRUPO',
'detall'=>'Los dos primeros dígitos',
'activo'=>1
] );

			

Tipocuenta::create( [
'id'=>3,
'nombre'=>'CUENTA',
'detall'=>'Los cuatro primeros dígitos',
'activo'=>1
] );

			

Tipocuenta::create( [
'id'=>4,
'nombre'=>'SUBCUENTA',
'detall'=>'Los seis primeros dígitos.',
'activo'=>1
] );

			

Tipocuenta::create( [
'id'=>5,
'nombre'=>'AUXILIAR',
'detall'=>'Cuenta auxiliar',
'activo'=>1
] );


Tipocuenta::create( [
'id'=>6,
'nombre'=>'SUBAUXILIAR',
'detall'=>'Cuenta subauxiliar',
'activo'=>1
] );

    }
}
