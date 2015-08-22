<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="telephone=no" name="format-detection" />
<title>魅而吧微信 - 订单详情</title>  
<style type="text/css"><!--  

body{font-family:"Microsoft Yahei","宋体","Tahoma",Arial;font-size:14px;margin:0;padding:0;color:black;background-color:#333333}
#topContainer{width: 100%;background-color: darkred;}
#container{width:100%;margin: auto; padding: auto}
.topbar{width: 960px;margin: auto;padding:auto;}
.topbar div{float: left; color: white;font-size: 16px;background-color: darkred; height: 80px;line-height: 80px}
#content{width:960px;background-color: #333333; margin: auto;padding:auto;}

.leftbar{width:200px;font-size:16px;float: left; text-align: center;color:black;line-height: 80px;}
.leftbar a:link{color: white;text-decoration: none;}
.leftbar a:visited{color: white;text-decoration: none; font-weight: bold}
.clear{clear:both;}
.rightbar{width:300px;line-height:20px;margin: auto;padding: auto;background-color: #ffffff; color: black; font-size: 14px; padding:20px 0;}
.rightbar p{padding:0 20px;margin: 8px 0}
.cancel{line-height: 30px;padding-left: 20px;text-align: center}
.allpay{float:left;}
.submitbtn{background-color:darkred;color:white;border:1px solid black;font-size: 10px;width:124px;height:24px;margin:10px 10px 0 0;-webkit-border-radius:8px;-webkit-appearance: none;}
.title{text-align: center;font-size: 18px;margin: 0 0 20px 0}
hr{border-top:1px solid #a6a6a6; border-bottom:0; margin: 20px 0; padding: 0}
.block{width:280px; float: left; text-align: right; cursor: pointer;background-color: #333333; height: 60px; color: white}
.c{border:1px solid red; width: 60px;float: right; height: 40px; line-height: 40px; text-align: center;}
--></style>
<script type="text/javascript">
function checkSubmit(status) {
    var r = confirm("您确定要修改该订单状态吗？");    
    if(!r) {
        return false;
    }
    document.getElementById('status').value = status;
    document.getElementById('form').submit();
}
function printpage(){ 
    var newstr = document.getElementById("ordercontent").innerHTML;
    // alert(newstr);
    var oldstr = document.body.innerHTML; 
    document.body.innerHTML = newstr; 
    window.print(); 
    document.body.innerHTML = oldstr; 
    return false; 
} 
</script>
    </head>
    <body>
        <form id="form" action="updateorder" action="get">
        <input type="hidden" value="" name="status" id="status"/>
            <div id="topContainer">
                <div class="topbar">
                    <div>@yield('orderno')</div>
                </div>

                <div class="clear"></div>
            </div>
		    <div id="container">
                <div id="content">
                    <div class="leftbar">
                        <div style="color:white;width:240px">操作员：@yield('admin')</div>
                        <div class="block" onclick="location.href='orders?type=NOT_FINISHED'"> <div class="c">返回 </div></div>
                        <div class="block" onclick="javascript:printpage()">  <div class="c">打印</div>  </div>
                        
                        <div class="clear"></div>
                    </div>
                    <div class="rightbar">
                        <div id="ordercontent">
                            <div class="title">订单信息</div>
                            @yield('orderDetail')
                            <hr>
                            @yield('foodContent')
                            <hr>
                            @yield('pay')
                            <hr>    
                            @yield('address')
                        </div>
                        <div class="cancel">
                        @yield('cancel')
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="clear"></div>
                </div>
            </div>
        </form>
        
    </body>
</html>