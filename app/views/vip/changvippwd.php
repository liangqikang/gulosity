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
#btnrow{cursor: pointer; width: 100%; margin-bottom: 20px;clear: both;margin-top: 10px;}
.pay{float:left; line-height:50px;color:red; height: 50px;width: 70%;text-align: center;background-color: white;border: 1px solid gray; }
.recharge{float:left;font-size: 18px; letter-spacing:8px; line-height:50px; height: 50px;width:28%;text-align: center;background-color: gray;border: 1px solid gray;}
#center{cursor: pointer; width: 298px;font-size: 18px; letter-spacing:8px; height: 40px; line-height: 40px; text-align: center;background-color: white;border: 1px solid gray}
.selectstyle{width: 288px; padding-left: 10px; height: 50px; border:1px solid gray; background: url("images/selectarrow.jpg") no-repeat 243px; background-color: white }
.moneyrow input{height: 40px; width: 284px;margin-top: 10px; line-height: 40px; padding-left: 10px; font-size: 18px;}
--></style>
<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
WeixinJSBridge.call('hideToolbar');
});

</script>

    </head>
    <body>
        <div id="container">
            <div class="subtitle">修改我的会员支付密码</div>

            <div class="moneyrow"><input name="password" placeholder="请输入我旧的会员支付密码"></input></div>
            <div class="moneyrow"><input name="password1" placeholder="请设置我新的会员支付密码"></input></div>
            <div class="moneyrow"><input name="password2" placeholder="请再次输入我新的会员支付密码"></input></div>
            <div class="moneyrow"><input placeholder="请输入您的会员支付密码" type="password" name="password"/></div>
            <br>
            <div id="btnrow">
                <div class="pay" onclick="vippay"><font style="font-size: 20px;letter-spacing:8px">确认修改</font></div>
            </div>
        </div>
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="images/mellbar_logo.png" width="120px"></div>
    </body>
</html>
