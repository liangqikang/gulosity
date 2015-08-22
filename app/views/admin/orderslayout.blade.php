<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection" />
<title>魅尔吧微信</title>  
<style type="text/css"><!--  
body{font-family:"Microsoft Yahei","宋体","Tahoma",Arial;font-size:14px;padding: 10px;color:white;background-color:darkred}
#container{width:100%;margin-bottom:40px}
.tips,.foodlist{background-color:white;color:black;border:1px solid black;margin:5px 0 5px 0;}
.tips{padding:15px 5px 15px 5px}
.foodlist{background-color:#e6e6e6;color:black;border:1px solid black;margin:5px 0 5px 0;}
.foodlist .row{clear:both; height:30px; line-height:30px;}
.foodlist .row div {float: left;}
.foodlist .last{border:0}
.no {padding-left:10px;width:40%}
.st .pay {padding-left: 10px}
hr{border-top:1px solid #a6a6a6; border-bottom:1px solid white; margin: 0; padding: 0}

--></style>

    </head>
    <body>
        <div id="container">
            <div>
                <div>提示</div>
                <div class="tips">魅儿吧1公里内免费送餐，欢迎点餐。</div>
            </div>
            <div id="rice">
                <div class="subtitle">订单列表</div>
                <div class="foodlist">
                    
                    @yield('orderList')
                    
                </div>
            </div>
        </div>
    </body>
</html>