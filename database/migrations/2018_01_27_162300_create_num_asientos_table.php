<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNumAsientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('num_asientos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('num_asiento',15);
            $table->text('concepto',255)->nullable();
            $table->text('periodo',5)->nullable();
            $table->date('fecha');
            $table->double('saldo_debe',15,2)->nullable();
            $table->double('saldo_haber',15,2)->nullable();
            $table->text('responsable',150)->nullable();
            $table->boolean('activo')->default(1);
            $table->integer('almacen_id')->unsigned();
            $table->foreign('almacen_id')->references('id')->on('almacens');
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
        Schema::drop('num_asientos');
    }
}
