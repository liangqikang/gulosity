<?php

include_once app_path().'/controllers/Common.php';

class VipController extends BaseController {

	public function main()
	{
		$user = Session::get('user');
		if(empty($user)) {
		 	//跳转到授权页
		 	Session::put('targetUrl', '/vip');
		 	return Redirect::to(WX_OAUTH_URL);
		}
		try {
			$vip = Vip::where('user_id', '=', $user->id)->firstOrFail();
		} catch (Exception $e) {
			
		}
		if (empty($vip)) {
			return View::make('/vip/joinvip');;
		}
		
		$attr = array('vipno' => $vip->mobile, 'balance' => $vip->balance);

    	return View::make('/vip/vip')->with('attr', $attr);
   	}

   	public function doJoin()
	{
		$user = Session::get('user');
		if(empty($user)) {
		 	//跳转到授权页
		 	Session::put('targetUrl', '/vip');
		 	return Redirect::to(WX_OAUTH_URL);
		}
		
		$vals = Input::all();
		$mobile = Input::get('vipno');
		$password = Input::get('password');
		$password1 = Input::get('password1');
		$email = Input::get('email');
		$vip = new Vip;
		$vip->user_id = $user->id;
		$vip->mobile = $mobile;
		$vip->email = $email;
		$vip->pay_password = $password; //MD5加密
		$vip->save();
    	return Redirect::to('/vip');
   	}

   	public function recharge()
	{
		// $user = Session::get('user');
		// if(empty($user)) {
		//  	//跳转到授权页
		//  	Session::put('targetUrl', '/menu');
		//  	return Redirect::to(WX_OAUTH_URL);
		// }
		

    	return View::make('/vip/recharge');
   	}

   	public function vippay()
	{
		// $user = Session::get('user');
		// if(empty($user)) {
		//  	//跳转到授权页
		//  	Session::put('targetUrl', '/menu');
		//  	return Redirect::to(WX_OAUTH_URL);
		// }
		

    	return View::make('/vip/pay');
   	}

   	public function vipcenter()
	{
		$user = Session::get('user');
		if(empty($user)) {
		 	//跳转到授权页
		 	Session::put('targetUrl', '/vip');
		 	return Redirect::to(WX_OAUTH_URL);
		}
		try {
			$vip = Vip::where('user_id', '=', $user->id)->firstOrFail();
		} catch (Exception $e) {
			
		}
		if (empty($vip)) {
			return View::make('/vip/joinvip');;
		}
		
		$attr = array('vipno' => $vip->mobile, 'balance' => $vip->balance);

    	return View::make('/vip/vipcenter')->with('attr', $attr);
   	}


   	public function doChangeVipPwd()
	{
		$user = Session::get('user');
		if(empty($user)) {
		 	//跳转到授权页
		 	Session::put('targetUrl', '/vip');
		 	return Redirect::to(WX_OAUTH_URL);
		}
		try {
			$vip = Vip::where('user_id', '=', $user->id)->firstOrFail();
		} catch (Exception $e) {
			
		}
		if (empty($vip)) {
			return View::make('/vip/joinvip');;
		}
		$vals = Input::all();
		$password1 = Input::get('password1');
		$password2 = Input::get('password2');
		$password = Input::get('password');
		if($password != $vip->pay_password) {
			$attr = array('msg' => '您输入的旧的支付密码不正确', 'url' => '/vip/changevippwd');
			return View::make('/message')->with('attr', $attr);
		}
		if($password1 != $password2) {
			$attr = array('msg' => '您两次输入的新支付密码不一致', 'url' => '/vip/changevippwd');
			return View::make('/message')->with('attr', $attr);
		}
		$vip->pay_password = $password1;
		$vip->update();
		$attr = array('msg' => '修改会员支付密码成功', 'url' => '/vip');
		return View::make('/message')->with('attr', $attr);  
   	}

