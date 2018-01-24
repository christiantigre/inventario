<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clase extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clases';

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
    protected $fillable = ['clase', 'codigo', 'detall', 'activo'];

    public function grupo(){
        return $this->hasMany(Grupo::class);
    }
    
}
