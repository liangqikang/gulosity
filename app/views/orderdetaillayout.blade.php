<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection" />
<title>魅尔吧 - 订单详情</title>  
<style type="text/css"><!--  
body{margin: 0;padding: 0 10px;background-color: darkred;font-family:"Microsoft Yahei","宋体","Tahoma",Arial;font-size:14px;}
#container{ width:300px;font-size:14px;margin:10px auto;color:black;background-color:white;padding: 0 0 50px 0}
.tips{padding: 0; margin: 0 0 40px 0; height: 40px; line-height: 40px; color: white;background-color: darkred}
p{line-height: 16px; margin: 10px 20px}
#submitbtn,#pay1,#pay2,#pay3{background-color:#cccccc;color:#525252;border:1px solid #999999;width:70px;height:20px; line-height:14px;-webkit-border-radius:0px;-webkit-appearance: none;}
hr{border-top:1px solid #a6a6a6; border-bottom:0; margin: 20px 0; padding: 0}

--></style>
<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
WeixinJSBridge.call('hideToolbar');
});
function checkSubmit() {
    var r = confirm("您确定要取消该订单吗？");    
    if(!r) {
        return false;
    }
    document.getElementById('form').submit();
}
function gopay(paytype) {
    var r;
    if(paytype==1){
        r = confirm("您确定要改为货到付款吗？");    
    }else if (paytype == 2){
        r = confirm("您确定要继续微信支付吗？");    
    }else if (paytype == 3){
        r = confirm("您确定要会员支付吗？");    
    }
    if(!r) {
        return false;
    }
    var orderno = @yield('orderno');
    location.href="/order/payagain?orderno=" + orderno + "&paytype=" + paytype;
}
</script>
    </head>
    <body>
        <form id="form" action="cancelorder" action="get">
        <div id="container">
            <div class="tips">感谢订餐，我们会在50分钟内送达您手中de！</div>
            
            @yield('orderDetail')
            <hr>
            @yield('foodContent')
            <hr>
            @yield('pay')
            <hr>    
            @yield('address')
        </div>
        </form>
        <div style="text-align:center;margin: 20px 0; height: 60px; line-height: 60px"><img src="../images/mellbar_logo.png" width="120px"></div>
        
    </body>
</html>