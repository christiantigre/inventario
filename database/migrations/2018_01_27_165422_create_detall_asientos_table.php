<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetallAsientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detall_asientos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('num_asiento',15)->nullable();
            $table->text('cod_cuenta',15)->nullable();
            $table->text('cuenta')->nullable();
            $table->text('periodo',5)->nullable();
            $table->date('fecha')->nullable();
            $table->double('saldo_debe',15,2)->nullable();
            $table->double('saldo_haber',15,2)->nullable();
            $table->text('concepto_detalle')->nullable();
            $table->integer('almacen_id')->unsigned();
            $table->foreign('almacen_id')->references('id')->on('almacens');
            $table->integer('asiento_id')->unsigned();
            $table->foreign('asiento_id')->references('id')->on('num_asientos');
            $table->text('codaux_clase')->nullable();
            $table->text('codaux_grupo')->nullable();
            $table->text('codaux_cuenta')->nullable();
            $table->text('codaux_subcuenta')->nullable();
            $table->text('codaux_auxiliar')->nullable();
            $table->text('codaux_subauxiliar')->nullable();
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
        Schema::drop('detall_asientos');
    }
}