   	public function doChangeVipno()
	{
		$user = Session::get('user');
		if(empty($user)) {
		 	//跳转到授权页
		 	Session::put('targetUrl', '/vip');
		 	return Redirect::to(WX_OAUTH_URL);
		}
		try {
			$vip = Vip::where('user_id', '=', $user->id)->firstOrFail();
		} catch (Exception $e) {
			
		}
		if (empty($vip)) {
			return View::make('/vip/joinvip');;
		}
		$vals = Input::all();
		$mobile = Input::get('vipno1');
		$mobile1 = Input::get('vipno2');
		$password = Input::get('password');
		if($password != $vip->pay_password) {
			$attr = array('msg' => '支付密码不正确', 'url' => '/vip/changevipno?vipno='.$vip->mobile);
			return View::make('/message')->with('attr', $attr);
		}
		$vip->mobile = $mobile;
		$vip->update();
		$attr = array('msg' => '修改会员卡号成功', 'url' => '/vip');
		return View::make('/message')->with('attr', $attr);   	
	}

	public function resetPwd()
	{
		$user = Session::get('user');
		if(empty($user)) {
		 	//跳转到授权页
		 	Session::put('targetUrl', '/vip');
		 	return Redirect::to(WX_OAUTH_URL);
		}
		try {
			$vip = Vip::where('user_id', '=', $user->id)->firstOrFail();
		} catch (Exception $e) {
			
		}
		if (empty($vip)) {
			return View::make('/vip/joinvip');;
		}
		try {
			$reset = Vip::whereRaw('vip_id='.$vip->id.' and status = 0')->firstOrFail();
		} catch (Exception $e) {
			
		}
		if (!empty($reset)) {
			$attr = array('msg' => '您已经提交过申请，请查看密码保护邮箱，不必重复申请', 'url' => '/vip/pay');
			return View::make('/message')->with('attr', $attr);
		}
		$vals = Input::all();
		$mobile = Input::get('vipno');
		$email = Input::get('email');
		if($mobile != $vip->mobile) {
			$attr = array('msg' => '会员卡号不正确', 'url' => '/vip/forgetpwd');
			return View::make('/message')->with('attr', $attr);
		}

		if($mobile != $vip->mobile) {
			$attr = array('msg' => '密码保护邮箱不正确', 'url' => '/vip/forgetpwd');
			return View::make('/message')->with('attr', $attr);
		}

		$reset = new VipPwdReset;
		$reset->status=0;
		$reset->vip_id=$vip->id;
		$reset->save();

		$attr = array('msg' => '<div style="font-size:16px;text-align:center">申请提交成功！</div>我们将会在24小时内进行人工审核，请及时留意您的邮箱信息，谢谢!', 'url' => '/vip');
		return View::make('/vip/message')->with('attr', $attr);   	
	}     

