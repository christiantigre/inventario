<?php

use Illuminate\Database\Seeder;
use App\Perfil;

class PerfilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Perfil::create( [
    		'id'=>1,
    		'nombre'=>'Christian Andres',
    		'apellido'=>'Tigre Condo',
    		'cedula'=>'0105118509',
    		'ruc'=>'0105118509002',
    		'telefono'=>'2203-584',
    		'celular'=>'0992702599',
    		'email'=>'andrescondo17@gmail.com',
    		'fecha_nacimiento'=>'1991/12/17',
    		'estado_civil'=>'1',
    		'genero'=>'0',
    		'foto'=>'uploads\\perfil\\63207.php-code.jpg',
    		'tipo_usuario'=>'admin',
    		'id_usuario'=>'1',
    		'titulo'=>'Developer Software',
    		'created_at'=>'2018-02-20 15:48:44',
    		'updated_at'=>'2018-02-20 16:03:09'
    	] );
    }
}
