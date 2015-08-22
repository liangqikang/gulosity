<?php

include_once app_path().'/controllers/Common.php';

class OrderController extends BaseController {

	public function showMenu()
	{
		$user = Session::get('user');
		if(empty($user)) {
		 	//跳转到授权页
		 	Session::put('targetUrl', '/menu');
		 	return Redirect::to(WX_OAUTH_URL);
		}
		$foods = Food::where('id', '<>', 0)->orderBy('order_by', 'asc')->get();
		$rice = array();
		$noodles = array();
		$drink = array();
		$plus = array();
		foreach ($foods as $key => &$value) {
			if(!empty($value->image))
				$value['image'] = substr($value['image'], 0, strlen($value['image']) - 3).'jpg';
			if($value->type == 1) {
				$rice[$key] = $value;			
			}
			else if($value->type == 2){
				$noodles[$key] = $value;
			}
			else if($value->type == 3){
				$drink[$key] = $value;
			}
			else if($value->type == 4){
				$plus[$key] = $value;
			}
		}
		$foods = array('rice' => $rice, 'noodles' => $noodles, 'drink' => $drink, 'plus' => $plus);

    	return View::make('menu')->with('foods', $foods);
   	}

	public function order()
	{	
		$user = Session::get('user');
		if(empty($user)) {
		 	//跳转到授权页
		 	Session::put('targetUrl', '/order/choose');
		 	return Redirect::to(WX_OAUTH_URL);
		 }
		
		 $allfoods = Food::all();
		

		 $user = Session::get('user');
		 if (empty($user)) {
		 	return Redirect::to('menu');
		 }
		 $address = null;
		 try {
		 	$address = Address::where('user_id', '=', $user['id'])->firstOrFail();
		 } catch (Exception $e) {
			 
		 }
		$todayBegin = date('Y-m-d 00:00:00');
        $todayEnd = date('Y-m-d 23:59:59');

        $lottery = DB::table('lottery')
            ->where('user_id', $user['id'])
            ->where('used', 0)
            ->whereBetween('created_at', array($todayBegin, $todayEnd))->first();
		$prize = 0;
		if(!empty($lottery)){
			$prize = $lottery->prize;
		}	                
        // $user = null; $address = null;
		$attr = array('user' => $user, 'address' => $address, 'prize' => $prize);
		return View::make('order')->with('attr', $attr);
	}

	public function createOrder()
	{
		$vals = Input::all();
		$foods = array();
		$addressid = Input::get('addressid');
		$paytype = Input::get('paytype');
		$comment = Input::get('comment');
		$fapiao = Input::get('fapiao');
		$fapiaotype = Input::get('fapiaotype');
		$fapiaocompany = Input::get('fapiaocompany');
		$dtimetype = Input::get('dtimetype');
		$ddate = Input::get('ddate');
		$dtime = Input::get('dtime');
		$totalprice = Input::get('allprice');
		$prize = Input::get('prize');
		$deliverytime = $dtimetype == '0' ? 0 : $ddate.' '.$dtime;
		$fapiaotype = $fapiao == 'on' ? $fapiaotype : 0;
		$fapiaocompany = $fapiao == 'on' ? $fapiaocompany : '';
		
		commonLog(json_encode($vals), '');
		// 生单
		$user = Session::get('user');
		if (empty($user)) {
			return Redirect::action('OrderController@showMenu');
		}
		$orderno = genOrderNo($user);
		$today1 = date('Y-m-d 00:00:00');
		$today2 = date('Y-m-d 00:00:00', strtotime('+1 day'));
		$num = DB::table('order')->whereBetween('created_at', array($today1,$today2))->max('num');
		$order = Order::create(array(
			'user_id' => $user['id'],
			'order_no' => $orderno,
			'num' => $num+1,
			'status' => ORDER_STATUS_CREATED,
			'pay_status' => PAY_STATUS_NOT,
			'address_id' => $addressid, 
			'pay_type' => $paytype, 
			'fapiao_type' => $fapiaotype, 
			'fapiao_title' => $fapiaocompany, 
			'delivery_time' => $deliverytime, 
			'comment' => $comment, 
			'total_price' => $totalprice,
			'prize' => $prize
			));
		$order->save();
		$todayBegin = date('Y-m-d 00:00:00');
        $todayEnd = date('Y-m-d 23:59:59');

        $lottery = DB::table('lottery')
            ->where('user_id', $user['id'])
            ->where('used', 0)
            ->whereBetween('created_at', array($todayBegin, $todayEnd))->first();
       	if(!empty($lottery)){
	        DB::table('lottery')
	        ->where('id', $lottery->id)
	        ->update(array('used' => 1));
	    }
		$orderFoods = Input::get('orderFoods');
		$orderFoods = json_decode($orderFoods);
		foreach ($orderFoods as $key => $value) {
			if($value->count > 0){
				// $arr = array();
				// foreach ($value->allplus as $kk => $plus) {
				// 	array_push($arr, $plus->name);
				// 	asort($arr);
				// }
				$orderfood = new OrderFood;
				$orderfood->order_id = $order->id;
				$orderfood->food_id = $value->id;
				$orderfood->count = $value->count;
				$orderfood->allplus = $value->allplusstr;
				$orderfood->save();
			}
		}
		if($paytype == '2'){
			//微信支付
			commonLog("微信支付：orderno->".$orderno.',total_fee->'.$totalprice);
			return Redirect::action("PayController@weixinPay", array('body' => '食品', 'orderno' => $orderno, 'total_fee' => $totalprice, 'attach' => WX_FEE_TYPE_PAY));
		}
		if($paytype == '3'){
			//会员支付
			commonLog("会员支付：orderno->".$orderno.',total_fee->'.$order->total_price);
			return Redirect::to("/vip/pay?orderno=".$orderno."&money=".$order->total_price);
		}
		return Redirect::action("OrderController@orderDetail", array('orderno' => $orderno));
	}

