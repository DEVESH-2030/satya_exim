<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;




	public function rating_calculation($rating_array)
	{

		$data = [];

		foreach ($rating_array as $key => $value) {
		$data[] = $value->rating;
		# code...
		}


		//dd($rating_array);
		if($data){
		$total = array_sum($data);
		$avg = $total/count($data);

		return number_format((float)$avg, 1, '.', '');
		}else{
		return '0';
		}
	}
	
}
