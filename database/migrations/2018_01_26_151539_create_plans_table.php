<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW plan_contable AS
            SELECT clases.codigo as cod, clases.clase as cuenta FROM `clases` WHERE activo='1' 
            UNION
            SELECT grupos.codigo as cod, grupos.grupo as cuenta FROM `grupos` WHERE activo='1' 
            UNION
            SELECT cuentas.codigo as cod, cuentas.cuenta as cuenta FROM `cuentas` WHERE activo='1'
            UNION
            SELECT subcuentas.codigo as cod, subcuentas.subcuenta as cuenta FROM `subcuentas` WHERE activo='1'
            UNION
            SELECT auxiliars.codigo as cod, auxiliars.auxiliar as cuenta FROM `auxiliars` WHERE activo='1'
            UNION
            SELECT subauxiliars.codigo as cod, subauxiliars.subauxiliar as cuenta FROM `subauxiliars` WHERE activo='1'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW `plan_contable`");
    }
}