	public function payAgain()
	{
		$orderno = Input::get('orderno');
		$paytype = Input::get('paytype');
		
		$user = Session::get('user');
		if (empty($user)) {
			return Redirect::action('OrderController@showMenu');
		}
		commonLog('订单：'.$orderno.'进行支付，支付方式'.$paytype, $user->wechat_id);
		$order = null;
		try {
			$order = Order::where('order_no', '=', $orderno)->firstOrFail();
			if(empty($order)){
				return Redirect::to('menu');
			}				
		} catch (Exception $e) {
			return Redirect::to('menu');
		}
		if($paytype == '1'){
			try {
				$order['pay_type'] = $paytype;
				$order->update();
			} catch (Exception $e) {
				return Redirect::to('menu');
			}
		}

		if($paytype == '2'){
			//微信支付
			commonLog("微信支付：orderno->".$orderno.',total_fee->'.$order->total_price);
			return Redirect::action("PayController@weixinPay", array('body' => '食品', 'orderno' => $orderno, 'total_fee' => $order->total_price, 'attach' => WX_FEE_TYPE_PAY));
		}
		if($paytype == '3'){
			//会员支付
			commonLog("会员支付：orderno->".$orderno.',total_fee->'.$order->total_price);
			return Redirect::to("/vip/pay?orderno=".$orderno."&money=".$order->total_price);
		}
		return Redirect::action("OrderController@orderDetail", array('orderno' => $orderno));
	}

	public function queryOrder()
	{
		$user = Session::get('user');
		if(empty($user)) 
		{
			//将表单数据存session，跳转到授权页
			Session::flash('targetUrl', '/orderlist');
			return Redirect::to(WX_OAUTH_URL);
		}
		$orders = null;
		try {
			$orders = Order::where('user_id', '=', $user['id'])->orderBy('created_at', 'desc')->take(5)->get();
		} catch (Exception $e) {
			
		}
		foreach ($orders as &$value) {
			handleOrderStatus($value);
		}
		return View::make('orderlist')->with('orders', $orders);
	}

	public function orderDetail()
	{
		$orderNo = Input::get('orderno');
		$order = null;
		try {
			$order = Order::where('order_no', '=', $orderNo)->firstOrFail();
		} catch (Exception $e) {
			
		}
		$foods = $order->foods;
		$attr = array();
		$user = Session::get('user');
		if (empty($user)) {
			return Redirect::action('OrderController@queryOrder');
		}
		$address = null;
		$rice = array();
		$noodles = array();
		$drink = array();
		$money = $order->total_price;
		if(!empty($foods))
		{
			foreach ($foods as $key => &$value) {
				$value['count'] = $value->pivot->count;
				$value['allplus'] = $value->pivot->allplus;
				if($value->type == 1) {
					$rice[$key] = $value;			
				}
				else if($value->type == 2){
					$noodles[$key] = $value;
				}
				else if($value->type == 3){
					$drink[$key] = $value;
				}
				// $money += $value->price * $value->count;
			}
			
			try {
				$address = Address::find($order->address_id);
			} catch (Exception $e) {
				
			}
			
		}
		handleOrderStatus($order);
		$attr = array('rice' => $rice, 'noodles' => $noodles, 'drink' => $drink,
			'user' => $user, 'address' => $address, 'money' => $money, 'order' => $order);

		return View::make('orderdetail')->with('attr', $attr);
	}

	public function cancelOrder()
	{
		$orderNo = Input::get('orderno');
		$order = null;
		try {
			$order = Order::where('order_no', '=', $orderNo)->firstOrFail();
		} catch (Exception $e) {
			
		}
		$user = Session::get('user');
		if (empty($user)) {
			return Redirect::action('OrderController@queryOrder');
		}
		
		if(!empty($order)) {
			commonLog('1:User'.$user->wechat_id.' cancel the order:'.$order->order_no, $user->user_id);			
			$order['status'] = ORDER_STATUS_CANCEL;
			try {
				$order->update();
			} catch (Exception $e) {
				return Redirect::to('menu');
			}
		}

		handleOrderStatus($order);

		return Redirect::to('/order/orderdetail?orderno='.$orderNo);
	}


}
function genOrderNo($user) {
	if(!empty($user))
	{
		return substr($user['wechat_id'],-2).substr(date('YmdHi',time()), 2).rand(1,9);
	}
}

