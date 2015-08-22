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
#pwdrow{width: 276px; padding: 0}
#pwdrow input{height: 34px;width: 100%; margin-top: 10px; border: 1px solid #666666; padding-left: 10px; font-size: 16px;border-radius: 0}
.forget{width: 100%;text-align: right; padding: 5px 0 0 0;color: white}
.selectstyle{width: 284px; padding-left: 10px; height: 40px; border:1px solid #666666; background: url("/images/selectarrow.jpg") no-repeat 250px;background-size: 44px; background-color: white }

--></style>
<script src="/static/jquery-1.7.2.min.js"></script>
<script src="/static/jquery.validate.min.js"></script>
<script src="/static/messages_zh.min.js"></script>

<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
WeixinJSBridge.call('hideToolbar');
});
$().ready(function() {

    $("#frm").validate();
});

</script>

    </head>
    <body>
        <div id="container">
            <div class="subtitle">欢迎充值会员卡</div>
            <form name="frm" id="frm" action="/vip/dorecharge" method="post">
                <div class="selectstyle">
                    <select id="money" name="money" style="height:40px; font-size:16px; width: 280px;-webkit-appearance:none;background:transparent;border:none" required>
                        <option>请选择充值金额</option>
                        <option value="330">充300送20元</option>
                        <option value="550">充500送50元</option>
                        <option value="1200">充1000送120元</option>
                    </select>
                </div>
                <div id="pwdrow"><input style="-webkit-appearance:none" required placeholder="请输入您的会员支付密码" type="password" name="password"></div>
                <div class="forget" onclick="location.href='/vip/forgetpwd'">忘记支付密码？</div>
                <br>
                <div id="btnrow">
                    <input class="pay" type="submit" value="确认充值"/>
                    <div class="recharge" onclick="javascript:history.go(-1)">取消</div>
                    <div style="clear:both"></div>
                </div>
            </form>
        </div>
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="/images/mellbar_logo.png" width="120px"></div>
    </body>
</html>
