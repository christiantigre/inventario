<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgrupacionSumadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        DB::statement("
            CREATE VIEW sumas_agrupadas_clases as
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, c.codigo as cod_cuenta, c.clase as cuenta, dt.periodo FROM detall_asientos dt JOIN clases c ON dt.codaux_clase = c.codigo GROUP BY c.codigo, c.clase, dt.periodo;
            ");

         DB::statement("
            CREATE VIEW sumas_agrupadas_grupos as
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, g.codigo as cod_cuenta, g.grupo as cuenta, dt.periodo FROM detall_asientos dt JOIN grupos g ON dt.codaux_grupo = g.codigo GROUP BY g.codigo, g.grupo, dt.periodo;
            ");

          DB::statement("
            CREATE VIEW sumas_agrupadas_cuentas as
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, ct.codigo as cod_cuenta, ct.cuenta as cuenta, dt.periodo FROM detall_asientos dt JOIN cuentas ct ON dt.codaux_cuenta = ct.codigo GROUP BY ct.codigo, ct.cuenta, dt.periodo;
            ");

           DB::statement("
            CREATE VIEW sumas_agrupadas_subcuentas as
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, sct.codigo as cod_cuenta, sct.subcuenta as cuenta, dt.periodo FROM detall_asientos dt JOIN subcuentas sct ON dt.codaux_subcuenta = sct.codigo GROUP BY sct.codigo, sct.subcuenta, dt.periodo;
            ");

            DB::statement("
            CREATE VIEW sumas_agrupadas_auxiliares as
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, a.codigo as cod_cuenta, a.auxiliar as cuenta, dt.periodo FROM detall_asientos dt JOIN auxiliars a ON dt.codaux_auxiliar = a.codigo GROUP BY a.codigo, a.auxiliar, dt.periodo;
            ");

            DB::statement("
            CREATE VIEW sumas_agrupadas_subauxiliares as
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, sa.codigo as cod_cuenta, sa.subauxiliar as cuenta, dt.periodo FROM detall_asientos dt JOIN subauxiliars sa ON dt.codaux_subauxiliar = sa.codigo GROUP BY sa.codigo, sa.subauxiliar, dt.periodo;
            ");

            DB::statement("
                CREATE VIEW sumas_agrupadas as
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, c.codigo as cod_cuenta, c.clase as cuenta, dt.periodo FROM detall_asientos dt JOIN clases c ON dt.codaux_clase = c.codigo GROUP BY c.codigo, c.clase, dt.periodo
            UNION
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, g.codigo as cod_cuenta, g.grupo as cuenta, dt.periodo FROM detall_asientos dt JOIN grupos g ON dt.codaux_grupo = g.codigo GROUP BY g.codigo, g.grupo, dt.periodo
            union
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, ct.codigo as cod_cuenta, ct.cuenta as cuenta, dt.periodo FROM detall_asientos dt JOIN cuentas ct ON dt.codaux_cuenta = ct.codigo GROUP BY ct.codigo, ct.cuenta, dt.periodo
            UNION
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, sct.codigo as cod_cuenta, sct.subcuenta as cuenta, dt.periodo FROM detall_asientos dt JOIN subcuentas sct ON dt.codaux_subcuenta = sct.codigo GROUP BY sct.codigo, sct.subcuenta, dt.periodo
            UNION
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, a.codigo as cod_cuenta, a.auxiliar as cuenta, dt.periodo FROM detall_asientos dt JOIN auxiliars a ON dt.codaux_auxiliar = a.codigo GROUP BY a.codigo, a.auxiliar, dt.periodo
            UNION
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, sa.codigo as cod_cuenta, sa.subauxiliar as cuenta, dt.periodo FROM detall_asientos dt JOIN subauxiliars sa ON dt.codaux_subauxiliar = sa.codigo GROUP BY sa.codigo, sa.subauxiliar, dt.periodo
            ");

            
    }

    /**
     * Reverse the migrations.
     *
     * @return void



     SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, c.codigo as cod_cuenta, c.clase as cuenta, dt.periodo FROM detall_asientos dt JOIN clases c ON dt.codaux_clase = c.codigo GROUP BY dt.codaux_clase, dt.periodo
union
SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, g.codigo as cod_cuenta, g.grupo as cuenta, dt.periodo FROM detall_asientos dt JOIN grupos g ON dt.codaux_grupo = g.codigo GROUP BY dt.codaux_grupo, dt.periodo
union
SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, ct.codigo as cod_cuenta, ct.cuenta as cuenta, dt.periodo FROM detall_asientos dt JOIN cuentas ct ON dt.codaux_cuenta = ct.codigo GROUP BY dt.codaux_cuenta, dt.periodo
union
SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, sct.codigo as cod_cuenta, sct.subcuenta as cuenta, dt.periodo FROM detall_asientos dt JOIN subcuentas sct ON dt.codaux_subcuenta = sct.codigo GROUP BY dt.codaux_subcuenta, dt.periodo
union
SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, a.codigo as cod_cuenta, a.auxiliar as cuenta, dt.periodo FROM detall_asientos dt JOIN auxiliars a ON dt.codaux_auxiliar = a.codigo GROUP BY dt.codaux_subcuenta, dt.periodo
union
SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, sa.codigo as cod_cuenta, sa.subauxiliar as cuenta, dt.periodo FROM detall_asientos dt JOIN subauxiliars sa ON dt.codaux_subauxiliar = sa.codigo GROUP BY dt.codaux_subauxiliar, dt.periodo


     */



/*
CREATE VIEW sumas_agrupadas as
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, c.codigo as cod_cuenta, c.clase as cuenta, dt.periodo FROM detall_asientos dt JOIN clases c ON dt.codaux_clase = c.codigo GROUP BY dt.codaux_clase, dt.periodo
            union
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, g.codigo as cod_cuenta, g.grupo as cuenta, dt.periodo FROM detall_asientos dt JOIN grupos g ON dt.codaux_grupo = g.codigo GROUP BY dt.codaux_grupo, dt.periodo
            union
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, ct.codigo as cod_cuenta, ct.cuenta as cuenta, dt.periodo FROM detall_asientos dt JOIN cuentas ct ON dt.codaux_cuenta = ct.codigo GROUP BY dt.codaux_cuenta, dt.periodo
            union
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, sct.codigo as cod_cuenta, sct.subcuenta as cuenta, dt.periodo FROM detall_asientos dt JOIN subcuentas sct ON dt.codaux_subcuenta = sct.codigo GROUP BY dt.codaux_subcuenta, dt.periodo
            union
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, a.codigo as cod_cuenta, a.auxiliar as cuenta, dt.periodo FROM detall_asientos dt JOIN auxiliars a ON dt.codaux_auxiliar = a.codigo GROUP BY dt.codaux_auxiliar, dt.periodo
            union
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, sa.codigo as cod_cuenta, sa.subauxiliar as cuenta, dt.periodo FROM detall_asientos dt JOIN subauxiliars sa ON dt.codaux_subauxiliar = sa.codigo GROUP BY dt.codaux_subauxiliar, dt.periodo
*/

            /*
            Nuevo armado
            CREATE VIEW sumas_agrupadas as
            SELECT saldo_debe, saldo_haber, cod_cuenta, cuenta,periodo from (
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, c.codigo as cod_cuenta, c.clase as cuenta, dt.periodo FROM detall_asientos dt JOIN clases c ON dt.codaux_clase = c.codigo GROUP BY c.codigo, c.clase, dt.periodo
            UNION
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, g.codigo as cod_cuenta, g.grupo as cuenta, dt.periodo FROM detall_asientos dt JOIN grupos g ON dt.codaux_grupo = g.codigo GROUP BY g.codigo, g.grupo, dt.periodo
            union
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, ct.codigo as cod_cuenta, ct.cuenta as cuenta, dt.periodo FROM detall_asientos dt JOIN cuentas ct ON dt.codaux_cuenta = ct.codigo GROUP BY ct.codigo, ct.cuenta, dt.periodo
            UNION
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, sct.codigo as cod_cuenta, sct.subcuenta as cuenta, dt.periodo FROM detall_asientos dt JOIN subcuentas sct ON dt.codaux_subcuenta = sct.codigo GROUP BY sct.codigo, sct.subcuenta, dt.periodo
            UNION
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, a.codigo as cod_cuenta, a.auxiliar as cuenta, dt.periodo FROM detall_asientos dt JOIN auxiliars a ON dt.codaux_auxiliar = a.codigo GROUP BY a.codigo, a.auxiliar, dt.periodo
            UNION
            SELECT sum(dt.saldo_debe) as saldo_debe, SUM(dt.saldo_haber) as saldo_haber, sa.codigo as cod_cuenta, sa.subauxiliar as cuenta, dt.periodo FROM detall_asientos dt JOIN subauxiliars sa ON dt.codaux_subauxiliar = sa.codigo GROUP BY sa.codigo, sa.subauxiliar, dt.periodo) as tab GROUP BY cod_cuenta
            */
            public function down()
            {
             DB::statement("
                DROP VIEW `sumas_agrupadas_clases`;
                DROP VIEW `sumas_agrupadas_grupos`;
                DROP VIEW `sumas_agrupadas_cuentas`;
                DROP VIEW `sumas_agrupadas_subcuentas`;
                DROP VIEW `sumas_agrupadas_auxiliares`;
                DROP VIEW `sumas_agrupadas_subauxiliares`;
                DROP VIEW `sumas_agrupadas`;
                ");
         }
     }
