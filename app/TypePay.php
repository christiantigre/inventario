<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypePay extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'type_pays';

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
    protected $fillable = ['type', 'status'];

    public function venta(){
        return $this->hasMany(Ventum::class);
    } 

}
