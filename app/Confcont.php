<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confcont extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'confconts';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'generar_contabilidad', 
    	'assauto_compras', 
    	'assauto_ventas', 
    	'assauto_pagos', 
    	'assauto_gastos', 
    	'assauto_costos', 
    	'assauto_inversiones', 
    	'assauto_cobros', 
    	'assauto_sueldos', 
    	'assauto_obligaciones', 
    	'assauto_impuestos', 
    	'assauto_servicios', 
    	'assauto_creditos', 
    	'almacen_id', 
    	];

}
