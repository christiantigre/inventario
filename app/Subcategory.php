<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subcategories';

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
    protected $fillable = ['subcategory', 'content', 'active', 'category_id'];
    /**
    Campo protejido soft-delete
    */
    protected $dates = ['deleted_at'];

    public function Category()
	{
		return $this->belongsTo('App\Category');
	}

    public static function subcategory($id){
        return Subcategory::where('category_id','=',$id)->get();
    }

    public function producto(){
        return $this->hasMany(Product::class);
    }
	
}
