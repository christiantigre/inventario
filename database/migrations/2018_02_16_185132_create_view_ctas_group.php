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
/*
SELECT c.codigo as cod_clase, c.clase , g.codigo as cod_grupo, g.grupo, ct.codigo as cod_cuenta, ct.cuenta, sb.codigo as cod_subcuenta, sb.subcuenta, a.codigo as cod_auxiliar, a.auxiliar, sa.codigo as cod_subauxiliar, sa.subauxiliar
FROM 
clases as c 
LEFT OUTER JOIN grupos as g on g.clase_id = c.id 
LEFT OUTER JOIN cuentas as ct on ct.grupo_id = g.id 
LEFT OUTER JOIN subcuentas as sb ON sb.cuenta_id = ct.id 
LEFT OUTER JOIN auxiliars as a ON a.subcuenta_id = sb.id 
LEFT OUTER JOIN subauxiliars sa ON sa.auxiliar_id = a.id
union 
select c.codigo as cod_clase, c.clase as clase,CONCAT("",' ', "") AS cod_grupo,CONCAT("",' ', "") AS grupo,CONCAT("",' ', "") AS cod_cuenta,CONCAT("",' ', "") AS cuenta,CONCAT("",' ', "") AS cod_subcuenta,CONCAT("",' ', "") AS subcuenta,CONCAT("",' ', "") AS cod_auxiliar,CONCAT("",' ', "") AS auxiliar,CONCAT("",' ', "") AS cod_subauxiliar,CONCAT("",' ', "") AS subauxiliar from clases c
UNION
select CONCAT("",' ', "") AS cod_clase, CONCAT("",' ', "") AS clase, g.codigo AS cod_grupo, g.grupo AS grupo,CONCAT("",' ', "") AS cod_cuenta,CONCAT("",' ', "") AS cuenta,CONCAT("",' ', "") AS cod_subcuenta,CONCAT("",' ', "") AS subcuenta,CONCAT("",' ', "") AS cod_auxiliar,CONCAT("",' ', "") AS auxiliar,CONCAT("",' ', "") AS cod_subauxiliar,CONCAT("",' ', "") AS subauxiliar from grupos g
UNION
select CONCAT("",' ', "") AS cod_clase, CONCAT("",' ', "") AS clase,CONCAT("",' ', "") AS cod_grupo,CONCAT("",' ', "") AS grupo,ct.codigo AS cod_cuenta,ct.cuenta AS cuenta,CONCAT("",' ', "") AS cod_subcuenta,CONCAT("",' ', "") AS subcuenta,CONCAT("",' ', "") AS cod_auxiliar,CONCAT("",' ', "") AS auxiliar,CONCAT("",' ', "") AS cod_subauxiliar,CONCAT("",' ', "") AS subauxiliar from cuentas ct
*/

