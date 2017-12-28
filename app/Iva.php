<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iva extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ivas';

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
    protected $fillable = ['iva', 'activo'];

    
}
