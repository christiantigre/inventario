<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Person;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Admin::create( [
    		'id'=>1,
    		'name'=>'Christian',
    		'email'=>'andrescondo17@gmail.com',
    		'password'=>bcrypt('andrescondo17@gmail.com'),
    		'remember_token'=>'vIVQ10nUVbor1moWyvfBXbnWv7FLARscKdXgvuXfVf6j20FUcgzsLl6yivye'
    	] );


    	Person::create( [
    		'id'=>1,
    		'name'=>'Andres',
    		'email'=>'andrestigre69@gmail.com',
    		'password'=>'$2y$10$SXSMu2Rt7t/3E8wmffnaPOLMxTqPjg2sYh2eOHP9pOJZHqj2/c5LK',
    	] );



    }
}
