<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateDetallVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detall_ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('producto')->nullable();
            $table->date('fecha_egreso')->nullable();
            $table->string('codbarra',35)->nullable();
            $table->string('precio',35)->nullable();
            $table->string('cant',20)->nullable();
            $table->double('total',15,2)->nullable();
            $table->integer('id_producto')->unsigned();            
            $table->integer('id_venta')->unsigned();            
            $table->foreign('id_producto')->references('id')->on('products');
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
        Schema::dropIfExists('detall_ventas');
    }
}