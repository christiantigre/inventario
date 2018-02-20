<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfils';

    protected $fillable = [
        'nombre', 'apellido', 'cedula','ruc','telefono','celular','email','fecha_nacimiento','estado_civil','genero','foto','tipo_usuario','id_usuario','titulo'
    ];
}
