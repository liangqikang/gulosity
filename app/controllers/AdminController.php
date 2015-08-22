<?php
include_once app_path().'/controllers/Common.php';

class AdminController extends BaseController {

	public function admin()
	{	
		return View::make('admin/login');
	}

	public function reset()
	{	
		return View::make('admin/reset');
	}

	public function login()
	{	
		$admin = Session::get('admin');
		if (!empty($admin)) {
			return Redirect::action('AdminController@orders');
		}
		$name = Input::get('name');
		$password = Input::get('password');
		MyLog::create(array('log' => 'admin '.$name.' login with password '.$password,'type' => 10,))->save();			
		if(empty($name) || empty($password)) {
			return Redirect::action('AdminController@admin');
		}			
		$admins = Admin::where('name', '=', $name)->get();
		foreach ($admins as $key => $admin) {
			if($admin->password == $password) {
				MyLog::create(array('log' => 'admin '.$name.' login with password '.$password.' successed','type' => 10,))->save();			
			
				Session::put('admin', $admin);
				return Redirect::action('AdminController@orders');
			}
			continue;
		}
		MyLog::create(array('log' => 'admin '.$name.' login with password '.$password.' failed','type' => 10,))->save();			

		return View::make('admin/login');
	}

	public function changepwd()
	{	
		$admin = Session::get('admin');
		if (empty($admin)) {
			return Response::json(array('status' => -1, 'msg'=>'需要先登录' ));
		}
		// $vals = Input::all();
		// commonLog(var_dump($vals), '');
		$password = Input::get('password');
		$password1 = Input::get('password1');
		$password2 = Input::get('password2');
		if(empty($password) || empty($password1)) {
			return Response::json(array('status' => -1, 'msg'=>'新旧密码均不能为空' ));
		}
		if($password1 != $password2) {
			return Response::json(array('status' => -1, 'msg'=>'两次输入的新密码不一致' ));
		}			
		$admins = Admin::find($admin->id);
		if($admins->password != $password) {
			return Response::json(array('status' => -1, 'msg'=>'旧密码不对' ));
		}
		$admins['password'] = $password1;
		try {
			$admins->update();
			return Response::json(array('status' => 0, 'msg'=>'修改密码成功' ));
		} catch (Exception $e) {
			return Response::json(array('status' => -1, 'msg'=>'修改失败' ));
		}
		return Response::json(array('status' => -1, 'msg'=>'修改失败' ));
	}

	public function orders()
	{
		$admin = Session::get('admin');
		if(empty($admin)) 
		{
			return View::make('admin/login');
		}
		$type = Input::get('type');
		if(empty($type)){
			$type = 'NOT_FINISHED';
		}
		$orders = null;
		$RESETPWD = 0;
		try {
			if($type == 'CANCELED') {
				$orders = Order::where('status', '=', ORDER_STATUS_CANCEL)->orderBy('created_at', 'desc')->take(100)->get();
			}
			else if($type == 'FINISHED') {
				$orders = Order::where('status', '=', ORDER_STATUS_FINISH)->orderBy('created_at', 'desc')->take(100)->get();
			}
			else if($type == 'DELIVERYING') {
				$orders = Order::where('status', '=', ORDER_STATUS_DELIVERYING)->orderBy('created_at', 'desc')->get();
			}
			else if($type == 'MAKING') {
				$orders = Order::where('status', '=', ORDER_STATUS_MAKING)->orderBy('created_at', 'desc')->get();
			}
			else {
				$orders = Order::whereRaw('status = '.ORDER_STATUS_CREATED.' and (pay_status > 0 or pay_type = 1)')->orderBy('created_at', 'desc')->get();
			}
			$CANCELED = Order::where('status', '=', ORDER_STATUS_CANCEL)->count();
			$FINISHED = Order::where('status', '=', ORDER_STATUS_FINISH)->count();
			$DELIVERYING = Order::where('status', '=', ORDER_STATUS_DELIVERYING)->count();
			$MAKING = Order::where('status', '=', ORDER_STATUS_MAKING)->count();
			$NOT_FINISHED = Order::whereRaw('status = '.ORDER_STATUS_CREATED.' and (pay_status > 0 or pay_type = 1)')->count();
			$RESETPWD = VipPwdReset::whereRaw('status = 0')->count();
		} catch (Exception $e) {
			
		}
		foreach ($orders as &$value) {
			handleOrderStatus($value);
		}
		return View::make('admin/orders')->with(array('orders' => $orders, 'type' => $type,
			'NOT_FINISHED'=>$NOT_FINISHED,'CANCELED'=>$CANCELED,'FINISHED'=>$FINISHED,'MAKING'=>$MAKING,
			'DELIVERYING'=>$DELIVERYING,'admin'=>$admin->name, 'RESETPWD'=>$RESETPWD));
	}

