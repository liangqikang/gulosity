<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/', 'HomeController@showWelcome');

Route::get('/clears', 'HomeController@clearSession');
Route::get('/createMenu', 'HomeController@createMenu');

Route::get('/auth', 'HomeController@auth');

Route::get('/choujiang', 'LotteryController@choujiang');
Route::get('/aboutus', function()
{
	return View::make('aboutus');
});
Route::post('/lottery', 'LotteryController@lottery');


Route::post('/wxresponse', 'WechatController@responseMsg');

Route::get('/menu', 'OrderController@showMenu');
Route::get('/order/choose', 'OrderController@order');
Route::post('/order/createorder', 'OrderController@createOrder');
Route::get('/order/cancelorder', 'OrderController@cancelOrder');
//查询用户的所有订单
Route::get('/orderlist', 'OrderController@queryOrder');
//查看订单详情
Route::get('/order/orderdetail', 'OrderController@orderDetail');
Route::get('/order/payagain', 'OrderController@payAgain');
Route::post('/order/paynotify', 'PayController@payNotify');
Route::get('/order/weixinPay', 'PayController@weixinPay');
Route::get('/order/deliverynotify', 'PayController@deliveryNotify');
Route::get('/ordertest/test', 'PayController@test');

Route::get('/order/addressform', 'AddressController@newAddress');
Route::post('/order/createaddress', 'AddressController@createAddress');
Route::get('/order/chooseaddress', 'AddressController@chooseAddress');
Route::get('/order/deladdress', 'AddressController@delAddress');


Route::get('/admin', 'AdminController@admin');
Route::post('/admin/login', 'AdminController@login');
Route::get('/admin/reset', 'AdminController@reset');
Route::post('/admin/changepwd', 'AdminController@changepwd');
Route::get('/admin/orders', 'AdminController@orders');
Route::get('/admin/vip', 'AdminController@vip');
Route::get('/admin/vipdetail', 'AdminController@vipDetail');
Route::get('/admin/vipresetpwd', 'AdminController@vipResetPwd');
Route::get('/admin/orderdetail', 'AdminController@orderDetail');
Route::get('/admin/updateorder', 'AdminController@updateOrder');
Route::get('/admin/quit', 'AdminController@quit');

Route::post('/aftersale/notify', 'AfterSaleController@notify');
Route::post('/monitor/notify', 'MonitorController@notify');

Route::get('/aftersale/notify', 'AfterSaleController@notify');
Route::get('/monitor/notify', 'MonitorController@notify');

Route::get('/vip', 'VipController@main');
Route::get('/vip/recharge', 'VipController@recharge');
Route::get('/vip/pay', function(){return View::make('/vip/vippay');});
Route::get('/vip/center', 'VipController@vipcenter');
Route::get('/vip/paylist', 'VipController@payList');

Route::get('/vip/changevippwd', function()
{
	return View::make('/vip/changevippwd');
});
Route::get('/vip/changevipno', function()
{
	return View::make('/vip/changevipno');
});
Route::get('/vip/join', function()
{
	return View::make('/vip/joinvip');
});
Route::get('/vip/forgetpwd', function()
{
	return View::make('/vip/forgetpwd');
});
Route::post('/vip/dojoin', 'VipController@doJoin');
Route::post('/vip/dochangevipno', 'VipController@doChangeVipno');
Route::post('/vip/dochangevippwd', 'VipController@doChangeVipPwd');
Route::post('/vip/dorecharge', 'VipController@doRecharge');
Route::post('/vip/dopay', 'VipController@doPay');
Route::post('/vip/resetpwd', 'VipController@resetPwd');
