<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('proveedor')->nullable();
            $table->string('dir')->nullable();
            $table->string('tlfn')->nullable();
            $table->string('cel_movi')->nullable();
            $table->string('cel_claro')->nullable();
            $table->string('watsapp')->nullable();
            $table->string('fax')->nullable();
            $table->string('mail')->nullable();
            $table->string('web')->nullable();
            $table->string('ruc')->nullable();
            $table->string('representante')->nullable();
            $table->text('actividad')->nullable();
            $table->boolean('status')->default(1);
            $table->string('empresa')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->string('logo')->nullable();
            $table->integer('id_pais')->unsigned()->nullable();
            $table->integer('id_provincia')->unsigned()->nullable();
            $table->integer('id_canton')->unsigned()->nullable();
            $table->foreign('id_pais')->references('id')->on('paises');
            $table->foreign('id_provincia')->references('id')->on('provincias');
            $table->foreign('id_canton')->references('id')->on('cantons');
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
        Schema::drop('proveedors');
    }
}