	public function orderDetail()
	{
		$admin = Session::get('admin');
		if(empty($admin)) 
		{
			return View::make('admin/login');
		}
		$orderNo = Input::get('orderno');
		$order = null;
		try {
			$order = Order::where('order_no', '=', $orderNo)->firstOrFail();
		} catch (Exception $e) {
			
		}
		$foods = $order->foods;
		$attr = array();
		
		$address = null;
		$rice = array();
		$noodles = array();
		$drink = array();
		$money = $order->total_price;
		$prize = $order->prize;
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
		$type = '';
		switch ($order->status) {
			case ORDER_STATUS_CREATED:
				$type = '客人来的订单';
				break;
			case ORDER_STATUS_MAKING:
				$type = '制作中的订单';
				break;
			case ORDER_STATUS_CANCEL:
				$type = '已取消的订单';
				break;
			case ORDER_STATUS_DELIVERYING:
				$type = '配送中的订单';
				break;
			case ORDER_STATUS_FINISH:
				$type = '已完成的订单';
				break;
			
			default:
				# code...
				break;
		}
		handleOrderStatus($order);
		$attr = array('rice' => $rice, 'noodles' => $noodles, 'drink' => $drink,
			'address' => $address, 'money' => $money, 'prize' => $prize, 'order' => $order, 'type'=>$type,'admin'=>$admin->name);

		return View::make('admin/orderdetail')->with('attr', $attr);
	}

	public function updateOrder()
	{
		$admin = Session::get('admin');
		if(empty($admin)) 
		{
			return View::make('admin/login');
		}
		$orderNo = Input::get('orderno');
		$toStatus = Input::get('status');
		$order = null;
		try {
			$order = Order::where('order_no', '=', $orderNo)->firstOrFail();
		} catch (Exception $e) {
			
		}

		if(!empty($order)) {
			MyLog::create(array('log' => $admin->name.'将订单:'.$order->order_no.'状态更新为'.getStatusStr($order->status),'type' => 3,'order_id'=>$order->id,))->save();			
			if($toStatus != ORDER_STATUS_CANCEL && $toStatus != ORDER_STATUS_FINISH
				&& $toStatus != ORDER_STATUS_DELIVERYING && $toStatus != ORDER_STATUS_MAKING) {
				return Redirect::to('admin/orderdetail?orderno='.$orderNo.'&err=状态码不对');
			}
			if($toStatus == ORDER_STATUS_CANCEL) {
				if($order->status == ORDER_STATUS_CANCEL) {
					return Redirect::to('admin/orderdetail?orderno='.$orderNo.'&err=订单已经是取消状态');
				}
				if($order->status == ORDER_STATUS_FINISH) {
					return Redirect::to('admin/orderdetail?orderno='.$orderNo.'&err=订单已经完成');
				}
				if($order->status == ORDER_STATUS_DELIVERYING) {
					return Redirect::to('admin/orderdetail?orderno='.$orderNo.'&err=订单已经在配送中');
				}
			}
			if($toStatus == ORDER_STATUS_MAKING) {
				if($order->status == ORDER_STATUS_MAKING) {
					return Redirect::to('admin/orderdetail?orderno='.$orderNo.'&err=订单已经是制作中状态');
				}
				if($order->status == ORDER_STATUS_FINISH) {
					return Redirect::to('admin/orderdetail?orderno='.$orderNo.'&err=订单已经完成');
				}
				if($order->status == ORDER_STATUS_DELIVERYING) {
					return Redirect::to('admin/orderdetail?orderno='.$orderNo.'&err=订单已经在配送中');
				}
				if($order->status == ORDER_STATUS_CANCEL) {
					return Redirect::to('admin/admin/orderdetail?orderno='.$orderNo.'&err=订单已经是取消状态');
				}
			}
			if($toStatus == ORDER_STATUS_DELIVERYING) {
				if($order->status == ORDER_STATUS_CANCEL) {
					return Redirect::to('admin/admin/orderdetail?orderno='.$orderNo.'&err=订单已经是取消状态');
				}
				if($order->status == ORDER_STATUS_FINISH) {
					return Redirect::to('admin/orderdetail?orderno='.$orderNo.'&err=订单已经完成');
				}
				if($order->status == ORDER_STATUS_DELIVERYING) {
					return Redirect::to('admin/orderdetail?orderno='.$orderNo.'&err=订单已经在配送中');
				}
			}
			if($toStatus == ORDER_STATUS_FINISH) {
				if($order->status == ORDER_STATUS_CANCEL) {
					return Redirect::to('admin/orderdetail?orderno='.$orderNo.'&err=订单已经是取消状态');
				}
				if($order->status == ORDER_STATUS_FINISH) {
					return Redirect::to('admin/orderdetail?orderno='.$orderNo.'&err=订单已经是完成状态');
				}
			}

			$order['status'] = $toStatus;
			$order['operator'] = $admin->name;
			try {
				$order->update();
			} catch (Exception $e) {
				return Redirect::to('menu');
			}
		}

		handleOrderStatus($order);

		return Redirect::to('admin/orderdetail?orderno='.$orderNo);
	}	

