<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nom_cli',75)->nullable();
            $table->string('app_cli',75)->nullable();
            $table->string('ced_cli',15)->nullable()->unique();
            $table->string('ruc_cli',15)->nullable()->unique();
            $table->string('dir_cli',191)->nullable();
            $table->string('mail_cli',75)->nullable()->unique();
            $table->string('tlf_cli',15)->nullable();
            $table->string('wts_cli',15)->nullable();
            $table->string('clmovi_cli',15)->nullable();
            $table->string('clclr_cli',15)->nullable();
            $table->boolean('activo')->default(1);
            $table->integer('id_pais')->unsigned()->nullable();
            $table->integer('id_provincia')->unsigned()->nullable();
            $table->integer('id_canton')->unsigned()->nullable();
            $table->foreign('id_pais')->references('id')->on('paises');
            $table->foreign('id_provincia')->references('id')->on('provincias');
            $table->foreign('id_canton')->references('id')->on('cantons');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clientes');
    }
}
