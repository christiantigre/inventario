<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfils', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nombre')->nullable();
            $table->text('apellido')->nullable();
            $table->text('cedula')->nullable();
            $table->text('ruc')->nullable();
            $table->text('telefono')->nullable();
            $table->text('celular')->nullable();
            $table->text('email')->nullable();
            $table->text('fecha_nacimiento')->nullable();
            $table->text('estado_civil')->nullable();
            $table->text('genero')->nullable();
            $table->text('foto')->nullable();
            $table->text('tipo_usuario')->nullable();
            $table->text('id_usuario')->nullable();
            $table->text('titulo')->nullable();
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
        Schema::dropIfExists('perfils');
    }
}
