<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create( [
            'id'=>1,
            'category'=>'n/n',
            'detall'=>'Electrónica',
            'activo'=>1
        ] );

        

        Category::create( [
            'id'=>2,
            'category'=>'Musica',
            'detall'=>'Musica',
            'activo'=>1
        ] );

        

        Category::create( [
            'id'=>3,
            'category'=>'Video',
            'detall'=>'Video',
            'activo'=>1
        ] );

        

        Category::create( [
            'id'=>4,
            'category'=>'Zapatos',
            'detall'=>'Zapatos',
            'activo'=>1
        ] );

        

        Category::create( [
            'id'=>5,
            'category'=>'Posters',
            'detall'=>'Posters',
            'activo'=>1
        ] );

        

        Category::create( [
            'id'=>6,
            'category'=>'Juguetes',
            'detall'=>'Juguetes',
            'activo'=>1
        ] );

        

        Category::create( [
            'id'=>7,
            'category'=>'Moda Hombre',
            'detall'=>'Moda Hombre',
            'activo'=>1
        ] );

        

        Category::create( [
            'id'=>8,
            'category'=>'Moda Mujer',
            'detall'=>'Moda Mujer',
            'activo'=>1
        ] );

        

        Category::create( [
            'id'=>9,
            'category'=>'Infantil',
            'detall'=>'Infantil',
            'activo'=>1
        ] );

        Category::create( [
            'id'=>10,
            'category'=>'Tecnología',
            'detall'=>'Tecnología',
            'activo'=>1
        ] );
    }
}
