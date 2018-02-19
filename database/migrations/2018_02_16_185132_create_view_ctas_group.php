<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewCtasGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        SELECT c.codigo as clase, c.clase , g.codigo as grupo, g.grupo, ct.codigo as cuenta, ct.cuenta,
sb.codigo as subcuenta, sb.subcuenta, a.codigo as auxiliar, a.auxiliar, sa.codigo as subauxiliar, sa.subauxiliar
FROM 
clases as c 
LEFT OUTER JOIN grupos as g on g.clase_id = c.id 
LEFT OUTER JOIN cuentas as ct on ct.grupo_id = g.id 
LEFT OUTER JOIN subcuentas as sb ON sb.cuenta_id = ct.id 
LEFT OUTER JOIN auxiliars as a ON a.subcuenta_id = sb.id 
LEFT OUTER JOIN subauxiliars sa ON sa.auxiliar_id = a.id
*/
    DB::statement("CREATE VIEW ctas_group AS
            SELECT c.codigo as cod_clase, c.clase , g.codigo as cod_grupo, g.grupo, ct.codigo as cod_cuenta, ct.cuenta,
sb.codigo as cod_subcuenta, sb.subcuenta, a.codigo as cod_auxiliar, a.auxiliar, sa.codigo as cod_subauxiliar, sa.subauxiliar
FROM 
clases as c 
LEFT OUTER JOIN grupos as g on g.clase_id = c.id 
LEFT OUTER JOIN cuentas as ct on ct.grupo_id = g.id 
LEFT OUTER JOIN subcuentas as sb ON sb.cuenta_id = ct.id 
LEFT OUTER JOIN auxiliars as a ON a.subcuenta_id = sb.id 
LEFT OUTER JOIN subauxiliars sa ON sa.auxiliar_id = a.id
            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW ctas_group");
    }
}
