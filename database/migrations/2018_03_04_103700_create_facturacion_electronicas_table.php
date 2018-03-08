<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFacturacionElectronicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturacion_electronicas', function (Blueprint $table) {
                $table->increments('id');
                $table->boolean('obligado_contabilidad')->nullable();
                $table->text('path_certificado')->nullable();
                $table->text('clave_certificado')->nullable();
                $table->boolean('modo_ambiente')->nullable();
                $table->boolean('generar_facturas')->default(1);
                $table->integer('id_almacen')->unsigned(); 
                $table->foreign('id_almacen')->references('id')->on('almacens');
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
        Schema::drop('facturacion_electronicas');
    }
}
