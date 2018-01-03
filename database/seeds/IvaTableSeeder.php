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
'iva'=>14.00,
'activo'=>0
] );

			

Iva::create( [
'id'=>2,
'iva'=>12.00,
'activo'=>1
] );

			


    }
}
