<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection" />
<meta http-equiv="refresh" content="15">
<title>魅尔吧微信</title>  
<script src="../static/jquery-1.7.2.min.js"></script>
<script src="../static/jquery.cookie.js"></script>
<style type="text/css"><!--  
body{font-family:"Microsoft Yahei","宋体","Tahoma",Arial;font-size:14px;margin:0;padding:0;color:white;background-color:#333333}
#topContainer{width: 100%;background-color: darkred;}
#container{width:100%;margin: auto; padding: auto}
.topbar{width: 960px;margin: auto;padding:auto;}
.topbar div{float: left; color: white;font-size: 16px;background-color: darkred;text-align: center; height: 80px;line-height: 80px}
#content{width:960px;background-color: #333333; margin: auto;padding:auto;}
.leftbar{width:200px;font-size:16px;float: left;border-right:1px solid #999999;background-color: #333333; text-align: center;color:black;line-height: 80px;background-color: #999999}
.leftbar div{padding-right: 10px;border-bottom: 1px solid #333333;cursor: pointer;text-align: left;padding-left: 20px}
.leftbar a:link{color: black;text-decoration: none;}
.leftbar a:visited{color: black;text-decoration: none; font-weight: bold}
.foodlist{float:left;background-color:#e6e6e6;color:black;padding-top: 10px}
.foodlist .row{clear:both; height:30px; line-height:30px;cursor: pointer;}
.foodlist .row div {float: left;}
.foodlist .last{border:0}
.type{padding-left: 0px;width:200px;;text-align: center}
.id{padding-left: 0px; width: 40px;text-align: center}
.no {padding-left:0px;width:180px;text-align: center}
.od {padding-left:0px;width:160px;text-align: center}
.st {padding-left: 0px; width: 120px;text-align: center}
.pay {padding-left: 0px; width: 120px;text-align: center}
.operator {width: 50px;text-align: center;padding-right: 30px}
hr{border-top:1px solid #a6a6a6; border-bottom:1px solid white; margin: 0; padding: 0}
.clear{clear:both;}
#n1,#n2,#n3,#n4,#n5{color:darkred;font-size: 18px}
.selected{background-color: #ffffff}
p{line-height: 40px}
--></style>
<script type="text/javascript">
$().ready(function(){
    var a = "@yield('type')";
    $("#" + a).addClass('selected');
    var count = "@yield('count')";
    if(count > 0){
        playSound();
    }
});
function playSound(){
    $('embed').remove();  
    $('body').append('<embed src="/static/567.wav" autostart="true" hidden="true" loop="true">'); 
}
</script>
    </head>
    <body>
        <div id="topContainer">
            <div class="topbar">
                <div class="type">订单内容分类</div>
                <div class="id">编号</div>
                <div class="no">订单号</div>
                <div class="od">订单时间</div>
                <div class="st">下单状态</div>
                <div class="pay">支付状态</div>
                <div class="operator">操作员</div>
            </div>
            <div class="clear"></div>
        </div>
        <div id="container">
            <div id="content">
                <div class="leftbar">
                    @yield('leftbar')
                    <div class="clear"></div>
                </div>

                <div class="foodlist">
                    
                    @yield('orderList')
                    
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </body>
</html>