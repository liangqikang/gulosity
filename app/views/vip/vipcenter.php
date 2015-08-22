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
body{font-family:"Microsoft Yahei","宋体","Tahoma",Arial;font-size:18px;color:black;background-color:darkred}
#container{width:300px;margin-bottom:40px; padding:auto; margin: auto;}
.subtitle{text-align: center;font-size: 18px;margin:10px;color: white}
.row{cursor: pointer; width: 100%; margin-bottom: 10px; font-size: 18px}
.clear{clear: both;}
.subject{float:left;width: 230px; background-color: white; padding-left: 10px; height: 50px; line-height: 50px}
.btn{float: left;width: 58px;height: 50px;background-color: gray;color: white; line-height: 50px; text-align: center;}
.paylist{cursor: pointer; width: 298px; background-color: white; text-align: center; height: 50px; line-height: 50px;font-size: 18px}

--></style>
<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
WeixinJSBridge.call('hideToolbar');
});

</script>

    </head>
    <body>
        <div id="container">
            <div class="subtitle">我的会员中心</div>
            <div class="row">
                <div class="subject">会员卡号：18000101010</div>
                <div class="btn" onclick="javascript:location.href='changevipno'">修改</div>
                <div class="clear"></div>
            </div>
            <div class="row">
                <div class="subject">会员卡余额：<font color="red">548</font> RMB</div>
                <div class="btn" onclick="javascript:location.href='recharge'">充值</div>
                <div class="clear"></div>
            </div>
            <div class="row">
                <div class="subject">我的会员支付密码</div>
                <div class="btn" onclick="javascript:location.href='changevippwd'">修改</div>
                <div class="clear"></div>
            </div>
            <div class="paylist" onclick="javascript:location.href='vippaylist'">最近我的会员卡账单</div>

        </div>
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="images/mellbar_logo.png" width="120px"></div>
    </body>
</html>
