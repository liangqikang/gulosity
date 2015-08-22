<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection" />
<title>魅尔吧</title>  
<link rel="stylesheet" type="text/css" href="/static/vip.css">
<style type="text/css"><!--  
#vipcard {height:180px; font-size: 16px; margin-top: 20px; line-height: 270px; text-align: center; color: black; background: url("/images/vipcard.jpg") no-repeat;background-size:300px;}
#payrow{cursor: pointer; width: 100%; margin-bottom: 10px;clear: both;margin-top: 4px;}
.pay{float:left;font-size: 12px; padding-top:15px;color:red; height: 45px;line-height:20px;width: 73%;text-align: center;background-color: white;border: 1px solid gray; }
.recharge{float:left;font-size: 20px; line-height:60px; height: 60px;width:25%;text-align: center;background-color: #999999;border: 1px solid #666666;}
#center{cursor: pointer; width: 298px;font-size: 18px; height: 40px; line-height: 40px; text-align: center;background-color: white;border: 1px solid #666666}
--></style>
<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
WeixinJSBridge.call('hideToolbar');
});

</script>

    </head>
    <body>
        <div id="container">
            <div id="vipcard">@yield('vipno')</div>
            <div id="payrow">
                <div class="pay" onclick="javascript:location.href='/vip/pay'"><font style="font-size: 20px; font-weight:bold">会员支付</font><br>@yield('balance')</div>
                <div class="recharge" onclick="javascript:location.href='/vip/recharge'">充值 > </div>
                <div style="clear:both"></div>
            </div>
            <div id="center" onclick="javascript:location.href='/vip/center'">我的会员中心</div>
        </div>
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="/images/mellbar_logo.png" width="120px"></div>
    </body>
</html>
