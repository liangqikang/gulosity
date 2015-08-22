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
                vipno: {
                  required: true,
                  isMobile: true
                },
                email: {
                  required: true,
                  email: true
                },
                password1: {
                    required:true,
                    equalTo:"#password"
                }
            },
            messages: {   
                password1: {
                    equalTo:"两次填写的密码不一致"
                }
            }
        });
});
jQuery.validator.addMethod("isMobile", function(value, element) {       
    var length = value.length;   
    var mobile = /^(((13[0-9]{1})|(14[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/;   
    return this.optional(element) || (length == 11 && mobile.test(value));       
}, "请正确填写您的手机号码"); 


</script>

    </head>
    <body>
        <div id="container">
            <div class="subtitle">欢迎加入魅尔吧会员家族</div>
            <form name="frm" id="frm" action="/vip/dojoin" method="post">
                <div class="moneyrow"><input name="vipno" placeholder="会员号码：请输入您的手机号码" required></input></div>
                <div class="moneyrow"><input name="password" id="password" placeholder="密码设置：请设置您的会员支付密码" type="password" required></input></div>
                <div class="moneyrow"><input name="password1" id="password1" placeholder="密码确认：请再次输入您的会员支付密码" type="password" required/></div>
                <div class="moneyrow"><input name="email" id="email" placeholder="邮箱地址：请输入保护您的支付密码的邮箱" required email/></div>
                <br>
                <div id="btnrow">
                    <input class="btn" type="submit" value="确认保存"</input>
                </div>
            </form>
        </div>
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="/images/mellbar_logo.png" width="120px"></div>
    </body>
</html>
