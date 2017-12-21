<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canton extends Model
{
	protected $table = 'cantons';
	
    protected $fillable = [
        'canton', 'cod_postal', 'latitud','longitud','provincia_id'
    ];

    public function parroquias(){
    	return $this->hasMany(Parroquias::class);
    }

    public function provincia(){
    	return $this->belongsTo(Provincias::class);
    }

    public static function canton($id){
        return Canton::where('provincia_id','=',$id)
        ->get();
    }

    public function proveedor(){
        return $this->hasMany(Proveedor::class);
    } 

}
