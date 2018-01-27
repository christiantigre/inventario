<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detall_asiento extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'detall_asientos';

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
    protected $fillable = ['num_asiento', 'cod_cuenta', 'cuenta', 'periodo', 'fecha', 'saldo_debe', 'saldo_haber', 'almacen_id', 'cuenta_id', 'asiento_id'];

    public function Almacen()
    {
        return $this->belongsTo('App\Almacen');
    }

    public function num_asiento()
    {
        return $this->belongsTo('App\num_asiento');
    }

    public function Plan()
    {
        return $this->belongsTo('App\Plan');
    }
}
