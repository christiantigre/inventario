<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    
    protected $table = 'plan_contable';

    /**
    * The database primary key value.
    *
    * @var string
    */

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cod', 'cuenta'];

    
}
