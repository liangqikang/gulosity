<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection" />
<title>魅尔吧</title>  
<link rel="stylesheet" type="text/css" href="/static/vip.css?v=3">
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
function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
}

$().ready(function() {
    var orderno = getQueryString('orderno');
    var money = getQueryString('money');
    if(orderno != undefined && money != undefined){
        $('#money').val(money);
        $('#money').attr('disabled', true);
        $('#orderno').val(orderno);
    }
    $("#frm").validate({
        rules: {
            money: {
              required: true,
              number: true
            }
        },
        messages: {   
            money: {
                number:"请输入数字"
            }
        }
    });
});

</script>

    </head>
    <body>
        <div id="container">
            <div class="subtitle">欢迎使用会员支付</div>
            <form name="frm" id="frm" action="/vip/dopay" method="post">
                <div id="moneyrow"><input style="-webkit-appearance:none" name="money" id="money" placeholder="请输入支付金额" required number></input></div>
                <div id="pwdrow"><input style="-webkit-appearance:none" placeholder="请输入您的会员支付密码" type="password" id="password" name="password" required/></div>
                <div class="forget" onclick="location.href='/vip/forgetpwd'">忘记支付密码？</div>
                <input type="hidden" name="orderno" id="orderno" value=""/>
                <br>
                <div id="btnrow">
                    <input class="pay" type="submit" value="确认支付"/>
                    <div class="recharge" onclick="javascript:history.go(-1)">取消</div>
                    <div style="clear:both"></div>
                </div>
            </form>
        </div>
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="/images/mellbar_logo.png" width="120px"></div>
    </body>
</html>
