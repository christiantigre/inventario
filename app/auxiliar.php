<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class auxiliar extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'auxiliars';

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
    protected $fillable = ['auxiliar','secuencia', 'codigo', 'detall', 'activo', 'subcuenta','subcuenta_id'];

    public function Subcuenta()
	{
		return $this->belongsTo('App\subcuentum');
	}
	
}
