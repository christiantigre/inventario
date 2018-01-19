<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('grupo')->nullable();
            $table->text('codigo')->nullable();
            $table->text('detall')->nullable();
            $table->boolean('activo')->nullable();
            $table->integer('clase_id')->unsigned();
            $table->foreign('clase_id')->references('id')->on('clases');
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
        Schema::drop('grupos');
    }
}
