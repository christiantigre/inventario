<?php

use Illuminate\Database\Seeder;
use App\Provincias as Provincia;

class ProvinciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	

    	Provincia::create( [
    		'id'=>1,
    		'provincia'=>'AZUAY',
    		'cod_prov'=>'01',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>2,
    		'provincia'=>'BOLIVAR',
    		'cod_prov'=>'02',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>3,
    		'provincia'=>'CAÑAR',
    		'cod_prov'=>'03',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>4,
    		'provincia'=>'CARCHI',
    		'cod_prov'=>'04',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>5,
    		'provincia'=>'COTOPAXI',
    		'cod_prov'=>'05',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>6,
    		'provincia'=>'CHIMBORAZO',
    		'cod_prov'=>'06',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>7,
    		'provincia'=>'EL ORO',
    		'cod_prov'=>'07',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>8,
    		'provincia'=>'ESMERALDAS',
    		'cod_prov'=>'08',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>9,
    		'provincia'=>'GUAYAS',
    		'cod_prov'=>'09',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>10,
    		'provincia'=>'IMBABURA',
    		'cod_prov'=>'10',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>11,
    		'provincia'=>'LOJA',
    		'cod_prov'=>'11',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>12,
    		'provincia'=>'LOS RIOS',
    		'cod_prov'=>'12',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>13,
    		'provincia'=>'MANABI',
    		'cod_prov'=>'13',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>14,
    		'provincia'=>'MORONA SANTIAGO',
    		'cod_prov'=>'14',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>15,
    		'provincia'=>'NAPO',
    		'cod_prov'=>'15',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>16,
    		'provincia'=>'PASTAZA',
    		'cod_prov'=>'16',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>17,
    		'provincia'=>'PICHINCHA',
    		'cod_prov'=>'17',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>18,
    		'provincia'=>'TUNGURAHUA',
    		'cod_prov'=>'18',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>19,
    		'provincia'=>'ZAMORA CHINCHIPE',
    		'cod_prov'=>'19',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>20,
    		'provincia'=>'GALAPAGOS',
    		'cod_prov'=>'20',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>21,
    		'provincia'=>'SUCUMBIOS',
    		'cod_prov'=>'21',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>22,
    		'provincia'=>'ORELLANA',
    		'cod_prov'=>'22',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>23,
    		'provincia'=>'SANTO DOMINGO DE LOS TSACHILAS',
    		'cod_prov'=>'23',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>24,
    		'provincia'=>'SANTA ELENA',
    		'cod_prov'=>'24',
    		'pais_id'=>1
    	] );

    	

    	Provincia::create( [
    		'id'=>25,
    		'provincia'=>'ZONAS NO DELIMITADAS',
    		'cod_prov'=>'90',
    		'pais_id'=>1
    	] );

    	


    }
}
