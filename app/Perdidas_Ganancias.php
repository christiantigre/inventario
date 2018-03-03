<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perdidas_Ganancias extends Model
{
    protected $table = 'perdidas_ganancias';

    protected $fillable = [
        'cod_cuenta', 'cuenta'
    ];
}
