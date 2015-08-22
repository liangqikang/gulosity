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
.subtitle{text-align: center;font-size: 18px;margin:10px;}
.content{background-color: white; padding: 0;color:black;}
.p{padding: 20px; line-height: 24px; font-size: 16px}

hr{border-top:1px solid #a6a6a6; border-bottom:1px solid white; margin: 0; padding: 0}
.name{font-size: 16px; margin-bottom: 20px}
.phone{cursor: pointer; font-size: 14px;margin-bottom: 20px; background-image: url("images/phone.png");background-size: 24px; background-repeat: no-repeat; padding-left: 30px}
.address{cursor: pointer; font-size: 14px;margin-bottom: 20px; background-image: url("images/addr.png");background-size: 24px; background-repeat: no-repeat; padding-left: 30px}
.phone a:link{color: black; }
.phone a:visited{color: black}
#vipcard {height:180px; margin-top: 10px; line-height: 270px; text-align: center; color: black; background-image: url("images/vipcard.png"); background-repeat: no-repeat;}
#btnrow{cursor: pointer; width: 100%; margin-bottom: 20px;clear: both;margin-top: 10px;}
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
            <div class="subtitle">欢迎充值会员卡</div>
            <div id="types">
                <select name="money">
                    <option>请选择充值金额</option>
                    <option value="300">充300送30元</option>
                    <option value="500">充500送50元</option>
                    <option value="1000">充1000送100元</option>
                </select>
            </div>
            <div id="pwdrow"><input placeholder="请输入您的会员支付密码" type="password" name="password"></div>
            <div id="btnrow">
                <div class="pay" onclick="vippay"><font style="font-size: 20px;letter-spacing:8px">确认支付</font></div>
                <div class="recharge" onclick="javascript:history.go(-1)">取消</div>
                <div style="clear:both"></div>
            </div>
        </div>
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="images/mellbar_logo.png" width="120px"></div>
    </body>
</html>
