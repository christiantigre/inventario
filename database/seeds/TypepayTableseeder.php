<?php

use Illuminate\Database\Seeder;
use App\TypePay as Typepay;

class TypepayTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Typepay::create( [
'id'=>1,
'type'=>'EFECTIVO',
'status'=>1,
'created_at'=>'2018-01-04 15:26:26',
'updated_at'=>'2018-01-04 15:26:26'
] );

			

Typepay::create( [
'id'=>2,
'type'=>'DINERO ELECTRÓNICO',
'status'=>1,
'created_at'=>'2018-01-04 15:28:25',
'updated_at'=>'2018-01-04 15:28:25'
] );

			

Typepay::create( [
'id'=>3,
'type'=>'TARJ. CRÉDITO/DÉBITO',
'status'=>1,
'created_at'=>'2018-01-04 15:29:01',
'updated_at'=>'2018-01-04 15:29:01'
] );

			

Typepay::create( [
'id'=>4,
'type'=>'OTROS',
'status'=>1,
'created_at'=>'2018-01-04 15:29:17',
'updated_at'=>'2018-01-04 15:29:17'
] );
    }
}
