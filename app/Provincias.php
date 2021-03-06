<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincias extends Model
{
	protected $table = 'provincias';

    protected $fillable = [
        'provincia', 'cod_postal', 'latitud','longitud','pais_id'
    ];

    public function pais(){
    	return $this->belongsTo(Pais::class);
    }

    public function cantones(){
    	return $this->hasMany(Canton::class);
    }

    public function almacen()
    {
        return $this->hasMany('App\Almacen', 'id');
    }
    
    public function proveedor(){
        return $this->hasMany(Proveedor::class);
    } 

}
