<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'grupos';

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
    protected $fillable = ['grupo', 'codigo', 'detall', 'activo', 'clase_id'];

    public function clase()
	{
		return $this->belongsTo('App\clase');
	}
	
}
