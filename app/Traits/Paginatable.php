<?php

namespace App\Traits;
use App\Models\Setting;


trait Paginatable
{
	protected $perPageMax = 5;

	public function returnPageSize(){
		// $pagesize = Setting::where('key','page_setting')->value('value');
		$pagesize=10;
		if(isset($pagesize) && $pagesize != 0)
		{
			return $pagesize;
		}
		else {
			return $this->perPageMax;
		}
	}
}
?>