	public function doRecharge()
	{
		$user = Session::get('user');
		if(empty($user)) {
		 	//跳转到授权页
		 	Session::put('targetUrl', '/vip');
		 	return Redirect::to(WX_OAUTH_URL);
		}
		try {
			$vip = Vip::where('user_id', '=', $user->id)->firstOrFail();
		} catch (Exception $e) {
			
		}
		if (empty($vip)) {
			return View::make('/vip/joinvip');;
		}
		$vals = Input::all();
		$money = Input::get('money');
		$password = Input::get('password');
		if($password != $vip->pay_password) {
			$attr = array('msg' => '支付密码不正确', 'url' => '/vip/recharge');
			return View::make('/message')->with('attr', $attr);
		}
		if(empty($money)) {
			$attr = array('msg' => '请选择充值金额', 'url' => '/vip/recharge');
			return View::make('/message')->with('attr', $attr);
		}
		//充值记录
		$paylog = new VipPayLog;
		$paylog->money = $money;
		$paylog->type = VIP_PAY_TYPE_RECHARGE;
		$paylog->pay_status = PAY_STATUS_NOT;
		$paylog->vip_id = $vip->id;
		$paylog->save();

		//支付
		//微信支付
		commonLog("微信支付，充值vip：paylog_id->".$paylog->id.',total_fee->'.$money);
		return Redirect::action("PayController@weixinPay", array('body' => '食品', 'orderno' => $paylog->id, 'total_fee' => $money, 'attach' => WX_FEE_TYPE_RECHARGE));
		//支付回调,修改用户的账户余额，paylog状态
		// $vip->balance = $money + $vip->balance;
		// $vip->update();
		// $attr = array('msg' => '修改会员卡号成功', 'url' => '/vip');
		// return View::make('/message')->with('attr', $attr);   	
	} 
	public function doPay()
	{
		$user = Session::get('user');
		if(empty($user)) {
		 	//跳转到授权页
		 	Session::put('targetUrl', '/vip');
		 	return Redirect::to(WX_OAUTH_URL);
		}
		try {
			$vip = Vip::where('user_id', '=', $user->id)->firstOrFail();
		} catch (Exception $e) {
			
		}
		if (empty($vip)) {
			return View::make('/vip/joinvip');;
		}
		$vals = Input::all();
		$money = Input::get('money');
		$password = Input::get('password');
		$orderno = Input::get('orderno');
		if($password != $vip->pay_password) {
			$attr = array('msg' => '支付密码不正确', 'url' => '/vip/pay');
			return View::make('/message')->with('attr', $attr);
		}
		if(empty($money) && empty($orderno)) {
			$attr = array('msg' => '请输入支付金额', 'url' => '/vip/pay');
			return View::make('/message')->with('attr', $attr);
		}
		if(!empty($orderno)){
			try {
				$order = Order::where('order_no', '=', $orderno)->firstOrFail();
			} catch (Exception $e) {
				
			}
			
			if(empty($order)) {
				$attr = array('msg' => '该订单已经不存在', 'url' => '/menu');
				return View::make('/message')->with('attr', $attr);
			}
			$money = $order->total_price;
		}
		if($money > $vip->balance) {
			$attr = array('msg' => '对不起，您的账户余额不足，请充值或者选择其他支付方式。', 'url' => '/vip');
			return View::make('/message')->with('attr', $attr);
		}

		//支付记录
		$paylog = new VipPayLog;
		$paylog->money = $money;
		$paylog->type = VIP_PAY_TYPE_PAY;
		$paylog->pay_status = PAY_STATUS_NOT;
		$paylog->vip_id = $vip->id;
		$paylog->save();

		$vip->balance = $vip->balance - $money;
		$vip->update();
		//如果是订单

		if(!empty($orderno)) {//为订单支付
			try {
				$order = Order::where('order_no', '=', $orderno)->firstOrFail();

				// commonLog('订单：'.$orderno.'微信支付1');
				if(!empty($order)){
					//if($order->total_price == $total_fee){
						$order['pay_status'] = PAY_STATUS_FINISH;
						$order['wx_transaction_id'] = $paylog->id;
						$order['pay_type'] = PAY_TYPE_VIP;
						try {
							// commonLog('订单：'.$orderno.'微信支付2');				
							$order->update();
							commonLog('订单：'.$orderno.'会员支付完成');
						} catch (Exception $e) {
							//todo
						}
					//}
				}
			} catch (Exception $e) {
			}
			//跳转到订单	
			$attr = array('msg' => '支付成功！支付金额为：￥'.$money, 'url' => '/order/orderdetail?orderno='.$orderno);
			return View::make('/message')->with('attr', $attr);
		}
		//跳转到会员中心
		$attr = array('msg' => '支付成功！支付金额为：￥'.$money, 'url' => '/vip');
		return View::make('/message')->with('attr', $attr);
	}   

	public function payList()
	{
		$user = Session::get('user');
		if(empty($user)) 
		{
			//将表单数据存session，跳转到授权页
			Session::flash('targetUrl', '/vip');
			return Redirect::to(WX_OAUTH_URL);
		}
		try {
			$vip = Vip::where('user_id', '=', $user->id)->firstOrFail();
		} catch (Exception $e) {
			
		}
		if (empty($vip)) {
			return View::make('/vip/joinvip');;
		}
		$paylogs = null;
		try {
			$paylogs = VipPayLog::where('vip_id', '=', $vip['id'])->orderBy('created_at', 'desc')->take(10)->get();
		} catch (Exception $e) {
			
		}
		
		return View::make('/vip/vippaylist')->with('paylogs', $paylogs);
	}	
}
