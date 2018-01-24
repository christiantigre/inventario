<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTempsubauxctasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempsubauxctas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('subauxiliar')->nullable();
            $table->text('secuencia')->nullable();
            $table->text('codigo')->nullable();
            $table->text('detall')->nullable();
            $table->boolean('activo')->default(1);
            $table->text('auxiliar')->nullable();
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
        Schema::drop('tempsubauxctas');
    }
}
