<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubauxiliarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subauxiliars', function (Blueprint $table) {
            $table->increments('id');
            $table->text('subauxiliar');
            $table->text('secuencia')->nullable();
            $table->text('codigo')->nullable();
            $table->text('detall')->nullable();
            $table->boolean('activo')->nullable();
            $table->integer('auxiliar_id')->unsigned();
            $table->foreign('auxiliar_id')->references('id')->on('auxiliars');
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
        Schema::drop('subauxiliars');
    }
}
