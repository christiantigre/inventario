<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprobanteVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprobante_ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_venta')->unsigned();            
            $table->text('numfactura')->nullable();          
            $table->text('claveacceso')->nullable();          
            $table->boolean('gen_xml')->default(0);          
            $table->boolean('fir_xml')->default(0);          
            $table->boolean('aut_xml')->default(0);          
            $table->boolean('convrt_ride')->default(0);          
            $table->boolean('send_ride')->default(0);          
            $table->boolean('send_xml')->default(0);          
            $table->text('num_autorizacion')->nullable();          
            $table->text('fecha_autorizacion')->nullable();          
            $table->text('estado_aprobacion')->nullable();          
            $table->text('mensaje')->nullable();          
            $table->foreign('id_venta')->references('id')->on('ventas');
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
        Schema::dropIfExists('comprobante_ventas');
    }
}
