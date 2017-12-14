<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
	protected $table = 'paises';

    protected $fillable = [
        'pais', 'cod_postal', 'latitud','longitud','status'
    ];

    public function provincias(){
    	return $this->hasMany(Provincia::class);
    }

    public function almacen()
    {
        return $this->hasMany('App\Almacen', 'id');
    }
    
}
