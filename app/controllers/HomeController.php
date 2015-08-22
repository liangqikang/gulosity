<?php
include_once app_path().'/controllers/Common.php';

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	protected $layout = 'layout';

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function showUsers()
	{
		return View::make('users');
	}

	public function clearSession ()
	{
		Session::forget('user');
		Session::forget('openid');
		Session::flush();
		return Session::get('user');
	}

	public function auth()
	{
		$code = Input::get('code');
		MyLog::create(array('log' => $code,
			'type' => 1,
		 ))->save();
		if(empty($code))
		{
			return View::make('menu');
		}
		$openidUrl = WX_OPEN_ID_URL.$code;
		$openid = null;
		try{
			$openid = json_decode(doCurlGetRequest($openidUrl))->{'openid'};	
		}
		catch(\Exception $e) {

		}
		
		if(!empty($openid)){
			Session::put('openid', $openid);
			try {
				$user = User::where('wechat_id', '=', $openid)->firstOrFail();	
			} catch (Exception $e) {
				// return $openid;
			}
			if(empty($user)){
				$user = User::create(array(
					'wechat_id' => $openid,
					'email' => $openid,
					'name' => $openid,
					'mobile' => '',
					));
			}
			Session::put('user', $user);
			MyLog::create(array('log' => 'put user '.$user->name.' into session','type' => 2,))->save();
			$targetUrl = Session::get('targetUrl');
			if(!empty($targetUrl)){
				MyLog::create(array('log' => $targetUrl.'after fetch:'.json_encode(Input::all()),'type' => 2,))->save();
				return Redirect::to($targetUrl.'?state=123');
			}
			else 
			{
				MyLog::create(array('log' => 'redirect to menu','type' => 2,))->save();			
				return Redirect::action('OrderController@showMenu');
			}
		}
		MyLog::create(array('log' => 'openid is empty','type' => 3,))->save();					
		return Redirect::action('OrderController@showMenu');
	}

	public function createMenu()
	{
		$redirect_uri = url_encode('http://www.mellbar.com/menu');
		$url1 = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx7c22de70c2ee5c75&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
		$menudata = array(
			'button'=>array(
				array(
					'name' => '外卖服务',
					'sub_button' => array(
						array(
							'type' => 'view',
							'name' => '外卖下单',
							'url' => 'http://www.mellbar.com/menu'
							),
						array(
							'type' => 'view',
							'name' => '微信小店',
							'url' => 'http://mp.weixin.qq.com/bizmall/mallshelf?id=&t=mall/list&biz=MjM5ODA1NjI5Ng==&shelf_id=1&showwxpaytitle=1#wechat_redirect'
							),
						array(
							'type' => 'view',
							'name' => '我要优惠',
							'url' => 'http://www.mellbar.com/choujiang'
							),
						array(
							'url' => 'http://www.mellbar.com/orderlist',
							'name' => '我的订单',
							'type' => 'view'
							)
						)
					),

				array(
					'name' => '会员服务',
					'sub_button' => array(
						array(
							'type' => 'view',
							'name' => '会员中心',
							'url' => 'http://www.mellbar.com/vip'	
							//'key' => 'V1001_VIP'
							),
						array(
							'type' => 'view',
							'name' => '免费上网',
							'url' => 'http://service.vip-wifi.com/Portal/Wx/login?weixin=Mellbar110'	
							//'key' => 'V1001_VIP'
							)
						)
					),


				array(
					'name' => '关于我们',
					'sub_button' => array(
						array(
							'url' => 'http://www.mellbar.com/aboutus',
							'name' => '关于我们',
							'type' => 'view'
							),
						array(
							'type' => 'click',
							'name' => '维权',
							'key' => 'V1004_VQ'
							)
					),
				)
			)
		);		

		$token = getAccessToken();
		$url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$token;
		commonLog("createMenu: ".$url, "");
		$data = urldecode(json_encode(url_encode($menudata)));
		return doCurlPostRequest($url, $data).$data;

	}
}
