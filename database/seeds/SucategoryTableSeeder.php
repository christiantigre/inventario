<?php

use Illuminate\Database\Seeder;
use App\Subcategory;

class SucategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcategory::create( [
            'id'=>1,
            'subcategory'=>'n/n',
            'content'=>'Camisetas',
            'active'=>1,
            'category_id'=>7
        ] );

        

        Subcategory::create( [
            'id'=>2,
            'subcategory'=>'Sudaderas',
            'content'=>'Sudaderas',
            'active'=>1,
            'category_id'=>7,
        ] );

        

        Subcategory::create( [
            'id'=>3,
            'subcategory'=>'Albun',
            'content'=>'Albun',
            'active'=>1,
            'category_id'=>2
        ] );

        

        Subcategory::create( [
            'id'=>4,
            'subcategory'=>'Single',
            'content'=>'Single',
            'active'=>1,
            'category_id'=>2
        ] );

        

        Subcategory::create( [
            'id'=>5,
            'subcategory'=>'Deportivos',
            'content'=>'Deportivos',
            'active'=>1,
            'category_id'=>4
        ] );

        

        Subcategory::create( [
            'id'=>6,
            'subcategory'=>'Casuales',
            'content'=>'Casuales',
            'active'=>1,
            'category_id'=>4
        ] );

        

        Subcategory::create( [
            'id'=>7,
            'subcategory'=>'Carros',
            'content'=>'Carros',
            'active'=>1,
            'category_id'=>6
        ] );

        

        Subcategory::create( [
            'id'=>8,
            'subcategory'=>'Muñecas',
            'content'=>'Muñecas',
            'active'=>1,
            'category_id'=>6
        ] );



        


    }
}
