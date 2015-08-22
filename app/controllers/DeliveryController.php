<?php

class DeliveryController extends BaseController {

	public function showMenu()
	{
		$foods = Food::all();

    	return View::make('menu')->with('foods', $foods);
   	}

	public function order()
	{	
		$user = User::find(1);
		$foods = Food::all();
		$money = 0;
		foreach ($foods as $key => $value) {
			$money = $money + $value->price;
		}
		$address = '北京市 东城区 光熙门北里26号楼1002';
		$attr = array('user' => $user, 'foods' => $foods, 'address' => $address, 'money' => $money);
		return View::make('order')->with('attr', $attr);
	}

	public function createOrder()
	{
		$vals = $input = Input::all();
		$foods = array();
		$addressid = Input::get('addressid');
		$paytype = Input::get('paytype');
		$comment = Input::get('comment');
		$totalprice = Input::get('allprice');
		
		// 生单
		$orderno = time();
		$order = Order::create(array(
			'user_id' => '1',
			'order_no' => $orderno,
			'status' => '0',
			'pay_status' => '0',
			'address_id' => $addressid, 
			'pay_type' => $paytype, 
			'comment' => $comment, 
			'total_price' => $totalprice
			));
		$order->save();
		foreach ($vals as $key => $value) {
			// Log::info($key.': '.$value);
			$tmp = explode('food-', $key);
			if(count($tmp) > 1){
				$orderfood = new OrderFood;
				$orderfood->order_no = $orderno;
				$orderfood->food_id = end($tmp);
				$orderfood->count = $value;
				$orderfood->save();
				Log::info($orderfood);
			}
		}
		return $order;
	}

}