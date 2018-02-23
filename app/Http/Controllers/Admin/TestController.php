<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CtasGrupos;

class TestController extends Controller
{
	public function index($cod){
		/*
		$columns = ['cod_cuenta','cod_subcuenta','cod_auxiliar','cod_subauxiliar'];
		$term = $cod;
		$words_search = explode(" ",$term);
		$posts = CtasGrupos::from('ctas_group as a')
		->where(function ($query) use ($columns,$words_search) {
			foreach ($words_search as $word) {
				$query = $query->where(function ($query) use ($columns,$word) {
					foreach ($columns as $column) {
						$query->orWhere($column,'like',"%$word%");
					}
				});
			}
		});
		$posts = $posts->where('a.periodo','=',2018)
		->get();
		*/
		$search = $cod;
$posts = CtasGrupos::from('ctas_group as a')
    ->where(function ($query) use ($search) {
      $query = $query->orWhere('a.cod_cuenta','like',"$search");
      $query = $query->orWhere('a.cod_subcuenta','like',"$search");
      $query = $query->orWhere('a.cod_auxiliar','like',"$search");
      $query = $query->orWhere('a.cod_subauxiliar','like',"$search");
    });
//$posts = $posts->where('a.periodo','=',2018)
$posts = $posts->first();
    dd($posts);
	}
}
