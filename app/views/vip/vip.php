<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection" />
<title>魅尔吧</title>  
<style type="text/css"><!--  
body{font-family:"Microsoft Yahei","宋体","Tahoma",Arial;font-size:14px;color:black;background-color:darkred}
#container{width:300px;margin-bottom:40px; padding:auto; margin: auto;}
#vipcard {height:180px; margin-top: 10px; line-height: 270px; text-align: center; color: black; background-image: url("images/vipcard.png"); background-repeat: no-repeat;}
#payrow{cursor: pointer; width: 100%; margin-bottom: 20px;clear: both;margin-top: 10px;}
.pay{float:left; padding-top:10px;color:red; height: 50px;width: 70%;text-align: center;background-color: white;border: 1px solid gray; }
.recharge{float:left;font-size: 18px; letter-spacing:8px; line-height:60px; height: 60px;width:28%;text-align: center;background-color: gray;border: 1px solid gray;}
#center{cursor: pointer; width: 298px;font-size: 18px; letter-spacing:8px; height: 40px; line-height: 40px; text-align: center;background-color: white;border: 1px solid gray}
--></style>
<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
WeixinJSBridge.call('hideToolbar');
});

</script>

    </head>
    <body>
        <div id="container">
            <div id="vipcard">NO. 18611111111</div>
            <div id="payrow">
                <div class="pay" onclick="javascript:location.href='/vip/pay'"><font style="font-size: 20px;letter-spacing:8px">会员支付</font><br>(余额：0 RMB)</div>
                <div class="recharge" onclick="javascript:location.href='/vip/recharge'">充值</div>
                <div style="clear:both"></div>
            </div>
            <div id="center" onclick="javascript:location.href='/vip/vipcenter'">我的会员中心</div>
        </div>
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="/images/mellbar_logo.png" width="120px"></div>
    </body>
</html>
