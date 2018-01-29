<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempdetallasientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempdetallasientos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('num_asiento',15)->nullable();
            $table->text('cod_cuenta',15)->nullable();
            $table->text('cuenta')->nullable();
            $table->text('periodo',5)->nullable();
            $table->date('fecha')->nullable();
            $table->double('saldo_debe',15,2)->nullable();
            $table->double('saldo_haber',15,2)->nullable();
            $table->text('concepto_detalle')->nullable();
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
        Schema::dropIfExists('tempdetallasientos');
    }
}
