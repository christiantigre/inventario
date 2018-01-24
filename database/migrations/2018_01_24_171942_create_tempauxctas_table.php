<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTempauxctasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempauxctas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('auxiliar')->nullable();
            $table->text('secuencia')->nullable();
            $table->text('codigo')->nullable();
            $table->text('detall')->nullable();
            $table->boolean('activo')->default(1);
            $table->text('subcuenta')->nullable();
            $table->integer('subcuenta_id')->unsigned();
            $table->foreign('subcuenta_id')->references('id')->on('subcuentas');
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
        Schema::drop('tempauxctas');
    }
}
