<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subcuentum extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subcuentas';

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
    protected $fillable = ['subcuenta','secuencia', 'codigo', 'detall', 'activo', 'cuenta','cuenta_id'];

    public function Cuenta()
	{
		return $this->belongsTo('App\Cuentum');
	}
	
}
