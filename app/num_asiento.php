<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class num_asiento extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'num_asientos';

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
    protected $fillable = ['num_asiento', 'concepto', 'periodo', 'fecha', 'saldo_debe','activo','responsable', 'saldo_haber', 'almacen_id'];

    public function Almacen()
	{
		return $this->belongsTo('App\Almacen');
	}
	
}
