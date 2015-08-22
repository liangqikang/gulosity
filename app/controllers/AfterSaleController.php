<?php
include_once app_path().'/controllers/Common.php';

class AfterSaleController extends BaseController {

	public function notify()
	{
		$all = Input::all();
		commonLog('aftersale:'.json_encode($all));
		return "success";	
   	}

}