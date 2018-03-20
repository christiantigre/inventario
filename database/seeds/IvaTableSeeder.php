<?php

use Illuminate\Database\Seeder;
use App\Iva;

class IvaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

Iva::create( [
'id'=>1,
'iva'=>0,
'codporcentaje'=>1,
'activo'=>0
] );

Iva::create( [
'id'=>2,
'iva'=>12.00,
'codporcentaje'=>2,
'activo'=>1
] );

			

Iva::create( [
'id'=>3,
'iva'=>14.00,
'codporcentaje'=>3,
'activo'=>0
] );

Iva::create( [
'id'=>4,
'iva'=>16.00,
'codporcentaje'=>4,
'activo'=>0
] );

			


    }
}
