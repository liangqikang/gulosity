<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection" />
<title>魅尔吧 - 微信安全支付</title>  
<style type="text/css"><!--  

--></style>
<script type="text/javascript">
var a = @yield('orderno');
var b = @yield('pay_package');
var attach = @yield('attach');
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
    WeixinJSBridge.invoke('getBrandWCPayRequest', b,function(res){
        //WeixinJSBridge.log(res.err_msg);
        //alert(res.err_code+"||" + res.err_desc+"||"+res.err_msg);
        if(res.err_msg == "get_brand_wcpay_request:ok"){
            if(attach == '1'){
                alert("支付成功！我们会尽快送餐！");
            }else{
                alert("支付完成，充值成功！请查看您的余额。")
            }
        }else{
            if(attach == '1'){
                alert("支付失败！您可以在稍后的订单详情页继续支付！");
            }else{
                alert("支付失败！请您检查原因。或者重新充值");
            }
        }
        if(attach == '1'){
            location.replace("/order/orderdetail?orderno=" + a);
        }else{
            location.replace("/vip");
        }
        //}
    });
});

</script>

<body>
</body>
