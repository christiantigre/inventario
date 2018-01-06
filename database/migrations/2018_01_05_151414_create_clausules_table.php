<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClausulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clausules', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('documento')->nullable();
            $table->text('pre_clausula')->nullable();
            $table->text('clausula')->nullable();
            $table->boolean('activo')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clausules');
    }
}
