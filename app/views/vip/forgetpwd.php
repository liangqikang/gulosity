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
<script src="/static/additional-methods.min"></script>
<script src="/static/messages_zh.min.js"></script>

<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
WeixinJSBridge.call('hideToolbar');
});

$().ready(function() {
    $("#frm").validate({
        rules: {
            vipno: {
              required: true,
              number: true
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {   
            vipno: {
                number:"请输入正确的卡号"
            }
        }
    });
});

</script>

    </head>
    <body>
        <div id="container">
            <div class="subtitle">找回我的会员支付密码</div>
            <form name="frm" id="frm" action="/vip/resetpwd" method="post">
                <div id="moneyrow"><input name="vipno" id="vipno" placeholder="请输入您的会员卡号" required></input></div>
                <div id="pwdrow"><input placeholder="请输入保护您会员支付密码的邮箱" id="email" name="email" required/></div>
                <input type="hidden" name="orderno" id="orderno" value=""/>
                <br>
                <div id="btnrow">
                    <input class="btn" type="submit" value="提交申请"/>
                </div>
            </form>
        </div>
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="/images/mellbar_logo.png" width="120px"></div>
    </body>
</html>
