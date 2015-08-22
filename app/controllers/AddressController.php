<?php
include_once app_path().'/controllers/Common.php';

class AddressController extends BaseController {

	public function newAddress()
	{	
		Session::flash('targetUrl', Input::get('targetUrl'));
		Session::flash('targetUrl', Input::get('targetUrl'));
		return View::make('addressform');
	}

	public function chooseAddress()
	{
		$user = Session::get('user');
		if (empty($user)) {
			return Redirect::action('OrderController@showMenu');
		}
		$addrs = Address::where('user_id', '=', $user->id)->orderBy('id', 'desc')->get();
		$arr = array();
		foreach ($addrs as $key => $value) {
			$addr = array('id'=>$value->id,'address'=>$value->address,
					'user_name'=>$value->user_name,'tel'=>$value->tel,
					);
			$arr[$value->id] = $addr;
		}
		return Response::json($arr);
	}

	public function createAddress()
	{
		$user = Session::get('user');
		if (empty($user)) {
			return Redirect::action('OrderController@showMenu');
		}
		$aid = Input::get('aid');
		$addr = Address::find($aid);
		if(empty($addr)){
			$addr = new Address;
		}
		$addr->user_id = $user->id;
		$addr->address = Input::get('city').Input::get('area').Input::get('address');
		$addr->user_name = Input::get('username');
		$addr->tel = Input::get('tel');
		$addr->save();
		return "SUCCESS";
	}

	public function delAddress()
	{
		$user = Session::get('user');
		if (empty($user)) {
			return Redirect::action('OrderController@showMenu');
		}
		$id = Input::get("aid");
		$addr = Address::find($id);
		if(!empty($addr)){
			$addr->delete();
			return "SUCCESS";
		}
		return "FAILED";
	}
}