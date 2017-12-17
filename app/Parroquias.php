<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parroquias extends Model
{
	protected $table = 'parroquias';

    protected $fillable = [
        'parroquia', 'cod_postal', 'latitud','longitud','canton_id'
    ];

    public function pais(){
    	return $this->belongsTo(Pais::class);
    }

    public function canton(){
    	return $this->belongsTo(Canton::class);
    }
    public function almacen()
    {
        return $this->hasMany('App\Almacen', 'id');
    }
    
}
