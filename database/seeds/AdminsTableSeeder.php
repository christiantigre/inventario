<?php

use Illuminate\Database\Seeder;
use App\Admin;

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
    }
}
