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
        $this->call(PerfilTableSeeder::class);
        $this->call(PaisesTableSeeder::class);
        $this->call(ProvinciasTableSeeder::class);
        $this->call(IvaTableSeeder::class);
        $this->call(TypepayTableseeder::class);
        $this->call(ClausuleTableSeeder::class);
        $this->call(CantonesTableSeeder::class);
        $this->call(DescuentosTableSeeder::class);
        //
        $this->call(AlmacenTableSeeder::class);
        $this->call(ParroquiasTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(SucategoryTableSeeder::class);
        $this->call(MarcaTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        //
        $this->call(ProductTableSeeder::class);

        $this->call(NivelesTableSeeder::class);
        $this->call(ClasesTableSeeder::class);
        $this->call(GruposTableSeeder::class);
        $this->call(CuentaTbaleSeeder::class);
        $this->call(SubcuentaTableSeeder::class);
        $this->call(AuxiliarTableSeeder::class);
        $this->call(ConfcontblTableSeeder::class);
        $this->call(ComprobanteTableSeeder::class);
        $this->call(MonedaTableSeeder::class);

    }
}
