
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection" />
<title>魅尔吧微信 - 大转盘</title>  
<style type="text/css"><!--  
body{margin: 0;padding: 0 10px;background-color: darkred;font-family:"Microsoft Yahei","宋体","Tahoma",Arial;font-size:14px;}

#container{
    width:300px;margin:0;color:#f0f0f0;background-color:darkred;
    margin: 60px auto 10px auto;}
#topbar{margin: 0 auto; width: 100%; height: 50px;line-height:50px; clear: both;background-color: #410000; position:fixed; top:0; left:0;right: 0}
#topbar div{float:left; width:100px;padding-left: 5px; color: white; font-size: 18px; text-align: center; line-height: 50px}
#topbar img{vertical-align: middle;}
.tips,.foodlist{background-color:white;color:black;border:1px solid black;margin:5px 0 5px 0;}
.tips{padding:15px 5px 15px 10px}
.foodlist{padding:0}
.foodlist .row{clear:both; height:85px; line-height:82px;}
.foodlist .row div {float: left;}
.foodlist .last{border:0}
.row img{vertical-align: middle}
.foodname{padding-left:5px;width:90px;}
.ename{font-size: 8px;line-height: 10px; width: 70px;overflow: auto}
.mxe{width: 66px;}
.tf{padding-top: 28px; height: 57px}
.mx1{padding-top: 32px; height: 53px}
.foodprice{padding-left:5px;line-height: 20px;width:83px; overflow: auto;font-size: 15px}
.foodprice p{margin: 0}
.yuan{width:40px; text-align: right; padding-right: 8px;line-height: 20px; font-size: 15px}
#totalprice {margin: 0 auto;color: white;line-height:30px; padding:10px 10px 10px 10px; clear:both;width:100%;background-color:#410000; position:fixed; bottom:0; left:0;right:0;opacity: 0.9;}
#totalprice div{float:left}
#tprice{width:65%;padding-left: 20px}
#next{background-color:darkred;border:0;width:60px;height:30px;color: white;-webkit-border-radius:3px;-webkit-appearance: none;}
.reduce{text-align: right;font-size:18px; display:none;-webkit-border-radius:13px; width: 26px; height: 26px; margin: 30px 0 0 0; background-color: red; color: white; font-weight: bold; text-align: center; vertical-align: middle; line-height: 24px}
.count{margin-left: 8px; font-size:18px;-webkit-border-radius:3px; margin-top:30px;  border:1px solid #999999; background-color: #CCCCCC; width: 25px; height: 25px;line-height: 25px;text-align: center}
.red{background-color: red; color: white; border: 1px solid red}
.darkred{background-color: darkred; color: white;}
hr{border-top:1px solid #a6a6a6; border-bottom:1px solid white; margin: 0; padding: 0;}
.target{position: relative;top: -60px;display: block;height: 0;overflow: hidden;}
--></style>
<script type="text/javascript">
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
WeixinJSBridge.call('hideToolbar');
});
function selectFood(id, price) {
    var i = parseInt(document.getElementById(id).innerHTML);
    var x;
    if(isNaN(i)) {
        x = 1;
    }else {
        x = i + 1;
    }
    document.getElementById(id).innerHTML = x;
    document.getElementById(id).className = "count red";
    document.getElementById(id+"-reduce").style.display = "block";
    document.getElementById("food-" + id).value = x;
    var c = parseInt(document.getElementById("allcount").innerHTML);
    var p = parseInt(document.getElementById("allprice").innerHTML);
    document.getElementById("allcount").innerHTML = c + 1;
    document.getElementById("allprice").innerHTML = p + price;
}
function reduce(id, price) {
    var i = parseInt(document.getElementById(id).innerHTML);
    if(i == 0 || isNaN(i)) {
        return;
    }
    var x;
    if(i == 1) {
        x = "";
        document.getElementById(id).className = "count";
        document.getElementById(id+"-reduce").style.display = "none";  
    }else {
        x = i - 1;
    }
    document.getElementById(id).innerHTML = x;
    document.getElementById("food-" + id).value = x;
    var c = parseInt(document.getElementById("allcount").innerHTML);
    var p = parseInt(document.getElementById("allprice").innerHTML);
    document.getElementById("allcount").innerHTML = c - 1;
    document.getElementById("allprice").innerHTML = p - price;
}
function checkSubmit() {
    // alert(document.getElementById('allprice').innerHTML);
    if(parseInt(document.getElementById('allprice').innerHTML) < 35) {
        alert('抱歉，满35元起送！');
        return false;
    }
    document.getElementById('next').value="下单中";
    document.getElementById('next').disabled = "disabled";    
    document.getElementById('form').submit();
}
var tabs = ['taofan', 'mixian', 'yinpin'];
function tab(t) {
    for(var i=0; i < tabs.length; i++) {
        if(t == tabs[i]) {
            location.hash = tabs[i] + "_a";   
            // document.getElementById(tabs[i] + "_t").className="darkred";
        }
        // else {
        //     document.getElementById(tabs[i] + "_t").className="";
        // }
    }
}
</script>
    </head>
    <body>
        
        <div id="container"> 
            
            <div id="topbar">
                <div id="taofan_t" onclick="javascript:tab('taofan')">套&nbsp;&nbsp;饭</div>
                <div id="mixian_t" onclick="javascript:tab('mixian')">米&nbsp;&nbsp;线</div>
                <div id="yinpin_t" onclick="javascript:tab('yinpin')">饮&nbsp;&nbsp;品</div>
            </div>        
            <form action="order" id="form" method="get">
                <a name="taofan_a"></a>  
                <div>
                    <div>温馨提示：</div>
                    <div class="tips">满35元起送，配送范围暂开放望京。</div>
                    <!-- <a href="clears"> clear session </a> -->
                </div>
                @yield('riceContent')
                @yield('noodleContent')
                @yield('drinkContent')
                </div>
                <div id="totalprice">

                        <div id="tprice"><span id="allcount">0</span>盒  ￥<span id="allprice">0</span>元</div>
                        <div id="nextstep"><input id="next" type="button" onClick="javascript:checkSubmit()" value="下一步"/></div>
                </div>
            </form>
        </div>
        <div style="text-align:center;margin: 10px 0 60px 0; height: 60px; line-height: 60px; color: white">魅尔吧微信</div>
    </body>
</html>