	public function quit ()
	{
		Session::flush();
		return Redirect::action('AdminController@orders');
	}

	public function vip()
	{
		$admin = Session::get('admin');
		if(empty($admin)) 
		{
			return View::make('admin/login');
		}
		$type = Input::get('type');
		if(empty($type)){
			$type = 'PAY';
		}
		$paylogs = null;
		$vipops = array();
		$RESETPWD = 0;
		try {
			if($type == 'RECHARGE') {
				$paylogs = VipPayLog::whereRaw('pay_status='.PAY_STATUS_FINISH.' and type=1')->orderBy('created_at', 'desc')->take(100)->get();
				foreach ($paylogs as $value) {
					$vipop = array('vipno' => $value->vip->mobile,'time' => $value->created_at, 'op'=>'充值 '.$value->money);
					$vipops[$value->id] = $vipop;
				}
			}
			else if($type == 'PAY') {
				$paylogs = VipPayLog::where('type', '=', -1)->orderBy('created_at', 'desc')->take(100)->get();
				foreach ($paylogs as $value) {
					$vipop = array('vipno' => $value->vip->mobile,'time' => $value->created_at, 'op'=>'支付 '.$value->money);
					$vipops[$value->id] = $vipop;
				}
			}
			else if($type == 'RESETPWD') {
				$resetpwd = VipPwdReset::where('status', '>=', 0)->orderBy('created_at', 'desc')->get();
				foreach ($resetpwd as $value) {
					$vipop = array('vipno' => $value->vip->mobile,'time' => $value->created_at, 'op'=>'找回密码申请', 'status'=>$value->status);
					$vipops[$value->id] = $vipop;
				}
			} 
			else if($type == 'SEARCH') {
				$keyword = Input::get('keyword');
				try {
					$vip = Vip::where('mobile', '=', $keyword)->firstOrFail();
				} catch (Exception $e) {
					
				}
				if (!empty($vip)) {
					$vipop = array('vipno' => $keyword,'time' => $vip->created_at, 'op'=>'');
					$vipops[$vip->id]=$vipop;
				}
			}
			$RESETPWD = VipPwdReset::whereRaw('status = 0')->count();
		} catch (Exception $e) {
			
		}
		return View::make('admin/vip')->with(array('vipops' => $vipops, 'type' => $type,
			'RESETPWD'=>$RESETPWD,'admin'=>$admin->name));
	}

	public function vipDetail()
	{
		$admin = Session::get('admin');
		if(empty($admin)) 
		{
			return View::make('admin/login');
		}
		$vipno = Input::get('vipno');
		$vip = null;
		try {
			$vip = Vip::where('mobile', '=', $vipno)->firstOrFail();
		} catch (Exception $e) {
			
		}
		if (empty($vip)) {
			return View::make('/admin/vip?type=PAY');;
		}
		$paylogs = null;
		try {
			$paylogs = VipPayLog::whereRaw('vip_id='.$vip->id.' and (pay_status='.PAY_STATUS_FINISH.' and type=1 or type=-1)')->orderBy('created_at', 'desc')->take(100)->get();
		} catch (Exception $e) {
			
		}
		return View::make('admin/vipdetail')->with(array('vip' => $vip, 'paylogs' => $paylogs,
			'admin'=>$admin->name));
	}

	public function vipResetPwd()
	{
		$admin = Session::get('admin');
		if(empty($admin)) 
		{
			return View::make('/admin/login');
		}
		$vipno = Input::get('vipno');
		$resetId = Input::get('resetid');
		try {
			$vip = Vip::where('mobile', '=', $vipno)->firstOrFail();
		} catch (Exception $e) {
			
		}
		if (empty($vip)) {
			return View::make('/admin/vip');;
		}
		$reset = null;
		try {
			$reset = VipPwdReset::find($resetId);
		} catch (Exception $e) {
			
		}
		if (!empty($reset)) {
			if($reset->status == 0){
				$pwd = rand(100000,999999);
				$reset->pwd=$pwd;
				$reset->status=1;
				$reset->update();

				$vip->pay_password=$pwd;
				$vip->update();
			}
			return View::make('/admin/resetdetail')->with(array('vip' => $vip, 'reset' => $reset, 'admin'=>$admin->name));
		}
		return View::make('/admin/vip?type=RESETPWD');
	}

}