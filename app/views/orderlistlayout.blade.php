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
body{font-family:"Microsoft Yahei","宋体","Tahoma",Arial;font-size:14px;padding: 10px;color:white;background-color:darkred}
#container{width:100%;margin-bottom:40px}
.tips,.foodlist{background-color:white;color:black;border:1px solid black;margin:5px 0 5px 0;}
.tips{padding:15px 5px 15px 5px}
.foodlist{background-color:#e6e6e6;color:black;border:1px solid black;margin:5px 0 5px 0;}
.foodlist .row{clear:both;}
.foodlist .row div {float: left;}
.foodlist .last{border:0}
.no {padding-left:10px;width:120px}
.st,.pay {padding-left: 10px; width:60px;}
hr{border-top:1px solid #a6a6a6; border-bottom:1px solid white; margin: 0; padding: 0}
.first{height: 60px; line-height: 60px; background-color: white}
.others{height:30px; line-height:30px;}
--></style>

    </head>
    <body>
        <div id="container">
            <div id="rice">
                <div class="subtitle">我的最新订单</div>
                <div class="foodlist">
                    
                    @yield('orderList')
                    
                </div>
            </div>
        </div>
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="images/mellbar_logo.png" width="120px"></div>
    </body>
</html>