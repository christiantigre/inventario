<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfcontsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confconts', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('generar_contabilidad')->default(1);
            $table->boolean('assauto_compras')->default(1);
            $table->boolean('assauto_ventas')->default(1);
            $table->boolean('assauto_pagos')->default(1);
            $table->boolean('assauto_gastos')->default(1);
            $table->boolean('assauto_costos')->default(1);
            $table->boolean('assauto_inversiones')->default(1);
            $table->boolean('assauto_cobros')->default(1);
            $table->boolean('assauto_sueldos')->default(1);
            $table->boolean('assauto_obligaciones')->default(1);
            $table->boolean('assauto_impuestos')->default(1);
            $table->boolean('assauto_servicios')->default(1);
            $table->boolean('assauto_creditos')->default(1);
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
        Schema::dropIfExists('confconts');
    }
}
