<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clientes';

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
    protected $fillable = ['nom_cli', 'app_cli', 'ced_cli', 'ruc_cli', 'dir_cli', 'mail_cli', 'tlf_cli', 'wts_cli', 'clmovi_cli', 'clclr_cli', 'activo', 'id_pais', 'id_provincia', 'id_canton'];

    
}
