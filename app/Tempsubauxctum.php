<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tempsubauxctum extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tempsubauxctas';

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
    protected $fillable = ['subauxiliar', 'secuencia', 'codigo', 'detall', 'activo', 'auxiliar', 'auxiliar_id'];

    public function auxiliar()
	{
		return $this->belongsTo('App\auxiliar');
	}
	
}
