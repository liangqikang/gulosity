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
.subtitle{text-align: center;font-size: 20px;margin:10px; color: white}
.msgcontent{height: 50px;  padding: 20px;font-size: 16px; color: white}
.btn{font-size: 18px; letter-spacing:8px; line-height:50px;color:red; height: 50px;width: 100%;text-align: center;background-color: white;border: 1px solid gray; }
--></style>
<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
WeixinJSBridge.call('hideToolbar');
});

</script>

    </head>
    <body>
        <div id="container">
            <div class="subtitle">操作结果</div>
            <div class="msgcontent" id="msg">
                @yield('msg')
            </div>
            @yield('confirmBtn')
        </div>
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="/images/mellbar_logo.png" width="120px"></div>
    </body>
</html>
