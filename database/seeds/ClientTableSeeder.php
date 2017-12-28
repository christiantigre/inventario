<?php

use Illuminate\Database\Seeder;
use App\Cliente;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create( [
'id'=>1,
'nom_cli'=>'CONSUMIDOR FINAL',
'ced_cli'=>'0000000000',
'ruc_cli'=>'0000000000000',
'dir_cli'=>'Jaime Roldós y Manuel Moreno',
'activo'=>1,
'id_pais'=>1,
'id_provincia'=>1,
'id_canton'=>1
] );

        Cliente::create( [
'id'=>2,
'created_at'=>'2017-12-26 16:28:55',
'updated_at'=>'2017-12-26 16:28:55',
'nom_cli'=>'Christian',
'app_cli'=>'Tigre',
'ced_cli'=>'0105118509',
'ruc_cli'=>'0105118509001',
'dir_cli'=>'Jaime Roldós y Manuel Moreno',
'mail_cli'=>'andrescondo17@gmail.com',
'tlf_cli'=>'2203 584',
'wts_cli'=>'0992702599',
'clmovi_cli'=>'0992702599',
'clclr_cli'=>'0992702599',
'activo'=>1,
'id_pais'=>1,
'id_provincia'=>1,
'id_canton'=>1
] );

			

Cliente::create( [
'id'=>3,
'created_at'=>'2017-12-26 20:52:26',
'updated_at'=>'2017-12-26 20:52:26',
'nom_cli'=>'Andres',
'app_cli'=>'Condo',
'ced_cli'=>'0105118508',
'ruc_cli'=>'0105118508001',
'dir_cli'=>'Cuenca',
'mail_cli'=>'andrestigre69@gmail.com',
'tlf_cli'=>NULL,
'wts_cli'=>NULL,
'clmovi_cli'=>NULL,
'clclr_cli'=>NULL,
'activo'=>1,
'id_pais'=>1,
'id_provincia'=>1,
'id_canton'=>1
] );
    }
}
