<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('producto')->nullable();
            $table->string('cod_barra')->nullable()->unique();
            $table->double('pre_compra')->nullable();
            $table->double('pre_venta')->nullable();
            $table->integer('cantidad')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->integer('compras')->nullable();
            $table->integer('ventas')->default(0);
            $table->integer('saldo')->nullable();
            $table->string('imagen')->nullable();
            $table->string('name_img')->nullable();
            $table->boolean('nuevo')->default(1);
            $table->boolean('promo')->default(1);
            $table->boolean('catalogo')->default(1);
            $table->boolean('activo')->default(1);
            $table->text('propaganda')->nullable();
            $table->integer('id_category')->unsigned()->nullable();
            $table->integer('id_subcategory')->unsigned()->nullable();
            $table->integer('id_proveedor')->unsigned()->nullable();
            $table->integer('id_marca')->unsigned()->nullable();
            $table->foreign('id_category')->references('id')->on('categories');
            $table->foreign('id_subcategory')->references('id')->on('subcategories');
            $table->foreign('id_proveedor')->references('id')->on('proveedors');
            $table->foreign('id_marca')->references('id')->on('marcas');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
