<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

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
    protected $fillable = ['category', 'detall', 'activo'];

    /**
    Campo protejido soft-delete
    */
    protected $dates = ['deleted_at'];

    public function subcategoria(){
        return $this->hasMany(Subcategory::class);
    }

    public function producto(){
        return $this->hasMany(Product::class);
    }
    
}
