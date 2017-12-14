<?php

use Illuminate\Database\Seeder;
use App\Pais as Paise;

class PaisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Paise::create( [
    		'id'=>1,
            'pais'=>'Ecuador',
    		'status'=>'1'
    	] );
    }
}
