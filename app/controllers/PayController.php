<?php
include_once app_path().'/controllers/Common.php';
include_once app_path().'/controllers/WxPay.config.php';
include_once app_path().'/controllers/CommonUtil.php';
include_once app_path().'/controllers/SDKRuntimeException.class.php';
include_once app_path().'/controllers/MD5SignUtil.php';

class PayController extends BaseController {

	public function test(){
		$commonUtil = new CommonUtil();
		$wxPayHelper = new WxPayHelper();

		$orderno='V414060301243';
		$wxPayHelper->setParameter("bank_type", "WX");
		$wxPayHelper->setParameter("body", '测试');
		$wxPayHelper->setParameter("partner", "1219036001");
		$wxPayHelper->setParameter("out_trade_no", $orderno);
		$wxPayHelper->setParameter("total_fee", '1');
		$wxPayHelper->setParameter("fee_type", "1");
		$wxPayHelper->setParameter("notify_url", "http://www.mellbar.com/order/paynotify");
		$wxPayHelper->setParameter("spbill_create_ip", "127.0.0.1");
		$wxPayHelper->setParameter("input_charset", "GBK");
		$package = $wxPayHelper->create_biz_package();
		commonLog('package->'.$package, '');
		$attr = array('pay_package' => $package, 'orderno' => $orderno);
		return View::make('gopay')->with('attr', $attr);
	}

	public function weixinPay (){
		$commonUtil = new CommonUtil();
		$wxPayHelper = new WxPayHelper();

		$body = Input::get('body');
		$orderno = Input::get('orderno');
		$total_fee = Input::get('total_fee');
		$attach = Input::get('attach');//1 支付订单， 2 vip充值
		$wxPayHelper->setParameter("bank_type", "WX");
		$wxPayHelper->setParameter("body", $body);
		$wxPayHelper->setParameter("partner", "1219036001");
		$wxPayHelper->setParameter("out_trade_no", $orderno);
		$wxPayHelper->setParameter("total_fee", floor($total_fee * 100));
		$wxPayHelper->setParameter("fee_type", 1);
		$wxPayHelper->setParameter("notify_url", "http://www.mellbar.com/order/paynotify");
		$wxPayHelper->setParameter("spbill_create_ip", "127.0.0.1");
		$wxPayHelper->setParameter("input_charset", "UTF-8");
		if(!empty($attach)){
			$wxPayHelper->setParameter("attach", $attach);
		}
		$package = $wxPayHelper->create_biz_package();
		commonLog('package->'.$package, '');
		$attr = array('pay_package' => $package, 'orderno' => $orderno, 'attach' => $attach);
		return View::make('gopay')->with('attr', $attr);
	}


	public function payNotify()
	{
		$all = Input::all();
		commonLog(json_encode($all), '');
		$orderno = Input::get("out_trade_no");
		$total_fee = Input::get("total_fee");
		$transaction_id = Input::get("transaction_id");
		$attach = Input::get("attach");
		$order = null;
		commonLog('订单：'.$orderno.'微信支付0');
		if($attach == WX_FEE_TYPE_PAY){
			try {
				$order = Order::where('order_no', '=', $orderno)->firstOrFail();

				// commonLog('订单：'.$orderno.'微信支付1');
				if(!empty($order)){
					//if($order->total_price == $total_fee){
						$order['pay_status'] = PAY_STATUS_FINISH;
						$order['wx_transaction_id'] = $transaction_id;
						try {
							// commonLog('订单：'.$orderno.'微信支付2');				
							$order->update();
							commonLog('订单：'.$orderno.'微信支付完成');
						} catch (Exception $e) {
							return 'error';
						}
					//}
				}
			} catch (Exception $e) {
				return 'error';
			}
		}elseif ($attach == WX_FEE_TYPE_RECHARGE) {
			try {
				$paylog = VipPayLog::find($orderno);
				$vip = Vip::find($paylog->vip_id);

				commonLog('充值：'.$orderno.'微信支付1');
				if(!empty($paylog) && !empty($vip)){
					//if($order->total_price == $total_fee){
						$paylog['pay_status'] = PAY_STATUS_FINISH;
						$paylog['wx_transaction_id'] = $transaction_id;
						$vip['balance'] = $vip['balance'] + $paylog->money;
						try {
							commonLog('充值：'.$orderno.'微信支付2');				
							$paylog->update();
							$vip->update();
							commonLog('充值：'.$orderno.'微信支付完成');

						} catch (Exception $e) {
							return 'error';
						}
					//}
				}
			} catch (Exception $e) {
				commonLog('error'.json_encode($e));
				return 'error';
			}
		}
		return 'success';
	}

	public function deliveryNotify(){
		$orderno = Input::get('orderno');
		$order = null;
		$openid = null;
		try {
			$order = Order::where('order_no', '=', $orderno)->firstOrFail();
			if(!empty($order)){
				$user = User::find($order->user_id);
				if(!empty($user)){
					$openid = $user->wechat_id;
				}
			}
		} catch (Exception $e) {
			return 'error';
		}
		$url = 'https://api.weixin.qq.com/pay/delivernotify?access_token='.getAccessToken();
		$time = time();
		$unsign = array(
			'appid' => APPID, 
			'appkey' => APPKEY,
			'openid' => $openid,
			'transid' => $order->wx_transaction_id,
			'out_trade_no' => $orderno,
			'deliver_timestamp' => $time,
			'deliver_status' => '1',
			'deliver_msg' => 'ok');

		// $commonUtil = new CommonUtil();
		// ksort($unsign);
		// $unSignParaString = $commonUtil->formatQueryParaMap($unsign, false);
		// $md5SignUtil = new MD5SignUtil();
		// $sign = $md5SignUtil->sign($unSignParaString,$commonUtil->trimString(PARTNERKEY));
		$wxPayHelper = new WxPayHelper();

		$sign = $wxPayHelper->get_biz_sign($unsign);

		$postdata = array(
			'appid' => APPID, 
			'openid' => $openid,
			'transid' => $order->wx_transaction_id,
			'out_trade_no' => $orderno,
			'deliver_timestamp' => $time,
			'deliver_status' => '1',
			'deliver_msg' => 'ok',
			'app_signature' => $sign,
			'sign_method' => 'sha1');

		commonLog($url.", deliveryNotify: ".json_encode($postdata).", unsign: ".json_encode($unsign));
		$data = json_encode($postdata);
		return doCurlPostRequest($url, $data);
	}

}