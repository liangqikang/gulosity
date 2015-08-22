<?php

define('WX_OAUTH_URL', 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx7c22de70c2ee****&redirect_uri='.url_encode('http://www.mellbar.com/auth').'&response_type=code&scope=snsapi_base&state=123#wechat_redirect');
define('WX_OPEN_ID_URL', 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx7c22de70c2ee****&secret=058f433f18f27292203765cee0f9****&grant_type=authorization_code&code=');
define('ORDER_STATUS_CREATED', 0);
define('ORDER_STATUS_CANCEL', -1);
define('ORDER_STATUS_MAKING', 1);
define('ORDER_STATUS_DELIVERYING', 2);
define('ORDER_STATUS_FINISH', 3);

define('PAY_STATUS_NOT', 0);
define('PAY_STATUS_FAILED', -1);
define('PAY_STATUS_FINISH', 1);

define('PAY_TYPE_CASH', 1);
define('PAY_TYPE_WEIXIN', 2);
define('PAY_TYPE_VIP', 3);

define('WX_FEE_TYPE_PAY', 1);//支付订单
define('WX_FEE_TYPE_RECHARGE', 2); //充值

define('VIP_PAY_TYPE_PAY', -1);//会员支付
define('VIP_PAY_TYPE_RECHARGE', 1);//充值
$G_ORDER_NUM = 1;

/**
 * @desc 封装curl的调用接口，post的请求方式
 */
function doCurlPostRequest($url, $requestString, $timeout = 5) {   
	if($url == "" || $requestString == "" || $timeout <= 0){
		return false;
	}

    $con = curl_init((string)$url);
    curl_setopt($con, CURLOPT_HEADER, false);
    curl_setopt($con, CURLOPT_POSTFIELDS, $requestString);
    curl_setopt($con, CURLOPT_POST, true);
    curl_setopt($con, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($con, CURLOPT_TIMEOUT, (int)$timeout);
    //近一段时间HTTPS加密协议SSL曝出高危漏洞，可能导致网络中传输的数据被黑客监听，对用户信息、网络账号密码等安全构成威胁。
    //为保证用户信息以及通信安全，微信公众平台将关闭掉SSLv2、SSLv3版本支持，不再支持部分使用SSLv2、 SSLv3或更低版本的客户端调用。
    //2014-11-08
    if(defined('CURL_SSLVERSION_TLSv1')){
    	curl_setopt($con, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
    }


    return curl_exec($con);
}  

/**
 * @desc 封装curl的调用接口，get的请求方式
 */
function doCurlGetRequest($url, $data = array(), $timeout = 10) {
	if($url == "" || $timeout <= 0){
		return false;
	}
	if($data != array()) {
		$url = $url . '?' . http_build_query($data);	
	}
	
	$con = curl_init((string)$url);
	curl_setopt($con, CURLOPT_HEADER, false);
	curl_setopt($con, CURLOPT_RETURNTRANSFER,true);
	curl_setopt($con, CURLOPT_TIMEOUT, (int)$timeout);

	return curl_exec($con);
}
function url_encode($str) {  
	if(is_array($str)) {  
		foreach($str as $key=>$value) {  
			$str[urlencode($key)] = url_encode($value);  
		}  
	} else {  
		$str = urlencode($str);  
	}  

	return $str;  
}  

function goAuth()
{
	$redirect_uri = url_encode('http://www.mellbar.com/auth');
	$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx7c22de70c2ee5c75&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
	doCurlGetRequest($url);
	return $url;
}

function handleOrderStatus($order)
{
	if(!empty($order))
	{
		switch ($order->status) {
			case ORDER_STATUS_CREATED:
				$order['status'] = '下单成功';
				break;
			case ORDER_STATUS_MAKING:
				$order['status'] = '制作中';
				break;
			case ORDER_STATUS_CANCEL:
				$order['status'] = '已取消';
				break;
			case ORDER_STATUS_DELIVERYING:
				$order['status'] = '配送中';
				break;
			case ORDER_STATUS_FINISH:
				$order['status'] = '已完成';
				break;
			
			default:
				# code...
				break;
		}

		switch ($order->pay_status) {
			case PAY_STATUS_NOT:
				if($order->pay_type == PAY_TYPE_CASH)
					$order['pay_status'] = '货到付款';
				else
					$order['pay_status'] = '未支付';
				break;
			case PAY_STATUS_FAILED:
				$order['pay_status'] = '支付失败';
				break;
			case PAY_STATUS_FINISH:
				$order['pay_status'] = '支付完成';
				break;
			
			default:
				# code...
				break;
		}
	}
}

function commonLog($content, $operator='') 
{
	MyLog::create(array('log' => $content, 'operator' => $operator, 'type' => 0,))->save();			
}

function getStatusStr($status)
{
	$str = '';
	switch ($status) {
			case ORDER_STATUS_CREATED:
				$str = '下单成功';
				break;
			case ORDER_STATUS_MAKING:
				$str = '制作中';
				break;
			case ORDER_STATUS_CANCEL:
				$str = '已取消';
				break;
			case ORDER_STATUS_DELIVERYING:
				$str = '配送中';
				break;
			case ORDER_STATUS_FINISH:
				$str = '已完成';
				break;
			
			default:
				# code...
				break;
		}
		return $str;
}

function getAccessToken(){
	$token = Session::get("access_token");
	if(!empty($token)){
		return $token;
	}
	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx7c22de70c2ee****&secret=058f433f18f27292203765cee0f9****";
	$token = json_decode(doCurlGetRequest($url));
	commonLog("get wx token: ".$token->{'access_token'}, '');
	Session::put("access_token", $token->{'access_token'});
	return $token->{'access_token'};
}
