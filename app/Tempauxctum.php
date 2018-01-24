<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tempauxctum extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tempauxctas';

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
    protected $fillable = ['auxiliar', 'secuencia', 'codigo', 'detall', 'activo', 'subcuenta', 'subcuenta_id'];

    public function subcuentas()
	{
		return $this->belongsTo('App\subcuentum');
	}
	
}
