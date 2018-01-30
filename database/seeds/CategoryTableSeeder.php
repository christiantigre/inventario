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
            'category'=>'N/N',
            'detall'=>'NO REGISTRADA',
            'activo'=>1,
            'created_at'=>'2018-01-29 18:00:11',
            'updated_at'=>'2018-01-29 18:04:08',
            'deleted_at'=>NULL
        ] );


        
        Category::create( [
            'id'=>2,
            'category'=>'HERRAMIENTAS',
            'detall'=>'Variedad de herramientas para ensamblado, reparación y mantenimiento automotriz o indutrial.',
            'activo'=>1,
            'created_at'=>'2018-01-29 18:00:11',
            'updated_at'=>'2018-01-29 19:22:13',
            'deleted_at'=>NULL
        ] );


        
        Category::create( [
            'id'=>3,
            'category'=>'REPUESTOS',
            'detall'=>'Repuestos internos y externos automotrices.',
            'activo'=>1,
            'created_at'=>'2018-01-29 18:00:11',
            'updated_at'=>'2018-01-29 19:23:14',
            'deleted_at'=>NULL
        ] );


        
        Category::create( [
            'id'=>4,
            'category'=>'TAPICERÍA',
            'detall'=>'Articulos de ensamblaje de tapicerpía del vehiculo.',
            'activo'=>1,
            'created_at'=>'2018-01-29 18:00:11',
            'updated_at'=>'2018-01-29 19:23:50',
            'deleted_at'=>NULL
        ] );


        
        Category::create( [
            'id'=>5,
            'category'=>'LATONERÍA',
            'detall'=>'Quimicos para pintado, mescla de pintura, removedores etc.',
            'activo'=>1,
            'created_at'=>'2018-01-29 18:00:11',
            'updated_at'=>'2018-01-29 19:25:12',
            'deleted_at'=>NULL
        ] );


        
        Category::create( [
            'id'=>6,
            'category'=>'ACCESORIOS',
            'detall'=>'Accesorios externos e internos de vehiculos.',
            'activo'=>1,
            'created_at'=>'2018-01-29 18:00:12',
            'updated_at'=>'2018-01-29 19:25:43',
            'deleted_at'=>NULL
        ] );


        
        Category::create( [
            'id'=>7,
            'category'=>'MANTENIMIENTO',
            'detall'=>'Articulos para realizar mantenimiento automotriz como limpiesa, lubricacón entre otros.',
            'activo'=>1,
            'created_at'=>'2018-01-29 18:00:12',
            'updated_at'=>'2018-01-29 19:26:27',
            'deleted_at'=>NULL
        ] );


        
        Category::create( [
            'id'=>8,
            'category'=>'VARIOS',
            'detall'=>'Varios articulos por clasificar',
            'activo'=>1,
            'created_at'=>'2018-01-29 18:00:12',
            'updated_at'=>'2018-01-29 19:26:49',
            'deleted_at'=>NULL
        ] );


        Category::create( [
            'id'=>9,
            'category'=>'SISTEMA ELECTRICO',
            'detall'=>'Varios articulos para el sistema eléctrico',
            'activo'=>1,
            'created_at'=>'2018-01-29 18:00:12',
            'updated_at'=>'2018-01-29 19:26:49',
            'deleted_at'=>NULL
        ] );



    }
}

// maestria sistema
// 10900

// 26 meses 
// 400 menual

// 289 Dolares 36 cuotas

// para mensual de 200 para 54 

// beca parcial 50%