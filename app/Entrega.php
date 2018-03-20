<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'entregas';

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
    protected $fillable = ['metodo', 'detalle', 'activo'];

    public function venta(){
        return $this->hasMany(Ventum::class);
    }
    
}
