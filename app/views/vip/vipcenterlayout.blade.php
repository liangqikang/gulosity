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
.row{cursor: pointer; width: 100%; margin-bottom: 10px; font-size: 18px}
.clear{clear: both;}
.subject{border:1px solid #666666; float:left;width: 226px; background-color: white; padding-left: 10px; height: 50px; line-height: 50px}
.btn{border: 1px solid #666666; float: left;width: 58px;height: 50px;background-color: #999999;color: white; line-height: 50px; text-align: center;}
.paylist{border:1px solid #666666; cursor: pointer; width: 296px; background-color: white; text-align: center; height: 50px; line-height: 50px;font-size: 18px}

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
                <div class="subject">@yield('vipno')</div>
                @yield('changeVipNoBtn')
                <div class="clear"></div>
            </div>
            <div class="row">
                <div class="subject">会员卡余额：<font color="red">@yield('balance')</font> RMB</div>
                <div class="btn" onclick="javascript:location.href='/vip/recharge'">充值</div>
                <div class="clear"></div>
            </div>
            <div class="row">
                <div class="subject">我的会员支付密码</div>
                <div class="btn" onclick="javascript:location.href='/vip/changevippwd'">修改</div>
                <div class="clear"></div>
            </div>
            <div class="paylist" onclick="javascript:location.href='/vip/paylist'">最近我的会员卡账单</div>

        </div>
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="/images/mellbar_logo.png" width="120px"></div>
    </body>
</html>
