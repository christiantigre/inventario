<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'proveedors';

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
    protected $fillable = ['proveedor', 'dir', 'tlfn', 'cel_movi', 'cel_claro', 'watsapp', 'fax', 'mail', 'web', 'ruc', 'representante', 'actividad', 'logo', 'id_pais', 'id_provincia', 'id_canton', 'status', 'empresa', 'ubicacion', 'latitud', 'longitud'];



    public function producto(){
        return $this->hasMany(Product::class);
    }    

    public function Pais()
    {
        return $this->belongsTo('App\Pais','id_pais');
    }

    public function Provincia()
    {
        return $this->belongsTo('App\Provincias','id_provincia');
    }

    public function Canton()
    {
        return $this->belongsTo('App\Canton','id_canton');
    }
    
}
