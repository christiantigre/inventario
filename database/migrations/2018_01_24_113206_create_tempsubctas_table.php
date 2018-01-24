<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTempsubctasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempsubctas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('subcuenta')->nullable();
            $table->text('secuencia')->nullable();
            $table->text('codigo')->nullable();
            $table->text('detall')->nullable();
            $table->boolean('activo')->default(1);
            $table->text('cuenta')->nullable();
            $table->integer('cuenta_id')->unsigned();
            $table->foreign('cuenta_id')->references('id')->on('cuentas');
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
        Schema::drop('tempsubctas');
    }
}
