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
function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
}
$().ready(function() {

    $("#vipno").val("我旧的会员卡号：" + getQueryString("vipno")); 
    $("#frm").validate({
        rules: {
            vipno1: {
                required: true,
                isMobile: true
            },
            vipno2: {
                required: true,
                isMobile: true,
                equalTo:"#vipno1"
            }
        },
        messages: {   
            vipno2: {
                equalTo:"两次填写的会员卡号不一致"
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
            <div class="subtitle">修改我的会员卡号</div>
            <form name="frm" id="frm" action="/vip/dochangevipno" method="post">
                <div class="moneyrow"><input name="vipno" id="vipno" value="" disabled="disabled"></input></div>
                <div class="moneyrow"><input name="vipno1" id="vipno1" placeholder="请设置我新的会员卡号(新手机号)" required></input></div>
                <div class="moneyrow"><input name="vipno2" id="vipno2" placeholder="请再次输入我新的会员卡号(新手机号）" required></input></div>
                <div class="moneyrow"><input id="password" placeholder="请输入我的会员支付密码" type="password" name="password" required/></div>
                <br>
                <div id="btnrow">
                    <input class="btn" type="submit" value="确认保存"</input>
                </div>
            </form>
        </div>
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="/images/mellbar_logo.png" width="120px"></div>
    </body>
</html>
