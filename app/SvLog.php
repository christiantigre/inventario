<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SvLog extends Model
{
    public function scopelog($query, $mensaje,$area){
		
		$date = Carbon::now();
		$date->timezone = new \DateTimeZone('America/Guayaquil');
		$datesegundos = Carbon::now();
		$datesegundos -> toDateTimeString();

		$date = $date->format('m-d-Y');

		$rutai = public_path();
		$ruta = str_replace("//", "//", $rutai);
		$dir = $ruta.'//logs//';
		$nombre_archivo = $dir;
		//$usuario = \Auth::user()->name;
        $name_usuario = auth('person')->user()->name;
        $mail_usuario = auth('person')->user()->email;
		$usuario = ($name_usuario).'-'.$mail_usuario;
		$mensaje = $area.' '.$usuario.' '.$mensaje;

		if($archivo = fopen($nombre_archivo.'/'.$date, "a")){
			if(fwrite($archivo, "# ".$datesegundos. " ". $mensaje. "\n")){
				$res  = "Registrado un evento";
			}else{
				$res = "Problema al crear el archivo";
			}
			fclose($archivo);
		}  
        return $res;
    }
}
