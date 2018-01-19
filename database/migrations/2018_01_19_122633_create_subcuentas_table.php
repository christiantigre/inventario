<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubcuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcuentas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('subcuenta');
            $table->text('codigo')->nullable();
            $table->text('detall')->nullable();
            $table->boolean('activo')->nullable();
            $table->integer('cuenta_id')->unsigned();
            $table->foreign('cuenta_id')->references('id')->on('cuentas');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subcuentas');
    }
}
