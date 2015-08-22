
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection" />
<title>魅尔吧</title>  
<link rel="stylesheet" type="text/css" href="static/common.css">
<link rel="stylesheet" type="text/css" href="static/menu.min.css?v=2">
<script src="static/jquery-1.7.2.min.js"></script>
<script src="static/jquery.cookie.min.js"></script>
<script src="static/jquery.lazyload.js"></script>
<script src="static/json2.min.js"></script>
<script src="static/menu.min.js?id=6"></script>
    </head>
    <body>
        
        <div id="container"> 
            
            <div id="topbar">
                <div id="taofan_t" onclick="javascript:tab('taofan')">套&nbsp;&nbsp;饭</div>
                <div id="mixian_t" onclick="javascript:tab('mixian')">米&nbsp;&nbsp;线</div>
                <div id="yinpin_t" onclick="javascript:tab('yinpin')">饮&nbsp;&nbsp;品</div>
            </div> 

            <form action="/order/choose" id="form" method="get">
                <a name="taofan_a"></a>  
                <div>
                    <div>温馨提示：</div>
                    <div class="tips">望京范围内可配送，满30元起免费送餐！</div>
                    <!-- <a href="clears"> clear session </a> -->
                </div>
                @yield('riceContent')
                @yield('noodleContent')
                @yield('drinkContent')
                </div>
                <div id="totalprice">

                        <div id="tprice"><span id="allcount">0</span>盒  ￥<span id="allprice">0</span>元</div>
                        <div id="nextstep"><input id="next11" type="button" onClick="javascript:checkSubmit()" value="下一步"/></div>
                </div>
            </form>
        </div>
        @yield('plusRow')
        <div style="text-align:center;margin: 20px 0 60px 0; height: 60px; line-height: 60px"><img src="images/mellbar_logo.png" width="120px"></div>
    </body>
</html>