/*
CREATE VIEW cuentas_relacionadas as
SET @numero=0;
select @numero:=@numero+1 AS `posicion`, c.codigo as cod_clase, c.clase as clase,CONCAT("",' ', "") AS cod_grupo,CONCAT("",' ', "") AS grupo,CONCAT("",' ', "") AS cod_cuenta,CONCAT("",' ', "") AS cuenta,CONCAT("",' ', "") AS cod_subcuenta,CONCAT("",' ', "") AS subcuenta,CONCAT("",' ', "") AS cod_auxiliar,CONCAT("",' ', "") AS auxiliar,CONCAT("",' ', "") AS cod_subauxiliar,CONCAT("",' ', "") AS subauxiliar from clases c 
UNION
select @numero:=@numero+1 AS `posicion`, c.codigo AS cod_clase, c.clase AS clase, g.codigo AS cod_grupo, g.grupo AS grupo,CONCAT("",' ', "") AS cod_cuenta,CONCAT("",' ', "") AS cuenta,CONCAT("",' ', "") AS cod_subcuenta,CONCAT("",' ', "") AS subcuenta,CONCAT("",' ', "") AS   cod_auxiliar,CONCAT("",' ', "") AS auxiliar,CONCAT("",' ', "") AS cod_subauxiliar,CONCAT("",' ', "") AS subauxiliar from grupos g JOIN clases c on g.clase_id = c.id 
UNION
select @numero:=@numero+1 AS `posicion`, cl.codigo AS cod_clase, cl.clase AS clase,g.codigo AS cod_grupo,g.grupo AS grupo,ct.codigo AS cod_cuenta,ct.cuenta AS cuenta,CONCAT("",' ', "") AS cod_subcuenta,CONCAT("",' ', "") AS subcuenta,CONCAT("",' ', "") AS cod_auxiliar,CONCAT("",' ', "") AS auxiliar,CONCAT("",' ', "") AS cod_subauxiliar,CONCAT("",' ', "") AS subauxiliar from cuentas ct JOIN grupos g ON ct.grupo_id = g.id JOIN clases cl ON g.clase_id = cl.id
UNION
select @numero:=@numero+1 AS `posicion`, cl.codigo AS cod_clase, cl.clase AS clase,g.codigo AS cod_grupo,g.grupo AS grupo,ct.codigo AS cod_cuenta,ct.cuenta AS cuenta,sct.codigo AS cod_subcuenta,sct.subcuenta AS subcuenta,CONCAT("",' ', "") AS cod_auxiliar,CONCAT("",' ', "") AS auxiliar,CONCAT("",' ', "") AS cod_subauxiliar,CONCAT("",' ', "") AS subauxiliar from subcuentas sct JOIN cuentas ct ON sct.cuenta_id = ct.id JOIN grupos g ON ct.grupo_id = g.id JOIN clases cl ON g.clase_id = cl.id
UNION
select @numero:=@numero+1 AS `posicion`, c.codigo AS cod_clase, c.clase AS clase,g.codigo AS cod_grupo,g.grupo AS grupo,ct.codigo AS cod_cuenta,ct.cuenta AS cuenta,sct.codigo AS cod_subcuenta,sct.subcuenta AS subcuenta,a.codigo AS cod_auxiliar,a.auxiliar AS auxiliar,CONCAT("",' ', "") AS cod_subauxiliar,CONCAT("",' ', "") AS subauxiliar from auxiliars a JOIN subcuentas sct on a.subcuenta_id = sct.id JOIN cuentas ct ON sct.cuenta_id = ct.id JOIN grupos g ON ct.grupo_id = g.id JOIN clases c ON g.clase_id = c.id
UNION
select @numero:=@numero+1 AS `posicion`, 
cc.codigo AS cod_clase, cc.clase AS clase,g.codigo AS cod_grupo,g.grupo AS grupo,ct.codigo AS cod_cuenta,ct.cuenta AS cuenta,
sbc.codigo AS cod_subcuenta,sbc.subcuenta AS subcuenta,a.codigo AS cod_auxiliar,a.auxiliar AS auxiliar,sba.codigo AS cod_subauxiliar,sba.subauxiliar AS subauxiliar from subauxiliars sba JOIN auxiliars a on sba.auxiliar_id = a.id JOIN subcuentas sbc ON a.subcuenta_id = sbc.id JOIN cuentas ct ON sbc.cuenta_id = ct.id JOIN grupos g ON ct.grupo_id = g.id JOIN clases cc ON g.clase_id = cc.id
*/
/*
CREATE VIEW cuentas_relacionadas as
select c.codigo as cod_clase, c.clase as clase,CONCAT("",' ', "") AS cod_grupo,CONCAT("",' ', "") AS grupo,CONCAT("",' ', "") AS cod_cuenta,CONCAT("",' ', "") AS cuenta,CONCAT("",' ', "") AS cod_subcuenta,CONCAT("",' ', "") AS subcuenta,CONCAT("",' ', "") AS cod_auxiliar,CONCAT("",' ', "") AS auxiliar,CONCAT("",' ', "") AS cod_subauxiliar,CONCAT("",' ', "") AS subauxiliar from clases c 
UNION
select c.codigo AS cod_clase, c.clase AS clase, g.codigo AS cod_grupo, g.grupo AS grupo,CONCAT("",' ', "") AS cod_cuenta,CONCAT("",' ', "") AS cuenta,CONCAT("",' ', "") AS cod_subcuenta,CONCAT("",' ', "") AS subcuenta,CONCAT("",' ', "") AS   cod_auxiliar,CONCAT("",' ', "") AS auxiliar,CONCAT("",' ', "") AS cod_subauxiliar,CONCAT("",' ', "") AS subauxiliar from grupos g JOIN clases c on g.clase_id = c.id 
UNION
select cl.codigo AS cod_clase, cl.clase AS clase,g.codigo AS cod_grupo,g.grupo AS grupo,ct.codigo AS cod_cuenta,ct.cuenta AS cuenta,CONCAT("",' ', "") AS cod_subcuenta,CONCAT("",' ', "") AS subcuenta,CONCAT("",' ', "") AS cod_auxiliar,CONCAT("",' ', "") AS auxiliar,CONCAT("",' ', "") AS cod_subauxiliar,CONCAT("",' ', "") AS subauxiliar from cuentas ct JOIN grupos g ON ct.grupo_id = g.id JOIN clases cl ON g.clase_id = cl.id
UNION
select cl.codigo AS cod_clase, cl.clase AS clase,g.codigo AS cod_grupo,g.grupo AS grupo,ct.codigo AS cod_cuenta,ct.cuenta AS cuenta,sct.codigo AS cod_subcuenta,sct.subcuenta AS subcuenta,CONCAT("",' ', "") AS cod_auxiliar,CONCAT("",' ', "") AS auxiliar,CONCAT("",' ', "") AS cod_subauxiliar,CONCAT("",' ', "") AS subauxiliar from subcuentas sct JOIN cuentas ct ON sct.cuenta_id = ct.id JOIN grupos g ON ct.grupo_id = g.id JOIN clases cl ON g.clase_id = cl.id
UNION
select c.codigo AS cod_clase, c.clase AS clase,g.codigo AS cod_grupo,g.grupo AS grupo,ct.codigo AS cod_cuenta,ct.cuenta AS cuenta,sct.codigo AS cod_subcuenta,sct.subcuenta AS subcuenta,a.codigo AS cod_auxiliar,a.auxiliar AS auxiliar,CONCAT("",' ', "") AS cod_subauxiliar,CONCAT("",' ', "") AS subauxiliar from auxiliars a JOIN subcuentas sct on a.subcuenta_id = sct.id JOIN cuentas ct ON sct.cuenta_id = ct.id JOIN grupos g ON ct.grupo_id = g.id JOIN clases c ON g.clase_id = c.id
UNION
select
cc.codigo AS cod_clase, cc.clase AS clase,g.codigo AS cod_grupo,g.grupo AS grupo,ct.codigo AS cod_cuenta,ct.cuenta AS cuenta,
sbc.codigo AS cod_subcuenta,sbc.subcuenta AS subcuenta,a.codigo AS cod_auxiliar,a.auxiliar AS auxiliar,sba.codigo AS cod_subauxiliar,sba.subauxiliar AS subauxiliar from subauxiliars sba JOIN auxiliars a on sba.auxiliar_id = a.id JOIN subcuentas sbc ON a.subcuenta_id = sbc.id JOIN cuentas ct ON sbc.cuenta_id = ct.id JOIN grupos g ON ct.grupo_id = g.id JOIN clases cc ON g.clase_id = cc.id
*/
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
