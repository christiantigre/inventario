<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(PaisesTableSeeder::class);
        $this->call(ProvinciasTableSeeder::class);
        $this->call(CantonesTableSeeder::class);
        $this->call(AlmacenTableSeeder::class);
        //$this->call(ParroquiasTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(SucategoryTableSeeder::class);
    }
}
