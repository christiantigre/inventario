<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'almacens';

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
    protected $fillable = ['almacen', 'propietario', 'gerente', 'pag_web', 'razon_social', 'ruc', 'email', 'fecha_inicio', 'logo', 'name_logo', 'activo', 'telefono', 'cel_movi', 'cel_claro', 'watsapp', 'fb', 'tw', 'ins', 'gg', 'funcion_empresa', 'dir', 'latitud', 'longitud', 'pais_id', 'provincia_id'];

    public function almacen()
	{
		return $this->belongsTo('App\Almacen');
	}
	
}
