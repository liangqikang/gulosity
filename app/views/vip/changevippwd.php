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
--></style>
<script src="/static/jquery-1.7.2.min.js"></script>
<script src="/static/jquery.validate.min.js"></script>
<script src="/static/messages_zh.min.js"></script>

<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
WeixinJSBridge.call('hideToolbar');
});
$().ready(function() {

    $("#frm").validate({
        rules: {
            password2: {
                required: true,
                equalTo:"#password1"
            }
        },
        messages: {   
            password2: {
                equalTo:"两次填写的新支付密码不一致"
            }
        }
    });
});
</script>

    </head>
    <body>
        <div id="container">
            <div class="subtitle">修改我的会员支付密码</div>
            <form name="frm" id="frm" action="/vip/dochangevippwd" method="post">

                <div class="moneyrow"><input type="password" id="password" name="password" placeholder="请输入我旧的会员支付密码" required></input></div>
                <div class="moneyrow"><input type="password" id="password1" name="password1" placeholder="请设置我新的会员支付密码" required></input></div>
                <div class="moneyrow"><input type="password" id="password2" name="password2" placeholder="请再次输入我新的会员支付密码" required></input></div>
                <br>
                <div id="btnrow">
                        <input class="btn" style="-webkit-appearance:none" type="submit" value="确认保存"</input>
                </div>
            </form>
        </div>
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="/images/mellbar_logo.png" width="120px"></div>
    </body>
</html>
