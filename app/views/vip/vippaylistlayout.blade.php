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
.foodlist{background-color:#999999;color:black;border:1px solid black;margin:5px 0 5px 0;}
.foodlist .row{clear:both;}
.foodlist .row div {float: left;}
.foodlist .last{border:0}
.no {padding-left:10px;width:180px}
.st {padding-left: 10px; width:60px;}
hr{border-top:1px solid #666666; margin: 0; padding: 0}
.first{height: 60px; line-height: 60px; background-color: white;color: red}
.others{height:30px; line-height:30px;}
--></style>
<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
WeixinJSBridge.call('hideToolbar');
});

</script>

    </head>
    <body>
        <div id="container">
            <div class="subtitle">最近我的会员卡账单</div>
            <div class="foodlist">
                    
                @yield('orderList')
                
            </div>
        </div>
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="/images/mellbar_logo.png" width="120px"></div>
    </body>
</html>
