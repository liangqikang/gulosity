<?php
include_once app_path().'/controllers/Common.php';

class MonitorController extends BaseController {

	
	public function notify()
	{
		$all = Input::all();
		commonLog('monitor:'.json_encode($all));

		return "success";	
   	}

}