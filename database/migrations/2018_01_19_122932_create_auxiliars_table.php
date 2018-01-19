<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuxiliarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auxiliars', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('auxiliar');
            $table->text('codigo')->nullable();
            $table->text('detall')->nullable();
            $table->boolean('activo')->nullable();
            $table->integer('subcuenta_id')->unsigned();
            $table->foreign('subcuenta_id')->references('id')->on('subcuentas');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('auxiliars');
    }
}
